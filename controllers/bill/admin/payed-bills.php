<?php

$title = "Оплаченные счета";

only_logged_admin();

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

$bills = $db->get_payed_bills();
