<?php
$mod = isset($_REQUEST['mod']) ? $_REQUEST['mod'] : 'beranda';
switch ($mod) {
    case 'home':
        require('home.php');
        break;
    case 'change':
        require('ubah.php');
        break;
    case 'add':
        require('tambah.php');
        break;
    default:
        require('home.php');
}
?>