<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html style="font-size:100px;">

	<head>
		<!--设置编码-->
		<meta charset="UTF-8">
		<!--设置设备屏幕自适应及用户缩放特性-->
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, 
			width=device-width, user-scalable=no">
		<title>home</title>
		<script type="text/javascript" src="__PUBLIC__/JS/jquery-2.1.0.js"></script>
		<script type="text/javascript">
		    var userpayUrl="__APP__/User/pay";
		    var payCount=0;
		    function payBtn(obj){
                $(obj).css('border','1px solid rgb(222,47,81)');
                $(obj).siblings().css('border','1px solid rgb(188,188,188)');
                $(obj).siblings().eq(0).css('border','0');
                payCount=parseInt($(obj).text());
			}
			$(document).ready(function(){
				$('#payInput').blur(function(){
					payCount=parseInt($(this).val());;
				});
				$('.error').hide();
				
				function errorInfo(obj){
					$('.error span').text(obj);
					$('.error').fadeIn();
					setTimeout(function(){
						$('.error').fadeOut();
					},1000);
				}
				$('.payNow').click(function(){
					if($("#userId").val()==0||$("#userId").val()==""){
						errorInfo('登录超时,请重新登录!');
					}else if(payCount){
						$.ajax({
							type:'POST',
							url:userpayUrl,
							dataType:'text',
							data:{payCount:payCount},
							beforeSend:function(){
								$('.error span').text('充值中,请稍后...');
								$('.error').fadeIn();
							},
							success:function(data){
								errorInfo(data);
								payCount=0;
								$('.recharge h4').siblings().css('border','1px solid rgb(188,188,188)');
								$('.recharge input').val("");
							},
							error:function(){
								errorInfo('连接超时,请检查网络');
							}
						});
					}else{
						errorInfo('请设置充值金额!');
					}
				});
			});
		
			
		</script>
		<link rel="stylesheet" type="text/css" href="__PUBLIC__/CSS/userPay.css" />
	</head>

	<body style="font-size: 0px;">
		<div class="homeHeader">
			<div class="homeTitle"><span>充值</span></div>
			<div class="messageCenter">
				<a href="__APP__/Index/index" ><img src="__PUBLIC__/images/icon/back.png" /> </a>
			</div>
		</div>
		<div class="top"></div>
		<div class="declare"> <span>充值金额用于购买零钱夺宝提供的电商优惠券(1元等于1张优惠券),同时获得相应个数的夺宝币,可以用于零钱夺宝,充值的款项将无法退回。</span> </div>
		<div class="recharge">
		    <h4>选择充值金额</h4>
		    <span onclick="payBtn(this)">10</span>
		    <span onclick="payBtn(this)">20</span>
		    <span onclick="payBtn(this)">50</span>
		    <span onclick="payBtn(this)">100</span>
		    <span onclick="payBtn(this)">200</span>
		    <input id='payInput' onclick="payBtn(this)" placeholder="其他金额" type='number'>
		</div>
		<div class="payNow">马上充值</div>
		<div class="error">
			<span></span>
		</div>
		<input id="userId" type="hidden" value="<?php echo ($userId); ?>"/>
	</body>

</html>