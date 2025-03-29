<?php
session_start();

// 清除所有会话变量
session_unset();

// 销毁会话
session_destroy();
echo "<script>
alert('logout success！');
window.location.href = 'index_1.php';
</script>";
exit;
?>