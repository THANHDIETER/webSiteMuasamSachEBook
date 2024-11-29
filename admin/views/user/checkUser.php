<?php 
if (!isset($_SESSION['name']) || $_SESSION['is_admin'] == 0) {
    header('Location: ' . BASE_URL . '?act=login');
    exit();
}