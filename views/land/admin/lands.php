<h1>Все участки</h1>
<ul>
   <?php if (count($result) > 0) : ?>
      <?php foreach ($result as $land) : ?>
         <li class="land_li">
            <fieldset class="land">
               <legend>
                  <a href="/land/<?= $land['id'] ?>"><?= $land['id'] ?></a>
               </legend>
               <h4>
                  <?php if ($land['payed'] == 0) : ?>
                     <spa class="warning">
                        ⚠
                     </spa>
                  <?php endif; ?>

                  <a href="/land/<?= $land['id'] ?>">
                     📌 <?= $land['address'] ?>
                  </a>

                  <div class="icons">
                     <span>
                        <?= $land['area'] ?> м²
                     </span>

                     <span>
                        <?= $land['electricity'] ? '⚡' : '' ?>
                     </span>
                     <span>
                        <?= $land['water_pipe'] ? '🚰' : '' ?>
                     </span>
                     <span>
                        <?= $land['gas'] ? '♨️' : '' ?>
                     </span>
                  </div>
               </h4>
               <p>
                  Владелец:
                  <a class="small" href="/user/<?= $land['land_lord']['id'] ?>">
                     <?= $land['land_lord']['fullname'] ?>
                  </a>
               </p>
            </fieldset>
         </li>
      <?php endforeach; ?>
   <?php else : ?>
      <li class="centered">
         <h4>Нет участков</h4>
      </li>
   <?php endif; ?>
</ul>

<div class="add_btn_container">
   <a href="land/create" class="add_btn">+</a>
</div>
