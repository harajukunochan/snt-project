<?php

$title = "Создать счёт для всех";

only_logged_admin();

if (isset($_POST['submit'])) {
   [
      'sum' => $sum,
      'comment' => $comment
   ] = $_POST;

   $sum = floatval($sum);

   $db->add_bill_for_all($sum, $comment);
}
