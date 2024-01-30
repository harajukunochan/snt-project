<?php

$title = 'Мои счета';

only_logged();

$bills = $db->get_payed_bills_for_user($current_user['id']);
