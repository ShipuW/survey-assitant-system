<?php
 
class MyConnect{
 
 public function connect($db_server,$db_user,$db_pwd,$db_name){
  $conn = mysql_connect($db_server,$db_user,$db_pwd);
  if (!$conn){
   die('connect failed: ' . mysql_error());
  }
  $flag = mysql_select_db($db_name,$conn);
  if(!$flag){
   echo "<p align='center'>db connect failed!</p>";exit();
  }else{
   //echo "<p align='center'>connect successful!</p>";
   mysql_query("SET NAMES UTF8");
  }
 }
 
}

$conn = new MyConnect();
$conn->connect("localhost","root","864159025","project");

?>
