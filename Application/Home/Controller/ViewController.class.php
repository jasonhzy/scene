<?php
namespace Home\Controller;
use Think\Controller;
class ViewController extends Controller {
    public function index(){
		// $confinfo = $this->get_js_sdk("wxba755ff76eb84167","2836c79a4817352d07b8ee810b0f1162");  // 测试公众号
		$confinfo = $this->get_js_sdk("wxba755ff76eb84167","2836c79a4817352d07b8ee810b0f1162");
		$this->assign("confinfo",$confinfo);
		$_scene = M('scene');
		$where['scenecode_varchar']  = I('get.id',0);
		$where['delete_int']  = 0;
		$_scene_list=$_scene->where($where)->select();     
		$argu2 = array();
		$argu2['title'] = $_scene_list[0]["scenename_varchar"];
		$argu2['url'] = 'v-'.$_scene_list[0]["scenecode_varchar"];
		$argu2['desc'] = $_scene_list[0]["desc_varchar"];
		$argu2['imgsrc'] = $_scene_list[0]["thumbnail_varchar"];
		$this->assign("confinfo2",$argu2);
		$this->display();
		/*
		<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <script>
          wx.config({
			  debug: false,
			  appId: '{$confinfo[appId]}',
			  timestamp: "{$confinfo[timestamp]}",
			  nonceStr: '{$confinfo[nonceStr]}',
			  signature: '{$confinfo[signature]}',
			  jsApiList: [
				'onMenuShareTimeline',
				'onMenuShareAppMessage'
			  ]
		  });
          wx.ready(function () {
		  
			  var shareData64 = {
				title: '微信JS-SDK Demo',
				desc: '微信JS-SDK,帮助第三方为用户提供更优质的移动web服务',
				link: 'http://demo.open.weixin.qq.com/jssdk/',
				imgUrl: 'http://mmbiz.qpic.cn/mmbiz/icTdbqWNOwNRt8Qia4lv7k3M9J1SKqKCImxJCt7j9rHYicKDI45jRPBxdzdyREWnk0ia0N5TMnMfth7SdxtzMvVgXg/0'
			  };
			  wx.onMenuShareAppMessage(shareData64);
			  wx.onMenuShareTimeline(shareData64);

          });
		  
		wx.error(function (res) {
			alert(res.errMsg);
		});
        </script>
		*/
    }


    public function test(){
		$confinfo = $this->get_js_sdk("wxba755ff76eb84167","2836c79a4817352d07b8ee810b0f1162");
		//$confinfo = $this->get_js_sdk("wxba755ff76eb84167","2836c79a4817352d07b8ee810b0f1162");
		$this->assign("confinfo",$confinfo);
		$this->display();
    }


		 /**
		 * php curl 请求链接
		 * 当$post_data为空时使用GET方式发送
		 * @param unknown $url
		 * @param string $post_data
		 * @return mixed
		 */
		function curlSend($url,$post_data=""){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$url);
			if($post_data != ""){
				curl_setopt($ch,CURLOPT_POST,1);
				curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
			}
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
			$result = curl_exec($ch);
			curl_close($ch);
			return $result;
		}


		/**
		 * 调用接口获取 $ACCESS_TOKEN
		 * 微信缓存 7200 秒，这里使用thinkphp的缓存方法
		 * @param unknown $APP_ID
		 * @param unknown $APP_SECRET
		 * @return Ambigous <mixed, Thinkmixed, object>
		 */
		function get_accesstoken($APP_ID,$APP_SECRET){
			$ACCESS_TOKEN = S($APP_ID);
			//if($ACCESS_TOKEN == false){
				$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$APP_ID."&secret=".$APP_SECRET;
				$json = $this->curlSend($url);
				
				$data=json_decode($json,true);
					
				S($APP_ID,$data[access_token],7000);
				$ACCESS_TOKEN = S($APP_ID);
			//}
		
			return $ACCESS_TOKEN;
		}

		/**
		 * 微信网页JSSDK  调用接口获取 $jsapi_ticket
		 * 微信缓存 7200 秒，这里使用thinkphp的缓存方法
		 * @param unknown $ACCESS_TOKEN
		 * @return Ambigous <mixed, Thinkmixed, object>
		 */
		function get_jsapi_ticket($ACCESS_TOKEN){
			$jsapi_ticket = S($ACCESS_TOKEN);
			//var_dump(S($ACCESS_TOKEN));exit;
			//if($jsapi_ticket == false){
				$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=".$ACCESS_TOKEN."&type=jsapi";
				$json = $this->curlSend($url);
				$data = json_decode($json,true);
				
				$aaa = S($ACCESS_TOKEN,$data[ticket],7000);
				$jsapi_ticket = S($ACCESS_TOKEN);
			//}
		
			return $jsapi_ticket;
		}

		/**
		 * 微信网页JSSDK 获取签名字符串
		 * 所有参数名均为小写字符
		 * @param unknown $nonceStr 随机字符串
		 * @param unknown $timestamp 时间戳
		 * @param unknown $jsapi_ticket
		 * @param unknown $url 调用JS接口页面的完整URL，不包含#及其后面部分
		 */
		function get_js_sdk($APP_ID,$APP_SECRET){
			$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== off || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
			$url = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			
			$argu = array();
			$argu['appId'] = $APP_ID;
			$argu['url'] = $url;
			$argu['nonceStr'] = $this->createNonceStr();
			$argu['timestamp'] = time();
			
			$ACCESS_TOKEN = $this->get_accesstoken($APP_ID, $APP_SECRET);
			$argu['jsapi_ticket'] = $this->get_jsapi_ticket($ACCESS_TOKEN);
		
			$string = "jsapi_ticket=".$argu[jsapi_ticket]."&noncestr=".$argu[nonceStr]."&timestamp=".$argu[timestamp]."&url=".$argu[url];
			$argu['signature'] = sha1(trim($string));
			return $argu;
		}

		/**
		 * 获取随机字符串
		 * @param number $length
		 * @return string
		 */
		function createNonceStr($length = 16) {
			$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$str = "";
			for ($i = 0; $i < $length; $i++) {
				$str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
			}
			return $str;
		}
		
		
}