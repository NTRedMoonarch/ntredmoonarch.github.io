<?php
session_start();

$isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'];

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

if ($page === 'logout') {
    session_destroy();
    header('Location: ?page=login');
    exit;
}

function getPageTitle($page)
{
    $titles = [
        'home' => 'Dashboard',
        'submissions' => 'Submissions',
        'ppaManagement' => 'Manage PPAs',
        'archives' => 'Archives',
        'comms' => 'Communications',
        'account' => 'Account',
        'login' => 'Login',
        'signup' => 'Sign Up'
    ];
    return isset($titles[$page]) ? $titles[$page] : 'Dashboard';
}

if (!$isLoggedIn && $page !== 'login' && $page !== 'signup') {
    header('Location: ?page=login');
    exit;
}

if ($isLoggedIn && ($page === 'login' || $page === 'signup')) {
    header('Location: ?page=home');
    exit;
}


$currentDateTime = date("F j, Y, g:i a");
return [
    'isLoggedIn' => $isLoggedIn,
    'page' => $page,
    'currentDateTime' => $currentDateTime,
    'getPageTitle' => 'getPageTitle',
];
