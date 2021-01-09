 <?php  
 //  
 function get_data()  
 {  
      $connect = mysqli_connect("localhost", "root", "", "carmen");  
      $query = "SELECT * FROM produkte";  
      $result = mysqli_query($connect, $query);  
      $employee_data = array();  
      while($row = mysqli_fetch_array($result))  
      {  
           $employee_data[] = array(  
                'kaffee'               =>     $row["kaffee"],  
                'preis'          =>     $row["preis"],  
                'lagerbestand'     =>     $row["lagerbestand"]  
           );  
      }  
      return json_encode($employee_data);  
 }  
 $file_name = date("d-m-Y") . ".json";  
 if(file_put_contents($file_name, get_data()))  
 {  
      echo $file_name . ' File created';  
 }  
 else  
 {  
      echo 'There is some error';  
 }  
 ?>  