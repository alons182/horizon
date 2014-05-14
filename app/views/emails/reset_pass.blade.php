<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mail</title>
</head>
<body>
	<p>Enter this code in the link to reset your password. <a href="{{ URL::to('newpassword') }}">{{ URL::to('newpassword') }}</a> <br /><br />

		<strong> Register Account:</strong> {{ $email }} <br />
		<strong> Reset Code: </strong> {{ $code }}
	</p>
</body>
</html>