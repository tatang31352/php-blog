<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">
<title>尊敬的凡心陛下</title>
<link rel="stylesheet" href="/admin/home/login/css/reset.css">
<link rel="icon" href="/bitbug_favicon.ico">
<link rel="stylesheet" href="/admin/home/login/css/style.css" media="screen" type="text/css" />
<script src="/admin/home/jquery-1.10.2.js"></script>  

</head>

<body>

<div id="window" style="display:none;">

	<div class="page page-front">
		<div class="page-content">
			<div class="input-row">
				<label class="label fadeIn">用户名</label>
				<input id="username" type="text" data-fyll="七星陛下" class="input fadeIn delay1"/>
			</div>
        	<input type="hidden" name="csrf-token" value="{{ csrf_token() }}">

			<div class="input-row">
				<label class="label fadeIn delay2">密码</label>
				<input id="password" type="password" data-fyll="hackmeplease" class="input fadeIn delay3"/>
			</div>
			<div class="input-row perspective">
				<button id="submit" class="button load-btn fadeIn delay4">
					<span class="default"><i class="ion-arrow-right-b"></i>登录</span>
					<div class="load-state">
						<div class="ball"></div>
						<div class="ball"></div>
						<div class="ball"></div>
					</div>
				</button>
			</div>
		</div>
	</div>
	
	<div class="page page-back">
		<div class="page-content">
			<img src="/admin/home/login/avatar.jpg" class="avatar"/>
			<p class="welcome">欢迎回来，狗！</p>
			<p class="number">5</p>
			<div class="perspective">
				<a href="{{url('admin/index/index')}}" class="button inline trigger-anim-replay">
					<i class="ion-refresh">立即登录</i> 
				</a>
			</div>
		</div>
	</div>
</div>

<!-- <div class="browser-warning hidden">问题或怪异的动画？让它玩一次，然后按重播。</div> -->

<script type="text/javascript" src='/admin/home/login/js/jquery.js'></script>
<script type="text/javascript" src='/admin/home/login/js/fyll.js'></script>
<script type="text/javascript" src="/admin/home/login/js/index.js"></script>
<script src="/admin/home/assets/layui.all.js"></script>
<div style="text-align:center;">
</div>

</body>
</html>