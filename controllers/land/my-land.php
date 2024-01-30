<?php

$title = 'Мой участок';

only_logged();

$all_users = $db->get_users();

$title = "Мой участок: " . $router->params[1];

$land = $db->get_land($router->params[1]);

if (
   $land
   && $land['land_lord'] == $current_user['id']
) {
   $land['land_lord'] = $current_user;

   $bills = $db->get_not_payed_bills_for_land($land['id']);
} else {
   add_notification(
      'error',
      "Участок" . $router->params[1] . " не найден."
   );
}
