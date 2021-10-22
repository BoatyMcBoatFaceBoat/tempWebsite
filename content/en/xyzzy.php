<?php session_start(); // english
$return_message = 'fail';

if (!empty($_POST['token']) && !empty($_SESSION[$_POST['token']])) {
  if (!empty($_POST['captcha']) && !empty($_SESSION[$_POST['token']]['captcha_answer']));
  $captcha = $_POST['captcha'];
  $captcha = trim(strtolower($captcha));
  $captcha = str_replace('the ', '', $captcha);
  $captcha = str_replace('a ', '', $captcha);
  if (in_array($captcha, $_SESSION[$_POST['token']]['captcha_answer'])) {
    $sent = mail($_SERVER['SERVER_ADMIN'],
      ':>hlt: ' . htmlspecialchars($_POST['subject']),
      htmlspecialchars(str_replace("\n.", "\n..", $_POST['message'])),
      'From: ' . htmlspecialchars($_POST['email']) . "\r\n" .
      'X-Mailer: PHP/' . phpversion());
    $return_message = 'success';
  }
}

header('Location: index.xhtml?message=' . $return_message);