<?php
// 資料庫連線
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT picture FROM blog WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($picture);
    $stmt->fetch();

    if ($picture) {
        header("Content-Type: image/jpeg"); // 根據圖片類型調整
        echo $picture;
    } else {
        echo "圖片不存在";
    }
    $stmt->close();
}
$conn->close();
?>
