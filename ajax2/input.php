    <?php
      include "dbh.php";
      $data  = $_REQUEST['data'];
      
    //Get current date and time
    date_default_timezone_set('Asia/Jakarta');
    $d = date("Y-m-d");
    //echo " Date:".$d."<BR>";
    $t = date("H:i");
      
      $mysqli  = "INSERT INTO data (data, time, date) VALUES ('$data', '$t', '$d')";
      $result  = mysqli_query($conn, $mysqli);
      if ($result) {
      } else {
        echo "Input gagal";
      }
      mysqli_close($conn);
      header("Location:http://emrifanesp.000webhostapp.com/ajax2/form.php");
    ?>