
        <?php
        include './sqlConnection.php';
        
        $result = mysqli_query($connect, "select * from tblCity where stateId = " . $_POST["id"]);
        
        $object = array();
        while ($row = mysqli_fetch_assoc($result)){
          $object[] = array(
              "id" =>  $row["cityId"],
              "name" => $row["cityName"]
          );
        }
      
        header("content-type: application/json");
        echo json_encode($object); 
        ?>
 
