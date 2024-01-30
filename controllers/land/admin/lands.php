<?php

only_logged_admin();

$result = [];

$lands = $db->get_lands();

if ($lands && $lands->num_rows > 0) {
   while ($temp = $lands->fetch_assoc()) {
      $land = [...$temp];

      $landlord = $db->get_user_by_id($land['land_lord']);

      if ($landlord) {
         $land['land_lord'] = $landlord;
      } else {
         add_notification(
            'error',
            "Владелец участка " . $land['id'] . " не найден в базе данных."
         );
      }

      $result[] = $land;
   }
}
