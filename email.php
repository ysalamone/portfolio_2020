<?php

echo var_dump($_POST);

$to = 'Yohan Salamone <yohan.salamone@outlook.com>';
$subject = 'Nouveau message de la part de '.$_POST['nom'];
$message =
    '<p>Bonjour,</p>' .
    '<p>Un message a été envoyé depuis le formulaire du portfolio, le voici : </p>' .
    "<br/>" .
    '<hr/>' .
    '<div><b>De la part de :</b> '.$_POST['nom'].' <'.$_POST['email'].'></div>' .
    '<div><b>Date d\'envoi :</b> '.date("\l\\e d/m/Y à H:i:s").'</div>' .
    '<div><b>Sujet :</b> '.$_POST['sujet'].'</div>' .
    '<div><b>Message :</b> <p>'.str_replace(["\n", "\r\n"], '<br/>', $_POST['message']).'</p></div>' .
    '<hr/>' .
    "<br/>" .
    '<p>Bonne journée.</p>'
;

$headers =
    'From: bonjour@yohansalamone.com' . "\r\n" .
    'Reply-To: '. $_POST['nom'].'<'.$_POST['email'].'>' . "\r\n" .
    'Content-Type: text/html; charset="UTF-8"' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$sent = mail($to, $subject, $message, $headers);

echo var_dump($sent);