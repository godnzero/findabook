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
</head>
<body>
 
    <!-- Connect to DB-->
    <?php include("../../connect.php");  
    error_reporting(E_ALL ^ E_NOTICE);?>

    <?php
        //INNER JOIN tb_hrd ON tb_scanaccess.empid_scan = tb_hrd.empid_info
        //INNER JOIN tb_specifictime ON tb_scanaccess.empid_scan = tb_specifictime.empid_time
        $sql = "SELECT * FROM tb_findbook";
        $query = mysqli_query($conn,$sql) or die("error");
    ?>

    <!--Show Reserve -->
    <div class="container-fluid">
        <h1>Check Imported</h1>
        <table id="myTable" class="mdl-data-table" style="width:100%">
            <thead>
                <tr>
                    <th>
                        <div align="center"> No. </div>
                    </th>
                    <th>
                        <div align="center"> Library </div>
                    </th>
                    <th>
                        <div align="center"> Floor </div>
                    </th>
                    <th>
                        <div align="center"> Book Case </div>
                    </th>
                    <th>
                        <div align="center"> Catalog </div>
                    </th>
                    <th>
                        <div align="center"> Call no </div>
                    </th>
                    <th>
                        <div align="center"> Barcode </div>
                    </th>
                    <th>
                        <div align="center"> Map </div>
                    </th>
                    <th>
                        <div align="center"> Note </div>
                    </th>
                    <th>
                        <div align="center"> Timestamp </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($result=mysqli_fetch_array($query,MYSQLI_ASSOC))
                { 
                echo "<tr>

                        <td>".$result["f_no"]."</td>

                        <td>".$result["f_lib"]."</td>

                        <td>".$result["f_floor"]."</td>

                        <td>".$result["f_bcase"]."</td>

                        <td>".$result["f_cat"]."</td>

                        <td>".$result["f_callno"]."</td>
                    
                        <td>".$result["f_barcode"]."</td>

                        <td>".$result["f_map"]."</td>

                        <td>".$result["f_note"]."</td>

                        <td>".$result["f_timestamp"]."</td>

                    </tr>"
                ;}
                ?>
            </tbody>
        </table>
        
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
    <?php mysqli_close($conn); ?>
</body>

</html>