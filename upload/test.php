<!DOCTYPE html>
<html>
<body>

<h1>check http https</h1>

<?php
$http_type = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http';
echo $http_type;
?>

</body>
</html>
