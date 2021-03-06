<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html style="font-size:100px;">
	<head>
		<!--设置编码-->
		<meta charset="UTF-8">
		<!--设置设备屏幕自适应及用户缩放特性-->
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, 
			width=device-width, user-scalable=no">
		<title>home</title>
		<script type="text/javascript" src="__PUBLIC__/js/jquery-2.1.0.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				var LLQH=window.innerHeight;
				var Height=LLQH-110;
				$(".content").css("height",Height+"px");
				$("html").css("height",LLQH+"px");
				$('.error').hide();
			});
			
			function Msg(obj){
				$('.error span').text(obj);
				$('.error').fadeIn();
				setTimeout(function(){
					$('.error').fadeOut();
				},2000);
			}
			
			function check(){
				var yue=parseInt($(".balanceRight i").text());
				var pay=parseInt($(".detail4 i").text());
				if(yue<pay){
					Msg("余额不足,请先充值");
					return false;
				}
		    }
		</script>
		<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/pay.css"/>
	</head>

	<body style="font-size: 0px;">
		<!--内容主体-->
		<div class="Header">
			<div class="back">
				<a href="__APP__/Index/index"><img src="__PUBLIC__/images/icon/back.png" /> </a>
			</div>
			<div class="Title"><span>订单</span></div>
		</div>
		<div class="content">
		    <div class="balance">
		        <span class="balanceLeft">余额支付</span>
		        <span class="balanceRight">(账户余额 : <i><?php echo ($balance); ?></i>夺宝币)</span>
		    </div>
		    <div class="detail">
		        <span class="detail1">商品数量 :</span>
		        <span class="detail2"><?php echo ($count); ?>件</span>
		        <span class="detail3">应付金额 :</span>
		        <span class="detail4">总计 :  <i><?php echo ($allPay); ?></i>金币</span>
		    </div>
		    <?php if(is_array($title)): foreach($title as $k=>$vo): ?><div class="list">
			        <span class="left"><?php echo ($vo); ?></span>
			        <span class="right"><?php echo ($price[$k]); ?>人次</span>
			    </div><?php endforeach; endif; ?>
		</div>
		<div class="footer">
			<div class="borderLine"></div>
			<form action="__APP__/Pay/pay" method="post" onsubmit="return check()">
			    <input class="id" name="idStr" type="hidden" value="<?php echo ($idStr); ?>"/>
			    <input class="price" name="priceStr" type="hidden" value="<?php echo ($priceStr); ?>"/>
			    <input class="allPay" name="allPay" type="hidden" value="<?php echo ($allPay); ?>"/>
				<div class="confirm"><input type="submit" value="确认支付" /> </div>
			</form>
		</div>
		<div class="error">
			<span></span>
		</div>
	</body>

</html>