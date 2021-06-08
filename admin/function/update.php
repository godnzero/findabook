<?php
$connect = mysqli_connect("localhost", "root", "[kob&kim]", "findabook");
if(isset($_POST["id"]))
{
 $value = mysqli_real_escape_string($connect, $_POST["value"]);
 $query = "UPDATE tb_findbook SET ".$_POST["column_name"]."='".$value."' WHERE f_no = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Updated';
 }
}
?>