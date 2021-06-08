<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <!-- Bootstrap core CSS -->
    <!-- CSS only 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- DataTables -->
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.material.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/4.0.0/material-components-web.min.css">
    <link rel="stylesheet" type="text/css" href="modal.css">
</head>
<body>
 
    <!-- Connect to DB-->
    <?php include("../../connect.php");  
    error_reporting(E_ALL ^ E_NOTICE);?>

    <?php
        //INNER JOIN tb_hrd ON tb_scanaccess.empid_scan = tb_hrd.empid_info
        //INNER JOIN tb_specifictime ON tb_scanaccess.empid_scan = tb_specifictime.empid_time
        $sql = "SELECT * FROM tb_image";
        $query = mysqli_query($conn,$sql) or die("error");
    ?>

    <!--Show Reserve -->
    <div class="container">
        <h1>Check Imported</h1>
        <table id="myTable" class="mdl-data-table" style="width:100%">
            <thead>
                <tr>
                    <th>
                        <div align="center"> No. </div>
                    </th>
                    <th>
                        <div align="center"> Pic </div>
                    </th>
                    <th>
                        <div align="center"> Path </div>
                    </th>
                    <th>
                        <div align="center"> Timestamp </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($result=mysqli_fetch_array($query,MYSQLI_ASSOC)){ 
                    echo "<tr>
                            <td>".$result["image_no"]."</td>
                            <td><img id='myImg' src='map_images/".$result["image_path"]." 'width='400' height='200'></td>
                            <td>".$result["image_path"]."</td>
                            <td>".$result["image_timestamp"]."</td>
                        </tr>"
                ;}    
                ?>
                <!-- The Modal -->
                <div id="myModal" class="modal">

                <!-- The Close Button -->
                <span class="close">&times;</span>

                <!-- Modal Content (The Image) -->
                <img class="modal-content" id="img01">

        
            </tbody>
        </table>
        
            
</div>
    </div>
    <button type="button" class="btn btn-secondary" onclick='location.replace("index.php")'>Back</button>
    

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
    <script>
    // Get the modal
        var modal = document.getElementById("myModal");

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById("myImg");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function(){
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
        modal.style.display = "none";
        }
    </script>
    <?php mysqli_close($conn); ?>
</body>
</html>