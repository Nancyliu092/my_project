<!DOCTYPE html>
<html lang="en">
    <head>
        <script src="script.js" type="text/javascript"></script>
        <link href="finalproject.css" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans+TC">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>food_blog</title>
    </head>

<body class="page1-1">
<?php
// 資料庫連線設定
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog2";

// 建立連線
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連線
if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
}

// 獲取 URL 中的 id
$id = isset($_GET['id']) ? intval($_GET['id']) : 0; // 確保 id 是數字
if ($id <= 0) {
    die("無效的 ID");
}

// 查詢對應的資料
// $sql = "SELECT restaurent_name, food_name, introduction FROM blog WHERE id = ?";
$sql = "SELECT id, star, restaurent_name, food_name, introduction, picture, tips1_title, tips1_context, tips2_title, tips2_context, tips3_title, tips3_context FROM blog WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // 提取資料
    $row = $result->fetch_assoc();
    
        echo '<div class="flex-container1-1">';
        echo '    <div class="flex-container1-1-2">';
        echo '        <div class="shortcut">';
        echo '            <div id="Home" class="listing"><a href="../index_1.php">back</a></div>';
        echo '                    <div class="rating">';
        for ($i = 0; $i < $row['star']; $i++) {
            echo '<span class="star"></span>'; // 在迴圈中輸出 HTML
        }
        echo '                    </div>'; 
        echo '        </div>';
        echo '        <div>';
        echo '            <img class="img1-1" style="width:320px; height:256px;" src="get_image.php?id=' . htmlspecialchars($row["id"]) . '">';
        echo '        </div>';
        echo '    </div>';
        echo '    <div class="text1-1">';
        echo '        <h2>' . htmlspecialchars($row["restaurent_name"]) . '</h2>';
        echo '        <h3>' . htmlspecialchars($row["food_name"]) . '</h3>';
        echo '        <p>' . htmlspecialchars($row["introduction"]) . '</p>';
        echo '    </div>';
        echo '</div>';
        echo '<div class="tips-divider">
                <div class="fade"></div>
                <h2>Eating Tips</h2>';
        echo '</div>';
        echo'        <div class="text1-2">
                    <div class="flex-container-tips">
                        <div class="tips-context">
                            <h2 class="tipstitle">1</h2>
                            <p><span class="tips">' . htmlspecialchars($row["tips1_title"]) . '</span><br><br>' . htmlspecialchars($row["tips1_context"]) . '</p>
                        </div>
                        <div class="tips-context">
                            <h2 class="tipstitle">2</h2>
                            <p><span class="tips">' . htmlspecialchars($row["tips2_title"]) . '</span><br><br>' . htmlspecialchars($row["tips2_context"]) . '</p>
                        </div>
                        <div class="tips-context">
                            <h2 class="tipstitle">3</h2>
                            <p><span class="tips">' . htmlspecialchars($row["tips3_title"]) . '</span><br><br>' . htmlspecialchars($row["tips3_context"]) . '</p>
                        </div>
                    </div>
                </div>';
        echo '<div class="tips-divider-last">';


        $sql_other = "SELECT id, food_name FROM blog WHERE id != ? LIMIT 5"; // 查詢其他食物，排除當前 ID，限制顯示 5 筆
        $stmt_other = $conn->prepare($sql_other);
        $stmt_other->bind_param("i", $id);
        $stmt_other->execute();
        $result_other = $stmt_other->get_result();

        echo '
            <div class="fade"></div>
            <div class="tips-divider-last">
                <h2>See More?</h2>
            </div>

            <div class="wrapper">
                <i id="left" class="fa-solid fa-angle-left"></i>
                <ul class="carousel">';

            // 使用 while 迴圈來遍歷多筆資料
            while ($row_other = $result_other->fetch_assoc()) {
            echo '
                <li class="card">
                    <div class="img">
                        <a href="page_from_index_before.php?id=' . htmlspecialchars($row_other["id"]) . '">
                            <img src="get_image.php?id=' . htmlspecialchars($row_other["id"]) . '" alt="' . htmlspecialchars($row_other["food_name"]) . '">
                        </a>
                    </div>
                    <h2>' . htmlspecialchars($row_other["food_name"]) . '</h2>
                </li>';
    }

            echo '
                </ul>
                <i id="right" class="fa-solid fa-angle-right"></i>
            </div>';

    } else {
    echo "沒有找到與該 ID 對應的資料。";
}

    

// 關閉連線
$stmt->close();
$conn->close();
?>
</body>
</html>







