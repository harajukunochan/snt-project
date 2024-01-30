<?php

$title = "Мой аккаунт";

only_logged();

$scripts[] = "edit_form";

global $current_user;
$user = $current_user;

[
   "id" => $id,
   "login" => $login,
   "fullname" => $fullname,
   "email" => $email,
   "phone_number" => $phone_number,
   "address" => $address,
] = $user;

$lands = $db->get_lands_by_landlord($id);
$bills = $db->get_not_payed_bills_for_user($id);

if (isset($_POST['submit'])) {
   [
      'id'           => $id,
      'fullname'     => $fullname,
      'email'        => $email,
      'phone_number' => $phone_number,
      'address'      => $address,
      'login'        => $login,
      'password'     => $password,
   ] = $_POST;

   if (empty($password)) {
      $password = $user["password"];
   }

   $result = $db->update_user(
      $id,
      $fullname,
      $email,
      $phone_number,
      $address,
      $login,
      $password
   );

   if (!$result) {
      add_notification(
         'success',
         'Данные обновлены.'
      );
   } else {
      add_notification(
         'error',
         'Данные не были обновлены!'
      );
   }
}
