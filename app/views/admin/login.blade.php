<!doctype html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Đăng nhập</title>	
	{{ HTML::style('css/admin.css') }}
</head>

<body id="login">

	<div id="login-box">
		

		<form class="" method="POST" action="/login">
			@if(isset($error))
				Bạn đã nhập sai email hoặc mật khẩu
			@endif
			<div class="emailnpassword">
				<input type="text" id="email" name="email" placeholder="Email của bạn">
				<input type="password" id="password" name="password" placeholder="Nhập mật khẩu">
			</div>	

			<div class="remembernsubmit">
				<div class="pull-left">
				<input type="checkbox" name="remember" /> <label for="remember">Ghi nhớ</label>
				</div>

				<div class="pull-right">
				<button type="submit" class="btn btn-blue">Đăng nhập</button>
				</div>
				<div class="clearfix"></div>
			</div>
		</form>



	</div>


</body>
</html>
	
