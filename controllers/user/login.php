<?php

$title = "Вход";

if (isset($_POST['submit'])) {
   $login = $_POST['login'];
   $password = $_POST['password'];

   $result = $db->login($login, $password);

   if ($result) {
      session_start();
      $_SESSION['login'] = $login;
      $_SESSION['password'] = $password;

      redirect("/");
   } else {
      add_notification(
         'warning',
         'Неправильное имя пользователя или пароль.'
      );
   }
}
