<?php

//Recupera informações do usuário
function GetUser($key = null) {
	if (!IsLogged())
		return false;
	else {
		$userkey = UserLog();
		$query = "SELECT * FROM usuarios WHERE userkey = '$userkey' LIMIT 1";
		$result = DBExecute($query);
		$data = mysqli_fetch_assoc($result);

		if ($key == null)
			return $data;
		else {
			return (isset($data[$key])) ? $data[$key] : false;
		}
	}

}

//Verifica usuário logado
function StayLogged() {
	$userkey = UserLog();
	$query = "SELECT userkey FROM usuarios WHERE userkey = '{$userkey}'";
	$result = DBExecute($query);

	if (mysqli_num_rows($result) <= 0)
		return false;
	else
		return true;
}

//Recupera Key
function GetKey($username, $password) {
	$dataUser = UserVerify($username, $password);
	return $dataUser;
}

//Verifica Usuário
function UserVerify($username, $password) {
	$password = CryptPassword($password);
	$query = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";
	$result = DBExecute($query);

	if (mysqli_num_rows($result) <= 0)
		return false;
	else {
		$data = mysqli_fetch_assoc($result);
		return $data['userkey'];
	}

}

//Edita usuário
function EditUser($nome, $email, $username, $insertId = false, $password) {
	$insertId = GetUser('id');
	$password = CryptPassword($password);
	$userkey = KeyGenerator();

	$query = "UPDATE usuarios SET nome = '$nome', email = '$email', username = '$username', userkey = '$userkey', password = '$password'";
	$query .= " WHERE id =  $insertId";

	return DBExecute($query);
}

//Cadastra usuário
function Register($nome, $email, $username, $password, $insertId = false) {
	$password = CryptPassword($password);
	$userkey = KeyGenerator();
	$register = time();

	$query = "INSERT INTO usuarios (nome, email, username, password, userkey)";
	$query .= "VALUES ('$nome', '$email', '$username', '$password', '$userkey')";

	return DBExecute($query, $insertId);
}

//Verifica se username existe
function UserNameExists($username) {

	$result = DBRead('usuarios', $params = 'username', $fields = 'username');

	$query = "SELECT username FROM usuarios WHERE username = '$username'";
	$result = DBExecute($query);

	if (mysqli_num_rows($result) <= 0)
		return true;
	else
		return false;
}

//Verifica se username existe
function UserNameExistsEdit($username) {
	$usernameUser = GetUser('username');

	$result = DBRead('usuarios', $params = 'username', $fields = 'username');
	$query = "SELECT username FROM usuarios WHERE username = '$username'";
	$result = DBExecute($query);
	$resultUsername = mysqli_fetch_assoc($result);
	$resultUsername = $resultUsername['username'];

	if (mysqli_num_rows($result) <= 0 || $usernameUser == $resultUsername)
		return true;
	else
		return false;
}

//Verifica se existe Email
function MailExists($email) {

	$query = "SELECT email FROM usuarios WHERE email = '$email'";
	$result = DBExecute($query);

	if (mysqli_num_rows($result) <= 0)
		return true;
	else
		return false;
}

//Verifica se existe Email ou se é o mesmo do usuário
function MailExistsEdit($email) {
	$mailUser = GetUser('email');

	$query = "SELECT email FROM usuarios WHERE email = '$email'";
	$result = DBExecute($query);
	$resultEmail = mysqli_fetch_assoc($result);
	$resultEmail = $resultEmail['email'];

	if ($mailUser === $resultEmail || mysqli_num_rows($result) <= 0)
		return true;
	else
		return false;
}

// Deleta Registros
function DBDelete($table, $where = null) {
	$where = ($where) ? " WHERE {$where}" : null;

	$query = "DELETE FROM {$table}{$where}";
	return DBExecute($query);
}

// Altera Registros
function DBUpDate($table, array $data, $where = null, $insertId = false) {
	foreach ($data as $key => $value) {
		$fields[] = "{$key} = '{$value}'";
	}

	$fields = implode(', ', $fields);

	$where = ($where) ? " WHERE {$where}" : null;

	$query = "UPDATE {$table} SET {$fields} {$where}";
	return DBExecute($query, $insertId);
}

// Ler Registros
function DBRead($table, $params = null, $fields = '*') {
	$params = ($params) ? " {$params}" : null;

	$query = "SELECT {$fields} FROM {$table} {$params}";
	$result = DBExecute($query);

	if (!mysqli_num_rows($result))
		return false;
	else {
		while ($res = mysqli_fetch_assoc($result)) {
			$data[] = $res;
		}

		return $data;
	}
}

// Grava Registros
function DBCreate($table, array $data, $insertId = false) {
	$data = DBEscape($data);

	$fields = implode(', ', array_keys($data));
	$values = "'" . implode("', '", $data) . "'";

	$query = "INSERT INTO {$table} ( {$fields} ) VALUES ( {$values} )";

	return DBExecute($query, $insertId);
}

// Executa Querys
function DBExecute($query, $insertId = false) {
	$link = DBConnect();
	$result = @mysqli_query($link, $query) or die(mysqli_error($link));

	if ($insertId)
		$result = mysqli_insert_id($link);

	DBClose($link);
	return $result;
}

// Protege contra SQL Injection
function DBEscape($data) {
	$link = DBConnect();

	if (!is_array($data))
		$data = mysqli_real_escape_string($link, $data);
	else {
		$arr = $data;

		foreach ($arr as $key => $value) {
			$key = DBEscape($key);
			$value = DBEscape($value);

			$data[$key] = $value;
		}
	}

	DBClose($link);
	return $data;
}

// Fecha Conexão com MySQL
function DBClose($link) {
	@mysqli_close($link) or die(mysqli_error($link));
}

// Abre com Conexão com MySQL
function DBConnect() {
	$link = @mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die(mysqli_connect_error());
	mysqli_set_charset($link, DB_CHARSET) or die(mysqli_error($link));
	return $link;
}
