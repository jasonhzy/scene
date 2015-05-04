<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
	
    public function check(){
		if(intval(session('userid'))>0)
		{
			header('Content-type: text/json');
			header('HTTP/1.1 200 ok');
			cookie('USERID',session('userid'));
			cookie('MD5STR',session('md5str'));
			echo '{"success":true,"code":200,"msg":"操作成功","obj":{"id":"'.session('userid').'","loginName":"'.session('username').'","md5str":"'.session('md5str').'","xd":0,"sex":1,"phone":null,"tel":null,"qq":null,"headImg":"","idNum":null,"idPhoto":null,"regTime":1423645215000,"name":"'.session('username').'","email":null,"type":0,"status":0,"relType":null,"roleIdList":[]},"map":null,"list":null}';
		}
		else
		{
			header('Content-type: text/json');
			header('HTTP/1.1 401 Unauthorized');
			echo json_encode(array("success" => false,"code"=> 1001,"msg" => "请先登录!","obj"=> null,"map"=> null,"list"=> null));
		}
    }
	
    public function login(){
		if (IS_POST && intval(session('userid'))==0) {
			$datas = $_POST;
			$userinfo['password_varchar'] = md5($datas['password']);
			$userinfo['email_varchar'] = $datas['username'];
			
			$User = M('users');
			$returnInfo=$User->where($userinfo)->select();
			if($returnInfo)
			{
			    if(date("Y-m-d",time())>$returnInfo[0]["limit_time"]){
			        header('Content-type: text/json');
			        header('HTTP/1.1 200 ok');
					
			        echo json_encode(array("success" => false,"code"=> 1004,"msg" => "用户已过期","obj"=> null,"map"=> array("isValidateCodeLogin"=>false),"list"=> null,"limit_time"=>$returnInfo[0]["limit_time"]));
			    }else{
					
			        session('userid',$returnInfo[0]["userid_int"]);
			        session('username',$returnInfo[0]["email_varchar"]);
			        session('scene_times',$returnInfo[0]["scene_times"]);
			        session('email',$returnInfo[0]["email_varchar"]);
			        session('md5str',md5('adklsj[]999875sssee,'.$returnInfo[0]["id"]));
			        cookie('USERID',$returnInfo[0]["userid_int"]);
			        cookie('MD5STR',md5('adklsj[]999875sssee,'.$returnInfo[0]["id"]));
			        header('HTTP/1.1 200 ok');
			        echo json_encode(array("success" => true,"code"=> 200,"msg" => "success","obj"=> null,"map"=> null,"list"=> null,"now_time"=>date("Y-m-d H:i:s",time()),"limit_time"=>$returnInfo[0]["limit_time"],"scene_times"=>$returnInfo[0]["scene_times"]));
			    }
								
			}
			else
			{
				header('Content-type: text/json');
				header('HTTP/1.1 200 ok');
				echo json_encode(array("success" => false,"code"=> 1005,"msg" => "密码错误","obj"=> null,"map"=> array("isValidateCodeLogin"=>false),"list"=> null));
				
			}
		}
    }

	
    public function register(){
		if (IS_POST) {
			$datas = $_POST;
			$userinfo['password_varchar'] = md5($datas['password']);
			$userinfo['email_varchar'] = $datas['email'];
			$userinfo['create_time'] = date('y-m-d H:i:s',time());
			$userinfo['last_time'] = date('y-m-d H:i:s',time());
			$userinfo['createip_varchar'] = get_client_ip();
			$userinfo['lastip_varchar'] = get_client_ip();
			
			
			$User1 = M('users');
			
			$map['email_varchar'] = $userinfo['email_varchar'];
			$returnInfo = $User1->where($map)->select();
			
			//$returnInfo=$User->add($userinfo);
			if(!$returnInfo)
			{
				$User = M('users');
				$User->add($userinfo);
				header('HTTP/1.1 200 ok');
				echo '{"success":true,"code":200,"msg":"操作成功","obj":null,"map":null,"list":null}';
				
			}
			else
			{
				header('Content-type: text/json');
				header('HTTP/1.1 200 ok');
				echo json_encode(array("success" => false,"code"=> 1006,"msg" => "帐号重复","obj"=> null,"map"=> array("isValidateCodeLogin"=>false),"list"=> null));
				
			}
		}
    }


    public function logout(){
		session('userid',null);
		session('username',null);
		session('email',null);
		session('md5str',null);
		cookie('USERID',null);
		cookie('MD5STR',null);
		header("Location: http://".$_SERVER['HTTP_HOST']."");
    }
}