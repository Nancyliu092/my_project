<!DOCTYPE html> 
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="finalproject.css" type="text/css" rel="stylesheet" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Epilogue:wght@400;700&display=swap">
        <link href="https://fonts.googleapis.com/css2?family=Chivo:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
        <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <title>Menu</title>
    </head>
    <body>
        <!-- Header -->
    <?php
echo '<header class="open">
        <button id="header-search-button" aria-label="開啟搜尋">🔍</button>
    </header>';
?>

<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("Location: ../login_process.php");
    exit;
}

?>

    <?php
    // session_start();
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

    $sql = "SELECT id, restaurent_name, food_name, introduction, picture, tips1_title, tips1_context, tips2_title, tips2_context, tips3_title, tips3_context FROM blog";
    $result = $conn->query($sql);

    // 假設 picture 欄位是存儲壓縮檔案 (.zip)
    if ($result->num_rows > 0) {
        echo ' <div class="nav1">
    <ul class="nav-bar">
        <!-- LOGO -->
        <li id="logo">
            <img src="../lu/foodlogo.png" alt="Logo"/>
            <a href="../index_2.php" id="logo-text">Nostimo</a>
        </li>

        <!-- 菜單切換按鈕 (響應式) -->
        <input type="checkbox" id="check">

        <div class="menu" id="main-menu">
            <!-- 搜尋表單開始 -->
        <li>
          <form id="search-form" action="search(2)_menu_after_login.php" method="GET">
            <input id="search-btn" type="checkbox" name="search-toggle"/>
            <label for="search-btn" aria-label="顯示搜尋欄">🔍</label>
            <input id="search-bar" type="text" name="q" placeholder="Search for a Brunch..." required/>
          </form>
        </li>
        <!-- 搜尋表單結束 -->
   
            <!-- 搜尋表單結束 -->
   
            <!-- 菜單項目 -->
            <li><a href="../index_2.php">HomePage</a></li>
            <li><a href="../wen/about.php">About us</a></li>
            <li><a href="">Menu</a></li>
            <li><a href="../logout.php">logout</a></li>
            
            <!-- 關閉菜單按鈕 -->
            <label for="check" class="close-menu"><i class="fas fa-times"></i></label>
        </div>

        <!-- 開啟菜單按鈕 -->
        <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
    </ul>
</div>

<!-- 搜尋結果容器 -->
<div id="search-results" class="hidden">

  <!-- 搜尋表單開始 (僅在小螢幕顯示) -->
  <form id="search-form-modal" class="search-form search-form-mobile" action="search(2)_menu_after_login.php" method="GET">
    <input id="search-btn-modal" class="search-btn search-btn-mobile" type="checkbox" name="search-toggle"/>
    <label for="search-btn-modal" aria-label="顯示搜尋欄">🔍</label>
    <input id="search-bar-modal" class="search-bar search-bar-mobile" type="text" name="q" placeholder="Search for a Brunch..." required/>
  </form>

  <div class="search-content">
      
      <!-- 搜尋表單結束 -->

      <!-- 搜尋結果內容將通過 AJAX 加載到這裡 -->
      <div id="top-results" class="search-list">
        <!-- 搜尋結果項目將在此處顯示 -->
    </div>

  </div>
</div>';

        echo '<div class="mainpage">
            <div id="navbar-container"></div>

            <div class="title">
                <div>
                    <h2>MENU</h2>
                </div>';
                // <div class="linking-button">
                //     <div id="taiwanese-brunch"><a href="#block-1-divider">Healthy Brunch</a></div>
                //     <div id="affordable-brunch"><a href="#block-2-divider">Affordable Brunch</a></div>
                //     <div id="instagrmmable-brunch"><a href="#block-3-divider">Instagrammable Brunch</a></div>
                // </div>
         echo '    <div class="down-arrow"></div>
            </div>';
        
        echo '<div class = "divider"></div>';

        echo '<div class="box1">
            <div class="fade"></div>
            <div id="block-1-divider">
                <h3>Recommendation</h3>
            </div>
            <section id="block">
                <div class="block-1">';

        // 確保資料庫查詢有結果
        while ($row = $result->fetch_assoc()) {
        
                    // 顯示圖片
                    echo '<div>
                            <div class="plus">';
                                // if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                                echo '<a href="../post_handler.php#' . htmlspecialchars($row['id']) . '">
                                    <img src="../plus.png">
                                </a>';
                                // };
                      echo '</div>
                            <a href="page_after_login.php?id=' . htmlspecialchars($row["id"]) . '">
                                <img src="get_image.php?id=' . htmlspecialchars($row["id"]) . '" alt="food image">
                            </a>
                            <p>' . htmlspecialchars($row["food_name"]) . '</p>
                            
                        </div>';
                    // echo '<div>
                    //         <a href="page.php?id=' . htmlspecialchars($row["id"]) . '"><img src="' . htmlspecialchars($row["food_name"]) . '" alt="food image"></a>
                    //         <p>' . htmlspecialchars($row["food_name"]) . '</p>
                    //       </div>';
                // } else {
                //     echo '該圖片文件解壓後未能找到圖片';
                // }
        
                // 清理臨時文件和目錄
                // unlink($tempZipPath);  // 刪除臨時 ZIP 文件
                // 選擇性刪除解壓目錄及其內容
                // array_map('unlink', glob($tempDir . '/*')); 
                // rmdir($tempDir); 
                
            // }
        }
        // if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        echo '<div class = "upload_bottom">
                <a href="../post_handler.php">
                    <img src="../plus.png">
                </a>
            </div>';
        // };

        echo '</div>
            </section>
        </div>';

        // Footer 部分
        echo '<!-- Footer -->
        <div style="background-color: #FF8C00; color: #ffffff; text-align: center; width: 100%; padding-top: 40px; padding-bottom: 40px;">
            <div class="footer-middle" style="display: flex; justify-content: center; align-items: center; gap: 30px; margin-bottom: 20px; text-align: center; padding-right: 35px;">
                <div class="link">
                    <a href="#"><img src="../lu/mail.png" alt="Mail" style="width: 30px; margin: 0;"></a>
                </div>
                <div class="contact">
                    <a href="#"><img src="../lu/phone_0.png" alt="Phone" style="width: 30px; margin: 0;"></a>
                </div>
                <div class="social">
                    <a href="#"><img src="../lu/facebook.png" alt="Facebook" style="width: 30px; margin: 0 12px;"></a>
                    <a href="#"><img src="../lu/instagram.png" alt="Instagram" style="width: 30px; margin: 0 12px;"></a>
                </div>
            </div>
            <div class="footer-bottom" style="text-align: center;">
                <p>@ Powered by <a href="https://www.w3schools.com/w3css/default.asp" style="color: #8F4586;">w3.css</a></p>
            </div>
        </div>';


        // if (file_exists($tempZipPath)) {
        //     unlink($tempZipPath);  // 刪除臨時 ZIP 文件
        // } else {
        //     echo "檔案不存在: $tempZipPath";
        // }
        // 清理臨時檔案
        // unlink($tempZipPath);

        echo '</div>';  // 結束 mainpage 部分
    } else {
        echo "沒有資料可顯示。";
    }

    // 關閉連線
    $conn->close();
    ?>    
    </body>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="finalproject_menu_after_login.js" type="text/javascript"></script>
</html>
