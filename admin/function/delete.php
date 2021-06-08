<?php
$connect = mysqli_connect("localhost", "root", "[kob&kim]", "findabook");
if(isset($_POST["id"]))
{
 $query = "DELETE FROM tb_findbook WHERE f_no = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Deleted';
 }
}
?>
