<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mail</title>
</head>
<body>
	<p>Ingresa este codigo en el siguiente enlace para activar tu cuenta. <a href="{{ URL::to('activation') }}">{{ URL::to('activation') }}</a> <br /><br />

		<strong> Cuenta registrada:</strong> {{ $email }} <br />
		<strong> Codigo:</strong> {{ $code }} </p>
</body>
</html>