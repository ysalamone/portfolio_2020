<?php

if(!isset($_POST['nom'], $_POST['email'], $_POST['sujet'], $_POST['message'], $_POST['g-recaptcha-response']))
	header('Location: http://www.yohansalamone.com?sent=false');

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://www.google.com/recaptcha/api/siteverify",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => "secret=6LfwPVobAAAAALDGrQW55VphSg6p-gw6ozNSCGHo&response=" . $_POST['g-recaptcha-response'],
	CURLOPT_HTTPHEADER => [
		"Content-Type: application/x-www-form-urlencoded"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if($err)
	header('Location: http://www.yohansalamone.com?sent=false');

$response = json_decode($response, TRUE);
if(!$response['success'] || (isset($response['score']) && $response['score'] <= 0.7))
	header('Location: http://www.yohansalamone.com?sent=false');

$to = 'Yohan Salamone <yohan.salamone@outlook.com>';
$subject = $_POST['sujet'];
$message =
	'<p>Bonjour,</p>' .
	'<p>Le message ci-dessous a été envoyé depuis le formulaire du portfolio.</p>' .
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
