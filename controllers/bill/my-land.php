<?php

$title = "Счета";

only_logged();

$land = $db->get_land($router->params[1]);

$bills = $db->get_payed_bills_for_land($land['id']);
