<?php
/**
 * Created by PhpStorm.
 * User: JHR
 * Date: 2019/1/11
 * Time: 11:02
 */
namespace App\Http\Controllers;

class WxpayController extends BaseController {

    public $config = [];

    public function __construct()
    {
        $this->config = [
            'appid' => 'wx1dc64acc9bd9eb09',
            'app_secret' => '18030345ebbbc089f628a5eb1db5cda3',
            'mch_id' => '1490402642',
            'appkey' => 'TIANJINTAOCIYUAN20190111SHWHCOPY',
            'sslcert_path' => '/var/www/html/public/cert/apiclient_cert.pem',
            'sslkey_path' => '/var/www/html/public/cert/apiclient_key.pem'
        ];
    }

    public function pay() {
        $appid = $this->config['appid'];
        $secret = $this->config['app_secret'];
        $mch_id = $this->config['mch_id'];
        if(!isset($_GET['code'])){
            $_GET['order_sn'] = $this->genOrderSn('');
            $redirect_uri=urlencode("http://".$_SERVER['HTTP_HOST']."/pay?order_sn=" . $_GET['order_sn']);
            $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_base&state=1#wechat_redirect";
            header("Location:".$url);
            exit();
        }else {
            /*-------------获取OPENID开始-------------*/
            $code = $_GET["code"];
            $order_sn = $_GET['order_sn'];
            /*--------------验证订单号---------------*/

            $get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appid . '&secret=' . $secret . '&code=' . $code . '&grant_type=authorization_code';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $get_token_url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            $res = curl_exec($ch);
            curl_close($ch);
            $json_obj = json_decode($res, true);
            $openid = $json_obj['openid'];
            $arr = [
                'appid' => $appid,
                'mch_id' => $mch_id,
                'nonce_str' => $this->randomkeys(32),
                'sign_type' => 'MD5',
                'body' => '山洞-测试',
                'out_trade_no' => $order_sn,
                'total_fee' => 1,
                'spbill_create_ip' => $_SERVER['REMOTE_ADDR'],
                'notify_url' => "http://" . $_SERVER['HTTP_HOST'] . "/notify",
                'trade_type' => 'JSAPI',
                'openid' => $openid
            ];
            $arr['sign'] = $this->getSign($arr);
            $url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
            $result = $this->curl_post_data($url, $this->array2xml($arr));
            $result = $this->xml2array($result);
            /*--------------微信统一下单--------------*/
            if ($result['return_code'] == 'SUCCESS' && $result['result_code'] == 'SUCCESS') {
                    $result['timestamp'] = time();
                    $arr2['appId'] = $arr['appid'];
                    $arr2['timeStamp'] = $result['timestamp'];
                    $arr2['nonceStr'] = $arr['nonce_str'];
                    $arr2['signType'] = $arr['sign_type'];
                    $arr2['package'] = 'prepay_id=' . $result['prepay_id'];
                    $arr2['paySign'] = $this->getSign($arr2);

                    return view('pay',['prepay'=>$arr2]);

            } else {
                echo '<script>alert("sys error");document.addEventListener("WeixinJSBridgeReady", function(){ WeixinJSBridge.call("closeWindow"); }, false);</script>';
            }
        }
    }

    public function weixinRefund() {
        $arr = [
            'appid' => $this->config['appid'],
            'mch_id'=> $this->config['mch_id'],
            'nonce_str'=>$this->randomkeys(32),
            'sign_type'=>'MD5',
            'transaction_id'=> '4200000253201901120328912492',
            'out_trade_no'=> '154727325783479000',
            'out_refund_no'=> $this->genOrderSn(),
            'total_fee'=> 3,
            'refund_fee'=> 1,
            'refund_fee_type'=> 'CNY',
            'refund_desc'=> '退款',
            'notify_url'=> 'http://'.$_SERVER['HTTP_HOST'].'/refundNotify',
        ];
        $arr['sign'] = $this->getSign($arr);
        $url = 'https://api.mch.weixin.qq.com/secapi/pay/refund';
        $res = $this->curl_post_datas($url,$this->array2xml($arr),true);
        if($res['return_code'] == 'SUCCESS') {
            if($res['result_code'] == 'SUCCESS') {
                halt($res);
            }else {
                halt($res);
            }
        }else {
            die('退款通知失败');
        }
    }

    public function notify() {
        //将返回的XML格式的参数转换成php数组格式
        $xml = file_get_contents('php://input');
        $data = $this->xml2array($xml);
        if($data) {
            $this->log('notify',var_export($data,true));
            if($data['return_code'] == 'SUCCESS' && $data['result_code'] == 'SUCCESS') {
//                $map = [
//                    ['order_sn','=',$data['out_trade_no']],
//                    ['pay_status','=',0],
//                ];
//                $exist = Db::table('mp_req')->where($map)->find();
//                if($exist) {
//                    $update_data = [
//                        'pay_status' => 1,
//                        'trans_id' => $data['transaction_id'],
//                        'pay_time' => time(),
//                    ];
//                    try {
//                        Db::table('mp_req')->where('order_sn','=',$data['out_trade_no'])->update($update_data);
//                    } catch (\Exception $e) {
//                        $this->log('notify',$e->getMessage());
//                    }
//                }

            }else if($data['return_code'] == 'SUCCESS' && $data['result_code'] != 'SUCCESS'){
                $data['out_trade_no'] = '支付失败';
            }
//            try {
//                $order_sn = isset($data['out_trade_no']) ? $data['out_trade_no'] : '';
//                Db::table('paylog')->insert(['order_sn'=>$order_sn,'detail'=>json_encode($data),'type'=>1]);
//            }catch (\Exception $e) {
//                $this->log($e->getMessage());
//            }
        }
        exit($this->array2xml(['return_code'=>'SUCCESS','return_msg'=>'OK']));
//        $file= 'notify.txt';
//        $text='[Time ' . date('Y-m-d H:i:s') ."] ".var_export(['username'=>'姜海蕤','age'=>27,'gender'=>1],true)."\n---END---" . "\n";
//        if(false !== fopen($file,'a+')){
//            file_put_contents($file,$text,FILE_APPEND);
//        }else{
//            echo '创建失败';
//        }
    }

    public function refundNotify() {
        //将返回的XML格式的参数转换成php数组格式
//        $xml = file_get_contents('php://input');
//        $data = $this->xml2array($xml);
//        if($data) {
//            $this->log('refundNotify',var_export($data,true));
//        }
        exit($this->array2xml(['return_code'=>'SUCCESS','return_msg'=>'OK']));
    }

    private function log($cmd = '',$msg = '') {
        $file= 'notify.txt';
        $text='[Time ' . date('Y-m-d H:i:s') ."]  cmd:".$cmd."\n".$msg."\n---END---" . "\n";
        if(false !== fopen($file,'a+')){
            file_put_contents($file,$text,FILE_APPEND);
        }else{
            echo '创建失败';
        }
    }

//生成签名
    private function getSign($arr)
    {
        //去除数组中的空值
        $arr = array_filter($arr);
        //如果数组中有签名删除签名
        if(isset($arr['sing']))
        {
            unset($arr['sing']);
        }
        //按照键名字典排序
        ksort($arr);
        //生成URL格式的字符串
        $str = http_build_query($arr)."&key=" . $this->config['appkey'];
        $str = $this->arrToUrl($str);
        return  strtoupper(md5($str));
    }
    //URL解码为中文
    private function arrToUrl($str)
    {
        return urldecode($str);
    }

    private function curl_post_data($url, $curlPost)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        curl_setopt($ch, 1, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $data = curl_exec($ch);
        return $data;
    }

    private function curl_post_datas($url, $curlPost,$userCert = false)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        if($userCert == true){
            //设置证书
            //使用证书：cert 与 key 分别属于两个.pem文件
            curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
            curl_setopt($ch,CURLOPT_SSLCERT, $this->config['sslcert_path']);
            curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
            curl_setopt($ch,CURLOPT_SSLKEY, $this->config['sslkey_path']);
        }
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        curl_setopt($ch, 1, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $data = curl_exec($ch);
        $arr = $this->xml2array($data);
        return $arr;
    }


    private function array2xml($arr) {
        if(!is_array($arr) || count($arr) <= 0) {
            return false;
        }
        $xml = "<xml>";
        foreach ($arr as $key=>$val)
        {
            if (is_numeric($val)){
                $xml.="<".$key.">".$val."</".$key.">";
            }else{
                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
            }
        }
        $xml.="</xml>";
        return $xml;
    }

    private function xml2array($xml)
    {
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $values;
    }

    private function genOrderSn($letter = '') {
        $time = explode (" ", microtime ());
        $timeArr = explode('.',$time [0]);
        $mtime = array_pop($timeArr);
        $fulltime = $letter.$time[1].$mtime;
        return $fulltime;
    }

    private function randomkeys($length) {
        $returnStr='';
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for($i = 0; $i < $length; $i ++) {
            $returnStr .= $pattern {mt_rand ( 0, 61 )};
        }
        return $returnStr;
    }

}