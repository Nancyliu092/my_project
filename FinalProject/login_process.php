<?php
session_start(); // 启动会话

$error_message = ""; // 初始化錯誤訊息

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 建立数据库连接
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blog2";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // 检查连接是否成功
    if ($conn->connect_error) {
        die("连接失败: " . $conn->connect_error);
    }

    if (isset($_POST['username']) && isset($_POST['password'])) {
        // 從表單中獲取使用者提供的使用者名稱和密碼
        $username = $_POST['username'];
        $password = $_POST['password'];

        // 在資料庫中查找匹配的使用者
        $sql = "SELECT * FROM authors WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);

        // 如果找到匹配的使用者，允許登入
        if ($result->num_rows > 0) {
            $_SESSION['username'] = $username; // 將使用者名稱存儲在會話中
            echo "<script>alert('success！'); window.location.href='index_2.php';</script>";
            exit;
        } else {
            $error_message = "Incorrect username or password, please try again!";
        }
    } else {
        $error_message = "Please enter a username and password!";
    }

    // 如果有錯誤訊息，顯示 alert 彈跳視窗
    if (!empty($error_message)) {
        echo "<script>alert('$error_message');</script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
    <meta charset="utf-8" />
    <link href="https://fonts.googleapis.com/css2?family=Chivo:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <meta charset="UTF-8">
</head>

<!--導航欄-->
<nav class="nav1">
    <ul class='nav-bar'>
        <li id='logo'><img src='./lu/foodlogo.png' /><a href='./index_1.php' id="logo-text">Nostimo</a>
        </li>
        <input type='checkbox' id='check'>
        <div class="menu">
            <li><a href="./index_1.php">HomePage</a></li>
            <li><a href="./wen/about.html">About us</a></li>
            <li><a href="./Finalproject1105-4th/finalproject.php">Menu</a></li>
            <li><a href="login_process.php">Login</a></li>
            <label for="check" class="close-menu"><i class="fas fa-times"></i></label>
        </div>
        <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
    </ul>
</nav><br><br><br><br><br><br><br><br><br><br>

<form id="login-form" action="" method="post">
    <div class="container">
        <div class="contact-box">
         
                <div class="left" >
                 
                <div id="crazy-potato">
                    <canvas id="display-canvas"></canvas>
             
               
                </div>
                </div>
            

            <div class="right">
                <h2>Login</h2>
                <input type="text" class="field" id="username" name="username" placeholder="Your Name">
                <input type="password" class="field" id="password" name="password" placeholder="password"><br><br>
                <!-- <input type="text" class="field" placeholder="Phone"> -->
                <!-- <textarea placeholder="Message" class="field"></textarea> -->
                <a href="register_process.php" class="custom-link">Don’t have an account? <strong>Sign
                        up</strong></a><br><br><br><br>
                <!-- 顯示錯誤訊息 -->


                <button class="btn" type="submit">Send</button>

            </div>
        </div>
    </div>
</form>

</body>

</html>

<!-- popop -->
<style>
        /* styles.css */


       #crazy-potato {
    border: none;
    background: none;
    cursor: pointer;
    outline: none;
    padding-top: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
}

#display-canvas {
    /* width: 150vw;
    height: 150vh; */
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}
    </style>
<!-- nav-->

<style>
    body {
        /* background-image: linear-gradient(to top, #e1c67b 0%, #ffdd99 100%); */
        background-color: linear-gradient(40deg, #e61b1b, #FFAD00, #FFDD99, #FFEFD6);
        background-repeat: no-repeat;
        background-size: cover;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .nav1 {
        margin: 0;
        padding: 0;
        font-family: "Chivo", sans-serif;
        --color1: #fff;
        --color2: #FF8C00;
    }

    /*導航欄*/
    .nav-bar {
        width: 100%;
        top: 0;
        display: flex;
        position: fixed;
        justify-content: space-between;
        align-items: center;
        list-style: none;
        background-color: var(--color2);
        padding: 12px 20px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.3);
        z-index: 9999;
    }

    #logo {
        display: flex;
        align-items: center;
    }

    #logo img {
        width: 50px;
        margin-right: 5px;
        /* 與文字保持距離 */
    }

    #logo a {
        font-size: 38px;
        /* 增加字體大小 */
        display: flex;
        align-items: center;
        text-decoration: none;
        /* 去掉底線 */
        font-weight: bold;
        font-family: 'Dancing Script', cursive;
        /* 使用指定字體 */
        color: white;
    }

    #logo a:hover {
        background-color: #AE8F00;
    }

    #logo-text span {
        border-right: .05em solid;
        animation: caret 1s steps(1) infinite;
    }

    @keyframes caret {
        50% {
            border-color: transparent;
        }
    }

    .typewriter-caret {
        border-right: 0.1em solid black;
        animation: blink-caret 0.5s step-end infinite;
    }

    @keyframes blink-caret {

        from,
        to {
            border-color: transparent;
        }

        50% {
            border-color: black;
        }
    }


    .menu {
        display: flex;
        /* align-items: center; */
    }

    .menu li {
        padding-left: 30px;
        position: relative;
    }

    .menu li a {
        font-size: 16px;
        display: inline-block;
        text-decoration: none;
        color: var(--color1);
        text-align: center;
        transition: 0.15s ease-in-out;
        position: relative;
        text-transform: uppercase;
        font-weight: bold;
    }

    .menu li a::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 1px;
        background-color: var(--color1);
        transition: 0.15s ease-in-out;
    }

    .menu li a:hover:after {
        width: 100%;
    }

    .menu li:not(:first-child)::after {
        content: "";
        position: absolute;
        left: 17px;
        top: 50%;
        transform: translateY(-50%);
        height: 100%;
        /* 調整分隔線的高度 */
        width: 2.5px;
        background-color: #fff;
        /* 分隔線顏色，可根據需要調整 */
    }

    .open-menu,
    .close-menu {
        position: absolute;
        color: var(--color1);
        cursor: pointer;
        font-size: 1.5rem;
        display: none;
    }

    .open-menu {
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
    }

    .close-menu {
        top: 20px;
        right: 20px;
    }

    #check {
        display: none;
    }

    @media (max-width: 610px){
        .menu {
            flex-direction: column;
            /* align-items: center; */
            justify-content: flex-start;
            width: 100%;
            max-height: 100vh;
            overflow-y: auto;
            position: fixed;
            margin: 0px;
            padding: 0px;
            top: 12px;
            /* 選單從頂部開始 */
            right: -100%;
            z-index: 100;
            background-color: var(--color2);
            transition: all 0.2s ease-in-out;
        }

        .menu li {
            margin: 10px 0;
        }

        .menu li a {
            padding: 10px;
        }

        .open-menu,
        .close-menu {
            display: block;
        }

        #check:checked~.menu {
            right: 0;
        }

        .menu li:not(:first-child)::after {
            content: none;
            /* 移除分隔線 */
        }
 
    }
</style>

</style>
<style>
    .error-message {
        color: #ff0000;
        /* 明亮的紅色 */
        font-size: 18px;
        /* 增加字體大小 */
        font-weight: bold;
        /* 加粗字體 */
        margin-top: 15px;
        /* 增加與其他元素的間距 */
        text-align: center;
        text-transform: uppercase;
        /* 全部轉為大寫 */
        background-color: #ffe6e6;
        /* 添加淺紅色背景 */
        padding: 10px;
        /* 增加內部間距 */
        border: 2px solid #ff0000;
        /* 添加紅色邊框 */
        border-radius: 5px;
        /* 圓角邊框 */
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        /* 添加陰影 */
    }


    .success-message {
        color: green;
        font-size: 14px;
        margin-top: 10px;
        text-align: center;
    }



    body {
        background-image: linear-gradient(to top, #e1c67b 0%, #ffdd99 100%);
        /* linear-gradient(40deg, #e61b1b, #FFAD00, #FFDD99, #FFEFD6); */
        background-repeat: no-repeat;
        background-size: cover;
    }

    section {
        display: grid;
        grid-template-columns: 50% 45%;
        place-items: center;
        gap: 60px;
        min-height: 100vh;
        padding: 20px 60px;
    }

    a.custom-link {
        color: black;
        text-decoration: none;
    }

    a.custom-link:hover {
        color: rgb(131, 109, 83);
        /* 這裡可以根據需求更改顏色 */
    }
</style>
<!-- navisbar -->

<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        /* font-family: 'Quicksand', sans-serif; */
    }

    body {
        height: 100vh;
        width: 100%;
    }

    .container {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px 40px;
    }

    .container:after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        background: url("wen/bg.jpg") no-repeat center;
        background-size: cover;
        filter: blur(50px);
        z-index: -1;
    }

    .contact-box {
        max-width: 850px;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        justify-content: center;
        align-items: center;
        text-align: center;
        background-color: #fff;
        box-shadow: 0px 0px 19px 5px rgba(0, 0, 0, 0.19);
    }

    .left .bg {
        background: url("wen/bg.jpg") no-repeat center;
        background-size: cover;
        height: 100%;
        /* transition-property: 190%; */
        filter: blur(50px);
    }

    .right {
        padding: 25px 40px;
    }

    h2 {
        position: relative;
        padding: 0 0 10px;
        margin-bottom: 10px;
    }

    h2:after {
        content: '';
        position: absolute;
        left: 50%;
        bottom: 0;
        transform: translateX(-50%);
        height: 4px;
        width: 50px;
        border-radius: 2px;
        background-color: #FF8C00;
    }

    .field {
        width: 100%;
        border: 2px solid rgba(0, 0, 0, 0);
        outline: none;
        background-color: rgba(230, 230, 230, 0.6);
        padding: 0.5rem 1rem;
        font-size: 1.1rem;
        margin-bottom: 22px;
        transition: .3s;
    }

    .field:hover {
        background-color: rgba(0, 0, 0, 0.1);
    }

    textarea {
        min-height: 150px;
    }

    .btn {
        width: 100%;
        padding: 0.5rem 1rem;
        background-color: #FF8C00;
        color: #fff;
        font-size: 1.1rem;
        border: none;
        outline: none;
        cursor: pointer;
        transition: .3s;
    }

    .btn:hover {
        background-color: rgb(248, 209, 81);
    }

    .field:focus {
        border: 2px solid rgba(30, 85, 250, 0.47);
        background-color: #fff;
    }

    @media screen and (max-width: 880px) {
        .contact-box {
            grid-template-columns: 1fr;
        }

        .left {
            height: 200px;
        }
        #crazy-potato {
    
    padding-top: 4rem;
 
}
    }
</style>


<script>
    document.addEventListener('DOMContentLoaded', function (event) {
        var dataText = ["Nostimo"];

        function typeWriter(text, i, fnCallback) {
            if (i < text.length) {
                document.querySelector("#logo-text").innerHTML = text.substring(0, i + 1) + '<span class="typewriter-caret" aria-hidden="true"></span>';
                setTimeout(function () {
                    typeWriter(text, i + 1, fnCallback);
                }, 100);
            } else if (typeof fnCallback == 'function') {
                setTimeout(fnCallback, 400);
            }
        }

        function StartTextAnimation(i) {
            if (i < dataText.length) {
                typeWriter(dataText[i], 0, function () {
                    StartTextAnimation(i + 1);
                });
            }
        }

        StartTextAnimation(0); // 初始化動畫
    });

</script>

<script type="module">
        if (!window.hasOwnProperty('DotLottie')) {
    import('https://esm.sh/@lottiefiles/dotlottie-web@0.37.0').then(module => {
        window.DotLottie = module.DotLottie;
    });
}

        import { DotLottie } from 'https://esm.sh/@lottiefiles/dotlottie-web@0.37.0';

        const dotLottie = new DotLottie({
            autoplay: true,
            loop: true,
            canvas: document.querySelector('#display-canvas'), // Targets the canvas element
            src: "https://lottie.host/ea94c1e3-5cea-4846-81ff-395a2d016287/DjCvZcleUA.lottie",
        });

        const button = document.getElementById('crazy-potato');

        const themes = ["day", "sunset", "night", "midnight", "winter"];
        let currentThemeIndex = 1;

        button.addEventListener('click', () => {
            currentThemeIndex = (currentThemeIndex + 1) % themes.length;
            const newTheme = themes[currentThemeIndex];
            dotLottie.setTheme(newTheme);

            console.log(`Theme set to: ${newTheme}`);
        });
    </script>