<?php
$controllerData = include_once '../app/controllers/homeController.php';

$isLoggedIn = $controllerData['isLoggedIn'];
$page = $controllerData['page'];
$currentDateTime = $controllerData['currentDateTime'];
$getPageTitle = $controllerData['getPageTitle'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $getPageTitle($page); ?> - Dashboard</title>
    <link rel="stylesheet" href="css/site.css">
</head>

<body>

    <?php if ($isLoggedIn): ?>
    <div class="sidebar">
        <h1>Dashboard</h1>
        <a href="?page=home">Home</a>
        <a href="?page=submissions">Submissions</a>
        <a href="?page=ppaManagement">Manage PPAs</a>
        <a href="?page=archives">Archives</a>
        <a href="?page=comms">Communications</a>
        <a href="?page=account">Account</a>
        <a href="?page=logout">Logout</a>
    </div>
    <div class="main-content">
        <div class="topbar">
            <div class="page-title"><?php echo $getPageTitle($page); ?></div>
            <div class="date-time"><?php echo $currentDateTime; ?></div>
        </div>

        <div class="content-area">
            <?php
                $filePath = '../app/views/' . $page . '.php';
                if (file_exists($filePath)) {
                    include($filePath);
                } else {
                    echo '<p>Sorry, the page you are looking for does not exist.</p>';
                }
                ?>
        </div>
    </div>
    <?php else: ?>
    <?php
        $filePath = '../app/views/' . $page . '.php';
        if (file_exists($filePath)) {
            include($filePath);
        } else {
            echo '<p>Sorry, the page you are looking for does not exist.</p>';
        }
        ?>
    <?php endif; ?>

</body>

</html>