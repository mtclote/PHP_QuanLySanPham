<?php
$host = "localhost";
$username ="root";
$password ="";
$dbname ="qlsp";

try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET["id"];
if (isset($id)) {
  $sql = "SELECT * FROM san_pham WHERE id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
else
echo "lỗi";
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
    <title>chi tiet</title>
</head>
<body>
<h1>Chi tiết sản phẩm</h1>
      Id <br>
      <?php echo $row["id"]; ?><br>
  
      Tên sản phẩm<br>
      <?php echo $row["ten"]; ?><br>
  
      Giá<br>
      <?php echo $row["gia"]; ?><br>
      Mô tả <br>
      <?php echo $row["mo_ta"]?><br>
    
  <a href="edit.php?id=<?php echo $row["id"]; ?>">Sửa sản phẩm</a>
  <a href="delete.php?id=<?php echo $row["id"]; ?>">Xóa sản phẩm</a>
  <a href="index.php">Quay lại</a>
</body>
</html>
