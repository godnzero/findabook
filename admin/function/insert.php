<?php
$connect = mysqli_connect("localhost", "root", "[kob&kim]", "findabook");
if(isset($_POST["f_lib"], $_POST["f_floor"],$_POST["f_bcase"], $_POST["f_cat"],$_POST["f_callno"], $_POST["f_barcode"],$_POST["f_map"], $_POST["f_note"]))
{
 $f_lib = mysqli_real_escape_string($connect, $_POST["f_lib"]);
 $f_floor = mysqli_real_escape_string($connect, $_POST["f_floor"]);
 $f_bcase = mysqli_real_escape_string($connect, $_POST["f_bcase"]);
 $f_cat = mysqli_real_escape_string($connect, $_POST["f_cat"]);
 $f_callno = mysqli_real_escape_string($connect, $_POST["f_callno"]);
 $f_barcode = mysqli_real_escape_string($connect, $_POST["f_barcode"]);
 $f_map = mysqli_real_escape_string($connect, $_POST["f_map"]);
 $f_note = mysqli_real_escape_string($connect, $_POST["f_note"]);
 $query = "INSERT INTO tb_findbook(f_lib, f_floor, f_bcase, f_cat, f_callno, f_barcode, f_map, f_note ) VALUES('$f_lib', '$f_floor','$f_bcase', '$f_cat','$f_callno', '$f_barcode','$f_map', '$f_note')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}
?>