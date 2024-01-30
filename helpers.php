<?php

function redirect(string $path) {
   echo "
      <script> window.location = '$path' </script>
   ";
   exit();
}


function get_logged_user()
{
   global $db;

   session_start();

   if (!isset($_SESSION['login']) || !isset($_SESSION['password'])) {
      return false;
   }

   $user = $db->login($_SESSION["login"], $_SESSION["password"]);

   return $user;
}

function only_logged()
{
   global $current_user;

   if (!$current_user) {
      redirect("/login");
   }
}

function only_logged_admin()
{
   global $db;
   global $current_user;

   if ($current_user) {
      $is_admin = $db->is_admin($current_user["id"]);

      if ($is_admin) {
         return;
      }
   }

   redirect("/login");
}

function add_notification(string $type, string $message) {
   global $notifications;
   $notifications[] = [
      "type"    => $type,
      "message" => $message,
   ];
}
