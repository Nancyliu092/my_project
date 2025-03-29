<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style1.css">
        <link rel="stylesheet" href="swiper-bundle.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

        <link href="https://fonts.googleapis.com/css2?family=Chivo:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
        <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        
        <title>HomePage</title>

 <header>

  <div class="triangle left"><h1>Welcome!</h1></div>
  <div class="triangle right"><h1>Welcome!</h1></div>
  <button id="header-search-button" aria-label="開啟搜尋">🔍</button>
</header>

<body>

  <div class="nav1">
    <ul class='nav-bar'>
        <!-- LOGO -->
        <li id='logo'>
            <img src='lu/foodlogo.png' alt="Logo"/>
            <a href='' id="logo-text">Nostimo</a>
        </li>

        <!-- 菜單切換按鈕 (響應式) -->
        <input type='checkbox' id='check'>

        <div class="menu" id="main-menu">
            <!-- 搜尋表單開始 -->
        <li>
          <form id="search-form" action="search.php" method="GET">
            <input id="search-btn" type="checkbox" name="search-toggle"/>
            <label for="search-btn" aria-label="顯示搜尋欄">🔍</label>
            <input id="search-bar" type="text" name="q" placeholder="Search for a Brunch..." required/>
          </form>
        </li>
        <!-- 搜尋表單結束 -->
   
            <!-- 菜單項目 -->
            <li><a href="">HomePage</a></li>
            <li><a href="wen/about.html">About us</a></li>
            <li><a href="Finalproject1105-4th/finalproject.php">Menu</a></li>
            <li><a href="login_process.php">login</a></li>
            
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
  <form id="search-form-modal" class="search-form search-form-mobile" action="search.php" method="GET">
    <input id="search-btn-modal" class="search-btn search-btn-mobile" type="checkbox" name="search-toggle"/>
    <label for="search-btn-modal" aria-label="顯示搜尋欄">🔍</label>
    <input id="search-bar-modal" class="search-bar search-bar-mobile" type="text" name="q" placeholder="Search for a Brunch..." required/>
  </form>

  <div class="search-content" id="search-content">
      
      <!-- 搜尋表單結束 -->

      <!-- 搜尋結果內容將通過 AJAX 加載到這裡 -->
      <div id="top-results" class="search-list">
        <!-- 搜尋結果項目將在此處顯示 -->
    </div>

  </div>
</div>



<nav>
  <ul>
    <li>

    </li>
  </ul>
  <div id="nav-close"><i class="fas fa-times"></i></div>
</nav>

    <div id="tsparticles"></div>
      
    <content>
    <section>
      <div class="content">
        <h1>Let's Savor Delicious Brunch Together!</h1>
        <p>
          "Nostimo" means "delicious" in Greek. Our blog aims to take you deep into the most enticing brunch scenes, creating unforgettable culinary experiences. You can discover hidden gourmet gems, iconic dishes, and the cultural delicacies that make each place unique.
        </p>


        <div id="container" onclick="window.location.href='Finalproject1105-4th/finalproject.php';" style="cursor: pointer;">
          <button class="learn-more">
            <span class="circle" aria-hidden="true">
              <span class="icon arrow"></span>
            </span>
            <span class="button-text">  Explore More </span>
          </button>
        </div>
    </div>


      <div class="swiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <img src="1 (1).png" />
            <div class="overlay">
              <h1>Morning Bliss: Pastry & Drink</h1>
              <p>
              Fresh pastries and cool drinks for a perfect start! Start your day with a perfect blend of freshly baked pastries and iced drinks. 
              </p>
              <div class="ratings">
                <div class="stars">
                  <ion-icon class="star" name="star"></ion-icon>
                  <ion-icon class="star" name="star"></ion-icon>
                  <ion-icon class="star" name="star"></ion-icon>
                  <ion-icon class="star" name="star"></ion-icon>
                  <ion-icon class="star" name="star-half-outline"></ion-icon>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <img src="1 (2).png"/>
            <div class="overlay">
              <h1>Crunchy Burger Delight</h1>
              <p>
              A savory burger paired with crispy potato bites, offering the perfect comfort meal with a side of tangy sauce. Perfect your all day.
              </p>
              <div class="ratings">
                <div class="stars">
                  <ion-icon class="star" name="star"></ion-icon>
                  <ion-icon class="star" name="star"></ion-icon>
                  <ion-icon class="star" name="star"></ion-icon>
                  <ion-icon class="star" name="star"></ion-icon>
                  <ion-icon class="star" name="star"></ion-icon>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <img src="1 (3).png" />
            <div class="overlay">
              <h1>Fresh Berry Granola Bowl</h1>
              <p>
              A vibrant and healthy mix of granola, berries, and bananas served with a slice of buttered bread for a wholesome breakfast.              </p>
              <div class="ratings">
                <div class="stars">
                  <ion-icon class="star" name="star"></ion-icon>
                  <ion-icon class="star" name="star"></ion-icon>
                  <ion-icon class="star" name="star"></ion-icon>
                  <ion-icon class="star" name="star"></ion-icon>
                  <ion-icon class="star" name="star-half-outline"></ion-icon>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <img src="1 (4).png" />
            <div class="overlay">
              <h1>Berry Sweet Dreams</h1>
              <p>
              A light and fluffy soufflé topped with fresh strawberries and a dusting of powdered sugar—perfect for a sweet treat.              </p>
              <div class="ratings">
                <div class="stars">
                  <ion-icon class="star" name="star"></ion-icon>
                  <ion-icon class="star" name="star"></ion-icon>
                  <ion-icon class="star" name="star"></ion-icon>
                  <ion-icon class="star" name="star"></ion-icon>
                  <ion-icon class="star" name="star-outline"></ion-icon>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="fade"></div>
     
    <section class="game-section">
      <h2 class="line-title"><strong>Trending Brunch</strong></h2>
      <div class="owl-carousel custom-carousel owl-theme">
        <!-- Item 1 -->
        <div class="item" style="background-image: url(https://api.harpersbazaar.com.hk/var/site/storage/images/_aliases/img_748_w/lifestyle/dining/taipei-cafe/7/1957934-1-chi-HK/7.jpg);">
          <div class="item-desc">
            <h3>Brunch Haven</h3>
            <p>Brunch Haven offers fresh dishes that make every visit worthwhile. Many students found it mid-semester and feel they get every penny's worth.</p>
          </div>
        </div>
    
        <!-- Item 2 -->
        <div class="item" style="background-image: url(https://api.harpersbazaar.com.hk/var/site/storage/images/_aliases/img_748_w/lifestyle/dining/taipei-cafe/2-drunk-cafe2/1333271-1-chi-HK/2-Drunk-Cafe.jpg);">
          <div class="item-desc">
            <h3>The Morning </h3>
            <p>The Morning is known for its incredibly friendly staff who make everyone feel welcome. It's a perfect spot for students new to the area.</p>
          </div>
        </div>
    
        <!-- Item 3 -->
        <div class="item" style="background-image: url(https://api.harpersbazaar.com.hk/var/site/storage/images/_aliases/img_748_w/lifestyle/dining/taipei-cafe/3-mkcr/1333347-1-chi-HK/3-MKCR.jpg);">
          <div class="item-desc">
            <h3>Sunrise Bistro</h3>
            <p>Sunrise Bistro offers an unforgettable brunch experience. Highly recommended for its attentive staff and outstanding signature dishes.</p>
          </div>
        </div>
    
        <!-- Item 4 -->
        <div class="item" style="background-image: url(https://api.harpersbazaar.com.hk/var/site/storage/images/_aliases/img_748_w/lifestyle/dining/taipei-cafe/5-meat-up2/1333570-1-chi-HK/5-Meat-Up.jpg);">
          <div class="item-desc">
            <h3>Brunch Oasis</h3>
            <p>Brunch Oasis provides a wonderful and rewarding dining experience. Customers love the enjoyable atmosphere and delicious meals.</p>
          </div>
        </div>
    
        <!-- Item 5 -->
        <div class="item" style="background-image: url(https://dynamic-media-cdn.tripadvisor.com/media/photo-o/15/8e/c9/53/photo3jpg.jpg?w=600&h=400&s=1);">
          <div class="item-desc">
            <h3>Sunshine Café</h3>
            <p>Sunshine Café offers awesome service from staff who know their menu inside out. Getting recommendations from them is a breeze.</p>
          </div>
        </div>
    
        <!-- Item 6 -->
        <div class="item" style="background-image: url(https://assets.everydayobject.us/wp-content/uploads/2020/04/taiwan_cafe.jpg);">
          <div class="item-desc">
            <h3>Delight</h3>
            <p>Delight is an overall wonderful brunch spot. Highly recommended for its cozy environment and delectable dishes.</p>
          </div>
        </div>
      </div>
    </section>
    
    <div class="fade"></div>

    <section class="review_part">
      <h2 class="line-title"><strong>Foodie Reviews</strong></h2>
      <div class="innerdiv">
          <!-- div1 -->
          <div class="div1 eachdiv">
              <div class="userdetails">
                  <div class="imgbox">
                      <img src="https://raw.githubusercontent.com/RahulSahOfficial/testimonials_grid_section/5532c958b7d3c9b910a216b198fdd21c73112d84/images/image-daniel.jpg" alt="">
                  </div>
                  <div class="detbox">
                      <p class="name">Daniel Clifford</p>
                      <p class="designation">University Student</p>
                  </div>
              </div>
              <div class="review">
                  <h4>Delicious Avocado Smash with Poached Eggs</h4>
                  <p>“The Avocado Smash at Brunch Haven is a delight. Creamy avocados are perfectly mashed and seasoned, topped with gently poached eggs and a sprinkle of feta cheese. Each bite combines rich textures and fresh flavors, making it a standout brunch dish.”</p>
              </div>
          </div>

          <!-- div2 -->
          <div class="div2 eachdiv">
              <div class="userdetails">
                  <div class="imgbox">
                      <img src="https://raw.githubusercontent.com/RahulSahOfficial/testimonials_grid_section/5532c958b7d3c9b910a216b198fdd21c73112d84/images/image-jonathan.jpg" alt="">
                  </div>
                  <div class="detbox">
                      <p class="name">Jonathan Walters</p>
                      <p class="designation">University Student</p>
                  </div>
              </div>
              <div class="review">
                  <h4>Hearty Shakshuka with Fresh Herbs</h4>
                  <p>“Brunch Haven’s Shakshuka is bursting with flavor. The rich tomato sauce is infused with aromatic spices and topped with perfectly cooked eggs. Garnished with fresh herbs and served with warm, crusty bread, it’s a satisfying meal.”</p>
              </div>
          </div>

          <!-- div3 -->
          <div class="div3 eachdiv">
              <div class="userdetails">
                  <div class="imgbox">
                      <img src="https://raw.githubusercontent.com/RahulSahOfficial/testimonials_grid_section/5532c958b7d3c9b910a216b198fdd21c73112d84/images/image-kira.jpg" alt="">
                  </div>
                  <div class="detbox">
                      <p class="name dark">Kira Whittle</p>
                      <p class="designation dark">Brunch Enthusiast</p>
                  </div>
              </div>
              <div class="review dark">
                  <h4>Fluffy Belgian Waffles with Seasonal Fruits</h4>
                  <p>“The Belgian waffles at Brunch Haven are the epitome of brunch perfection. Light and airy on the inside with a crisp exterior, they are generously topped with an assortment of seasonal fruits and a drizzle of pure maple syrup. Every bite is a delightful indulgence.”</p>
              </div>
          </div>

          <!-- div4 -->
          <div class="div4 eachdiv">
              <div class="userdetails">
                  <div class="imgbox">
                      <img src="https://raw.githubusercontent.com/RahulSahOfficial/testimonials_grid_section/5532c958b7d3c9b910a216b198fdd21c73112d84/images/image-jeanette.jpg" alt="">
                  </div>
                  <div class="detbox">
                      <p class="name dark">Jeanette Harmon</p>
                      <p class="designation dark">Student Foodie</p>
                  </div>
              </div>
              <div class="review dark">
                  <h4>Decadent Eggs Benedict with Smoked Salmon</h4>
                  <p>“The Eggs Benedict here is divine. Perfectly poached eggs sit atop smoked salmon and toasted English muffins. The combination of textures and flavors makes it unforgettable.”</p>
              </div>
          </div>

          <!-- div5 -->
          <div class="div5 eachdiv">
              <div class="userdetails">
                  <div class="imgbox">
                      <img src="https://raw.githubusercontent.com/RahulSahOfficial/testimonials_grid_section/5532c958b7d3c9b910a216b198fdd21c73112d84/images/image-patrick.jpg" alt="">
                  </div>
                  <div class="detbox">
                      <p class="name">Patrick Abrams</p>
                      <p class="designation">Graduate Student</p>
                  </div>
              </div>
              <div class="review">
                  <h4>Decadent French Toast with Cinnamon Sugar</h4>
                  <p>“The French toast at Brunch Haven is absolutely decadent. Thick slices of brioche are soaked in a cinnamon-infused batter, grilled to golden perfection, and dusted with a generous amount of cinnamon sugar. Served with a side of fresh berries and a drizzle of maple syrup, it’s a sweet and indulgent start to any day.”</p>
              </div>
          </div>
      </div>
  </section>
  

    


   </content>
   
<!-- Footer -->
<div style="background-color: #FF8C00; color: #ffffff; text-align: center; width: 100%; padding-top: 40px; padding-bottom: 40px;">
  <div class="footer-middle" style="display: flex; justify-content: center; align-items: center; gap: 30px; margin-bottom: 20px; text-align: center; padding-right: 35px;">
      <div class="link">
          <a href="#"><img src="lu/mail.png" alt="Mail" style="width: 30px; margin: 0;"></a>
      </div>
      <div class="contact">
          <a href="#"><img src="lu/phone_0.png" alt="Phone" style="width: 30px; margin: 0;"></a>
      </div>
      <div class="social">
          <a href="#"><img src="lu/facebook.png" alt="Facebook" style="width: 30px; margin: 0 12px;"></a>
          <a href="#"><img src="lu/instagram.png" alt="Instagram" style="width: 30px; margin: 0 12px;"></a>
      </div>
  </div>
  <div class="footer-bottom" style="text-align: center;">
      <p>@ Powered by <a href="https://www.w3schools.com/w3css/default.asp" style="color: #8F4586;">w3.css</a></p>
  </div>
</div>  

  </body>
    <script src="swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@1.37.5/tsparticles.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="javascript1.js"></script>
    <!-- <div id="footer-container"></div> -->
</html>