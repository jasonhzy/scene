<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html lang="en">

	
	
	<head>
		<meta charset="utf-8" />
		<meta id="metaDescription" name="description" content="场景标题，场景描述，由好站长免费移动场景应用自营销管家提供技术支持" />
		<meta name="keywords" content="好站长微场景,场景魔方,微场景,免费,免费移动场景应用自营销管家,移动场景自营销管家,移动场景自营销工具,活动自营销管家,场景展示,免费的报名页,收集潜在客户,二次营销,轻CRM,提高移动场景营销效果" />
		<META HTTP-EQUIV="pragma" CONTENT="no-cache"> 
		<META HTTP-EQUIV="Cache-Control" CONTENT="no-store, must-revalidate"> 
		<META HTTP-EQUIV="expires" CONTENT="Wed, 26 Feb 1997 08:21:57 GMT"> 
		<META HTTP-EQUIV="expires" CONTENT="0">
		<meta id="MobileViewport" name="viewport" content="width=320, initial-scale=1, maximum-scale=1, user-scalable=no" servergenerated="true">
        <link rel="shortcut icon" href="http://yqx.cn/favicon.ico" type="image/x-icon" />
		<title></title>
		<!-- compiled CSS -->
		<link rel="stylesheet" type="text/css" href="/Public/css/sceneshow.css?v0322" />
		<div id='wx_pic' style='margin:0 auto;display:none;' ><img src="http://yqx.cn/userfiles/<?php echo ($confinfo2['imgsrc']); ?>"/></div>
		<!--<div id='wx_pic' style='margin:0 auto;display:none;height:300px;width:300px;'><img src="http://yqx.cn/userfiles/pic/1/201504/551c11c853ec6.jpg" height="300px" width="300px"/></div>-->
	</head>
	<body>
		<div id="ppitest" style="width:1in;visible:hidden;padding:0px"></div>
		<div class="p-index main phoneBox" id="con" style="display: none;">
		    <div class="top"></div>
		    <div class="phone_menubar"></div>
		    <div class="scene_title_baner" style="display: none">
            	<div class="scene_title"></div>
          	</div>
            <div class="nr">
            	<!-- <div id="audio_btn" class="loading_background">
            		<div id="yinfu" class="loading_yinfu"></div>
            		<audio loop="" src="" id="media" autoplay="" preload></audio>
            	</div> -->
            	<div id="audio_btn" class="off">
            		<div id="yinfu"></div>
            		<audio loop src="" id="media" autoplay="" preload></audio>
            	</div>
            	<div id="loading" class="loading">
				  <div class="loadbox">
				    <div class="loadlogo"></div>
				    <div class="loadbg"></div>
				  </div>
				</div>
            </div>
            <div class="bottom"></div>
		    
		    <!--上下滚动代码 end-->
		</div>
		
		<!-- <div style = "position: absolute;left: 100px; top: 100px;">
			<button id = "pre_page" type = "button" onclick = "prePage()">上一页</button>
			<button id = "next_page" type = "button" onclick = "nextPage()">下一页</button>
		</div> -->
        <script language="javascript">var _hmt = _hmt || [];(function() {var hm = document.createElement("script");hm.src = "//hm.baidu.com/hm.js?9f9481778d1928344a0475cab76ce937";var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(hm, s);})();</script>
		<script type="text/javascript">
			var PREFIX_URL = "http://"+window.location.host+"/";
			var PREFIX_S1_URL = "http://"+window.location.host+"/json/";
			var PREFIX_HOST = "http://"+window.location.host+"/index.php";
			var PREFIX_FILE_HOST = "http://yqx.cn/Uploads/";
		    var USER_FILE_HOST = "http://"+window.location.host+"/userfiles/";
			var CLIENT_CDN = "http://"+window.location.host+"/Public/css/";
			var clientWidth = document.documentElement.clientWidth;
			var INTERVAL_OBJ = {}; 
        </script>
        <script type="text/javascript" src="/Public/js/sceneshow.js?v150322"></script>
		<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <script>
          wx.config({
			  debug: false,
			  appId: '<?php echo ($confinfo[appId]); ?>',
			  timestamp: "<?php echo ($confinfo[timestamp]); ?>",
			  nonceStr: '<?php echo ($confinfo[nonceStr]); ?>',
			  signature: '<?php echo ($confinfo[signature]); ?>',
			  jsApiList: [
				'onMenuShareTimeline',
				'onMenuShareAppMessage'
			  ]
		  });
          wx.ready(function () {
		  
			  var shareData64 = {
				title: '<?php echo ($confinfo2[title]); ?>',
				desc: '<?php echo ($confinfo2[desc]); ?>',
				link: PREFIX_URL+'<?php echo ($confinfo2[url]); ?>',
				imgUrl: (('<?php echo ($confinfo2[imgsrc]); ?>'.indexOf('syspic/') >= 0) ? PREFIX_FILE_HOST : USER_FILE_HOST)+'<?php echo ($confinfo2[imgsrc]); ?>'
			  };
			  wx.onMenuShareAppMessage(shareData64);
			  wx.onMenuShareTimeline(shareData64);

          });
		  
		wx.error(function (res) {
			//alert(res.errMsg);
		});
        </script>
	</body>
</html>