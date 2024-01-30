<?php

$title = "Создать счёт";

only_logged_admin();

if (isset($_POST['submit'])) {
   [
      'land_id' => $id_land,
      'sum' => $sum,
      'comment' => $comment
   ] = $_POST;

   $sum = floatval($sum);

   $db->add_bill_for_land($id_land, $sum, $comment);
}

$land = $db->get_land($router->params[1]);
