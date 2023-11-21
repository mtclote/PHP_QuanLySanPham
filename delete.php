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
{
    echo "lỗi ";
}
if (isset($_POST["submit"])) {
  $sql = "DELETE FROM san_pham WHERE id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id);
  if ($stmt->execute()) {
    echo "Xóa sản phẩm thành công";
  } else {
    echo "Xóa sản phẩm thất bại: " ;
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>xoa san pham</title>
</head>
<body>
<h1>Xóa sản phẩm</h1>
  <form method="post" action="delete.php?id=<?php echo $id; ?>">
        Tên sản phẩm:
        <?php echo $row["ten"]; ?><br>
        Giá:
        <?php echo $row["gia"]; ?><br>
    Bạn có chắc muốn xóa sản phẩm này?
    <input type="submit" name="submit" value="Đồng ý">
    <a href="details.php?id=<?php echo $id; ?>">Quay lại</a>
  </form>
</body>
</html>