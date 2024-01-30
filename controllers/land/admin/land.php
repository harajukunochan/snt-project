<?php

$title = "Участок";

only_logged_admin();

$title = "Участок " . $router->params[1];

$scripts[] = "edit_form";
$scripts[] = "search_user";

if (isset($_POST['submit'])) {

   switch ($_POST['action']) {
      case 'edit':
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

         $result = $db->update_land(
            $id,
            $land_lord,
            $address,
            $electricity,
            $water_pipe,
            $gas,
            $area
         );

         if ($result) {
            redirect("/land/" . $result["id"]);
         } else {
            add_notification(
               'error',
               'Не удалось обновить данные участка ' . $router->params[1] . "!"
            );
         }

         break;

      case 'delete':
         $id = $_POST['id'];

         $result = $db->delete_land($id);

         if ($result) {
            add_notification(
               'success',
               "Участок " . $id . " был удалён."
            );

            redirect("/lands");
         } else {
            add_notification(
               'error',
               "Участок " . $id . " не был удалён!"
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

$all_users = $db->get_users();

$land = $db->get_land($router->params[1]);

if ($land) {
   $landlord = $db->get_user_by_id($land['land_lord']);

   if ($landlord) {
      $land['land_lord'] = $landlord;
   } else {
      add_notification(
         'error',
         "Владелец участка " . $router->params[1] . " не найден в базе данных."
      );
   }

   $bills = $db->get_not_payed_bills_for_land($land['id']);
} else {
   add_notification(
      'error',
      "Участок" . $router->params[1] . " не найден."
   );
}
