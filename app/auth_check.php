<?php
session_start();

if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    http_response_code(401);
    exit;
}

http_response_code(200);