<?php

Init();

//Valida Formulário de login
function ValidateFormLogin() {
	if (!!GetPost('send')) {
		$message = null;
		$username = GetPost('username');
		$password = GetPost('password');

		if (empty($username))
			$message = 'Informe seu usuário!';
		else if (empty($password))
			$message = 'Informe sua senha!';
		else {
			if (!UserVerify($username, $password))
				$message = 'Nome de usuário ou senha incorretos';
			else {
				CreateSession($username, $password);
			}
		}

		echo($message != null) ? $message . '<hr/>' : null;
	}
}

//Valida formulario de cadastro
function ValidateFormRegister() {
	if (!!GetPost('send')) {

		$message = null;

		$nome = GetPost('nome');
		$email = GetPost('email');
		$username = GetPost('username');
		$password = GetPost('password');
		$confirm = GetPost('confirm');

		if (empty($nome))
			$message = 'Informe seu Nome!';
		else if (empty($email))
			$message = 'Informa seu E-mail!';
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			$message = 'Informe um E-mail válido!';
		else if (empty($username))
			$message = 'Informa seu Usuário!';
		else if (empty($password))
			$message = 'Informa sua Senha!';
		else if (empty($email))
			$message = 'Confirme sua Senha!';
		else if ($password != $confirm)
			$message = 'As Senhas não correspondem!';
		else {
			if (!MailExists($email))
				$message = 'Este Email já está cadastrado!';
			else if (!UserNameExists($username))
				$message = 'Este usuário já está cadastrado!';
			else {
				$register = Register($nome, $email, $username, $password);
				if (!$register)
					$message = 'Desculpe, ocorreu um erro.';
				else
					CreateSession($username, $password);
			}
		}
		echo($message != null) ? $message . '<hr/>' : null;
	}
}

//Valida formulario de cadastro
function ValidateFormEdit() {
	if (!!GetPost('edit')) {
		$message = null;

		$nome = GetPost('nome');
		$email = GetPost('email');
		$username = GetPost('username');
		$password = GetPost('password');
		$confirm = GetPost('confirm');

		if (empty($nome))
			$message = 'Informe seu Nome!';
		else if (empty($email))
			$message = 'Informa seu E-mail!';
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			$message = 'Informe um E-mail válido!';
		else if (empty($password))
			$message = 'Informa sua Senha!';
		else if ($password != $confirm)
			$message = 'As Senhas não correspondem!';
		else if (empty($username))
			$message = 'Informa seu Usuário!';
		else {
			if (!MailExistsEdit($email))
				$message = 'Este email já está cadastrado!';
			else if (!UserNameExistsEdit($username))
				$message = 'Este usuário já está cadastrado!';
			else {
				$register = EditUser($nome, $email, $username, $password, $confirm);
				var_dump($register);
				if (!$register)
					$message = 'Desculpe, ocorreu um erro.';
				else
					CreateSession($username, $password);
			}
		}
		echo($message != null) ? $message . '<hr/>' : null;
	}
}

//INIT
function Init() {
	session_start();

	//Chama config
	$configFile = $_SERVER['DOCUMENT_ROOT'] . '/BetaLabs/system/config.php';

	if (!file_exists($configFile))
		die('Erro, arquivo config.php não existe.');
	else
		require_once $configFile;

	//Chama Helpers
	if (!file_exists(FILE_HELPERS))
		die('Erro, arquivo helpers.php não existe.');
	else
		require_once FILE_HELPERS;

	//Chama Database
	if (!file_exists(FILE_DATABASE))
		die('Erro, arquivo database.php não existe.');
	else
		require_once FILE_DATABASE;

	DBConnect();
	DoLogout();

}
?>