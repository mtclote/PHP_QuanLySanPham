<?php
$host = "localhost";
$username ="root";
$password ="";
$dbname ="qlsp";

try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT sp.id, sp.ten, sp.gia, lsp.ten_loai FROM san_pham sp JOIN loai_san_pham lsp ON sp.loai = lsp.id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>danh sach</title>
</head>
<body>
<h1>Danh sách sản phẩm</h1>
  <a href="add.php">Thêm sản phẩm</a><br>
      Tên sản phẩm<br>
      Loại sản phẩm<br>
      Giá
    <?php
      foreach($result as $row) {    
        echo "<br><a href='details.php?id=".$row["id"]."'>".$row["ten"]."</a>";
        echo "<br> ".$row["ten_loai"]." ";
        echo " <br>".$row["gia"]." ";
      }
    ?>
</body>
</html>