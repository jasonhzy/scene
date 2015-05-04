<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title><?php echo C('site_name');?>后台管理系统 - BBS_haoid.cn</title>
    <meta name="keywords" content="<?php echo ($f_siteName); ?>-黑 锐微场景后台管理系统" />
    <meta name="description" content="<?php echo ($f_siteName); ?>-黑 锐微场景后台管理系统" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />    
    
    <link href="<?php echo RES;?>/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo RES;?>/css/bootstrap-responsive.min.css" rel="stylesheet" />
    
    <link href="<?php echo RES;?>/css/font-awesome.css" rel="stylesheet" />
    
    <link href="<?php echo RES;?>/css/adminia.css" rel="stylesheet" /> 
    <link href="<?php echo RES;?>/css/adminia-responsive.css" rel="stylesheet" /> 
    
    <link href="<?php echo RES;?>/css/pages/dashboard.css" rel="stylesheet" /> 
    <link href="<?php echo RES;?>/css/pages/faq.css" rel="stylesheet" />

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="<?php echo RES;?>/js/html5.js"></script>
    <![endif]-->
	<script src="<?php echo RES;?>/js/jquery-1.7.2.min.js"></script>
	<script src="<?php echo STATICS;?>/kindeditor/kindeditor.js"></script>
	<script src="<?php echo STATICS;?>/kindeditor/lang/zh_CN.js"></script>
	<script src="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.js"></script>
	<link rel="stylesheet" href="<?php echo STATICS;?>/kindeditor/themes/default/default.css" />
	<link rel="stylesheet" href="<?php echo STATICS;?>/kindeditor/plugins/code/prettify.css" /> 

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
	$(function(){

		var str = $(".widget-header h3").html();
		// alert(str.indexOf("&gt;"));
		var hstr = $.trim(str.substr(0, str.indexOf("&gt;")));
		var num = '';
		if(hstr == "站点设置")
			num = '1';
		else if(hstr == '用户管理')
			num = '2';
		else if(hstr == '内容管理')
			num = '3';
		else if(hstr == '公众号管理')
			num = '4';
		else if(hstr == '功能管理')
			num = '5'
		else if(hstr == '扩展管理')
			num = '6';

		var current = '#collapse' + num;
		$(current).css('height','auto').removeClass('collapse').addClass('in');

	})
</script>
</head>

<body>
	
<div class="navbar navbar-fixed-top">
	
	<div class="navbar-inner">
		
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 				
			</a>
			
			<a class="brand" href="<?php echo U('System/System/index');?>">好站长微场景后台</a>
			
			<div class="nav-collapse">
			
				<ul class="nav pull-right">

					
					<li class="divider-vertical"></li>
					
					<li class="dropdown">
						
						<a data-toggle="dropdown" class="dropdown-toggle " href="#">
							管理 <b class="caret"></b>							
						</a>
						
						<ul class="dropdown-menu">
							
							<li>
								<a href="<?php echo U('System/User/edit');?>&id=1"><i class="icon-lock"></i> 密码修改</a>
							</li>
							
							<li class="divider"></li>
							
							<li>
								<a href="<?php echo U('System/Admin/logout');?>"><i class="icon-off"></i> 退出系统</a>
							</li>
						</ul>
					</li>
				</ul>
				
			</div> <!-- /nav-collapse -->
			
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->

<div id="content">
	
	<div class="container">
		
		<div class="row">
			
			<div class="span3">
				
				<ul id="main-nav" class="nav nav-tabs nav-stacked">
									
					<li class="active accordion-group">
		              <a class="accordion-toggle" data-toggle="collapse" data-parent="" href="#collapse2">
		                <i class="icon-user"></i>
		                用户管理
		              </a>

		              <div id="collapse2" class="accordion-body collapse" style="height: 0px; ">
		                <a class="accordion-toggle" data-toggle="collapse" data-parent="" href="" onclick="javascript:window.location.href = '<?php echo U('System/User/index', array('pid'=>18, 'level'=>3));?>'">
		                  <i class="icon-share-alt"></i>
		                  用户中心
		                </a>
		                <a class="accordion-toggle" data-toggle="collapse" data-parent="" href="" onclick="javascript:window.location.href = '<?php echo U('System/Users/index', array('pid'=>50, 'level'=>3));?>'">
		                  <i class="icon-share-alt"></i>
		                  前台用户
		                </a>
		              </div>
					</li>
				</ul>	
			
				<br />
		
			</div> <!-- /span3 -->
				
			<div class="span9">

				<div class="widget widget-table">
										
					<div class="widget-header">
						<i class="icon-th-list"></i>
						<h3>用户管理 >> 用户中心 >> 用户列表</h3>
					</div> <!-- /widget-header -->
					
					<div class="widget-content">
						<!--<link href="<?php echo RES;?>/images/main.css" type="text/css" rel="stylesheet">
<script src="<?php echo STATICS;?>/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo STATICS;?>/function.js" type="text/javascript"></script>
<meta http-equiv="x-ua-compatible" content="ie=7" />
</head>
<body class="warp">
<div id="artlist">
	<div class="mod kjnav">
		<?php if(is_array($nav)): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U($action.'/'.$vo['name'],array('pid'=>$_GET['pid'],'level'=>3,'title'=>urlencode ($vo['title'])));?>"><?php echo ($vo['title']); ?></a>
		<?php if(($action == 'Article') or ($action == 'Img') or ($action == 'Text') or ($action == 'Voiceresponse')): break; endif; endforeach; endif; else: echo "" ;endif; ?>
	</div>   	
</div>-->
			            <table class="table table-striped table-bordered" style="margin-top:10px;" id="set_table">
						  <tr>
							<td width="70">ID</td>
							<td width="150">用户名称</td>
							<td width="150">角色名称</td>
							<td width="150">用户描述</td>
							<td width="100">最后登录IP</td>
							<td width="150">最后登录位置</td>
							<td width="150">最后登录时间</td>
							<td width="70">状态</td>
							<td width="150">管理操作</td>
						  </tr>
						    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
									<td align='center'><?php echo ($vo["id"]); ?></td>
									<td ><?php echo ($vo["username"]); ?></td>
									<td ><?php echo ($role[$vo['role']]); ?></td>
									<td ><?php echo ($vo["remark"]); ?></td>
									<td align='center'><?php echo ($vo["last_login_ip"]); ?></td>
									<td align='center'><?php echo ($vo["last_location"]); ?></td>
									<td align='center'><?php echo date('Y-m-d H:i:s', $vo['last_login_time']) ?></td>
									<td align='center'><?php if(($vo["status"]) == "1"): ?><font color="red">√</font><?php else: ?><font color="blue">×</font><?php endif; ?> 
									</td>
									<td align='center'>
										<a href="<?php echo U('User/edit/',array('id'=>$vo['id']));?>">修改</a>
										| <?php if(($vo["username"]) == "admin"): ?><font color="#cccccc">删除</font><?php else: ?><a href="javascript:void(0)" onclick="return confirmurl('<?php echo U('User/del/',array('id'=>$vo['id']));?>','确定删除该用户吗?')">删除</a><?php endif; ?>
									</td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
					     <tr bgcolor="#FFFFFF"> 
					      <td colspan="9"><div class="listpage"><?php echo ($page); ?></div></td>
					    </tr>
			            </table>				
					
					</div> <!-- /widget-content -->
					
				</div> <!-- /widget -->
			
			</div> <!-- /span9 -->
			
			
		</div> <!-- /row -->
		
	</div> <!-- /container -->
	
</div> <!-- /content -->
					
	
<div class="navbar navbar-fixed-bottom">
	<div class="navbar-inner" style="text-align: center;color:#fff;">
		微场景应用 版权所有 2014-2015 技术支持 <a href="http://yqx.cn">yqx.cn</a>
	</div>
</div>


    

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="<?php echo RES;?>/js/excanvas.min.js"></script>
<script src="<?php echo RES;?>/js/jquery.flot.js"></script>
<script src="<?php echo RES;?>/js/jquery.flot.pie.js"></script>
<script src="<?php echo RES;?>/js/jquery.flot.orderBars.js"></script>
<script src="<?php echo RES;?>/js/jquery.flot.resize.js"></script>
<script src="<?php echo STATICS;?>/artDialog/jquery.artDialog.js?skin=default"></script>
<script src="<?php echo STATICS;?>/artDialog/plugins/iframeTools.js"></script>


<script src="<?php echo RES;?>/js/bootstrap.js"></script>
<script src="<?php echo RES;?>/js/charts/bar.js"></script>
  </body>
</html>