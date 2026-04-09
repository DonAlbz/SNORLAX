<?php
require_once 'config.php';
unset($_SESSION['user']);
session_regenerate_id(true);
redirect(url_with_lang('home.php'));