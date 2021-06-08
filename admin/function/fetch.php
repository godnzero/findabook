<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "[kob&kim]", "findabook");
$columns = array('f_lib', 'f_floor', 'f_bcase', 'f_car', 'f_callno', 'f_barcode', 'f_map', 'f_note');

$query = "SELECT * FROM tb_findbook ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE f_callno LIKE "%'.$_POST["search"]["value"].'%" 
 OR f_barcode LIKE "%'.$_POST["search"]["value"].'%"
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY f_no ASC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 //$sub_array[] = '<div contenteditable class="update" data-id="'.$row["f_no"].'" data-column="f_no">' . $row["f_no"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["f_no"].'" data-column="f_lib">' . $row["f_lib"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["f_no"].'" data-column="f_floor">' . $row["f_floor"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["f_no"].'" data-column="f_bcase">' . $row["f_bcase"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["f_no"].'" data-column="f_cat">' . $row["f_cat"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["f_no"].'" data-column="f_callno">' . $row["f_callno"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["f_no"].'" data-column="f_barcode">' . $row["f_barcode"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["f_no"].'" data-column="f_map">' . $row["f_map"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["f_no"].'" data-column="f_note">' . $row["f_note"] . '</div>';
 $sub_array[] = '<button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row["f_no"].'">Delete</button>';
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM tb_findbook";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>