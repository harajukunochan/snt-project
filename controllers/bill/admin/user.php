<?php

$title = "Счета";

only_logged_admin();

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

// Если была отправлена форма
if (isset($_POST['submit'])) {
   switch ($_POST['action']) {
      case 'reset':
         [
            'id_bill' => $id_bill,
            'type' => $type,
         ] = $_POST;

         $id_bill = intval($id_bill);

         $db->set_bill_status($id_bill, $type, false);

         break;

      default:
         // Ничего не делаем
         break;
   }
}

$bills = $db->get_payed_bills_for_user($id);
