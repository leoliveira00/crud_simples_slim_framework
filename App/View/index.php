<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />

	<title>.:: Essentia - Clientes ::.</title>	

    <link rel="stylesheet" href="css/estilo.css">
    
    <!--JQuery-->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>
<body>

<div id="container">
    <ul>
        <li><a href="#aba-1">Listagem</a></li>
        <li><a href="#aba-2">Cadastro</a></li>
    </ul>
    <div id="aba-1"><?php include "listagem.php"; ?></div>
    <div id="aba-2"><?php include "cadastro.php"; ?></div>
</div>
    
<script src="js/main.js"></script>

</body>
</html>