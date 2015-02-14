<?php

/*================================================*/
/*PROTEÇÃO*/

//Controla acesso publico
function AccessPublic() {
	if (IsLogged())
		Redirect(URL_PAINEL);
}

//Controla acesso privado
function AccessPrivate() {
	if (!IsLogged())
		Redirect(URL_BASE);
}

/*================================================*/

/*================================================*/
/*SESSÃO*/

//Efetua logout
function DoLogout() {
	if (isset($_GET['logout']))
		DestroySession();
}

//Destrói sessão
function DestroySession() {
	unset($_SESSION['userLog']);
	AccessPrivate();
}

//Cria a sessão
function CreateSession($username, $password) {
	$key = GetKey($username, $password);
	UserLog($key);
	AccessPublic();
}

// Seta ou recupera USER LOG
function UserLog($value = null) {
	if ($value === null)
		return $_SESSION['userLog'];
	else
		$_SESSION['userLog'] = $value;
}

//Verifica login
function IsLogged() {
	if (!isset($_SESSION['userLog']) || empty($_SESSION['userLog']))
		return false;
	else {
		if (StayLogged()) {
			return true;
		} else {
			DestroySession();
		}
	}

}

/*================================================*/

//Criptografar senhas
function CryptPassword($password) {
	return sha1($password);
}

//Gera Key de usuário
function KeyGenerator() {
	return sha1(rand() . time());
}

//Recuperar post
function GetPost($key = null) {
	if ($key === null)
		return $_POST;
	else
		return (isset($_POST[$key])) ? $_POST[$key] : false;
}

//Redireciona
function Redirect($url) {
	header("Location: " . $url);
	die();
}

//Limpa string/
function DBClearString($str) {
	return mysql_real_escape_string(strip_tags(trim($str)));
}

function PublicComment() {
	if (isset($_POST['publicar'])) {

		$form['titulo'] = DBEscape(strip_tags(trim($_POST['titulo'])));
		$form['autor'] = DBEscape(strip_tags(trim($_POST['autor'])));
		$form['id_usuario'] = GetUser('id');
		$form['data'] = date('Y-m-d H:i:s');
		$form['conteudo'] = str_replace('\r\n', "\n", DBEscape(trim($_POST['conteudo'])));

		if (empty($form['titulo']))
			echo 'Preencha o campo título';
		else if (empty($form['autor']))
			echo 'Preencha o campo autor';
		else if (empty($form['conteudo']))
			echo 'Preencha o campo conteudo';
		else {
			if (DBCreate('comentarios', $form))
				echo 'Seu comentário foi enviado com sucesso.';
			else {
				echo 'Desculpe, ocorreu um erro..';
			}

		}

		echo '<hr>';
	}
}

function EditComment() {
	if (isset($_POST['salvar'])) {

		$form['titulo'] = DBEscape(strip_tags(trim($_POST['titulo'])));
		$form['autor'] = DBEscape(strip_tags(trim($_POST['autor'])));
		$form['data'] = date('Y-m-d H:i:s');
		$form['conteudo'] = str_replace('\r\n', "\n", DBEscape(trim($_POST['conteudo'])));
		$id = $_GET['id'];
		
		if (empty($form['titulo']))
			echo 'Preencha o campo título';
		else if (empty($form['autor']))
			echo 'Preencha o campo autor';
		else if (empty($form['conteudo']))
			echo 'Preencha o campo conteudo';
		else {
			if (DBUpDate('comentarios', $form, "id = '{$id}'")) {
				echo 'Seu comentário foi editado com sucesso.';

				$coment = DBRead('comentarios', "WHERE id = '{$id}' LIMIT 1");
				$coment = $coment[0];
			} 
			else {
				echo 'Desculpe, ocorreu um erro..';
			}

		}
		echo '<hr>';
	}
}
?>