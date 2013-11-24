<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript" src="./javaScript/scriptValidacao.js"></script>
<link rel="stylesheet" type="text/css" href="./css/estilos.css" />
<title>Logon</title>
</head>
<body>
	<div>

		<form name="login" action="autenticacao.php" method="POST">
			<table border="0" align="center">
				<tr>
					<td>Login:</td>
					<td><input type="text" name="log" /></td>
				</tr>
				<tr>
					<td>Senha:</td>
					<td><input type="password" name="senha" /></td>
				</tr>
				<tr>
					<td></td>
					<td align="right"><input type="button" name="btnLogin"
						value="Logar" onclick="validaLogon()" /></td>
				</tr>

			</table>
		</form>
	</div>
</body>
</html>