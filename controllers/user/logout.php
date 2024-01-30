<?php

$title = "Выход";

session_start();

$_SESSION['login'] = null;
$_SESSION['password'] = null;

redirect("/login");
