<?php

$title = "Страница пользователя";

only_logged_admin();

$scripts[] = "edit_form";

$id = intval($router->params[1]);
$user = $db->get_user_by_id($id);

if (!$user) {
   include("views/page404.php");
   exit();
}

[
   "id"           => $id,
   "login"        => $login,
   "fullname"     => $fullname,
   "email"        => $email,
   "phone_number" => $phone_number,
   "address"      => $address,
] = $user;

$title = $fullname;

$lands = $db->get_lands_by_landlord($id);

// Если была отправлена форма
if (isset($_POST['submit'])) {
   switch ($_POST['action']) {
         // Отправлена форма редактирования пользователя
      case 'edit':
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
               "Данные пользователя \"$fullname\" обновлены."
            );
         } else {
            add_notification(
               'error',
               "Данные пользователя \"$fullname\" не были обновлены!"
            );
         }

         break;

         // Удаление пользователя
      case 'delete':
         $id = $_POST['delete_id'];

         $result = $db->delete_user($id);

         if ($result) {
            add_notification(
               'success',
               "Пользователь \"$fullname\" был удалён."
            );

            redirect("/users");
         } else {
            add_notification(
               'error',
               "Пользователь \"$fullname\" не был удалён!"
            );
         }

         break;

      case 'pay':
         [
            'id_bill' => $id_bill,
            'type' => $type,
         ] = $_POST;

         $id_bill = intval($id_bill);

         $db->set_bill_status($id_bill, $type);

         break;

      default:
         // Ничего не делаем
         break;
   }
}

$bills = $db->get_not_payed_bills_for_user($id);
