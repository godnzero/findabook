<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
	<?php
	$con=mysqli_connect('localhost','root','','findabook');
	if(isset($_POST['submit'])){
		$file=$_FILES['doc']['tmp_name'];
		
		$ext=pathinfo($_FILES['doc']['name'],PATHINFO_EXTENSION);
		if($ext=='xlsx'){
			require('PHPExcel/PHPExcel.php');
			require('PHPExcel/PHPExcel/IOFactory.php');
			
			$obj=PHPExcel_IOFactory::load($file);
			foreach($obj->getWorksheetIterator() as $sheet){
				$getHighestRow=$sheet->getHighestRow();
				for($i=2;$i<=$getHighestRow;$i++){
					$lib=$sheet->getCellByColumnAndRow(0,$i)->getValue();
					$floor=$sheet->getCellByColumnAndRow(1,$i)->getValue();
					$bcase=$sheet->getCellByColumnAndRow(2,$i)->getValue();
					$cat=$sheet->getCellByColumnAndRow(3,$i)->getValue();
					$callno=$sheet->getCellByColumnAndRow(4,$i)->getValue();
					$barcode=$sheet->getCellByColumnAndRow(5,$i)->getValue();
					if($i!=''){
						mysqli_query($con,"INSERT INTO tb_findbook(f_lib,f_floor,f_bcase,f_cat,f_callno,f_barcode) VALUES('$lib','$floor','$bcase','$cat','$callno','$barcode')");
					}
				}
				echo "Success";
			}
		}else{
			echo "Invalid file format";
		}
	}
	?>
</head>
<body>
<div class="jumbotron text-center">
  <div class="container">
    <h1 class="display-4">	
	<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-spreadsheet-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  		<path fill-rule="evenodd" d="M2 3a2 2 0 0 1 2-2h5.293a1 1 0 0 1 .707.293L13.707 5a1 1 0 0 1 .293.707V13a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V3zm7 2V2l4 4h-3a1 1 0 0 1-1-1zM3 8v1h2v2H3v1h2v2h1v-2h3v2h1v-2h3v-1h-3V9h3V8H3zm3 3V9h3v2H6z"/>
	</svg> Import Excel File</h1>
    <form method="post" enctype="multipart/form-data">
		<input type="file" name="doc"/>
		<input type="submit" class="btn btn-dark" name="submit" value="Upload">
		<button type="button" class="btn btn-secondary" onclick='location.replace("index.php")'>Back</button>
	</form>
	
  </div>
</div>
</body>
</html>