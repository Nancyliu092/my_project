
document.addEventListener("DOMContentLoaded", function() {
  // 確保 jQuery 已經加載
  if (typeof $ === 'undefined') {
      console.error('jQuery 未加載。請確保已經引入 jQuery。');
      return;
  }

  /* ============================
     1. Header 動畫與初始化
  ============================ */
  
  // 直接打開 header，觸發動畫
  $("header").addClass("open");

  // 確保頁面加載時滾動位置在頂部
  window.onbeforeunload = function () {
      window.scrollTo(0, 0);
  };

  /* ============================
     2. Typewriter 動畫
  ============================ */
  
  var dataText = ["Nostimo"];
  
  function typeWriter(text, i, fnCallback) {
      if (i < text.length) {
          document.querySelector("#logo-text").innerHTML = text.substring(0, i + 1) + '<span class="typewriter-caret" aria-hidden="true"></span>';
          setTimeout(function() {
              typeWriter(text, i + 1, fnCallback);
          }, 100); 
      } else if (typeof fnCallback == 'function') {
          setTimeout(fnCallback, 400);
      }
  }
  
  function StartTextAnimation(i) {
      if (i < dataText.length) {
          typeWriter(dataText[i], 0, function() {
              StartTextAnimation(i + 1);
          });
      }
  }
  
  StartTextAnimation(0); // 初始化動畫

  /* ============================
     3. Swiper 初始化
  ============================ */
  
  var topSwiper = new Swiper(".swiper", {
      effect: "cube",
      grabCursor: true,
      loop: true,
      speed: 1000,
      cubeEffect: {
          shadow: false,
          slideShadows: true,
          shadowOffset: 10,
          shadowScale: 0.94,
      },
      autoplay: {
          delay: 2600,
          pauseOnMouseEnter: true,
      },
      touchRatio: 1.2, // 調整靈敏度
      allowTouchMove: true,
  });
  
  setTimeout(function() {
      $(".swiper").css("display", "block").animate({ opacity: 1 }, 500);
  }, 500);

  /* ============================
     4. 導航菜單切換功能
  ============================ */
  
  function toggleNav() {
      if ($("nav").is(":visible")) {
          $("nav").fadeOut();
          $("button").removeClass("menu");
          $(".learn-more").show(); 
          $(".swiper").show(); 
          topSwiper.update(); // 更新 Swiper
          topSwiper.autoplay.start();
      } else {
          $("button").addClass("menu");
          $("nav").fadeIn().css('display', 'flex');
          $(".learn-more").hide(); 
          $(".swiper").hide(); 
          topSwiper.autoplay.stop();
      }
  }

  // 當點擊導航菜單項目時，滾動到相應部分並切換菜單
  $("nav li").off('click').on('click', function() { // 移除之前的監聽器以避免重複
      var index = $(this).index();
      var target = $("content section").eq(index);
  
      toggleNav();
  
      // 暫停自動播放
      topSwiper.autoplay.stop();
  
      $('html,body').delay(300).animate({
          scrollTop: target.offset().top
      }, 500, function() {
          // 在滾動完成後恢復自動播放
          topSwiper.autoplay.start();
      });
  });

  /* ============================
     5. Owl Carousel 初始化與事件
  ============================ */
  
  $(".custom-carousel").owlCarousel({
      autoWidth: true,
      loop: true
  });

  // 當點擊 carousel 項目時，切換 active 類
  $(".custom-carousel .item").off('click').on('click', function () { // 移除之前的監聽器
      $(".custom-carousel .item").not($(this)).removeClass("active");
      $(this).toggleClass("active");
  });

  /* ============================
     6. 其他 Header 動畫
  ============================ */
  
  setTimeout(function() {
      $("header").addClass("open");
  }, 2000);


  /* ============================
     7. Swiper 事件處理
  ============================ */
  
  topSwiper.on('slideChangeTransitionEnd', function () {
      topSwiper.allowSlideNext = true;
      topSwiper.allowSlidePrev = true;
      topSwiper.allowTouchMove = true; // 重新啟用拖曳
  });

  // 當用戶開始手動拖曳時，暫停自動播放
  topSwiper.on('touchStart', function () {
      topSwiper.autoplay.stop();
  });

  // 當手動拖曳結束後，自動播放重啟
  topSwiper.on('touchEnd', function () {
      topSwiper.autoplay.start();
  });

  /* ============================
     8. 測試區塊懸停效果
  ============================ */
  
  const testimonialItems = document.querySelectorAll('.eachdiv');

  testimonialItems.forEach(item => {
      // 滑鼠懸停時放大區塊
      item.addEventListener('mouseover', () => {
          item.style.transform = 'scale(1.05)';
          item.style.transition = 'transform 0.3s ease';
      });

      // 滑鼠離開時恢復原樣
      item.addEventListener('mouseleave', () => {
          item.style.transform = 'scale(1)';
      });
  });

  /* ============================
     9. tsParticles 初始化
  ============================ */
  
  tsParticles.load("tsparticles", {
      fpsLimit: 60,
      backgroundMode: {
          enable: true,
          zIndex: -1,
      },
      particles: {
          number: {
              value: 30,
              density: {
                  enable: true,
                  area: 800,
              },
          },
          color: {
              value: [
                  "#3998D0", "#2EB6AF", "#A9BD33", "#FEC73B",
                  "#F89930", "#F45623", "#D62E32"
              ],
          },
          destroy: {
              mode: "split",
              split: {
                  count: 1,
                  factor: {
                      value: 5,
                      random: {
                          enable: true,
                          minimumValue: 4,
                      },
                  },
                  rate: {
                      value: 10,
                      random: {
                          enable: true,
                          minimumValue: 5,
                      },
                  },
                  particles: {
                      collisions: {
                          enable: false,
                      },
                      destroy: {
                          mode: "none",
                      },
                      life: {
                          count: 1,
                          duration: {
                              value: 1,
                          },
                      },
                  },
              },
          },

          shape: {
              type: "circle",
              stroke: {
                  width: 0,
                  color: "#000000",
              },
              polygon: {
                  sides: 5,
              },
          },
          opacity: {
              value: 1,
              random: false,
              animation: {
                  enable: false,
                  speed: 1,
                  minimumValue: 0.1,
                  sync: false,
              },
          },
          size: {
              value: 8,
              random: {
                  enable: true,
                  minimumValue: 4,
              },
              animation: {
                  enable: false,
                  speed: 40,
                  minimumValue: 0.1,
                  sync: false,
              },
          },
          collisions: {
              enable: true,
              mode: "destroy",
          },
          move: {
              enable: true,
              speed: 7,
              direction: "none",
              random: false,
              straight: false,
              out_mode: "out",
              attract: {
                  enable: false,
                  rotateX: 600,
                  rotateY: 1200,
              },
          },
      },
      detectRetina: true,
  });

  /* ============================
     10. 搜尋表單功能
  ============================ */
  
  const searchFormModal = document.getElementById('search-form-modal');
  const searchBarModal = document.getElementById('search-bar-modal');
  const searchBtnModal = document.getElementById('search-btn-modal');
  const searchForm = document.getElementById('search-form');
  const searchBtn = document.getElementById('search-btn');
  const searchBar = document.getElementById('search-bar');
  const searchResults = document.getElementById('search-results');
  const headerSearchButton = document.getElementById('header-search-button');
  
  let debounceTimer;
  
  function performSearch(page, query) {
    // 發送 AJAX 請求
    fetch(`search.php?q=${encodeURIComponent(query)}&page=${page}`)
        .then(response => response.text())
        .then(data => {
            ensureSearchResults();  // 確保 .search-content 元素存在
            const searchContent = searchResults.querySelector('.search-content');
            if (searchContent) {
                searchContent.innerHTML = data;  // 設置搜尋結果
                searchResults.classList.add('show');
                addPaginationListeners();  // 添加分頁監聽器
            } else {
                console.error('.search-content 元素不存在');
            }
        })
        .catch(error => {
            console.error('錯誤:', error);
            if (searchResults.querySelector('.search-content')) {
                searchResults.querySelector('.search-content').innerHTML = "<p>搜尋時發生錯誤。</p>";
            }
            searchResults.classList.add('show');
        });
}

  
  // 為表單和搜尋欄添加事件監聽器
  function setupSearchEventListeners() {

      // 為模態搜尋表單添加事件監聽器
      if (searchFormModal && searchBarModal) {
          searchFormModal.addEventListener('submit', function(e) {
              e.preventDefault(); // 防止表單默認提交
              const query = searchBarModal.value.trim();
              performSearch(1, query); // 默認搜尋第1頁
          });
  
          // 監聽輸入事件，實現即時搜尋
          searchBarModal.addEventListener('input', function() {
              clearTimeout(debounceTimer);
              debounceTimer = setTimeout(() => {
                  const query = searchBarModal.value.trim();
                  performSearch(1, query); // 每次輸入後重置為第1頁
              }, 300); // 延遲 300 毫秒後執行搜尋
          });
      }
  
      // 監聽表單提交事件
      searchForm.addEventListener('submit', function(e) {
          e.preventDefault(); // 防止表單默認提交
          const query = searchBar.value.trim();
          performSearch(1, query); // 默認搜尋第1頁
      });
  
      // 監聽輸入事件，實現即時搜尋
      searchBar.addEventListener('input', function() {
          clearTimeout(debounceTimer);
          debounceTimer = setTimeout(() => {
              const query = searchBar.value.trim();
              performSearch(1, query); // 每次輸入後重置為第1頁
          }, 300); // 延遲 300 毫秒後執行搜尋
      });
  }
  
  // 監聽 Checkbox 狀態變化
  function setupCheckboxListeners() {
    searchBtnModal.addEventListener('change', function() {
        if (searchBtnModal.checked) {
            ensureSearchResults();
            performSearch(1, searchBarModal.value.trim());
            searchResults.classList.add('show');
            searchBtn.checked = false;
        } else {
            resetSearchState('searchBtnModal');
        }
    });

    searchBtn.addEventListener('change', function() {
        if (searchBtn.checked) {
            ensureSearchResults();
            performSearch(1, searchBar.value.trim());
            searchResults.classList.add('show');
            searchBtnModal.checked = false;
        } else {
            resetSearchState('searchBtn');
        }
    });
}
  
  // 確保搜尋結果區域存在
  function ensureSearchResults() {
      if (!searchResults.querySelector('.search-content')) {
          const contentDiv = document.createElement('div');
          contentDiv.classList.add('search-content');
          searchResults.appendChild(contentDiv);
      }
  }
  
  function resetSearchState(preserveBtn = null) {
    searchBarModal.value = '';
    searchResults.innerHTML = '';
    searchResults.classList.remove('show');
    
    if (preserveBtn !== 'searchBtn') {
        searchBtn.checked = false;
    }
    if (preserveBtn !== 'searchBtnModal') {
        searchBtnModal.checked = false;
    }
}
  // 為分頁連結添加事件監聽器
  function addPaginationListeners() {
      const paginationLinks = searchResults.querySelectorAll('.pagination a');
      paginationLinks.forEach(link => {
          link.addEventListener('click', function(e) {
              e.preventDefault();
              const page = this.getAttribute('data-page');
              const query = searchBar.value.trim();
              performSearch(page, query); // 更新分頁
          });
      });
  }
  
  
  if (headerSearchButton) {
    headerSearchButton.addEventListener('click', function() {
        // 如果當前是關閉狀態，則打開
        if (!searchBtnModal.checked) {
            searchBtnModal.checked = true;
            searchFormModal.classList.add('show');
            searchBarModal.focus();

            // 確保另一個搜尋按鈕是關閉的
            searchBtn.checked = false;

            // 執行搜尋（如果有需要）
            ensureSearchResults();
            performSearch(1, searchBarModal.value.trim());
            searchResults.classList.add('show');
        } else {
            // 如果已經是打開狀態，則關閉
            searchBtnModal.checked = false;
            searchFormModal.classList.remove('show');
            searchResults.classList.remove('show');
        }
    });
}


  //監聽 visibilitychange 事件
  document.addEventListener('visibilitychange', function() {
      if (document.visibilityState === 'visible') {
          if (searchBtnModal.checked) {
              searchResults.classList.add('show');
              ensureSearchResults();
              performSearch(1, searchBarModal.value.trim()); // 重新執行搜尋
          }
      }
  });
  
  
  // 點擊背景遮罩時隱藏搜尋結果
  $('#search-results').on('click', function(e) {
    if ($(e.target).is('#search-results')) {
        $('#search-results').removeClass('show');
        $('#search-btn').prop('checked', false);
        $('#search-bar').val('');
        $('#search-results .search-content').empty();
    }
});

// 點擊背景遮罩或其他非 #search-bar-modal 和 #search-content 的地方時隱藏搜尋結果
$('#search-results').on('click', function(e) {
    // 檢查點擊的目標是否不在 #search-bar-modal 和 #search-content 內
    if (!$(e.target).closest('#search-bar-modal').length && 
        !$(e.target).closest('#search-content').length
        && !$(e.target).closest('#search-btn-modal').length) {
        
        // 隱藏搜尋結果並重置相關元素
        $('#search-results').removeClass('show');
        $('#search-btn').prop('checked', false);
        $('#search-bar').val('');
        $('#search-btn-modal').prop('checked', false);
        $('#search-bar-modal').val('');
        $('#search-results .search-content').empty();
    }
});


  
  // 初始化事件監聽器
  setupSearchEventListeners();
  setupCheckboxListeners();
  
});

