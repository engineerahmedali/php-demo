<?php


$server = "localhost";
$db_name = "station";
$db_user = "root";
$db_password = "";

$con = new PDO("mysql:host=$server;dbname=$db_name", $db_user, $db_password);



if(isset($_POST["delete"]))
{
        $userld=$_POST["deleteld"];

        $stmt = $con->prepare("delete from users where id = ?");
        $stmt->bindParam(1, $userld);
        
        $stmt->execute();
     
 }
 $stmt = $con->query("select * from users");

include "./inc/header.php";
?>
    <div class="wrapper">
    <div class="tableHeader">
    <h1>المشتركين</h1>
    <a href="add_user.php" class="btn">إضافة</a>
    </div>
    <table border="1">
      <tr>
        <th>م</th>
        <th>الاسم</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
      <?php
          while($row = $stmt->fetch()){
            ?>
            <tr>
              <td><?= $row["id"] ?></td>
              <td><?= $row["name"] ?></td>
              <td><a href="add_record.php?userId=<?= $row["id"] ?>">اضافة قراءة</a></td>
              <td><a href="show_bill.php?userId=<?= $row["id"] ?>">عرض فاتورة</a></td>
              <td><a href="payment.php?userId=<?= $row["id"] ?>">تسديد</a></td>
              <td><FORM method = "POST"><input type="hidden" name="userld" id="userld" value="<?=$row["id"]?>"><button id ="delete" name="delete">حذف </button><form></td>

            </tr>
            <?php
          }
      ?>
    </table>
    </div>

    <?php include "./inc/footer.php"; ?>