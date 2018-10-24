<?php
function get_ip()
{
  if (!empty($_SERVER['HTTP_CLIENT_IP']))
  {
    $ip=$_SERVER['HTTP_CLIENT_IP'];
  }
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
  {
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  else
  {
    $ip=$_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}

function connect_db() {
  $mysqli = new mysqli(
    "localhost",
    "opn.mvp.com",
    "FqJCN0sqxS",
    "mvp_white_list"
  );

  $mysqli->set_charset("utf8");

  if ($mysqli->connect_errno) {
    echo("error connect bd");
    exit;
  }

  return $mysqli;
}

$mysqli = connect_db();

$ip = get_ip();

$sql = "INSERT INTO `mvp_white_list` (`email`, `ip`) VALUES ('".$_POST['email']."','$ip')";

if (!$mysqli->query($sql)) {
  echo("error recovery bd");
  exit;
}

$mysqli->close();

send_hook($_POST['email'], $ip);

function send_hook($email, $ip){
// Создаём POST-запрос
  $request = [
    'content' => '**email: **' . $email. "\n" .
      '**ip: **' . $ip. "\n" .
      '--------------------------',
  ];

// Устанавливаем соединение
  $ch = curl_init("https://discordapp.com/api/webhooks/503568677363384330/6UpK1lOoGXvaUpemuK5Y-j6xaJXNvVKHkrDl2BoQyJcr144CAYch16mZLWd1ZT7gaOTj");
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));

  $result = curl_exec($ch);

  if ($result) {
    echo $result;
  }
}
