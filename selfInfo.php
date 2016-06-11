<?php
	session_start();
	require_once 'backprop/SqlHelper.class.php';
?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="社交，花园，社交花园，聊天，交友，兴趣，爱好">
    <meta name="author" content="Jack">
    <meta name="robots" content="index,follow">
    <meta name="application-name" content="社交花园">
    <meta name="description" content="社交花园是一个集聊天、沟通于一体的社交平台。理念是分享生活，留住感动！用户可通过此平台及时了解同学、朋友的讯息，亦可发布自己的工作生活感悟、照片等讯息，让关心自己的和自己关心的人随时了解自己的情况。">
    <title>社交花园~个人花园~个人信息</title>
    <link href="lib/bootstrap-3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="lib/Font-Awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/blue.css" rel="stylesheet">
    <!--[if IE 7]>
			<link rel="stylesheet" href="lib/Font-Awesome/css/font-awesome-ie7.min.css">
		<![endif]-->
    <link rel="apple-touch-icon-precomposed" href="img/logo.png">
    <link rel="icon" href="img/logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="img/logo.png">
    <link rel="canonical" href="garden.php" />
    <script src="lib/jquery-2.2.2.min.js"></script>
    <script src="lib/bootstrap-3.3.5/js/bootstrap.min.js"></script>
    <!--[if lt IE 9]>
      <script src="lib/html5.min.js"></script>
      <script src="lib/respond.min.js"></script>
    <![endif]-->
    <link href="lib/nprogress.min.css" rel="stylesheet">
    <script src="lib/nprogress.min.js"></script>
    <script src="lib/bootstrap-autohidingnavbar/dist/jquery.bootstrap-autohidingnavbar.min.js" type="text/javascript"></script>
    <script src="lib/messenger.min.js"></script>
    <link href="lib/messenger.min.css" rel="stylesheet">
    <link href="lib/messenger-theme-future.min.css" rel="stylesheet">
    <link href="lib/buttons.min.css" rel="stylesheet">
    
    <style type="text/css">
			* { 
				font-family: 微软雅黑;	
			}
			
			body {	
				background-color: #ccc; 
			}
			
			.logo {
				margin: 1px 5px 1px 0px;
		  	float: left;
		  }
		  
		  #nprogress .bar{ 
		  	background: yellow; 
			}
			
			#nprogress .peg { 
				box-shadow: 0 0 10px yellow, 0 0 5px yellow; 
			}
			
			#nprogress .spinner-icon { 
		  	border-top-color: yellow;
			  border-left-color: yellow;
			}
			
			#my-content { 
				margin-top: 55px; 
			}
			
			.btn { 
				outline: none; 
			}
			
			#go_top {
				position:fixed;
				right:10px;
				bottom:200px;
			}
		
		.bs-callout {
		  padding: 20px;
		  margin: 20px 0;
		  border: 1px solid #fff;
		  border-left-width: 10px;
		  border-radius: 3px;
			background-color: #eee;
			box-shadow: 10px 10px 5px #888;
		}
	
		.bs-callout-info {
		  border-left-color: #1b809e;
		}
		</style>
		
		<script type="text/javascript">
			$(function(){
				NProgress.configure({ easing: 'ease', speed: 500 });
				NProgress.start();
				NProgress.done();

				$("#my-navbar .navbar-fixed-top").autoHidingNavbar();

				$('[data-toggle="popover"]').popover();

				$('.dropdown-toggle').dropdown('toggle');

				/*返回顶部*/
				$(window).on('scroll',function(){
					var st = $(document).scrollTop();
					if( st>0 ){
						if( $('#main-container').length != 0  ){
							var w = $(window).width(),mw = $('#main-container').width();
							if( (w-mw)/2 > 70 )
								$('#go_top').css({'left':(w-mw)/2+mw+20});
							else{
								$('#go_top').css({'left':'auto'});
							}
						}
						$('#go_top').fadeIn(function(){
							$(this).removeClass('dn');
						});
					}else{
						$('#go_top').fadeOut(function(){
							$(this).addClass('dn');
						});
					}	
				});
				$('#go_top .go').on('click',function(){
					$('html,body').animate({'scrollTop':0},500);
				});
				
			});
		</script>
	</head>
	<body>
		<div>
			
			<div id="my-navbar">
		    <nav class="navbar navbar-inverse navbar-fixed-top">
		      <div class="container">
		        <div class="navbar-header">
				      <img class="logo" src="img/logo.png">
		          <a class="navbar-brand" style="font-size: 40px; color: orange; font-family:华文彩云;">社交花园</a>
		        </div>
		        <div class="collapse navbar-collapse">
				      <ul class="nav navbar-nav">				        
				      	<li>
				        	<a id="public-garden" href="garden.php">
				        		<i class="icon-group icon-large"></i> 公共花园
			        		</a>
		        		</li>
				        <li class="active dropdown">
				        	<a id="self-garden" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				        		<i class="icon-user icon-large"></i> 个人花园  <span class="caret"></span>
			        		</a>
			        		<ul class="dropdown-menu">
			        			<li class="active">
						        	<a href="selfInfo.php">
						        		<i class="icon-user-md icon-large"></i> 个人信息
					        		</a>
				        		</li>
				        		<li role="separator" class="divider"></li>
				        		<li>
						        	<a href="self.php">
						        		<i class="icon-file-alt icon-large"></i> 已发说说
					        		</a>
				        		</li>
			        		</ul>
		        		</li>
				      </ul>
				      <ul class="nav navbar-nav navbar-right" style="width:300px;">
				      	<li id="liWelcome">
				      		<a id="welcome"><?php if ($_SESSION['nickname'] != '') echo '欢迎你，' . $_SESSION['nickname'].' <span class="glyphicon glyphicon-piggy-bank" aria-hidden="true"></span>';?></a>
				      	</li>
				      	<li id="liOut">
				      		<a id="logout" href="backprop/selfLogoutProcess.php">
				      			<span class="glyphicon glyphicon-log-out"></span> 退出
				      		</a>
				      	</li>
				      </ul>
				    </div>
		      </div>
		    </nav>
	    </div>
			
			<div class="container">
			
				<div class="tip" style="margin-top: 65px;">
        	<p class="bg-success" style="padding: 10px 10px 10px 20px; border-radius: 7px;">
        		<i class="icon-comment icon-large"></i> 你的个人的信息
        	</p>
        </div>   
        
        <?php 
        	$sqlHelper = new SqlHelper();
        	$sql = "select * from tb_user where id=".$_SESSION['user_id'];
        	$res = $sqlHelper->excute_dql2($sql);
        ?>
        				
				<div>
					<div class="bs-callout bs-callout-info" style="border-left-color: #1b809e;">
						<h4><b>账 号</b></h4>
						<p><?php echo $res[0]['username']?></p>
					</div>
					<div class="bs-callout bs-callout-info" style="border-left-color: #FF6600;">
						<h4><b>昵 称</b></h4>
						<p><?php echo $res[0]['nickname']?></p>
					</div>
					<div class="bs-callout bs-callout-info" style="border-left-color: #CC9900;">
						<h4><b>邮 箱</b></h4>
						<p><?php echo $res[0]['email']?></p>
					</div>
					<div class="bs-callout bs-callout-info" style="border-left-color: #66CC00;">
						<h4><b>密保问题(<small>高中第一个同桌的姓名？</small>)答案</b></h4>
						<p><?php echo $res[0]['save_pwd_answer']?></p>
					</div>
				</div>
        
			</div>
			
			<!--返回顶部-->
	    <div id="go_top" class="go_top dn">
	    	<img src="img/backtop.png" data-toggle="tooltip" data-placement="top" title="返回顶部" class="go" alt="GO TOP"/>
	    </div>
			
			<footer>
      	<div style="height: 53px;background-color: #202020;color:#959595;text-align:center;">
      		<div class="container">
      			<p style="padding-top: 14px;padding-bottom:9px;">2016&nbsp;&nbsp;Copyright © Jack	|	 版权所有仿冒必究</p>
      		</div>
      	</div>
      </footer>
			
		</div>
	</body>
</html>
    