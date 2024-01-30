<?php

$title = 'Мои участки';

only_logged();

$result = [];

$lands = $db->get_lands_by_landlord($current_user['id']);

while ($lands && $temp = $lands->fetch_assoc()) {
   $result[] = $temp;
}
