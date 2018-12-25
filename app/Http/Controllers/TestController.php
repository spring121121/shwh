<?php
/**
 * Created by PhpStorm.
 * User: shiminmin
 * Date: 18-12-23
 * Time: 下午4:30
 */


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\models\UserModel;

class TestController extends BaseController
{

    /**
     * 显示指定用户的个人数据。
     *
     * @param  int $id
     * @return Response
     */
    public function userAdd()
    {


    $userModel = new UserModel();
    $userModel->name = "smm2";
    $userModel->save();
        //return view('user.profile', ['user' => User::findOrFail($id)]);
    }

    /**
     * e.g 接参 && 校验
     * 接参 文档：https://laravel-china.org/docs/laravel/5.2/requests/1102
     * 校验 文档：https://laravel-china.org/docs/laravel/5.2/validation/1135
     * @param Request $request
     * @param $id
     */
    public function testRequest(Request $request, $id)
    {

        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',

        ]);
        echo $id;
    }

    /**
     * e.g HTTP  JSON 响应
     * 文档：https://laravel-china.org/docs/laravel/5.2/responses/1103
     */
    public function testResponse(Request $request)
    {

        $data = [];//data 是返回的内容 格式为数组
        return $this->success($data);
        //默认的错误编码的内容在config/errorcode.php中
        //调用fail方法默认不用带第三个参数，会自动去errorcode.php文件去解析响应code码的含义
        //传了第三个参数直接返回msg信息
        return $this->fail(300, $data);
        return $this->fail(300, $data, $msg = '');
    }
    public function getOpenId($url){
        layout(false);
        if(!$_SESSION['openid']){
            if($_GET['code']){
                $code = $_GET['code'];
                $result =  file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx1ef69d837c12a709&secret=b472d909c749a61ca9904d835d2ec2f3&code=".$code."&grant_type=authorization_code");
                $jsondecode = json_decode($result); //对JSON格式的字符串进行编码
                $array = get_object_vars($jsondecode);//转换成数组
                $openid = $array['openid'];//输出openid
                return $openid;
            }else{
                $url = urlencode($url);
                header("Location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx1ef69d837c12a709&redirect_uri=$url&response_type=code&scope=snsapi_base&state=123#wechat_redirect");
            }
        }
    }

    public function index(){
        layout(false);
        $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
        $openid = $this->getOpenId($url);

        $where['id'] = $_GET['vid'];
        //$where['etime'] = array('gt',time());
        $code = M('Voucher') -> where($where) -> getField('code');

        $whereLog['code'] = $code;
        $whereLog['openid'] = $openid;
        $log = M('VoucherLog') -> where($whereLog) -> find();

        if(!$log['id']){
            $a = '1';
            $this->assign('a',$a);
        }

        $this->assign('code',$code);
        $this->display();
    }


}