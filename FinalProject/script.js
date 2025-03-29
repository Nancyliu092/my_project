document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('search-form');
    const searchBtn = document.getElementById('search-btn');
    const searchBar = document.getElementById('search-bar');
    const searchResults = document.getElementById('search-results');
    
    let debounceTimer;

    // 監聽表單提交事件
    searchForm.addEventListener('submit', function(e) {
        e.preventDefault(); // 防止表單默認提交
        performSearch(1); // 默認搜尋第1頁
    });

    // 監聽輸入事件，實現即時搜尋
    searchBar.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            performSearch(1); // 每次輸入後重置為第1頁
        }, 300); // 延遲 300 毫秒後執行搜尋
    });

    // 監聽 Checkbox 狀態變化
    searchBtn.addEventListener('change', function() {
        if (searchBtn.checked) {
            performSearch(1); // 按下按鈕時，執行搜尋（列出所有物件）
            searchResults.classList.add('show'); // 顯示搜尋結果
        } else {
            searchBar.value = '';
            searchResults.innerHTML = '';
            searchResults.classList.remove('show'); // 隱藏搜尋結果
        }
    });

    // 搜尋功能
    function performSearch(page) {
        const query = searchBar.value.trim();

        // 發送 AJAX 請求
        fetch(`search.php?q=${encodeURIComponent(query)}&page=${page}`)
            .then(response => response.text())
            .then(data => {
                searchResults.innerHTML = data;
                searchResults.classList.add('show'); // 確保顯示搜尋結果
                addPaginationListeners(); // 添加新的分頁事件監聽器
            })
            .catch(error => {
                console.error('錯誤:', error);
                searchResults.innerHTML = "<p>搜尋時發生錯誤。</p>";
                searchResults.classList.add('show'); // 顯示錯誤訊息
            });
    }

    // 為分頁連結添加事件監聽器
    function addPaginationListeners() {
        const paginationLinks = document.querySelectorAll('.pagination a');
        paginationLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const page = this.getAttribute('data-page');
                const query = searchBar.value.trim();
                
                performSearch(page);
            });
        });
    }
});
