<!DOCTYPE HTML>

<html>
	<head>
		<title>731X - Respeito e União</title>
		<meta charset = "UTF-8" />
		<link rel = "stylesheet" type="text/css" href="css/style.css" />
		<link rel = "stylesheet" type="text/css" href="css/grid-min.css" />
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	</head>
	<body>
		<div class="geral">
			<?php include 'header-black.php'; ?>
				<section class = "container-part1">
					<div class="grid-container">
						<div class="grid-100">
							<form action="" method="post" class = "form">
								<h1>C O N T A T O</h1><br>
								<p>Preencha os campos abaixo para entrar em<br>contato conosco.</p><br/>
								<input type="text" class="formArea" placeholder="NOME:" name = "nome">
								<input type="text" class="formArea" placeholder="EMAIL:" name = "email">
								<input type="text" class="formArea" placeholder="ASSUNTO:" name = "assunto">
								<textarea placeholder="MENSAGEM:" class="formMsg" cols="20" rows="6" name="mensagem"></textarea><br/>	
								
								<input type="submit"  name="publicar" value="ENVIAR &#8594" class="submit">			
							</form>
						</div>
					</div>
				</section>
				<section class = "container-part2">
					<div class="grid-container">
						<div class="grid-100">
							<img src="img/001.jpg"/>
						</div>
					</div>				
				</section>
			</div>
	</body>
</html>