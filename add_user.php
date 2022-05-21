<?php
$server = "localhost";
$db_name = "station";
$db_user = "root";
$db_password = "";

$con = new PDO("mysql:host=$server;dbname=$db_name", $db_user, $db_password);

$error = "";

if(isset($_POST["sub"])){
    if(empty($_POST["name"])){
        $error = "ادخل اسم المستخدم";
    }else{
        $stmt = $con->prepare("insert into users (name, address, phone) values(?,?,?)");
        $stmt->bindParam(1, $_POST["name"]);
        $stmt->bindParam(2, $_POST["address"]);
        $stmt->bindParam(3, $_POST["phone"]);

        if($stmt->execute()){
            $error = "تم اضافة المشترك";
        }else{
            $error = "خطأ في الادخال";
        }
    }
}

include "./inc/header.php";
?>

<div class="wrapper">
<h1>اضافة مشترك</h1>

<form action="" method="post">
    <input type="text" name="name" placeholder="اسم المشترك">
    <input type="text" name="address" placeholder="عنوان المشترك">
    <input type="text" name="phone" placeholder="هاتف المشترك">
    <button class="btn" name="sub">اضافة</button>
    <p><?= $error ?></p>
</form>
</div>

<?php include "./inc/footer.php"; ?>