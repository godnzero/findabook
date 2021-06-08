<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap core CSS -->
    <!-- CSS only -->
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.material.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/4.0.0/material-components-web.min.css">
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
 
    <!-- Connect to DB-->
    <?php include("connect.php");  
    error_reporting(E_ALL ^ E_NOTICE);?>

    <?php
        $callno=$_GET['callno'];
        //INNER JOIN tb_hrd ON tb_scanaccess.empid_scan = tb_hrd.empid_info
        //INNER JOIN tb_specifictime ON tb_scanaccess.empid_scan = tb_specifictime.empid_time
        //$callno = "Fic A113m 2011";
        $sql = "SELECT * FROM tb_findbook 
        INNER JOIN tb_image ON tb_findbook.f_map = tb_image.image_no
        WHERE f_callno = '$callno'";
        $query = mysqli_query($conn,$sql) or die("error");
        $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
        if($query)
        {   
            if($query->num_rows) {
                while($row = mysqli_fetch_assoc($query))
                {
                    echo "THERE WAS A RESULT HERE: "; 
                }
            }
            else {
                    echo "<br><h1 class='forcenter'>No Results Found in Database<h1><br>"; 
            }
        }
    ?>
    
<img src="assets/logo-MULKC.png" alt="..." class="img-fluid" width="500" height="600" style="max-width:100%;height:auto;">
    <!--Show Reserve -->
    <div class="container-fluid">
        <!--<h1>Search Information</h1>-->
        <div class="row">
            <div id="labelname" class="col-6">Library | ห้องสมุด</div>
            <div id="result" class="col-6" align="left"><b><?php echo $result["f_lib"] ?></b></div> 
        
            <div id="labelname" class="col-6">Floor | ชั้น</div>
            <div id="result" class="col-6" align="left"><b><?php echo $result["f_floor"] ?></div></b>
        
            <div id="labelname" class="col-6">Book Case No. | ตู้หนังสือ</div>
            <div id="result" class="col-6" align="left"><b><?php echo $result["f_bcase"] ?></b> </div>
        
            <div id="labelname" class="col-6">Category | ประเภทหนังสือ</div>
            <div id="result" class="col-6" align="left"><b><?php echo $result["f_cat"] ?></b> </div>
        
            <div id="labelname" class="col-6">Call No. | เลขเรียกหนังสือ</div>
            <div id="result" class="col-6" align="left"><b><?php echo $result["f_callno"] ?></b> </div>
        
            <div id="labelname" class="col-6">Barcode | บาร์โค้ด</div>
            <div id="result" class="col-6" align="left"><b><?php echo $result["f_barcode"] ?></b> </div>                 
        </div>
            <h1 align="right">Map Location</h1>
            <div align="center"><img src="admin/import_img/map_images/<?php echo $result["image_path"]?>"></div> 
    <center>
        <h1>Found Book?</h1>
        <button type="button" class="btn btn-primary" id="found">Found</button>
        <button type="button" class="btn btn-danger" id="Nfound">Not Found</button>
    </center>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<!-- Counter -->
<script>
    $(function (){
        $('#found').click(function(){
        var request = $.ajax({
                                type: "POST",
                                url: "server_code_increment.php"                               
                                });
                                request.done(function( msg ) {

                                    alert('Thank You!');
                                    return;

                                });
                                request.fail(function(jqXHR, textStatus) {
                                    alert( "Request failed: " + textStatus );
                                });
        });
    });

    $(function (){
        $('#Nfound').click(function(){
        var request = $.ajax({
                                type: "POST",
                                url: "server_code_increment_N.php"                               
                                });
                                request.done(function( msg ) {

                                    alert('กรุณาติดต่อเจ้าหน้าที่');
                                    return;

                                });
                                request.fail(function(jqXHR, textStatus) {
                                    alert( "Request failed: " + textStatus );
                                });
        });
    });
</script>
    

    <!-- JavaScript and dependencies -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.material.min.js"></script>

    <!--use DataTable-->
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                autoWidth: false,
                columnDefs: [
            {
                targets: ['_all'],
                className: 'mdc-data-table__cell'
            }
        ]
            });
        });
    </script>
    <?php mysqli_close($conn); ?>
</body>
</html>