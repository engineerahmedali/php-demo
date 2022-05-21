<?php

$error = "";
$n="ahmed";
$pass="775181456";
if(isset($_REQUEST['sub'])){
    $name=$_POST['name'];
    $pas1=$_POST['pas'];
    if(empty($name)){
        $error = "الرجاء ادخل اسم المستخدم";
    }
    if(empty($pas1)){
        $error .= "<br>";
        $error .= "الباسورد مطلوب";
    }
    if($n == $name && $pass == $pas1){
          header("location: dashboard.php");
    }
        
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    
        <form action=""  method="post"  name="aa1">
    <div class="ee11">
         اسم المستخدم <input type="text" name="name"><br><br>
          كلمة السر    <input type="password" name="pas"><br><br>
          <input type="submit" name="sub">
          <p style="color:red;"><?= $error; ?></p>
    </div>
       </form>
    
</body>
</html>