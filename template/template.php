<!DOCTYPE html>
<html lang="ru">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?= isset($title) ? $title : "SNT" ?></title>
   <link rel="stylesheet" type="text/css" href="/template/style.css">
</head>

<body>
   <header>
      <?php require("template/header.php") ?>
   </header>

   <div class="container">
      <?php $arr_for_class = explode('/', $routed_file); ?>
      <main class="<?= str_replace('.php', '', end($arr_for_class)) ?>">
         <?php if (!empty($notifications)) : ?>
            <ul class="notifications">
               <?php foreach ($notifications as $notification) : ?>

                  <li class="<?= $notification['type'] ?>">
                     •  <?= $notification['message'] ?>
                  </li>

               <?php endforeach; ?>
            </ul>
         <?php endif; ?>

         <?php require("views/" . $routed_file) ?>
      </main>
   </div>

   <?php foreach ($scripts as $script) : ?>
      <script src="/scripts/<?= $script ?>.js"></script>
   <?php endforeach; ?>
</body>

</html>
