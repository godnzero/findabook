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
    <?php include("../connect.php");  
    error_reporting(E_ALL ^ E_NOTICE);?>

    <form id="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="start">Select Date:</label>
        <input type="date" id="dateInput" name="dateInput" value="<?php echo date("Y-m-d");?>">
        <button class="btn btn-dark" id="submit" name="submit">Submit</button>
        <button type="button" class="btn btn-secondary" onclick='location.replace("index.php")'>Back</button>
    </form>


    <?php
    if(isset($_POST['submit']))
{
  $dateInput = date('Y-m-d', strtotime($_POST['dateInput']));
  echo "Selected (Year-Month-Day) : $dateInput";
}
        //INNER JOIN tb_hrd ON tb_scanaccess.empid_scan = tb_hrd.empid_info
        //INNER JOIN tb_specifictime ON tb_scanaccess.empid_scan = tb_specifictime.empid_time
        $sql = "SELECT * FROM tb_scanaccess WHERE sca_date LIKE '$dateInput'";
        $query = mysqli_query($conn,$sql) or die("error");
    ?>

    <!--Show Reserve -->
    <div class="container">
        <h1>Scan Access Time</h1>
        <table id="myTable" class="mdl-data-table" style="width:100%">
            <thead>
                <tr>
                    <th>
                        <div align="center">Employee ID </div>
                    </th>
                    <th>
                        <div align="center">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-calendar-week" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1zm1-3a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2z"/>
                            <path fill-rule="evenodd" d="M3.5 0a.5.5 0 0 1 .5.5V1a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 .5-.5zm9 0a.5.5 0 0 1 .5.5V1a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 .5-.5z"/>
                            <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
                            </svg> Date 
                        </div>
                    </th>
                    <th>
                        <div align="center"> 
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clock" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm8-7A8 8 0 1 1 0 8a8 8 0 0 1 16 0z"/>
                            <path fill-rule="evenodd" d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                            </svg> IN
                        </div>
                    </th>
                    <th>
                        <div align="center">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clock-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                            </svg> OUT 
                        </div>
                    </th>
                    <th>
                        <div align="center">Name </div>
                    </th>
                    <th>
                        <div align="center">Status </div>
                    </th>
                    <th>
                        <div align="center">Timestamp </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($result=mysqli_fetch_array($query,MYSQLI_ASSOC))
                { 
                echo "<tr>

                        <td>".$result["empid_scan"]."</td>

                        <td>".$result["sca_date"]."</td>

                        <td>".$result["sca_in"]."</td>

                        <td>".$result["sca_out"]."</td>

                        <td>".$result["sca_name"]."</td>

                        <td>".$result["sca_status"]."</td>
                    
                        <td>".$result["sca_timestamp"]."</td>

                    </tr>"
                ;}
                ?>
            </tbody>
        </table>
        
    </div>

    

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