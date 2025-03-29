<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("Location: login_process.php");
    exit;
}

?>
<?php
// 資料庫連線設定
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog2"; //資料庫名稱記得換


// 建立資料庫連線
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$conn->set_charset("utf8mb4");
header("Content-Type: text/html; charset=utf-8");


// 初始化 $stmt
$stmt = null;


// 處理新增、修改、刪除動作
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $id = $_POST['id'] ?? null;


    $category = $_POST['category'] ?? null;
    $star = $_POST['star'] ?? null;
    $restaurent_name = $_POST['restaurent_name'] ?? null;
    $food_name = $_POST['food_name'] ?? null;
    $introduction = $_POST['introduction'] ?? null;
    $tips1_title = $_POST['tips1_title'] ?? null;
    $tips1_context = $_POST['tips1_context'] ?? null;
    $tips2_title = $_POST['tips2_title'] ?? null;
    $tips2_context = $_POST['tips2_context'] ?? null;
    $tips3_title = $_POST['tips3_title'] ?? null;
    $tips3_context = $_POST['tips3_context'] ?? null;


    // 處理圖片上傳
    $picture = null;
    if (isset($_FILES['picture']['tmp_name']) && !empty($_FILES['picture']['tmp_name'])) {
        $picture = file_get_contents($_FILES['picture']['tmp_name']);
    }


    // 新增資料
    if ($action === 'add') {
        $stmt = $conn->prepare(
            "INSERT INTO blog (category, star, restaurent_name, food_name, introduction, tips1_title, tips1_context, tips2_title, tips2_context, tips3_title, tips3_context, picture)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param(
            'sisssssssssb',
            $category,
            $star,
            $restaurent_name,
            $food_name,
            $introduction,
            $tips1_title,
            $tips1_context,
            $tips2_title,
            $tips2_context,
            $tips3_title,
            $tips3_context,
            $picture
        );
        if ($picture !== null) {
            $stmt->send_long_data(11, $picture); // 使用 send_long_data 處理 BLOB
        }
        $stmt->execute();
        echo "<script>alert('Add Successful！');</script>";
    }


    // 修改資料
    /*elseif ($action === 'update' && $id !== null) {
        $sql = "UPDATE blog SET category=?, star=?, restaurent_name=?, food_name=?, introduction=?, tips1_title=?, tips1_context=?, tips2_title=?, tips2_context=?, tips3_title=?, tips3_context=?";
        $types = 'sisssssssss';
        $params = [&$category, &$star, &$restaurent_name, &$food_name, &$introduction, &$tips1_title, &$tips1_context, &$tips2_title, &$tips2_context, &$tips3_title, &$tips3_context];


        if ($picture !== null) {
            $sql .= ", picture=?";
            $types .= 'b';
            $params[] = &$picture;
        }


        $sql .= " WHERE id=?";
        $types .= 'i';
        $params[] = &$id;


        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$params);
        if ($picture !== null) {
            $stmt->send_long_data(count($params) - 2, $picture);
        }
        $stmt->execute();
        echo "<script>alert('Modify Successful！');</script>";
    }*/


    // 刪除資料
    elseif ($action === 'delete' && $id !== null) {
        $stmt = $conn->prepare("DELETE FROM blog WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        echo "<script>alert('Delete Successful！');</script>";
    }
    if ($stmt !== null) {
        $stmt->close();
    }

    // 修改資料
    elseif ($action === 'update' && $id !== null) {
        // 默认 SQL 和绑定参数
        $sql = "UPDATE blog SET category=?, star=?, restaurent_name=?, food_name=?, introduction=?, tips1_title=?, tips1_context=?, tips2_title=?, tips2_context=?, tips3_title=?, tips3_context=?";
        $types = 'sisssssssss';
        $params = [&$category, &$star, &$restaurent_name, &$food_name, &$introduction, &$tips1_title, &$tips1_context, &$tips2_title, &$tips2_context, &$tips3_title, &$tips3_context];

        // 如果上传了新图片
        if ($picture !== null) {
            $sql .= ", picture=?";
            $types .= 'b';
            $params[] = &$picture;
        }

        // 完成 SQL 并绑定 ID
        $sql .= " WHERE id=?";
        $types .= 'i';
        $params[] = &$id;

        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$params);

        // 如果上传了新图片，使用 send_long_data 处理图片数据
        if ($picture !== null) {
            $stmt->send_long_data(count($params) - 2, $picture);
        }

        $stmt->execute();
        echo "<script>alert('Modify Successful！');</script>";
    }
}


// 顯示圖片的功能
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];


    $stmt = $conn->prepare("SELECT picture FROM blog WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($picture);
    $stmt->fetch();


    if ($picture) {
        header("Content-Type: image/jpg"); // 根據圖片格式設置 MIME 類型，例如 image/png 或 image/jpg
        echo $picture;
    } else {
        echo "<script>alert('Picture doesn't exist！');</script>";
    }


    if ($stmt !== null) {
        $stmt->close();
    }
    exit;
}


// 查詢所有貼文
$sql = "SELECT * FROM blog ORDER BY id DESC";
$result = $conn->query($sql);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css?v=1.0">
    <title>Post Handler System</title>
</head>


<body>
    <div class="form-container">
        <a href="Finalproject1105-4th/menu_after_login.php" ><img class="back1" src="back1.jpg"></a>
        <h2 class="form-title">Add/Fix Post</h2>
        <?php if (!empty($message)) echo "<p class='form-message'>$message</p>"; ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" id="category" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="star">Star（1~5）</label>
                <input type="number" name="star" id="star" class="form-input" min='1' max='5' required>
            </div>


            <div class="form-group">
                <label for="restaurent_name">Restaurant Name</label>
                <input type="text" name="restaurent_name" id="restaurent_name" class="form-input" required>
            </div>


            <div class="form-group">
                <label for="food_name">Food Name</label>
                <input type="text" name="food_name" id="food_name" class="form-input" required>
            </div>


            <div class="form-group">
                <label for="introduction">Food Introduction</label>
                <textarea name="introduction" id="introduction" class="form-textarea"></textarea>
            </div>


            <!--<div class="form-group">
                <label for="picture">Photo</label>
                <input type="file" name="picture" id="picture" class="form-input" required>
            </div>-->

            <div class="form-group">
                <label for="picture">Photo</label>
                <input type="file" name="picture" id="picture" class="form-input">
            </div>


            <h3 class="tips-title">Tips</h3>


            <div class="form-group">
                <label for="tips1_title">Tips1 Title</label>
                <input type="text" name="tips1_title" id="tips1_title" class="form-input">
            </div>
            <div class="form-group">
                <label for="tips1_context">Tips1 context</label>
                <textarea name="tips1_context" id="tips1_context" class="form-textarea"></textarea>
            </div>


            <div class="form-group">
                <label for="tips2_title">Tips2 Title</label>
                <input type="text" name="tips2_title" id="tips2_title" class="form-input">
            </div>
            <div class="form-group">
                <label for="tips2_context">Tips2 context</label>
                <textarea name="tips2_context" id="tips2_context" class="form-textarea"></textarea>
            </div>


            <div class="form-group">
                <label for="tips3_title">Tips3 Title</label>
                <input type="text" name="tips3_title" id="tips3_title" class="form-input">
            </div>
            <div class="form-group">
                <label for="tips3_context">Tips3 context</label>
                <textarea name="tips3_context" id="tips3_context" class="form-textarea"></textarea>
            </div>


            <div class="button-group">
                <button type="submit" name="action" value="add" class="btn btn-add">Add</button>
                <button type="submit" name="action" value="update" class="btn btn-update" >Modify</button>
            </div>
            <input type="hidden" name="id" id="id">
        </form>
    </div>


    <br>

    <?php if ($result->num_rows > 0) {
    // 使用循环输出每一条记录
    while ($row = $result->fetch_assoc()) {
        /*if (!empty($row['picture'])) {
            $image_info = getimagesizefromstring($row['picture']);
            if ($image_info) {
                $mime_type = $image_info['mime'];
                echo "<p>MIME Type: $mime_type</p>";
                echo "<p>Data Length: " . strlen($row['picture']) . "</p>";
            } else {
                echo "<p>Invalid image data.</p>";
            }
        }*/




        ?>
        <div class="main-container">
            <div id="<?php echo $row['id']; ?>" style = "background-color: #FFE29A; margin-bottom: 20px;" class="card">
                <div style="width: 85%; padding: 20px; display: flex; justify-content: center; align-items: center;">
                    <img src="data:image/jpg;base64,<?php echo base64_encode($row['picture']); ?>" alt="<?php echo htmlspecialchars($row['food_name'], ENT_QUOTES, 'UTF-8'); ?>"  
                    style="border-radius: 10px; max-width: 80%; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
                </div>
                <div style="width: 85%; padding: 20px; background-color: #FFF6D4; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
                    <h2 style="margin: 0; font-size: 24px;  font-family:Times New Roman;"><?php echo $row['food_name']; ?></h2>
                    <h4 style="margin: 10px 0; font-size: 16px;  font-family:Times New Roman; color: #555;"><?php echo $row['restaurent_name']; ?></h4>
                    <p style="margin: 10px 0; font-size: 14px;  font-family:Times New Roman; color: #555;">
                        <?php echo $row['introduction']; ?>
                    </p>
                    <div style="margin-top: 10px;">
                        <?php for ($i = 0; $i < $row['star']; $i++): ?>
                            <span style="color: gold;">&#9733;</span>
                        <?php endfor; ?>
                    </div>


                    <h2 style="text-align: center;  font-family:Times New Roman;">Eating Tips</h2>
                    <div style="background-color: #FFE29A; padding: 20px; border-radius: 10px;">
                        <?php if (!empty($row['tips1_context'])): ?>
                            <div style="display: flex; align-items: center; background-color: black; color: white; border-radius: 10px; padding: 15px; margin-bottom: 10px;">
                                <div style="width: 50px; height: 50px; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 20px; font-weight: bold; margin-right: 10px;">
                                    1
                                </div>
                                <div>
                                    <h4 style="margin: 0; font-size: 18px;"><?php echo htmlspecialchars($row['tips1_title'], ENT_QUOTES, 'UTF-8'); ?></h4>
                                    <p style="margin: 0; font-size: 14px;"><?php echo htmlspecialchars($row['tips1_context'], ENT_QUOTES, 'UTF-8'); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($row['tips2_context'])): ?>
                            <div style="display: flex; align-items: center; background-color: black; color: white; border-radius: 10px; padding: 15px; margin-bottom: 10px;">
                                <div style="width: 50px; height: 50px;  border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 20px; font-weight: bold; margin-right: 10px;">
                                    2
                                </div>
                                <div>
                                    <h4 style="margin: 0; font-size: 18px;"><?php echo htmlspecialchars($row['tips2_title'], ENT_QUOTES, 'UTF-8'); ?></h4>
                                    <p style="margin: 0; font-size: 14px;"><?php echo htmlspecialchars($row['tips2_context'], ENT_QUOTES, 'UTF-8'); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($row['tips3_context'])): ?>
                            <div style="display: flex; align-items: center; background-color: black; color: white; border-radius: 10px; padding: 15px; margin-bottom: 10px;">
                                <div style="width: 50px; height: 50px; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 20px; font-weight: bold; margin-right: 10px;">
                                    3
                                </div>
                                <div>
                                    <h4 style="margin: 0; font-size: 18px;"><?php echo htmlspecialchars($row['tips3_title'], ENT_QUOTES, 'UTF-8'); ?></h4>
                                    <p style="margin: 0; font-size: 14px;"><?php echo htmlspecialchars($row['tips3_context'], ENT_QUOTES, 'UTF-8'); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>


                    <form method="POST" action="" style="margin: 0;">
                        <!-- 隱藏欄位存放 ID -->
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                        <input type="hidden" name="category" value="<?php echo htmlspecialchars($row['category']); ?>">
                        <input type="hidden" name="star" value="<?php echo htmlspecialchars($row['star']); ?>">
                        <input type="hidden" name="restaurent_name" value="<?php echo htmlspecialchars($row['restaurent_name']); ?>">
                        <input type="hidden" name="food_name" value="<?php echo htmlspecialchars($row['food_name']); ?>">
                        <input type="hidden" name="introduction" value="<?php echo htmlspecialchars($row['introduction']); ?>">
                        <input type="hidden" name="tips1_title" value="<?php echo htmlspecialchars($row['tips1_title']); ?>">
                        <input type="hidden" name="tips1_context" value="<?php echo htmlspecialchars($row['tips1_context']); ?>">
                        <input type="hidden" name="tips2_title" value="<?php echo htmlspecialchars($row['tips2_title']); ?>">
                        <input type="hidden" name="tips2_context" value="<?php echo htmlspecialchars($row['tips2_context']); ?>">
                        <input type="hidden" name="tips3_title" value="<?php echo htmlspecialchars($row['tips3_title']); ?>">
                        <input type="hidden" name="tips3_context" value="<?php echo htmlspecialchars($row['tips3_context']); ?>">
                        <button type="button" class="edit-btn" style="padding: 10px 20px; background-color: #FF8000; border: none; border-radius: 5px; color: white; cursor: pointer; font-size: 14px; transition: background-color 0.3s ease;">
                            Modify
                        </button>
                        <button type="submit" name="action" value="delete" style="padding: 10px 20px; background-color: #DC3545; border: none; border-radius: 5px; color: white; cursor: pointer; font-size: 14px; transition: background-color 0.3s ease;">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    echo "<p>目前没有任何数据。</p>";
}
?>


<script>
    // 動態將貼文內容載入主表單供修改
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('form');
            const mainForm = document.querySelector('form[action=""]'); // 主表單


            // 將隱藏欄位的值複製到主表單
            ['id', 'category', 'star', 'restaurent_name', 'food_name', 'introduction',
            'tips1_title', 'tips1_context', 'tips2_title', 'tips2_context',
            'tips3_title', 'tips3_context'].forEach(field => {
                const targetField = mainForm.querySelector(`[name="${field}"]`);
                if (targetField) {
                    targetField.value = form.querySelector(`[name="${field}"]`).value;
                }
            });


            // 滾動到主表單位置
            mainForm.scrollIntoView({ behavior: 'smooth' });
        });
    });
</script>
</body>
</html>



