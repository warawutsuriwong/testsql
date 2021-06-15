<?php

    $servernameDB = "localhost";
    $usernameDB = "root";
    $passwordDB = "";
    $dbnameDB = "register_db";

    // รูปแบการเชื่อมต่อ PDO
    try {   

        $conn = new PDO("mysql:host=$servernameDB;dbname=$dbnameDB", $usernameDB, $passwordDB);     
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("set names utf8");
    
    } catch(PDOException $e) 
        {    
            echo "Connected failed: " . $e->getMessage(); 
        } 
    //$input = file_get_contents('php://input');
    //$obj = json_decode($input);

    // รับค่ามาแปลงเป็นออบเจ็ค รูปแบบที่เอามาทำงานได้
    $obj = json_decode($_POST["json"]);

    // echo $obj->{'customer_id'};
    // echo $obj->{'username'}
    
    //$customer_id = $obj->{'customer_id'};
    //รับค่ามาใส่ตัวแปร
    $username = $obj->{'username'};
    $password = $obj->{'password'};
    $name = $obj->{'name'};
    $tel = $obj->{'tel'};
    $country = $obj->{'country'};



// เตรียม
$stmt = $conn->prepare("
        INSERT INTO user4 set 
        Username = :username,
        Password = :password,
        Name  = :name,
        Tel = :tel,
        Country = :country
    ");
    // :ตัดคำ กรอง
    //CustomerID = :customer_id,":customer_id" => $customer_id,

// ทำ
    $check = $stmt->execute([":username" => $username,
    ":password" => $password,
    ":name" => $name,
    ":tel" => $tel,
    ":country" => $country]);

    $output = [];

    // เอาไว้เช็ค
    if( empty( $check ) )
    {
        $output["message"] = "เกิดข้อผิดพลาด";
        $output["success"] = 0;
        exit( json_encode($output ) );
    }
    
    $output["message"] = "บันทึกข้อมูลสำเร็จ";
    $output["success"] = 1;
    exit( json_encode($output ) );

  //  $conn = mysqli_connect($servernameDB, $usernameDB, $passwordDB, $dbnameDB);
    
    // if ($conn->connect_error) {
    // die("Connection failed: " . $conn->connect_error);
    // }else{
        // echo "connection";
    // }

     //$sql = "INSERT INTO user VALUES(".$customerid.", '".$username."', '".$password."', '".$name."', '".$tel."', '".$country."')";
    //  $conn->query($sql);

    // if ($conn->query($sql) === true) {
    //     echo "บันทึกข้อมูลเสร็จสิ้น";
    // } else {
    //     echo "บันทึกข้อมูลไม่สำเร็จ";
    // }


   // $sql = "INSERT INTO user (CustomerID,Username,Password,Name,Tel,Country) VALUES ('$customerid','$username','$password','$name','$tel','$country')";
  //  $conn->query($sql);


    // $sql = "INSERT INTO user (id, username, password,name,tel,country) VALUES('$customerid','$username','$password','$name','$tel','$country')";
   

    // $sql = "SELECT * FROM user";
    
    // $result = $conn->query($sql);
    

    // if ($result->num_rows > 0) {
    // while($row = $result->fetch_assoc()) {
    //     echo "username: ". $row["Username"]. "<br>";
    //     echo "password: ". $row["Password"];
    // }
    // } else {
    // echo "0 results";
    // }
    //$conn->close();
?>