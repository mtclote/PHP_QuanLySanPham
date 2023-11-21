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
  $ten = $_POST["ten"];
  $gia = $_POST["gia"];
  $mota=$_POST["mota"];
  if ($ten == "" || $gia == ""||$mota=="") {
    echo "Vui lòng nhập đầy đủ thông tin sản phẩm";
  }
  $sql = "UPDATE san_pham SET ten = :ten , gia = :gia , mo_ta=:mota WHERE id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':ten', $ten);
  $stmt->bindParam(':gia', $gia);
  $stmt->bindParam(':mota', $ten);
  $stmt->bindParam(':id', $id);
  if ($stmt->execute()) {
    echo "Cập nhật sản phẩm thành công";
  } else {
    echo "Cập nhật sản phẩm thất bại: " ;
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
  <title>sua san pham</title>
</head>
<body>
<h1>Sửa sản phẩm</h1>
  <form method="post" action="edit.php?id=<?php echo $id; ?>">
        Tên sản phẩm:
        <input type="text" name="ten" value="<?php echo $row["ten"]; ?>" maxlength="255" >
       Giá:
        <input type="number" name="gia" value="<?php echo $row["gia"]; ?>" min="1" >
        Mô tả:
        <input type="text" name="mota" value="<?php echo $row["mo_ta"]; ?>">
      <input type="submit" name="submit" value="Cập nhật sản phẩm">
      <a href="details.php?id=<?php echo $id; ?>">Quay lại</a>
  </form>
</body>
</html>
