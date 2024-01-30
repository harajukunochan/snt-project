<?php

/**
 * Sitemap
 */
$sitemap = [

   // Ошибки

   '_404'           => 'page404.php',

   // Главная

   '/'              => 'panel.php',

   // Пользователи

   '/login'         => 'user/login.php',
   '/logout'        => 'user/logout.php',

   '/me'            => 'user/me.php',

   '/users'                => 'user/admin/users.php',
   '/user/([0-9]+)/bills'  => 'bill/admin/user.php',
   '/user/([0-9]+)'        => 'user/admin/user.php',
   '/user/create'          => 'user/admin/create_user.php',

   // Земли

   '/my-lands'                    => 'land/my-lands.php',
   '/my-land/([-A-Za-z0-9]+)/bills'  => 'bill/my-land.php',
   '/my-land/([-A-Za-z0-9]+)'     => 'land/my-land.php',

   '/lands'                            => 'land/admin/lands.php',
   '/land/create'                      => 'land/admin/create_land.php',
   '/land/([-A-Za-z0-9]+)/bills'       => 'bill/admin/land.php',
   '/land/([-A-Za-z0-9]+)/create_bill' => 'bill/admin/create_bill.php',
   '/land/([-A-Za-z0-9]+)'             => 'land/admin/land.php',

   // Счета

   '/my-bills'             => 'bill/my-bills.php',
   '/my-payed-bills'       => 'bill/my-payed-bills.php',

   '/bills'                => 'bill/admin/bills.php',
   '/payed-bills'          => 'bill/admin/payed-bills.php',

   '/create-bills-for-all' => 'bill/admin/create_bills_for_all.php',
];
