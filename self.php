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
    <title>社交花园~个人花园~个人说说</title>
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
			
			#go_top{
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

			function showTip() {
				popwindown('info', '不能在个人花园内给自己点赞或评论！');
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
			        			<li>
						        	<a href="selfInfo.php">
						        		<i class="icon-user-md icon-large"></i> 个人信息
					        		</a>
				        		</li>
				        		<li role="separator" class="divider"></li>
				        		<li class="active">
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
        		<i class="icon-spinner icon-spin icon-large"></i> 个人发布过的动态信息
        	</p>
        </div>
        
        <?php 
        	// 获取内容
        	$pageIndex = 0;	//当前是第几页
        	if (!empty($_GET['pageIndex']))
        		$pageIndex = $_GET['pageIndex'];
        	$sqlHelper = new SqlHelper();
        	$sql = "select * from tb_content where user_id=".$_SESSION["user_id"]." order by id desc limit ".($pageIndex*10).",10;";
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
        		
        		echo '<div class="panel panel-info"><div class="panel-heading"><h3 class="panel-title"><i class="icon-github-alt"></i> '. $nickArr[0]['nickname'] .'<span class="pull-right">'.$resArr[$i]['sent_time'].'</span></h3></div><div class="panel-body"><i class="glyphicon glyphicon-grain"></i> '. $resArr[$i]["msg"] .'</div><div class="panel-footer"><a class="btn btn-danger" id="btnZan" onclick="showTip()"><i class="icon-thumbs-up"></i> 点赞 <span class="badge">'.$zans.'</span></a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-success" id="btnRefresh"  onclick="showTip()"><i class="icon-edit"></i> 评 论 <span class="badge">'.$comments.'</span></a><hr/><div id="showZans">'.$names.'</div><hr/><div id="showComments">'.$outComments.'</div></div></div>';
        		
        	}
        ?>
        
        <?php 
        	// 获取内容数据总数
					$countSql = "select count(id) rows from tb_content where user_id=".$_SESSION["user_id"];
					$countArr = $sqlHelper->excute_dql2($countSql);
					$_SESSION['data_rows'] = $countArr[0]['rows'];
				?>
        
        <input type="hidden" id="datacount" name="datacount" value="<?php echo $_SESSION['data_rows'];?>" >
        
        <!-- 分页 -->
        <nav>
				  <ul class="pager">
				  	<li><a href="self.php?pageIndex=0"><i class="icon-double-angle-left"></i>   第一页</a></li>
				    <li><a href="self.php?pageIndex=<?php if($pageIndex>0) echo $pageIndex-1; else echo 0;?>"><span>&larr;</span> 上一页</a></li>
				    <li><a>第 <span class="badge"><?php echo $pageIndex+1;?></span> 页，共 <span class="badge"><?php $pages=ceil($_SESSION['data_rows']/10);echo $pages;?></span> 页，每页 <span class="badge">10</span> 条</a></li>
				    <li><a href="self.php?pageIndex=<?php if($pageIndex<$pages-1) echo $pageIndex+1; else echo $pages-1;?>">下一页  <span>&rarr;</span></a></li>
				    <li><a href="self.php?pageIndex=<?php echo $pages-1;?>">最后一页   <i class="icon-double-angle-right"></i></a></li>
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
    