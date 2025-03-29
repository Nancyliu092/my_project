<?php
// 開啟錯誤顯示（在生產環境請關閉）
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 資料庫連接設定
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "blog2";  

// 建立 PDO 連接
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    // 設定 PDO 錯誤模式為警告
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (PDOException $e) {
    echo "<p>資料庫連接失敗: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</p>";
    exit;
}

// 獲取搜尋關鍵字
if (isset($_GET['q'])) {
    $search = trim($_GET['q']);

    // 不限制關鍵字的最小長度

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
    $page = max($page, 1); // 確保頁碼至少為 1
    $limit = 5; // 每頁顯示 5 筆結果
    $offset = ($page - 1) * $limit;
    
    // 將關鍵字用 LIKE 模糊匹配
    $search_param = '%' . $search . '%';
    
    // 總結果數量（加入 WHERE 條件）
    $countStmt = $conn->prepare("SELECT COUNT(*) FROM blog WHERE food_name LIKE :search OR introduction LIKE :search");
    $countStmt->bindParam(':search', $search_param, PDO::PARAM_STR);
    $countStmt->execute();
    
    // 檢查是否有錯誤
    $error = $countStmt->errorInfo();
    if ($error[0] != '00000') {
        echo "<p>資料庫錯誤: " . htmlspecialchars($error[2], ENT_QUOTES, 'UTF-8') . "</p>";
        exit;
    }
    
    $total = $countStmt->fetchColumn();
    
    // 查詢搜尋結果
    $stmt = $conn->prepare("SELECT id, food_name, introduction, picture, mime_type FROM blog WHERE food_name LIKE :search OR introduction LIKE :search LIMIT :limit OFFSET :offset");
    $stmt->bindParam(':search', $search_param, PDO::PARAM_STR);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT); // 使用 bindValue 並指定類型為整數
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->execute();
    
    // 檢查是否有錯誤
    $error = $stmt->errorInfo();
    if ($error[0] != '00000') {
        echo "<p>資料庫錯誤: " . htmlspecialchars($error[2], ENT_QUOTES, 'UTF-8') . "</p>";
        exit;
    }
    
    $results = $stmt->fetchAll();
    
    if ($results) {
        echo "<h2 id='top-results'>TOP RESULTS：</h2>";
        echo "<div class='search-list' id='search-list' >"; // 開始 search-list
        $counter = $offset + 1; // 計數器初始化
        foreach ($results as $row) {
            // 將關鍵字分割為陣列（支持多關鍵字）
            $keywords = preg_split('/\s+/', $search);
            $keywords = array_filter($keywords); // 移除空白元素
            
            // 處理 food-introduction 以確保關鍵字在前三行內
            $processed_introduction = processIntroduction($row['introduction'], $keywords);
            
            // 高亮顯示關鍵字（在轉義前進行）
            foreach ($keywords as $word) {
                // 使用正則表達式匹配關鍵字
                $pattern = '/' . preg_quote($word, '/') . '/i';
                $replacement = '<strong>$0</strong>';
                $processed_introduction = preg_replace($pattern, $replacement, $processed_introduction);
            }
            
            // 將 food_name 中的關鍵字高亮顯示
            $escaped_food_name = htmlspecialchars($row['food_name'], ENT_QUOTES, 'UTF-8');
            foreach ($keywords as $word) {
                $pattern = '/' . preg_quote($word, '/') . '/i';
                $replacement = '<strong>$0</strong>';
                $escaped_food_name = preg_replace($pattern, $replacement, $escaped_food_name);
            }
            
            // 將處理後的介紹進行 HTML 特殊字符轉義
            $escaped_introduction = htmlspecialchars($processed_introduction, ENT_QUOTES, 'UTF-8');
            // 因為已經添加了 <strong> 標籤，這裡不再需要轉義
            // 所以將 <strong> 標籤替換回去
            $escaped_introduction = preg_replace('/&lt;strong&gt;(.*?)&lt;\/strong&gt;/i', '<strong>$1</strong>', $escaped_introduction);
            
            // 詳細頁面 URL
            $detail_url = "Finalproject1105-4th/page_from_index_after.php?id=" . urlencode($row['id']);
            
            // 直接使用圖片數據
            if (!empty($row['picture']) && !empty($row['mime_type'])) {
                $base64_image = base64_encode($row['picture']);
                $mime_type = htmlspecialchars($row['mime_type'], ENT_QUOTES, 'UTF-8');
            } else {
                // 使用預設佔位符圖片
                $placeholder_path = __DIR__ . '/placeholder.jpg';
                if (file_exists($placeholder_path)) {
                    $base64_image = base64_encode(file_get_contents($placeholder_path));
                    $mime_type = 'image/jpeg'; // 根據 placeholder.jpg 的實際 MIME 類型
                } else {
                    // 記錄錯誤並使用透明像素作為後備
                    error_log("placeholder.jpg not found at path: $placeholder_path");
                    // 透明像素
                    $base64_image = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGNgYAAAAAMAASsJTYQAAAAASUVORK5CYII=';
                    $mime_type = 'image/png';
                }
            }
            
            // HTML 結構，添加 'fade-in-up' 類到每個搜尋項目
            echo "<div class='search-item fade-in-up'>";
            // 編號
            echo "<div class='search-number'>$counter.</div>";
            // 圖片
            echo "<a href='" . $detail_url . "'><img src='data:" . $mime_type . ";base64," . $base64_image . "' alt='" . htmlspecialchars($row['food_name'], ENT_QUOTES, 'UTF-8') . "' class='search-image' loading='lazy'/></a>";
            // 文字內容容器
            echo "<div class='search-content'>";
                // 食物名稱
                echo "<h3 class='food-name'><a href='" . $detail_url . "'>" . $escaped_food_name . "</a></h3>";
                // 食物介紹
                echo "<p class='food-introduction'>" . $escaped_introduction . "</p>";
                // Continue Reading 連結
                echo "<a href='" . $detail_url . "' class='continue-reading'>Continue Reading</a>";
            echo "</div>"; // 關閉 search-content 容器
            echo "</div>"; // 關閉 search-item 容器
            
            $counter++; // 計數器遞增
        }
        echo "</div>"; // 關閉 search-list 容器

        // 分頁連結
        echo "<div class='pagination'>";
        $totalPages = ceil($total / $limit);
        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i == $page) {
                echo "<span class='current-page'>$i</span>";
            } else {
                echo "<a href='?q=" . urlencode($search) . "&page=$i' data-page='$i'>$i</a>"; // 加入 data-page 屬性
            }
        }
        echo "</div>";
    } else {
        echo "<p>Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>";
    }

}
// 關閉連接
$conn = null;
// 關閉連接
$conn = null;

/**
 * 處理介紹文字，確保關鍵字出現在摘要內，且避免截斷單詞
 * 
 * @param string $introduction 原始介紹文字
 * @param array $keywords 關鍵字陣列
 * @return string 處理後的介紹文字片段
 */
function processIntroduction($introduction, $keywords) {
    // 確保 UTF-8 編碼
    $introduction = mb_convert_encoding($introduction, 'UTF-8', 'auto');

    // 初始化第一個關鍵字的位置為字符串長度（未找到時）
    $first_pos = mb_strlen($introduction, 'UTF-8');

    // 找到最早出現的關鍵字位置
    foreach ($keywords as $word) {
        $pattern = '/' . preg_quote($word, '/') . '/i';
        if (preg_match($pattern, $introduction, $matches, PREG_OFFSET_CAPTURE)) {
            $pos = $matches[0][1];
            if ($pos < $first_pos) {
                $first_pos = $pos;
            }
        }
    }

    if ($first_pos < mb_strlen($introduction, 'UTF-8')) {
        // 計算起始位置：關鍵字前50個字符，但不低於0
        $start = max(0, $first_pos - 50);

        // 確保起始位置在單詞邊界
        if ($start > 0) {
            // 找到起始位置後的第一個空格
            $space_pos = mb_strpos($introduction, ' ', $start, 'UTF-8');
            if ($space_pos !== false) {
                $start = $space_pos + 1;
            }
        }

        // 提取150個字符的摘要
        $snippet = mb_substr($introduction, $start, 150, 'UTF-8');

        // 確保摘要結束於單詞邊界
        $last_space = mb_strrpos($snippet, ' ', 0, 'UTF-8');
        $last_period = mb_strrpos($snippet, '.', 0, 'UTF-8');
        $last_comma = mb_strrpos($snippet, ',', 0, 'UTF-8');
        $last_question = mb_strrpos($snippet, '?', 0, 'UTF-8');
        $last_exclamation = mb_strrpos($snippet, '!', 0, 'UTF-8');

        // 找到最後一個可接受的截斷位置
        $cut_positions = array_filter([
            $last_space,
            $last_period,
            $last_comma,
            $last_question,
            $last_exclamation
        ]);

        if (!empty($cut_positions)) {
            $cut_position = max($cut_positions);
            $snippet = mb_substr($snippet, 0, $cut_position + 1, 'UTF-8');
        }

        return $snippet . '...';
    } else {
        // 如果找不到關鍵字，返回前150個字符，避免截斷單詞
        $snippet = mb_substr($introduction, 0, 150, 'UTF-8');

        // 確保摘要結束於單詞邊界
        $last_space = mb_strrpos($snippet, ' ', 0, 'UTF-8');
        $last_period = mb_strrpos($snippet, '.', 0, 'UTF-8');
        $last_comma = mb_strrpos($snippet, ',', 0, 'UTF-8');
        $last_question = mb_strrpos($snippet, '?', 0, 'UTF-8');
        $last_exclamation = mb_strrpos($snippet, '!', 0, 'UTF-8');

        $cut_positions = array_filter([
            $last_space,
            $last_period,
            $last_comma,
            $last_question,
            $last_exclamation
        ]);

        if (!empty($cut_positions)) {
            $cut_position = max($cut_positions);
            $snippet = mb_substr($snippet, 0, $cut_position + 1, 'UTF-8');
        }

        return $snippet . '...';
    }
}
?>
