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

$sql = "INSERT INTO `mvp_white_list` (`email`, `ip`) 
        VALUES ('".$_POST['email']."','$ip')";

send_hook($_POST['email'], $ip);
echo $sql;
if (!$mysqli->query($sql)) {
    echo("error recovery bd");
    exit;
}

$mysqli->close();






function send_hook($email, $ip){
    $webhookUrl = "https://discordapp.com/api/webhooks/503568677363384330/6UpK1lOoGXvaUpemuK5Y-j6xaJXNvVKHkrDl2BoQyJcr144CAYch16mZLWd1ZT7gaOTj";

    $email_from_name = 'opnplatform';
    $email_from_email = 'notifications.opnplatform@gmail.com';
    $list_id = 15226169;
// Создаём POST-запрос
    $request = [
        'email' => $email,
        'ip' => $ip,

    ];

// Устанавливаем соединение
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_URL, $webhookUrl);

    $result = curl_exec($ch);

    if ($result) {
        // Раскодируем ответ API-сервера
        $jsonObj = json_decode($result);

        if (null === $jsonObj) {
            // Ошибка в полученном ответе
            echo 'Invalid JSON';

        } elseif (!empty($jsonObj->error)) {
            // Ошибка отправки сообщения
            echo sprintf('An error occured %s (code: %s)', $jsonObj->error, $jsonObj->code);
        } else {
            // Сообщение успешно отправлено
            echo 'Email message is sent. Message id ' . $jsonObj->result->email_id;

        }
    } else {
        // Ошибка соединения с API-сервером
        echo 'API access error';
    }
}
