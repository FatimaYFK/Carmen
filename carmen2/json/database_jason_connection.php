 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>JSON DATA</title>  
      </head>  
      <body>  
           <?php   
           $connect = mysqli_connect("127.0.0.1", "root", "", "carmen");  
           $sql = "SELECT * FROM register_user";  
           $result = mysqli_query($connect, $sql);  
           $json_array = array();  
           while($row = mysqli_fetch_assoc($result))  
           {  
                $json_array[] = $row;  
           }  
           /*echo '<pre>';  
           print_r(json_encode($json_array));  
           echo '</pre>';*/  
           echo json_encode($json_array);  
           ?>  
      </body>  
 </html>  