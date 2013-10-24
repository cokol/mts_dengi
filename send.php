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
  require($_SERVER["DOCUMENT_ROOT"]."/newclients/dbcon.php");
  $query = "INSERT INTO `requests` VALUES('',NOW(),'".getRealIpAddr()."','".mysql_real_escape_string($_POST["request_name"])."','".mysql_real_escape_string($_POST["request_lastname"])."','".mysql_real_escape_string($_POST["request_email"])."','".mysql_real_escape_string($_POST["request_phone"])."','".($from ? $from : "newclients")."')";
  mysql_query($query);
}


//var_dump($_POST);
$body="Фамилия: ".$_POST['request_lastname']."\n";
$body.="Имя: ".$_POST['request_name']."\n";
$body.="Электронная почта: ".$_POST['request_email']."\n";
$body.="Контактный телефон: ".$_POST['request_phone']."\n";

//mail("disco3000@gmail.com", "Заявка на карту", $body);

?>