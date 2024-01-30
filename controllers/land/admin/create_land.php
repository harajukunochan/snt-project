<?php

$title = 'Добавить участок';

only_logged_admin();

$all_users = $db->get_users();

if (!$all_users) {
   add_notification(
      'error',
      'Не удалось загрузить список пользователей'
   );
}

$scripts[] = "edit_form";
$scripts[] = "search_user";

if (isset($_POST['submit'])) {
   [
      'id'           => $id,
      'land_lord'    => $land_lord,
      'address'      => $address,
      'electricity'  => $electricity,
      'water_pipe'   => $water_pipe,
      'gas'          => $gas,
      'area'         => $area,
   ] = $_POST;

   $land_lord     = intval($land_lord);
   $area          = floatval($area);

   $electricity   = isset($electricity) ? 1 : 0;
   $water_pipe    = isset($water_pipe ) ? 1 : 0;
   $gas           = isset($gas        ) ? 1 : 0;

   $result = $db->add_land(
      $id,
      $land_lord,
      $address,
      $electricity,
      $water_pipe,
      $gas,
      $area
   );

   redirect("/land/" . $result["id"]);
}
