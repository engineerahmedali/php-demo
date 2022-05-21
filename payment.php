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
        $error = "ادخل  المبلغ";
    }else{
        $stmt = $con->prepare("insert into user_payments (user_id,amount ) values(?,?)");
        $stmt->bindParam(1, $_GET["userId"]);
        $stmt->bindParam(2, $_POST["amount"]);
       

        if($stmt->execute()){
            $error = "تم التسديد ";
        }else{
            $error = "خطأ في الادخال";
        }
    }
}

include "./inc/header.php";
?>

<div class="wrapper">
<h1> تسديد</h1>

<form action="" method="post">
    <input type="number" name="amount" placeholder="الميلغ ">
   
    <button class="btn" name="sub">اضافة</button>
    <p><?= $error ?></p>
</form>
</div>

<?php include "./inc/footer.php"; ?>