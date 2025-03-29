<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("Location: ../login_process.php");
    exit;
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
    <ul class="nav-bar">
      <li id="logo">
        <img src="../lu/foodlogo.png" /><a href="../index_2.php" id="logo-text"
          >Nostimo</a
        >
      </li>
      <input type="checkbox" id="check" />
      <div class="menu">
        <li><a href="../index_2.php">HomePage</a></li>
        <li><a href="about.php">About us</a></li>
        <li><a href="../Finalproject1105-4th/menu_after_login.php">Menu</a></li>
        <li><a href="../logout.php">logout</a></li>
        <label for="check" class="close-menu"
          ><i class="fas fa-times"></i
        ></label>
      </div>
      <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
    </ul>
  </nav> 


</body>

</html>

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
        align-items: center;
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

<!-- nav結束 -->

<body div style="background: #ffdd99">
  <head>
    <meta charset="utf-8" />
    <link
      href="https://fonts.googleapis.com/css2?family=Chivo:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
      integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />

    <meta charset="UTF-8" />
  </head>

  <!-- 導航欄
  <nav class="nav1">
    <ul class="nav-bar">
      <li id="logo">
        <img src="../lu/foodlogo.png" /><a href="../index_2.php" id="logo-text"
          >Nostimo</a
        >
      </li>
      <input type="checkbox" id="check" />
      <div class="menu">
        <li><a href="../index_2.php">HomePage</a></li>
        <li><a href="about.php">About us</a></li>
        <li><a href="../Finalproject1105-4th/menu_after_login.php">Menu</a></li>
        <li><a href="../logout.php">logout</a></li>
        <label for="check" class="close-menu"
          ><i class="fas fa-times"></i
        ></label>
      </div>
      <label for="check" class="open-menu"><i class="fas fa-bars"></i></label>
    </ul>
  </nav> -->

  <div class="title">
    <div>
      <h2>ABOUT</h2>
      <!-- <img src="clouds_1.png" id="clouds_1" />
        <img src="clouds_2.png" id="clouds_2" />
        <img src="fork_left_-removebg-preview.png" id="mountain_left" /> -->
    </div>

    <div class="down-arrow"></div>
  </div>
  <section class="blog" style="background: #ffdd99">
    <h2>About us</h2>
    <p>Why we call "Nostimo"?</p>
    <p></p>
    <p>
      Nostimo, which means "delicious" in Greek, is a food blog created with the
      idea of bringing simple, affordable, and delicious recipes to the college
      community. The blog was inspired by the creator's personal journey as a
      university student, balancing tight budgets, limited cooking skills, and a
      desire for homemade, nutritious meals.<br /><br />

      The blog is specifically designed for college students who often face
      challenges such as limited time, access to ingredients, or even basic
      cooking knowledge. Through step-by-step recipes, tips for meal prepping,
      and ideas for quick and easy meals, Nostimo aims to empower students to
      enjoy cooking and explore flavors from different cuisines, all while
      saving money and staying healthy.<br /><br />
    </p>

    <!-- <div style="border: 1px solid black;"></div> -->

    <div
      class="fade"
      style="
        border: 0;
        padding: 0px;
        padding-top: 10px;
        color: #fefeff;
        border-top: 1px solid #ffad00;
        box-shadow: inset 0 10px 10px -10px;
      "
    ></div>
  </section>
  <section class="blog" style="background: #ffdd99">
    <h2>Authors</h2>
    <div class="cards">
      <div class="card">
        <img
          src="https://github.com/ecemgo/mini-samples-great-tricks/assets/13468728/db0b1567-8d28-49c1-8687-7a982c594140"
          alt=""
        />
        <!-- <img
        class="card-img"
        src="wen_r.png"
        alt=
      /> -->
        <div class="overlay">
          <h3>Liu Yiwen</h3>
          <p>
            I've loved cooking since I was a kid, experimenting with flavors and
            recipes from all over the world. After years of filling my family
            and friends with my creations, I realized that I wanted to share my
            recipes and experiences with a wider audience. Starting a food blog
            felt like the perfect way to do that! Through my blog, I hope to
            inspire others to try new dishes and make cooking a more joyful,
            creative experience. Food brings people together, and my goal is to
            build a community that shares this love.
          </p>
        </div>
      </div>

      <div class="card">
        <!-- <img
        src="lu_r.png"
          alt=""
        />
         -->
        <img
          src="https://github.com/ecemgo/mini-samples-great-tricks/assets/13468728/1ee42860-8dba-452d-91c5-6cfb9763b29e"
          alt=""
        />
        <div class="overlay">
          <h3>Lu Guanyu</h3>
          <p>
            Traveling and tasting different cuisines has always been my greatest
            passion. I've had the chance to try street food in Bangkok, fine
            dining in Paris, and everything in between. Starting a food blog was
            a way for me to share these culinary experiences with others and
            showcase the incredible diversity of food cultures worldwide. My
            blog is a mix of recipes and travel stories, aimed at helping
            readers explore the world from their own kitchens. I want to
            encourage people to be adventurous with food, even if they can’t
            always travel!
          </p>
        </div>
      </div>

      <div class="card">
        <!-- <img
        src="liu_r.png" 
        alt=""
        /> -->
        <img
          src="https://github.com/ecemgo/mini-samples-great-tricks/assets/13468728/a18e223f-28a1-4ae2-9068-ffe6157a4988"
          alt=""
        />
        <div class="overlay">
          <h3>Liu Xiuhui</h3>
          <p>
            I started my food blog as a way to document my journey in the
            culinary world and to showcase the skills and techniques I’m
            learning. Sharing recipes and kitchen tips allows me to connect with
            food lovers and get feedback from a broader community. My blog is a
            blend of classic and modern recipes, with a focus on making gourmet
            food approachable for home cooks. My hope is that my blog will
            inspire others to take on new cooking challenges and bring the joy
            of fine dining into their own homes.
          </p>
        </div>
      </div>

      <div class="card">
        <!-- <img
        src="lin_r.png" 
        alt=""
        /> -->
        <img src="./1.png" alt="" />
        <div class="overlay">
          <h3>Lin Peiting</h3>
          <p>
            For years, I’ve been crafting nutritious, delicious recipes for
            myself and my family, focusing on fresh, whole ingredients. I
            started my food blog to share these recipes with a larger audience,
            especially those who are looking to live healthier lives but don’t
            want to sacrifice taste. My goal is to show that healthy eating can
            be both enjoyable and accessible to everyone. Through my blog, I
            hope to make it easier for people to cook wholesome meals and enjoy
            food that’s both nourishing and satisfying.
          </p>
        </div>
      </div>
    </div>

    <p>
      We are funny students in NSYSU. If you have any problem please contact us!
    </p>
    <!-- <div style="border: 1px solid black"></div> -->
    <div
    class="fade"
    style="
      border: 0;
      padding: 0px;
      padding-top: 10px;
      color: #fefeff;
      border-top: 1px solid #ffad00;
      box-shadow: inset 0 10px 10px -10px;
    "
  ></div>
  </section>

  <!-- contact -->
  <div class="container">
    <h2>Contact</h2>
  </div>

  <div class="container">
    <div class="contact-box">
      <div class="left"></div>
      <div class="right">
        <h2>Contact Us</h2>
        <input type="text" class="field" placeholder="Your Name" />
        <input type="text" class="field" placeholder="Your Email" />
        <input type="text" class="field" placeholder="Phone" />
        <textarea placeholder="Message" class="field"></textarea>
        <button class="btn">Send Message</button>
      </div>
    </div>
  </div>
  <br /><br />

  <!-- Footer -->
  <div
    style="
      background-color: #ff8c00;
      color: #ffffff;
      text-align: center;
      width: 100%;
      padding-top: 40px;
      padding-bottom: 40px;
    "
  >
    <div
      class="footer-middle"
      style="
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 30px;
        margin-bottom: 20px;
        text-align: center;
        padding-right: 35px;
      "
    >
      <div class="link">
        <a href="#"
          ><img src="../lu/mail.png" alt="Mail" style="width: 30px; margin: 0"
        /></a>
      </div>
      <div class="contact">
        <a href="#"
          ><img
            src="../lu/phone_0.png"
            alt="Phone"
            style="width: 30px; margin: 0"
        /></a>
      </div>
      <div class="social">
        <a href="#"
          ><img
            src="../lu/facebook.png"
            alt="Facebook"
            style="width: 30px; margin: 0 12px"
        /></a>
        <a href="#"
          ><img
            src="../lu/instagram.png"
            alt="Instagram"
            style="width: 30px; margin: 0 12px"
        /></a>
      </div>
    </div>
    <div class="footer-bottom" style="text-align: center">
      <p>
        @ Powered by
        <a
          href="https://www.w3schools.com/w3css/default.asp"
          style="color: #8f4586"
          >w3.css</a
        >
      </p>
    </div>
  </div>
</body>
<!-- form -->
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
    /* height: 100%; */
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0px 40px 0 20px;
  }

  .container:after {
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    background: url("img/bg.jpg") no-repeat center;
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

  .left {
    background: url("https://github.com/ecemgo/mini-samples-great-tricks/assets/13468728/a18e223f-28a1-4ae2-9068-ffe6157a4988")
      no-repeat center;
    background-size: cover;
    height: 100%;
  }

  .right {
    padding: 25px 40px;
  }

  .container h2 {
    font-size: clamp(2rem, 6vw, 3rem);
    color: #000;
    margin: 0px 0 40px;
    text-align: center;
  }

  .h2:after {
    content: "";
    position: absolute;
    left: 50%;
    bottom: 0;
    transform: translateX(-50%);
    height: 4px;
    width: 50px;
    border-radius: 2px;
    background-color: #ff8c00;
  }

  .field {
    width: 100%;
    border: 2px solid rgba(0, 0, 0, 0);
    outline: none;
    background-color: rgba(230, 230, 230, 0.6);
    padding: 0.5rem 1rem;
    font-size: 1.1rem;
    margin-bottom: 22px;
    transition: 0.3s;
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
    background-color: #ff8c00;
    color: #fff;
    font-size: 1.1rem;
    border: none;
    outline: none;
    cursor: pointer;
    transition: 0.3s;
  }

  .btn:hover {
    background-color: rgb(244, 205, 48);
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
  }
</style>
<!-- about首頁圖 -->
<style>
  .title {
    background: linear-gradient(
        to bottom,
        rgba(255, 255, 255, 0) 97%,
        #ffe8cc 100%
      ),
      url("bg.jpg") no-repeat center center / cover !important;
    background-repeat: no-repeat;
    width: 100%;
    height: 100%;
    width: 100%;
    height: 80%;
    padding-bottom: 120px;
    position: relative;
    transition: transform 0.3s ease, opacity 0.3s ease;
  }

  .title h2 {
    font-family: "Georgia", "Times New Roman", serif;
    font-weight: bold;
    font-size: 2em;
  }

  .title {
    transition: transform 0.3s ease-out, opacity 0.3s ease-out;
    padding-top: 150px;
  }

  .title.hidden {
    transform: translateY(-100%);
    opacity: 0;
  }

  section,
  .block-1-divider,
  .block-2-divider,
  .block-3-divider {
    opacity: 0;
    transition: opacity 1s ease;
  }

  section.show,
  .block-1-divider.show,
  .block-2-divider.show,
  .block-3-divider.show {
    opacity: 1;
  }

  .down-arrow {
    text-align: center;
    font-size: 24px;
    animation: bounce 1s infinite;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    bottom: 10px;
  }

  @keyframes bounce {
    0%,
    100% {
      transform: translateY(0);
    }

    50% {
      transform: translateY(10px);
    }
  }

  .title h2 {
    font-family: "Times New Roman", serif;
    font-size: 180px;
    font-weight: lighter;
    text-align: center;
    justify-content: center;
    margin-bottom: 50px;
    cursor: context-menu;
  }

  .linking-button {
    display: flex;
    flex-direction: row;
    justify-content: center;
    text-align: center;
    font-size: 16px;
    font-weight: bold;
  }

  .linking-button div {
    font-family: "Times New Roman", sans-serif !important;
    padding: 10px;
    margin-left: 35px;
    margin-right: 35px;
    border: 2px solid transparent;
    border-radius: 30%;
    text-decoration: none;
    cursor: pointer;
    background-color: rgba(28, 27, 27, 0.783);
  }

  .linking-button div:hover {
    background-color: rgba(83, 90, 98, 0.635);
  }

  .linking-button a:link {
    color: white;
  }

  .linking-button a:visited {
    color: white;
  }

  .linking-button div a {
    text-decoration: none;
  }

  .down-arrow {
    width: 0;
    height: 0;
    border-left: 10px solid transparent;
    border-right: 10px solid transparent;
    border-top: 15px solid black;
    margin: 0 auto;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    bottom: 10px;
    animation: bounce 1s infinite;
  }
</style>
<style>
  @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700&display=swap");

  * {
    box-sizing: border-box;
  }

  /* body {
    height: 100vh;
    width: 100vw;
  } */

  #mountain_left,
  #mountain_right {
    width: 50%;
    /* Adjust the percentage as needed */
    height: auto;
    /* Maintain aspect ratio */
    position: absolute;
    /* Keep the position if required */
    top: 50%;
    /* Adjust vertical positioning if necessary */
    transform: translateY(-50%);
    /* Center the images vertically */
  }

  #top {
    /* position: relative; */
    width: 100%;
    height: 80vh;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  /* #top::before {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    height: 200px;
    width: 100%;
    background: linear-gradient(to top, #ffdd99, transparent);
    z-index: 1000;
  } */
  #man {
    top: inherit;
    bottom: 0;
    width: 100%;
  }

  #top #bg,
  #text {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    pointer-events: none;
  }

  #text {
    position: relative;

    font-size: 10rem;
    text-align: center;
  }

  #sec {
    padding: 100px;
    padding-bottom: 20px;
  }

  #sec h2 {
    font-size: 4rem;
    margin-bottom: 30px;
    color: #dae01b;
  }

  #sec p {
    font-size: 21px;
    /* 設定為 21px */
    line-height: 2rem;
    font-weight: 300;
  }

  /* RWD */
  @media (max-width: 1024x) {
    #sec {
      padding: 50px;
    }

    #sec h2 {
      font-size: 3rem;
    }

    #sec p {
      font-size: 1rem;
      line-height: 1.6rem;
    }

    #bg {
      max-width: 100%;
      /* 避免圖片縮小過度 */
      max-height: 100vh;
      /* 限制高度 */
      width: auto;
      /* 自動寬度調整 */
      height: auto;
      /* 自動高度調整 */
      object-fit: cover;
      /* 確保圖片完全覆蓋 */
    }

    #text {
      font-size: 2.5rem;
      /* 在小螢幕上調整字體大小 */
    }
  }

  @media (max-width: 375px) {
    /* #top {
      height: auto;
    } */
    #sec {
      padding: 5px;
    }

    #bg {
      max-width: 100%;

      width: auto;
      height: 70%;
      object-fit: cover;
    }

    #text {
      font-size: 50px;
      /* 增大字體大小，使其在小螢幕上更易讀 */
    }
  }
</style>

<style>
  @import url("https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&family=Mooli&display=swap");

  html {
    scroll-behavior: smooth;
  }

  /* h1,
  h2,
  h3 {
    font-family: "Comfortaa", cursive;
  } */

  body {
    min-height: 100dvh;
    overflow-x: hidden;
    background: #fff;
    /* font-family: "Mooli", sans-serif; */
  }

  .logo {
    color: #112434;
    font-weight: 700;
    font-size: clamp(1.1rem, 6vw, 1.7rem);
    text-decoration: none;
  }

  .navigation {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .navigation li {
    list-style: none;
    margin-left: 20px;
  }

  .navigation li a {
    text-decoration: none;
    padding: 6px 15px;
    color: #112434;
    border-radius: 20px;
    font-size: clamp(0.9rem, 6vw, 1rem);
  }

  .navigation li a:hover,
  .navigation li a.active {
    background: #112434;
    color: #fff;
  }

  .parallax {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 150dvh;
    background: rgb(206, 245, 223);
    background: radial-gradient(
      circle,
      rgba(206, 245, 223, 0.4) 34%,
      rgba(206, 245, 223, 1) 68%
    );
  }

  .parallax img {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    pointer-events: none;
  }

  #title {
    position: absolute;
    top: 13%;
    font-size: clamp(2rem, 6vw, 4rem);
    color: #000;
    z-index: 50;
  }

  .blog {
    position: relative;
    padding: 120px 150px 20px;
    /* background: #f6f0e7; */
  }

  /* 
  .blog::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 50px;
    background: rgb(246, 240, 231);
    background: radial-gradient(
      circle,
      rgba(246, 240, 231, 1) 54%,
      rgba(0, 114, 125, 1) 99%
    );
    z-index: 999;
  } */

  .blog h2 {
    font-size: clamp(2rem, 6vw, 3rem);
    color: #000;
    margin: 0px 0 40px;
    text-align: center;
  }

  .blog p {
    font-size: clamp(1rem, 6vw, 1.3rem);
    color: #000;
    font-weight: 400;
    margin-bottom: 30px;
    text-align: center;
    line-height: 1.5;
  }

  .cards {
    display: grid;
    align-items: center;
    justify-items: center;
    grid-template-columns: 1fr;
    gap: 40px;
    padding: 60px 60px;
    /* background: #f6f0e7; */
    display: flex;
    flex-wrap: wrap;
    /*gap: 100px;*/
    justify-content: center;
    align-items: flex-start;
  }

  .card {
    position: relative;
    display: flex;
    flex-wrap: wrap;
    /* flex-direction: column; */
    /* align-items: center; */
    gap: 20px;
    justify-content: center;
    align-items: flex-start;
    width: min(100%, 450px);
    background-color: #fff;
    box-shadow: 0 6px 30px rgba(0, 0, 0, 0.3);
    border-radius: 20px;
    padding: 30px 40px;
  }

  .card img {
    display: block;
    width: 100%;
    max-width: 250px;
    aspect-ratio: 1/1;
    margin: 20px;
  }

  .card h3 {
    font-size: 1.4rem;
    font-weight: 700;
    margin: 20px 0 20px;
    text-align: center;
    color: #000;
  }

  .card p {
    font-size: 1rem;
    text-align: justify;
    line-height: 1.5;
    color: #000;
  }

  .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background: linear-gradient(to bottom, #c4821f, #ffad00, #ffdd99, #ffefd6);
    border-radius: 20px;
    list-style: none;
    z-index: 1;
    opacity: 0;
    padding: 20px 40px;
    transition: all 0.4s ease-in-out;
  }

  .overlay:hover {
    opacity: 1;
    cursor: default;
  }

  @media (max-width: 1300px) {
    header {
      padding: 30px 50px;
    }

    #title {
      top: 16%;
    }

    .parallax {
      height: 120dvh;
    }

    .blog {
      padding: 0px 120px 20px;
    }
  }

  @media (max-width: 900px) {
    .navigation li {
      margin-left: 10px;
    }

    .parallax {
      height: 100dvh;
    }

    #title {
      top: 20%;
    }

    .blog {
      padding: 0px 100px 20px;
    }

    .cards {
      padding: 40px 40px;
    }

    .card h3 {
      margin: 20px 0 20px;
    }
  }

  @media (max-width: 600px) {
    .navigation li {
      margin-left: 5px;
    }

    header {
      padding: 30px 10px;
    }

    #title {
      top: 40%;
    }

    .blog {
      padding: 0px 40px 20px;
    }

    .blog p {
      font-size: 1rem;
    }

    .card {
      width: min(100%, 450px);
    }

    .card h3 {
      font-size: 1.2rem;
    }

    .card p {
      font-size: 0rem;
      text-align: unset;
    }
    .title h2 {
      margin-top: 150px;
      font-size: 60px;
    }
  }
</style>

<!-- navbarcss -->

<style>
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
    --color2: #ff8c00;
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
    font-family: "Dancing Script", cursive;
    /* 使用指定字體 */
    color: white;
  }

  #logo a:hover {
    background-color: #ae8f00;
  }

  #logo-text span {
    border-right: 0.05em solid;
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
    align-items: center;
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

  @media (max-width: 610px) {
    .menu {
      flex-direction: column;
      align-items: flex-start;
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

    #check:checked ~ .menu {
      right: 0;
    }

    .menu li:not(:first-child)::after {
      content: none;
      /* 移除分隔線 */
    }
  }
</style>

<style>
  /*聯絡資訊*/

  .contact-section h2 {
    font-size: clamp(2rem, 6vw, 3rem);
    color: #000;
    margin: 60px 0 40px;
    text-align: center;
  }

  .contact-section {
    width: 100%;
    padding-top: 70px;
    padding-bottom: 20px;
    padding-left: 80px;
    padding-right: 80px;
    background-color: #ffdd99;
    /* border: 1px solid #ddd; */
    /* box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); */
  }

  .contact-section h1 {
    font-size: 2rem;
    margin-bottom: 20px;
    text-align: center;
  }

  .contact-section p {
    font-size: 1.5rem;
    line-height: 1.5;
    color: #333;
    margin-bottom: 15px;
  }

  .contact-section form {
    display: flex;
    flex-direction: column;
  }

  .contact-section label {
    font-size: 1.3rem;
    color: #333;
    margin-bottom: 5px;
  }

  .contact-section input,
  .contact-section textarea {
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 1rem;
    color: #333;
  }

  .contact-section button {
    padding: 12px;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
  }

  .contact-section button:hover {
    background-color: #555;
  }
</style>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    fetch("about_hero.html")
      .then((response) => response.text())
      .then((data) => {
        document.getElementById("about-hero-container").innerHTML = data;

        // 在這裡重新初始化動畫或執行載入的腳本
        initHeroAnimation(); // 確認 initHeroAnimation() 是動畫的初始化函數
      });
  });

  const mountainLeft = document.querySelector("#mountain_left");
  const mountainRight = document.querySelector("#mountain_right");
  const cloud1 = document.querySelector("#clouds_1");
  const cloud2 = document.querySelector("#clouds_2");
  const text = document.querySelector("#text");
  const man = document.querySelector("#man");

  window.addEventListener("scroll", () => {
    let value = scrollY;
    mountainLeft.style.left = `-${value / 0.7}px`;
    cloud2.style.left = `-${value * 2}px`;
    mountainRight.style.left = `${value / 0.7}px`;
    cloud1.style.left = `${value * 2}px`;
    text.style.bottom = `-${value}px`;
    man.style.height = `${window.innerHeight - value}px`;
  });

  document.addEventListener("DOMContentLoaded", function () {
    // 載入 animal.html 並插入到 animal-container
    fetch("animal.html")
      .then((response) => response.text())
      .then((data) => {
        document.getElementById("animal-container").innerHTML = data; // 如果需要初始化 `animal.html` 裡的動畫或效果，這裡可以呼叫初始化函數

        initAnimalAnimation(); // 確認 initAnimalAnimation() 是動畫的初始化函數
      });
  }); // 定義初始化動畫的函數，確保 `animal.html` 的內容載入後能夠正常啟用動畫

  function initAnimalAnimation() {
    // 動畫初始化代碼，例如加入 `show` 類別來觸發動畫
    const animalElements = document.querySelectorAll(".animal-animation");
    animalElements.forEach((element) => {
      element.classList.add("show");
    });
  }


  window.addEventListener("scroll", function () {
    const blocks = document.querySelectorAll(
      "#block-1-divider, #block-2-divider"
    );

    blocks.forEach((block) => {
      const rect = block.getBoundingClientRect();
      if (rect.top < window.innerHeight && rect.bottom >= 0) {
        block.classList.add("show");
      } else {
        block.classList.remove("show");
      }
    });
  });

  document.addEventListener("DOMContentLoaded", function () {
    fetch("/lu/nav.html")
      .then((response) => response.text())
      .then((data) => {
        document.getElementById("navbar-container").innerHTML = data;
      })
      .catch((error) => console.log("Error loading nav.html:", error));
  });

  document.addEventListener("DOMContentLoaded", function (event) {
    var dataText = ["Nostimo"];

    function typeWriter(text, i, fnCallback) {
      if (i < text.length) {
        document.querySelector("#logo-text").innerHTML =
          text.substring(0, i + 1) +
          '<span class="typewriter-caret" aria-hidden="true"></span>';
        setTimeout(function () {
          typeWriter(text, i + 1, fnCallback);
        }, 100);
      } else if (typeof fnCallback == "function") {
        setTimeout(fnCallback, 400);
      }
    }

    function StartTextAnimation(i) {
      if (i < dataText.length) {
        typeWriter(dataText[i], 0, function () {
          StartTextAnimation(i + 1);
        });
      }
      // 移除或注釋掉以下這段代碼，以防止重複循環
      /*
      else {
          setTimeout(function() {
              StartTextAnimation(0);
          }, 20000);
      }
      */
    }

    // StartTextAnimation(0); // 初始化動畫
  });

  function pageLoad() {
    // location.reload()
    const blocks = document.querySelectorAll("section");
    const title = document.querySelector(".title");
    let lastScrollTop = 0;
    let titleTimeout;

    window.addEventListener("scroll", function () {
      const scrollTop = window.scrollY;
      const windowHeight = window.innerHeight;

      blocks.forEach((block, index) => {
        const blockRect = block.getBoundingClientRect();
        const divider = document.querySelector(`#block-${index + 1}-divider`);

        if (blockRect.top <= windowHeight && blockRect.bottom >= 0) {
          block.classList.add("show");
          if (divider) {
            divider.classList.add("show");
          }
        } else {
          block.classList.remove("show");
          if (divider) {
            divider.classList.remove("show");
          }
        }
      });

      const triggerPosition = windowHeight / 2;

      if (scrollTop > lastScrollTop) {
        title.classList.add("hidden");
        blocks.forEach(
          (block) => (block.style.transform = "translateY(-20px)")
        );
      } else if (scrollTop < lastScrollTop) {
        clearTimeout(titleTimeout);
        titleTimeout = setTimeout(() => {
          if (scrollTop < triggerPosition) {
            title.classList.remove("hidden");
            blocks.forEach(
              (block) => (block.style.transform = "translateY(0)")
            );
          }
        }, 100);
      }
      lastScrollTop = scrollTop;
    });
  }
  window.onbeforeunload = function () {
    window.scrollTo(0, 0);
  };
  window.onload = pageLoad;
</script>
