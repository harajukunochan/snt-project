<?php

$title = "Создание пользователя";

only_logged_admin();

if (isset($_POST['submit'])) {

   [
      'fullname'     => $fullname,
      'email'        => $email,
      'phone_number' => $phone_number,
      'address'      => $address,
      'login'        => $login,
      'password'     => $password,
      'pd'           => $pd,
   ] = $_POST;

   if (isset($pd) && $pd == 'on') {
      $result = $db->add_user(
         $fullname,
         $email,
         $phone_number,
         $address,
         $login,
         $password
      );

      redirect('/user/' . $result["id"]);
   } else {
      add_notification(
         'warning',
         'Согласитесь на обработку персональных данных!'
      );
   }
}
