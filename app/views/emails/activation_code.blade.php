<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mail</title>
</head>
<body>
	<p>Enter this code in the link to activate your account. <a href="{{ URL::to('activation') }}">{{ URL::to('activation') }}</a> <br /><br />

		<strong> Register Account:</strong> {{ $email }} <br />
		<strong> Code:</strong> {{ $code }} </p>
</body>
</html>