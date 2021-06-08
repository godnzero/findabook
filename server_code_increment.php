<?php
// Connection to database
  $connection=mysqli_connect("localhost","root","[kob&kim]","findabook");
// Check connection
  if (mysqli_connect_errno())
    {
    echo 'Error Failed to Connect to MySQL';
    //echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

// Increasing the current value with 1
    mysqli_query($connection,"UPDATE tb_found SET found = (found + 1)
    WHERE id='1'");

    mysqli_close($connection);

    echo 'Successfully';   
?>