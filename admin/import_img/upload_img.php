1d111<?phpasd
  // Create database connection
  $db = mysqli_connect("localhost", "root", "[kob&kim]", "findabook");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  	// Get image name
  	$image = $_FILES['image']['name'];

  	// image file directory
  	$target = "map_images/".basename($image);

  	$sql = "INSERT INTO tb_image (image_path) VALUES ('$image')";
  	// execute query
  	mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		echo $msg = "Image uploaded successfully";
  	}else{
        echo $msg = "Failed to upload image";
  	}
  }
?>
<!DOCTYPE html>
<html>
<head>
<title>Image Upload</title>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
<h2>Map Location Upload</h2>
  <div class="container">
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="size" value="1000000">
        <div class="row justify-content-start">
            <div class="col-4">
                <input class="form-control" type="file" name="image" onchange="loadFile(event)">
            </div>
            <div class="col-4">
                <button class="btn btn-primary" type="submit" name="upload">Upload</button> <button type="button" class="btn btn-secondary" onclick='location.replace("index.php")'>Back</button>
            </div>
        </div>
    </form>
        <div class="text-center">
            <img id="preview" style="max-width:100%; height:auto;">
        </div>
    </div>
    <script>
		var loadFile = function (event) {
		var output = document.getElementById('preview');
		output.src = URL.createObjectURL(event.target.files[0]);
        };
	</script>
</body>
</html>