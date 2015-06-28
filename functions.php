<?php

if($_POST)
{
    require_once("phpmailer/class.smtp.php");
    require_once("phpmailer/class.phpmailer.php");

    $subject = '731X contato via site - ' . $_POST['assunto'];

    $message = $_POST['mensagem'];

    $mail = new PHPMailer();

    $mail->IsSMTP();

    $mail->SMTPAuth = true;

    $mail->SMTPSecure = "ssl";
    $mail->Host='smtp.gmail.com';
    //$mail->Username = "framework@bluecore.it"; // SMTP username
    //$mail->Password = "bluecore1357"; // SMTP password
    $mail->Username = "teix.ru@gmail.com"; // SMTP username
    $mail->Password = "gktteix731x"; // SMTP password

    $mail->IsHTML(true);
    $mail->Port = "465";
    $mail->SingleTo = true;

    $mail->From     = $_POST['email'];
    $mail->FromName = $_POST['nome'];

    $mail->AddAddress('teix.ru@gmail.com');
    $mail->AddReplyTo('teix.ru@gmail.com');
    $mail->Subject = $subject;
    $mail->Body = $message;

    $return = $mail->Send();

    // Exibe uma mensagem de resultado
    if (!$return) {
      echo "Não foi possível enviar o e-mail.";
      echo "<b>Informações do erro:</b> " . $mail->ErrorInfo;
      print_r($return);exit;
    }
}

?>
