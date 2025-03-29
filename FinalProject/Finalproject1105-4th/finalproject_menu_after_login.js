function pageLoad() {
    const blocks = document.querySelectorAll('section');
    const title = document.querySelector('.title');
    let lastScrollTop = 0;
    let titleTimeout;

    window.addEventListener('scroll', function() {
        const scrollTop = window.scrollY;
        const windowHeight = window.innerHeight;

        blocks.forEach((block, index) => {
            const blockRect = block.getBoundingClientRect();
            const divider = document.querySelector(`#block-${index + 1}-divider`);

            if (blockRect.top <= windowHeight && blockRect.bottom >= 0) {
                block.classList.add('show');
                if (divider) {
                    divider.classList.add('show');
                }
            } else {
                block.classList.remove('show');
                if (divider) {
                    divider.classList.remove('show');
                }
            }
        });

        const triggerPosition = windowHeight / 2;

        if (scrollTop > lastScrollTop) {
            title.classList.add('hidden');
            blocks.forEach(block => block.style.transform = 'translateY(-20px)');
        }
        else if (scrollTop < lastScrollTop) {
            clearTimeout(titleTimeout);
            titleTimeout = setTimeout(() => {
                if (scrollTop < triggerPosition) {
                    title.classList.remove('hidden');
                    blocks.forEach(block => block.style.transform = 'translateY(0)');
                }
            }, 100);
        }
        lastScrollTop = scrollTop;
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
    fetch(`search(2)_menu_after_login.php?q=${encodeURIComponent(query)}&page=${page}`)
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
        !$(e.target).closest('#search-content').length&& 
        !$(e.target).closest('#search-btn-modal').length) {
        
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
}
// 確保頁面加載後執行
document.addEventListener('DOMContentLoaded', pageLoad);
