<?php

function getRealIpAddr()
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

//$_POST = str_replace ("'", "", $_POST);
if($_POST["request_lastname"] && $_POST["request_name"] && $_POST["request_email"] && $_POST["request_phone"]){
  //подключимся к базе
  mysql_connect('localhost', 'dengi_mts_dbu', 'dengi_mts_360d');    \
  mysql_select_db('dengi_mts');
  mysql_query("SET NAMES utf8");
  $query = "INSERT INTO `requests` VALUES('',NOW(),'".getRealIpAddr()."','".mysql_real_escape_string($_POST["request_name"])."','".mysql_real_escape_string($_POST["request_lastname"])."','".mysql_real_escape_string($_POST["request_email"])."','".mysql_real_escape_string($_POST["request_phone"])."')";
  mysql_query($query);
}


//var_dump($_POST);
$body="Фамилия: ".$_POST['request_lastname']."\n";
$body.="Имя: ".$_POST['request_name']."\n";
$body.="Электронная почта: ".$_POST['request_email']."\n";
$body.="Контактный телефон: ".$_POST['request_phone']."\n";

//mail("disco3000@gmail.com", "Заявка на карту", $body);

?>