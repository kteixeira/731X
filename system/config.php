<?php
	//BANCO DE DADOS
	
    define('DB_HOSTNAME', 'localhost');
	define('DB_USERNAME','root');
	define('DB_PASSWORD', '');
	define('DB_DATABASE','dump');
	define('DB_CHARSET','utf8');
	
	//URL'S
	
	define ('URL_BASE', 'http://localhost/BetaLabs');
	define ('URL_CADASTRO', URL_BASE.'/cadastro.php');
	define ('URL_PAINEL', URL_BASE.'/painel.php');
	define ('URL_LOGIN', URL_BASE.'/login.php');
	
	//DIRETÓRIOS
	
	define('DIR_BASE', $_SERVER['DOCUMENT_ROOT'].'/BetaLabs/');
	define('DIR_SYSTEM', DIR_BASE.'system/');
	
	//CONFIG DE ARQUIVS
	
	define ('FILE_CONFIG', DIR_SYSTEM.'config.php');
	define ('FILE_HELPERS', DIR_SYSTEM.'helpers.php');
	define ('FILE_DATABASE', DIR_SYSTEM.'database.php');
	
?>