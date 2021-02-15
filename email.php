<?php

echo var_dump($_POST);

$to = 'Yohan Salamone <yohan.salamone@outlook.com>';
$subject = 'Nouveau message de la part de '.$_POST['nom'];
$message =
    'Bonjour,' . "\r\n" .
    'Un message a été envoyé depuis le formulaire du portfolio, le voici : ' . "\r\n" .
    "\r\n" .
    '----------------------------------------------------------------------' . "\r\n" .
    'De la part de : '.$_POST['nom'].'<'.$_POST['email'].'>' . "\r\n" .
    'Date d\'envoi : '.date("\l\\e d/m/Y à H:i:s") . "\r\n" .
    'Sujet : '.$_POST['sujet']. "\r\n" .
    'Message : '.$_POST['message']. "\r\n" .
    '----------------------------------------------------------------------' . "\r\n" .
    "\r\n" .
    'Bonne journée.'. "\r\n" .
    ''
;

$headers =
    'From: bonjour@yohansalamone.com' . "\r\n" .
    'Reply-To: '. $_POST['nom'].'<'.$_POST['email'].'>' . "\r\n" .
    'Content-Type: text/plain; charset="UTF-8"' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$sent = mail($to, $subject, $message, $headers);

echo var_dump($sent);