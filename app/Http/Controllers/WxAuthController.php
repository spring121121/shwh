<?php
/**
 * Created by PhpStorm.
 * User: JHR
 * Date: 2019/1/11
 * Time: 11:02
 */
namespace App\Http\Controllers;
use App\models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use App\models\StoreModel;
use App\Http\Services\UserService;
use Jssdk;
class WxAuthController extends BaseController {

    public function share() {
        $jssdk = new Jssdk($this->config['appid'], $this->config['app_secret']);
        $data = $jssdk->getSignPackage();
        return view('share',['data'=>$data]);
    }

    public function getAddress(Request $request) {
        $param = $request->all();
        if(isset($param['goods_id']) && isset($param['num'])) {
            $query = http_build_query($param);
            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/wap/shop_purchase?' . $query;
        }else {
            $url = 'http://' . $_SERVER['HTTP_HOST'] . '/wap/my_address';
        }
        $jssdk = new Jssdk($this->config['appid'], $this->config['app_secret']);
        $data = $jssdk->getSignPackage();
        return view('personal/new-address',['addrSign'=>$data,'origin'=>urlencode($url)]);
    }

    public function getLocation() {
        $jssdk = new Jssdk($this->config['appid'], $this->config['app_secret']);
        $data = $jssdk->getSignPackage();
        return view('location',['data'=>$data]);
    }

    /**
     * 1、获取微信用户信息，判断有没有code，有使用code换取access_token，没有去获取code。
     * @return array 微信用户信息数组
     */
    public function auth(Request $request){
        if (!isset($_GET['code'])){ //没有code，去微信接口获取code码
            $callback = 'http://'.$_SERVER['HTTP_HOST'] . '/wx/auth';//微信服务器回调url
            $this->get_code($callback);
        } else {    //获取code后跳转回来到这里了
            $code = $_GET['code'];
            $data = $this->get_access_token($code);//获取网页授权access_token和用户openid

            $data_all = $this->get_user_info($data['access_token'],$data['openid']);//获取微信用户信息
            $openid = $data_all['openid'];

            $user_exist = UserModel::where("openid",$openid)->get()->toArray();
            if($user_exist) {
                $data_all['id'] = $user_exist[0]['id'];
                $data_all['grade_name'] = UserService::getGrade($user_exist[0]['score']);
                $store_id = StoreModel::where('uid', $data_all['id'])->select('id', 'status')->first();
                if ($store_id) {
                    $data_all['store_id'] = $store_id['id'];
                    $data_all['store_status'] = $store_id['status'];
                } else {
                    $data_all['store_id'] = 0;
                    $data_all['store_status'] = 3;//写死
                }

            }else {
                $info = UserModel::create(['openid'=>$openid,'photo'=>$data_all['headimgurl'],'nickname'=>$data_all['nickname']]);
                $data_all['id'] = $info->id;
//                $user = new UserModel();
//                $user->openid = $openid;
//                $user->save();
//                $data_all['uid'] = $user->id;
                $data_all['grade_name'] = UserService::getGrade(0);
                $store_id = StoreModel::where('uid', $data_all['id'])->select('id', 'status')->first();
                if ($store_id) {
                    $data_all['store_id'] = $store_id['id'];
                    $data_all['store_status'] = $store_id['status'];
                } else {
                    $data_all['store_id'] = 0;
                    $data_all['store_status'] = 3;//写死
                }
            }
            $userinfo = $request->session()->get('userInfo');
            if(!$userinfo) {
                $userinfo = [];
            }
            $userinfo = array_merge($userinfo,$data_all);
            $userinfo['photo'] = $userinfo['headimgurl'];
            $request->session()->put('userInfo',$userinfo);
            Cookie::queue('info',$userinfo,120);
//            return view("test",Cookie::get('info'));
            return redirect("wap/personal");
        }

    }
    /**
     * 2、用户授权并获取code
     * @param string $callback 微信服务器回调链接url
     */
    private function get_code($callback){
        $appid = $this->config['appid'];
        $scope = 'snsapi_userinfo';
        $state = md5(uniqid(rand(), true));//唯一ID标识符绝对不会重复
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=' . urlencode($callback) .  '&response_type=code&scope=' . $scope . '&state=' . $state . '&connect_redirect=1#wechat_redirect';
        header("Location:".$url);exit;
    }
    /**
     * 3、使用code换取access_token
     * @param string 用于换取access_token的code，微信提供
     * @return array access_token和用户openid数组
     */
    private function get_access_token($code){
        $appid = $this->config['appid'];
        $appsecret = $this->config['app_secret'];
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $appid . '&secret=' . $appsecret . '&code=' . $code . '&grant_type=authorization_code';
        $user = json_decode(file_get_contents($url));
        if (isset($user->errcode)) {
            if($user->errcode == '40163') {
                echo 'Code been used!!!';exit;
            }
            echo 'error:' . $user->errcode.'<hr>msg :' . $user->errmsg;exit;
        }
        $data = json_decode(json_encode($user),true);//返回的json数组转换成array数组
        return $data;
    }
    /**
     * 4、使用access_token获取用户信息
     * @param string access_token
     * @param string 用户的openid
     * @return array 用户信息数组
     */
    private function get_user_info($access_token,$openid){
        $url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $access_token . '&openid=' . $openid . '&lang=zh_CN';
        $user = json_decode(file_get_contents($url));
        if (isset($user->errcode)) {
            echo 'error:' . $user->errcode.'<hr>msg  :' . $user->errmsg;exit;
        }
        $data = json_decode(json_encode($user),true);//返回的json数组转换成array数组
        return $data;
    }


}