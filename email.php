<?php

echo var_dump($_POST);

$to = 'Yohan Salamone <yohan.salamone@outlook.com>';
$subject = $_POST['sujet'];
$message =
    '<p>Bonjour,</p>' .
    '<p>Le message ci-dessous vous a été envoyé depuis le formulaire du portfolio.</p>' .
    '<p>Bonne journée.</p>' .
    "<br/>" .
    '<hr size="2"/>' .
    '<div><b>De la part de :</b> '.$_POST['nom'].' &lt;'.$_POST['email'].'&gt;</div>' .
    '<div><b>Date d\'envoi :</b> '.date("\l\\e d/m/Y à H:i:s").'</div>' .
    '<div><b>Sujet :</b> '.$_POST['sujet'].'</div>' .
    '<p>'.str_replace(["\n", "\r\n"], '<br/>', $_POST['message']).'</p>'
;

$headers =
    'From: bonjour@yohansalamone.com' . "\r\n" .
    'Reply-To: '. $_POST['nom'].'<'.$_POST['email'].'>' . "\r\n" .
    'Content-Type: text/html; charset="UTF-8"' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$sent = mail($to, $subject, $message, $headers);

if($sent)
    header('Location: http://www.yohansalamone.com?sent=true');
else
    header('Location: http://www.yohansalamone.com?sent=false');