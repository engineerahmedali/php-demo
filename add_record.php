<?php
if(!isset($_GET["userId"]) || empty($_GET["userId"])){
    header("location: indix2.php");
}
$server = "localhost";
$db_name = "station";
$db_user = "root";
$db_password = "";

$con = new PDO("mysql:host=$server;dbname=$db_name", $db_user, $db_password);

$error = "";

if(isset($_POST["sub"])){
    if(empty($_POST["amount"])){
        $error = "ادخل  القراءه";
    }else{
        $stmt = $con->prepare("insert into user_records (user_id,amount ) values(?,?)");
        $stmt->bindParam(1, $_GET["userId"]);
        $stmt->bindParam(2, $_POST["amount"]);
       

        if($stmt->execute()){
            $error = "تم اضافة ";
        }else{
            $error = "خطأ في الادخال";
        }
    }
}

include "./inc/header.php";
?>

<div class="wrapper">
<h1>اضافة قراهء</h1>

<form action="" method="post">
    <input type="number" name="amount" placeholder="القراهء ">
   
    <button class="btn" name="sub">اضافة</button>
    <p><?= $error ?></p>
</form>
</div>

<?php include "./inc/footer.php"; ?>