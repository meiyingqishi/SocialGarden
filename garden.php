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
    <title>社交花园~公共花园</title>
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
			
			*
		  body {	
		  	background-color: #eee; 
			}
		  
		  .logo {
				margin: 1px 5px 1px 0px;
		  	float: left;
		  }
		  
		  #nprogress .bar { 
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
					
			#public-garden, #self-garden, #login, #register { 
				outline: none; 
			}
			
			.popover { 
				background-color: #eee; 
			}
			
			.modal-dialog { 
				margin: 60px auto; 
			}
			
			.modal-content { 
				width: 436px; 
			}
			
			.modal-header {
				background: url("img/dialog-radius-top-bg.png") repeat-x;
				border-radius: 13px 13px 0px 0px;
				box-shadow: 0 2px 6px #d1d1d1;
			}
			
			.modal-footer {
				background: url("img/dialog-radius-top-bg.png") repeat-x;
				box-shadow: 0 -2px 6px #d1d1d1;
			}
			
			.modal-body {	
				padding: 30px 30px 15px; 
			}
			
			#btnRegister {
				outline:none; width: 100%; 
				box-shadow: 5px 5px 5px #999;
			}
			
			#go_top {
				position:fixed;
				right:10px;
				bottom:200px;
			}
			
			#btnZanNickname {
				outline: 0;
				-webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
				box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
			}
			
			#btnZanIcon {
				color: #fff;
				background-color: #f0ad4e;
				border-color: #eea236;
			}
			
			#btnOutComments {
				color: #fff;
				background-color: #5cb85c;
				border-color: #4cae4c;
			}
		</style>
		
		<script type="text/javascript">
			$(function(){
				NProgress.configure({ easing: 'ease', speed: 500 });
				NProgress.start();
				NProgress.done();

				$("#my-navbar .navbar-fixed-top").autoHidingNavbar();
				
				$('#login').click(function() {
					$('#login').popover({
						html: true,
						content: '<div class="container"><a id="btnCloseLogin" style="margin-left:210px;" onclick="$(\'#login\').popover(\'destroy\');" href="javascript:void(0);"><i class="glyphicon glyphicon-remove"></i></a> <form><h2 style="margin-top:-20px;">请登录</h2> <label for="username" class="sr-only">账号</label> <div class="input-group" style="margin-bottom:-1px;"><span class="input-group-addon" style="border-bottom-right-radius:0;border-bottom-left-radius:0;"><i class="icon-user"></i></span> <input type="text" id="username" class="form-control" style="border-bottom-right-radius:0;border-bottom-left-radius:0;width:180px;" placeholder="账号/邮箱/手机号码"></div><label for="password" class="sr-only">密码</label><div class="input-group"><span class="input-group-addon" style="border-top-right-radius: 0;border-top-left-radius:0;"><i class="icon-lock" style="padding:1px;"></i></span><input type="password" id="password" class="form-control" style="border-top-right-radius: 0;border-top-left-radius: 0;width:180px;" placeholder="密码"></div><br/><button class="btn btn-lg btn-primary btn-block" id="btnLogin" style="width:216px;outline:none;" type="button">登 录</button></form></div>',
						placement: "bottom"
					});
					$('#login').on('shown.bs.popover', function () {
						$("#btnLogin").click(function(){
							var uid = $("#username").val().trim();
							var pwd = $("#password").val().trim();
							if (escape(uid).indexOf("%u") != -1)
								return;
							$.ajax({
								type: "POST",
								url: "backprop/loginProcess.php",
								data: "username=" + uid + "&password=" + pwd,
								success: function (nickname) {
									if (nickname == '0') {
										popwindown("error", "账号或密码错误！");
										return;
									}
									$("#btnCloseLogin").click();
									popwindown("success", "恭喜你，登录成功！");
									
									
									$("#welcome").html("欢迎你，" + nickname);
									showEle("liWelcome");
									showEle("liOut");
									hideEle("liLogin");
									hideEle("liRegister");
									/*$("#logout").click(function () {
										<?php 
											$_SESSION["isLogin"] = "no";
										?>
										hideEle("liWelcome");
										hideEle("liOut");
										showEle("liLogin");
										showEle("liRegister");
										
									});*/
								},
								error: function () {
									popwindown("error", "很遗憾，登录失败，请重新登录！");
									<?php 
										$_SESSION["isLogin"] = "no";
									?>
								}
							});
						});
						
					});
					
				});

				$('[data-toggle="popover"]').popover();
				$('[data-toggle="tooltip"]').tooltip();

				/*
				 * 判断一个值是否包含有非英文字符
				 * 参数为元素id
				 * 返回值0表示不是input元素，1表示输入值含有中文，-1表示全为英文字符
				 */
				function judgeNonEngChar(inputId) {
					var $element = $("#" + inputId);
					// 判断是否是input元素
					if (!$element.is("input"))
						return 0;
					var inputVal = $element.val().trim();
					// 判断是否包含有中文字符
					if (escape(inputVal).indexOf("%u") != -1)
						return 1;
					return -1;
				}

				/*
				 * 显示弹出提示框
				 * 参数为要显示在的元素id和提示内容
				 */
				function showPopover(id, tipContent) {
					var $element = $("#" + id);
					$element.attr("data-content", tipContent);
					$element.popover("show");
				}

				/*
				 * 隐藏弹出提示框
				 * 参数为要隐藏在的元素id
				 */
				function hidePopover(id) {
					var $element = $("#" + id);
					$element.attr("data-content", "");
					$element.popover("hide");
				}

				/*
				 * 验证是否为邮箱
				 * 参数该元素值得id
				 * 验证成功返回true，否则为false
				 */
				function isEmail(id) {
					var inputval = $("#" + id).val().trim();
					var regexp = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
					if (regexp.test(inputval))
						return true;
					return false;
				}
					
				
				// 验证账号：是否包含中文字符，是否是邮箱
				$("#username").blur(function () {
					if (judgeNonEngChar("username") != -1)
						showPopover("username", "账号不能包含中文字符！");
					else
						hidePopover("username");
					
					if (isEmail("username"))
						$("#email").attr("value", $("#username").val().trim());
					
				});

				
				// 密码验证：是否低于8位
				$("#password").blur(function () {
					if ($("#password").val().trim().length < 8)
						showPopover("password", "密码不能少于8位数！");
					else
						hidePopover("password");
				});

				// 重复密码验证：是否与密码一致
				function repeatPwd() {
					var $repwd = $("#repassword");
					if ($("#password").val().trim() !== $repwd.val().trim()) {
						showPopover("repassword", "两次输入的密码不一致！");
						return false;
					} else {
						hidePopover("repassword");
						return true;
					}
				}

				$("#repassword").blur(function () {
					repeatPwd();
				});
			

				// 验证邮箱
				$("#email").blur(function () {
					if (!isEmail("email"))
						showPopover("email", "邮箱格式不正确！");
					else
						hidePopover("email");
				});

				// 点击x，清除注册表单内容
				$("#btnCloseModal").click(function () {
					var ids = ["username", "password", "repassword", "email", "checkcode", "nickname", "savePwdAnswer"];
					$.each(ids, function (index, id) {
						$("#" + id).val("");
						location = 'garden.php';
					});
				});

				/**
				 * 关闭注册窗口
				 */
				function closeReg() {
					$("#btnCloseModal").click();
				}

				/**
				 * 弹出提示框
				 */
				function popwindown(infotype, infodata) {
					Messenger().post({
					  message: infodata,
					  type: infotype,
						showCloseButton: true
					});
				}

				/**
				 * 显示元素
				 */
				function showEle(id) {
					$("#"+id).removeClass("sr-only");
				}

				/**
				 * 隐藏元素
				 */
				function hideEle(id) {
					$("#"+id).addClass("sr-only");
				}

				// 点击注册按钮，对要提交数据做检查
				$("#btnRegister").click(function () {
					$("#btnRegister").attr("disabled", "disabled");
					var isPost = true;
					var ids = ["username", "password", "repassword"];
					$.each(ids, function (index, id) {
						if ($("#" + id).val().trim() == ""){
							showPopover(id, "该内容必须填写！");
							isPost = false;
						}
					});
					// 验证重填的密码是否正确
					if (!repeatPwd())
						isPost = false;
					if (!isPost)
						return;
					// 验证账号和密码是否包含中文字符，包含则不提交
					if ((judgeNonEngChar('username') != -1) || (judgeNonEngChar('email') != -1) || (judgeNonEngChar('checkcode') != -1)) {
						alert("账号、密码或验证码不能包含中文字符！");
						return;
					}
					var postData = "username=" + $("#username").val().trim() 
											+ "&password=" + $("#password").val().trim() 
											+ "&repassword=" + $("#repassword").val().trim() 
											+ "&email=" + $("#email").val().trim() 
											+ "&checkcode=" + $("#checkcode").val().trim() 
											+ "&nickname=" + $("#nickname").val().trim() 
											+ "&savePwdAnswer=" + $("#savePwdAnswer").val().trim();
					$.ajax({
						type: "POST",
						url: "backprop/registerProcess.php",
						data: postData,
						success: function (msg) {
							$("#btnRegister").removeAttr("disabled");
							if (msg == 1) {
								alert("账号、邮箱或验证码不能包含中文字符！");
								return;
							} else if (msg == 2) {
								alert("密码长度不能小于8位！");
								return;
							} else if (msg == 3) {
								alert("账户已存在，请选择其它账户！");
								return;
							} else if (msg == 4) {
								alert("验证码错误！");
								return;
							} else {
								var nickname = $("#nickname").val().trim();
								closeReg();
								popwindown("success", "恭喜你，注册成功！");
								
								<?php 
									$_SESSION["isLogin"] = "yes";
								?>
								
								$("#welcome").html("欢迎你，" + nickname);
								showEle("liWelcome");
								showEle("liOut");
								hideEle("liLogin");
								hideEle("liRegister");
								$("#logout").click(function () {
									<?php 
										$_SESSION["isLogin"] = "no";
									?>
									hideEle("liWelcome");
									hideEle("liOut");
									showEle("liLogin");
									showEle("liRegister");
								});
							}
				   	},
				   	error: function () {
				   		closeReg();
				   		popwindown("error", "很遗憾，注册失败，请重新注册！");
				   		<?php 
								$_SESSION["isLogin"] = "no";
							?>
				   	}
					});
				});

				// 发表说说
				$("#btnSent").click(function () {
					var content = $("#txtContent").val().trim();	// 要发表的内容
					$.ajax({
						type: "POST",
						url: "backprop/sentSSProcess.php",
						data: "msg=" + content,
						success: function (msg) {
							if (msg == 3)
								popwindown("error", "请登录再发表说说！");
							else {
								popwindown("info", "发表成功！");
								$("#txtContent").val("");
								$("#my-content").append(msg);
								location.reload();
							}
						},
						error: function () {
							popwindown("error", "发表失败！");
						} 
					});
				});

				// 获取未读内容数
				function getNoReadRows () {
					$.ajax({
						type: "POST",
						url: "backprop/getDataCount.php",
						success: function (msg) {
							var oldDataCount = $('#datacount').val();
							if (msg - oldDataCount > 0) {
								$("#tipcount").html('有  <span class="badge">'+(msg - oldDataCount)+'</span> 条新内容未读！');
							} else {
								$("#tipcount").html('');
							}
						}
					});
				}

				setInterval(getNoReadRows, 3000);

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
			
			/**
			 * 刷新验证码
			 */
			function refreshCaptcha(){
				var img = document.images['captchaimg'];
				img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
			}

			/**
			 * 点击评论按钮
			 */
			function toComment(content_id, user_id) {
				$('#modalComment').modal();
				$('#modalComment').on('shown.bs.modal', function () {
					  $('#txtComment').focus();
					  $("#btnComment").click(function(){
							$('#btnCancel').click();
							var txtComment = $("#txtComment").val().trim();
							if (txtComment == '') {
								alert("空评论，发表评论失败！"); 
								location = "garden.php";
								return;
							}
							$.ajax({
								type: "POST",
								url: "backprop/commentProcess.php",
								data: "content_id=" + content_id + "&user_id=" + user_id + "&comment=" + txtComment,
								success: function (msg) {
									if (msg == '1')
										alert("空评论，发表评论失败！");
									else if (msg == '2')
										alert("请登录再评论！");
									location = "garden.php";
								}
							});
						});
				});
			}
			
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
				      	<li class="active">
				        	<a id="public-garden" href="garden.php">
				        		<i class="icon-group icon-large"></i> 公共花园
			        		</a>
		        		</li>
				        <li>
				        	<a id="self-garden" href="backprop/gotoSelfProcess.php">
				        		<i class="icon-user icon-large"></i> 个人花园
			        		</a>
		        		</li>
				      </ul>
				      <ul class="nav navbar-nav navbar-right" style="width:300px;">
				      	<?php if (@$_SESSION['nickname'] != null) { ?>
				      		<li id="liWelcome">
					      		<a id="welcome">
					      			<?php if ($_SESSION['nickname'] != '') echo '欢迎你，'.$_SESSION['nickname'].' <span class="glyphicon glyphicon-piggy-bank" aria-hidden="true"></span>';?>
				      			</a>
					      	</li>
					      	<li id="liOut">
					      		<a href="backprop/logoutGardenProcess.php">
					      			<span class="glyphicon glyphicon-log-out"></span> 退出
					      		</a>
					      	</li>
				      	<?php } else {?>
					      	<li class="sr-only" id="liWelcome">
					      		<a id="welcome"><?php if ($_SESSION['nickname'] != '') echo '欢迎你，'.$_SESSION['nickname'].' <span class="glyphicon glyphicon-piggy-bank" aria-hidden="true"></span>';?></a>
					      	</li>
					      	<li class="sr-only" id="liOut">
					      		<a href="backprop/logoutGardenProcess.php">
					      			<span class="glyphicon glyphicon-log-out"></span> 退出
					      		</a>
					      	</li>
					        <li id="liLogin">
					        	<a id="login" href="javascript:void(0);">
					        		<span class="glyphicon glyphicon-log-in"></span> 登 录
				        		</a>
			        		</li>
					        <li id="liRegister">
					        	<a id="register" href="javascript:void(0);" data-toggle="modal" data-target="#modalRegister">
					        		<span class="glyphicon glyphicon-registration-mark"></span> 注 册
				        		</a>
			        		</li>
		        		<?php }?>
				      </ul>
				    </div>
		      </div>
		    </nav>
	    </div>
    
    	<div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" data-backdrop="static">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" id="btnCloseModal" data-dismiss="modal">
			        	<span>&times;</span>
			        </button>
			        <h4 class="modal-title">用户注册</h4>
			      </div>
			      <div class="modal-body">
			        <form>
			          <div class="form-group">
			            <div class="input-group">
				            <span class="input-group-addon">
					            <span class="glyphicon glyphicon-user"></span>
				            </span>
				            <input type="text" class="form-control input-lg" id="username" name="username" placeholder="账号，邮箱/电话，不能包含中文字符" data-container="body" data-toggle="popover" data-placement="right"  data-content="" required>
			            </div>
			          </div>
			          <div class="form-group">
			            <div class="input-group">
			            	<span class="input-group-addon">
			            		<span class="glyphicon glyphicon-lock"></span>
			            	</span>
			            	<input type="password" class="form-control input-lg" id="password" name="password" placeholder="密码，不少于8位数" data-container="body" data-toggle="popover" data-placement="right"  data-content="" required>
			            </div>
			          </div>
			          <div class="form-group">
			            <div class="input-group">
			            	<span class="input-group-addon">
			            		<span class="glyphicon glyphicon-lock"></span>
			            	</span>
			            	<input type="password" class="form-control input-lg" id="repassword" name="repassword" placeholder="重复密码" data-container="body" data-toggle="popover" data-placement="right"  data-content="" required>
			            </div>
			          </div>
			          <div class="form-group">
			            <div class="input-group">
			            	<span class="input-group-addon">
			            		<span class="glyphicon glyphicon-envelope"></span>
			            	</span>
			            	<input type="email" class="form-control input-lg" id="email" name="email" placeholder="邮箱，用于修改密码" data-container="body" data-toggle="popover" data-placement="right"  data-content="" required>
			            </div>
			          </div>
			          <div class="form-group">
			            <div class="input-group">
			            	<span class="input-group-addon">
			            		<span class="glyphicon glyphicon-star"></span>
			            	</span>
			            	<input type="text" class="form-control input-lg" id="checkcode" name="checkcode" placeholder="请输入右侧验证码，点击可换" data-toggle="popover" data-placement="right"  data-content="" required>
			            	<span class="input-group-addon">
			            		<img onclick="refreshCaptcha()" src="backprop/captcha.php?rand=<?php echo rand();?>" id='captchaimg'>
			            	</span>
			            </div>
			          </div>
			          <div class="form-group">
			            <div class="input-group">
			            	<span class="input-group-addon">
			            		<span class="glyphicon glyphicon-piggy-bank"></span>
			            	</span>
			            	<input type="text" class="form-control input-lg" id="nickname" placeholder="昵称，亦即网名" required>
			            </div>
			          </div>
			          <div class="form-group">
			            <div class="input-group">
			            	<span class="input-group-addon">
			            		<span class="glyphicon glyphicon-comment"></span>
			            	</span>
			            	<input type="text" class="form-control input-lg" id="savePwdAnswer" placeholder="密保问题：第一个高中同桌的名字？" data-container="body" data-toggle="popover" data-placement="right" data-trigger="hover focus" data-content="第一个高中同桌的名字？" required>
			            </div>
			          </div>
			        </form>
			      </div>
			      <div class="modal-footer">
			        <button class="btn btn-primary btn-lg" id="btnRegister" type="button" data-type="modal-trigger">注 册</button>
			      </div>
			    </div>
			  </div>
			</div>
    
    	
    	<div class="modal fade" id="modalComment" tabindex="-1" role="dialog" data-backdrop="static">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h4 class="modal-title"><i class="icon-edit"></i> 评 论</h4>
			      </div>
			      <div class="modal-body">
			        <textarea class="form-control input-lg" id="txtComment" name="txtComment" rows="5"  placeholder="评论一下 ..." data-container="body" data-toggle="popover" data-placement="right"></textarea>
			      </div>
			      <div class="modal-footer" style="padding: 0px;">
				      <div class="btn-group btn-group-lg" role="group">
				      	<button class="btn btn-default" style="border-top-left-radius: 0;border-bottom-left-radius: 0; width: 217px;" data-dismiss="modal" id="btnCancel" type="button" data-type="modal-trigger">取 消</button>
				        <button class="btn btn-default" id="btnComment"  style="border-top-right-radius: 0;border-bottom-right-radius: 0;  width: 217px;" type="button" data-type="modal-trigger">评 论</button>
				      </div>
			      </div>
			    </div>
			  </div>
			</div>
    	
    
      <div class="container" id="my-content">
      
        <div id="sentText" style="margin-top: 10px;">
	        <div class="row">
		        <div class="col-xs-offset-2">
		        	<div class="col-xs-8">
		        		<textarea class="form-control" id="txtContent" name="txtContent" rows="3" placeholder="想说的话 . . ." data-toggle="tooltip" data-placement="bottom" title="分享生活，留住感动！"></textarea>
		        	</div>
		        	<div class="col-xs-1" style="margin-left: -20px;">
				      	<button class="button button-primary button-box button-giant" id="btnSent">发表</button>
		        	</div>
		        </div>
	        </div>
        </div>
        
        <div class="tip" style="margin-top: 10px;">
        	<p class="bg-success" style="padding: 10px 10px 10px 20px; border-radius: 7px;">
        		<i class="icon-refresh icon-spin icon-large"></i> 全部动态
        		<a class="btn btn-default" style="margin-left: 110px;" href="garden.php" data-toggle="tooltip" data-placement="left" title="显示最新内容！"><i class="icon-repeat"></i> 刷 新</a>
        		<span id="tipcount" class="label label-info"></span>
        	</p>
        </div>
        
        <?php 
        	// 获取内容
        	$pageIndex = 0;	//当前是第几页
        	if (!empty($_GET['pageIndex']))
        		$pageIndex = $_GET['pageIndex'];
        	$sqlHelper = new SqlHelper();
        	$sql = "select * from tb_content order by id desc limit ".($pageIndex*10).",10;";
        	$resArr = $sqlHelper->excute_dql2($sql);
        	for ($i = 0; $i < count($resArr); $i++) {
        		$userid = $resArr[$i]["user_id"];
        		$sqlNickname = "select * from tb_user where id=" . $userid;
        		$nickArr = $sqlHelper->excute_dql2($sqlNickname);
        		$sqlZans = "select count(id) zans from tb_zan where content_id={$resArr[$i]["id"]}";
        		$zansArr = $sqlHelper->excute_dql2($sqlZans);
        		$zans = '';
        		if ($zansArr[0]['zans'] != 0)
        			$zans = $zansArr[0]['zans'];
        		
        			
        		$sqlZanIds = "select user_id from tb_zan where content_id={$resArr[$i]["id"]}";
        		$zanIds = $sqlHelper->excute_dql2($sqlZanIds);
        		$ids = '';
	        	$names = '';
        		if (!empty($zanIds)) {
        			$names = '<a class="button button-circle" id="btnZanIcon"><i class="icon-thumbs-up"></i></a> ';
	        		for ($j = 0; $j < count($zanIds); $j++) {
	        			$ids .= $zanIds[$j]['user_id'].',';
	        		}
	        		$ids = rtrim($ids, ',');
	        		$sqlSelectZanNames = "select nickname from tb_user where id in ($ids)";
	        		$zanNames = $sqlHelper->excute_dql2($sqlSelectZanNames);
	        		for ($k = 0; $k < count($zanNames); $k++) {
	        			$names .= '<a class="btn" id="btnZanNickname">'.$zanNames[$k]['nickname'].'</a> ';
	        		}
        		}
        		
        		
        		$comments = '';
        		$sqlSelComments = "select count(id) comments from tb_comment where content_id={$resArr[$i]["id"]}";
        		$commentCount = $sqlHelper->excute_dql2($sqlSelComments);
        		if ($commentCount[0]['comments'] != 0)
        			$comments = $commentCount[0]['comments'];
        		
        			
        		$outComments = '';
        		if (!empty($comments)) {
	        		$sqlSelCommentContent = "select clickcomment_user_id, comment, comment_datetime from tb_comment where  content_id=".$resArr[$i]['id'];
	        		$SelCommentContens = $sqlHelper->excute_dql2($sqlSelCommentContent);
	        		for ($n = 0; $n < count($SelCommentContens); $n++) {
	        			
	        			$sqlCommentNickname = "select nickname from tb_user where id={$SelCommentContens[$n]['clickcomment_user_id']}";
        				$CommentNickNames = $sqlHelper->excute_dql2($sqlCommentNickname);
        				
        				
	        			$outComments .= '<a class="button button-circle" id="btnOutComments"><i class="icon-edit"></i></a> '.$CommentNickNames[0]['nickname']." ： ".$SelCommentContens[$n]['comment'].'<span class="pull-right">'.$SelCommentContens[$n]['comment_datetime']."</span> <br/><br/>";
	        		}
	        		$outComments = rtrim($outComments, '<br/>');
        		}
        		
        		
        		echo '<div class="panel panel-primary"><div class="panel-heading"><h3 class="panel-title"><i class="icon-github-alt"></i> '. $nickArr[0]['nickname'] .'<span class="pull-right">'.$resArr[$i]['sent_time'].'</span></h3></div><div class="panel-body"><i class="glyphicon glyphicon-grain"></i> '. $resArr[$i]["msg"] .'</div><div class="panel-footer"><a class="btn btn-warning" id="btnZan" href="backprop/clickZanProcess.php?tag='.$resArr[$i]["id"].'"><i class="icon-thumbs-up"></i> 点赞 <span class="badge">'.$zans.'</span></a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-success" id="btnRefresh" onclick="toComment('.$resArr[$i]["id"].','.$resArr[$i]["user_id"].')"><i class="icon-edit"></i> 评 论 <span class="badge">'.$comments.'</span></a><hr/><div id="showZans">'.$names.'</div><hr/><div id="showComments">'.$outComments.'</div></div></div>';
        		
        	}
        ?>
        
        <?php 
        	// 获取内容数据总数
					$countSql = "select count(id) rows from tb_content";
					$countArr = $sqlHelper->excute_dql2($countSql);
					$_SESSION['data_rows'] = $countArr[0]['rows'];
				?>
        
        <input type="hidden" id="datacount" name="datacount" value="<?php echo $_SESSION['data_rows'];?>" />
        
        <!-- 分页 -->
        <nav>
				  <ul class="pager">
				  	<li><a href="garden.php?pageIndex=0"><i class="icon-double-angle-left"></i>   第一页</a></li>
				    <li><a href="garden.php?pageIndex=<?php if($pageIndex>0) echo $pageIndex-1; else echo 0;?>"><span>&larr;</span> 上一页</a></li>
				    <li><a>第 <span class="badge"><?php echo $pageIndex+1;?></span> 页，共 <span class="badge"><?php $pages=ceil($_SESSION['data_rows']/10);echo $pages;?></span> 页，每页 <span class="badge">10</span> 条</a></li>
				    <li><a href="garden.php?pageIndex=<?php if($pageIndex<$pages-1) echo $pageIndex+1; else echo $pages-1;?>">下一页  <span>&rarr;</span></a></li>
				    <li><a href="garden.php?pageIndex=<?php echo $pages-1;?>">最后一页   <i class="icon-double-angle-right"></i></a></li>
				  </ul>
				</nav>
        
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