<?php
$host = "localhost";
$username ="root";
$password ="";
$dbname ="qlsp";

try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST["submit"])) {
  $ten =$_POST["ten"];
  $loai=$_POST["loai"];
  $gia = $_POST["gia"];
  $mota=$_POST["mota"];
  if ($ten == "" || $gia == ""||$loai==""||$mota=="") {
    echo "Vui lòng nhập đầy đủ thông tin sản phẩm";
  }
  $sql = "INSERT INTO san_pham (ten,loai, gia,mo_ta) VALUES (:ten,:loai,:gia,:mota)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':ten', $ten);
  $stmt->bindParam(':loai', $loai);
  $stmt->bindParam(':gia', $gia);
  $stmt->bindParam(':mota', $mota);
  if ($stmt->execute()) {
    echo "thêm sản phẩm thành công";
  } else {
    echo "thêm sản phẩm thất bại: " ;
  }
}
} catch(PDOException $e) {
  echo "Kết nối thất bại: " . $e->getMessage();
}
$conn = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>them</title>
</head>
<body>
<h1>Thêm sản phẩm</h1>
  <form method="post" action="add.php">
       Tên sản phẩm:
        <input type="text" name="ten" maxlength="255" >
        loại:
        <input type="text" name="loai">
        Giá:
      <input type="number" name="gia" min="1" >
      mô tả:
      <input type="text" name="mota">
    <input type="submit" name="submit" value="Thêm sản phẩm">
    <a href="index.php">Quay lại</a>
  </from>
</body>
</html>
