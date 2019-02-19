<?php
require_once './api/ServicesConnection.php';
?> 

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Connect</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/contrast.css" />
    <script src="main.js"></script>
</head>
<body class="lighter theme-contrast ">
<div class="content-plus">
    <h1 class="text-plus">User <span class="span-plus"><?php echo $_SESSION['user_mail'] ?></span> is connect.</h1>
    <a class="disconnect-plus" class="btn-default" href="api/ServicesConnection.php?deco=1">Disconnect</a>
</div>    
</body>
</html>