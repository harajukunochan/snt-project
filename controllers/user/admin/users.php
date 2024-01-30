<?php

$title = "Список пользователей";

only_logged_admin();

$scripts[] = "users";

$result = $db->get_users();
