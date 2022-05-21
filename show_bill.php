<?php
include "./models/Values.php";

if(!isset($_GET["userId"]) || empty($_GET["userId"])){
    header("location: indix2.php");
}


$server = "localhost";
$db_name = "station";
$db_user = "root";
$db_password = "";

$con = new PDO("mysql:host=$server;dbname=$db_name", $db_user, $db_password);


$stmt = $con->prepare("select * from users where id = ?");
$stmt->bindParam(1, $_GET["userId"]);
$stmt->execute();
$user = $stmt->fetch();

$values = new Values();

$billStmt = $con->prepare("SELECT COALESCE((amount - (SELECT amount FROM `user_records` WHERE user_id = ? ORDER BY created_at DESC LIMIT 1,1)), amount) as current, (amount * ? - COALESCE((select sum(amount) from user_payments where user_id = ?), 0)) as total, month(created_at) as curMonth, year(created_at) as curYear FROM user_records WHERE user_id = ? ORDER BY created_at DESC LIMIT 1");
$billStmt->bindParam(1, $_GET["userId"]);
$billStmt->bindParam(2, $values->kiloPrice);
$billStmt->bindParam(3, $_GET["userId"]);
$billStmt->bindParam(4, $_GET["userId"]);
$billStmt->execute();
$bill = $billStmt->fetch();

if($bill != null){
    $amount = $bill["current"];
    $total = $bill["total"];
    $month = $bill["curMonth"];
    $year = $bill["curYear"];
}else{
    $amount = 0;
    $total = 0;
    $month = "";
    $year = "";
}


include "./inc/header.php";
?>

<div class="wrapper">
    <div class="centerChild">
        <div class="centerCard">
            <h1>فاتورة المستخدم: <b><?= $user["name"] ?></b></h1>
            <p>هاتف المستخدم : <b><?= $user["phone"] ?></b></p>
            <p>استهلاك الشهر الحالي: <b>(<?= $amount ?>) كيلو</b></p>
            <p> للشهر <b><?= $month ?> / <?= $year ?></b></p>
            <p>عليه : <b><?= $total ?></b> ريال يمني</p>
        </div>
    </div>
</div>

<?php include "./inc/footer.php"; ?>