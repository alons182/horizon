<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mail</title>
</head>
<body>
	<p>Ingresa este codigo en el siguiente enlace para resetear tu contraseña. <a href="{{ URL::to('newpassword') }}">{{ URL::to('newpassword') }}</a> <br /><br />

		<strong> Cuenta registrada:</strong> {{ $email }} <br />
		<strong> Codigo de reseteo : </strong> {{ $code }}
	</p>
</body>
</html>