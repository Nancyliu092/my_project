document.addEventListener('DOMContentLoaded', function(event) {
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
});
