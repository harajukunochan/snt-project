<form class="edit_form" method="post">
   <button id="edit" form="no">✏️</button>
   <fieldset disabled>
      <legend>
         Пользователь: <?= $login ?>
      </legend>

      <ul>
         <li>
            <label>
               ФИО:
               <input name="fullname" placeholder="Фамилия Имя Отчество" type="text" value="<?= $fullname ?>" required>
            </label>
         </li>

         <li>
            <label>
               E-mail:
               <input name="email" placeholder="Электронная почта" type="text" value="<?= $email ?>" required>
            </label>
         </li>

         <li>
            <label>
               Номер телефона:
               <input name="phone_number" placeholder="Номер телефона" type="text" value="<?= $phone_number ?>" required>
            </label>
         </li>

         <li>
            <label>
               Адрес
               <input name="address" placeholder="Адрес" type="text" value="<?= $address ?>" required>
            </label>
         </li>

         <li class="hidden_disabled">
            <label>
               Логин:
               <input name="login" placeholder="Новый логин" type="text" value="<?= $login ?>" required>
            </label>
         </li>

         <li class="hidden_disabled">
            <label>
               Пароль:
               <input name="password" placeholder="Новый пароль" type="text">
            </label>
         </li>
      </ul>


      <div class="buttons hidden_disabled">
         <input class="delete" form="delete_form" type="submit" name="submit" value="Удалить">
         <input class="save" type="submit" name="submit" value="Сохранить">
      </div>

      <input type="hidden" name="action" value="edit" required>
      <input type="hidden" name="id" value="<?= $id ?>" required>

   </fieldset>
</form>

<form method="post" id="delete_form" class="hidden">
   <input type="hidden" name="action" value="delete" required>
   <input type="hidden" name="delete_id" value="<?= $id ?>" required>
</form>

<section class="lands">
   <h4>Участки</h4>
   <ul>
      <?php if ($lands && $lands->num_rows > 0) : ?>

         <?php foreach ($lands as $land) : ?>

            <li class="land_li">
               <fieldset class="land">
                  <legend>
                     <a href="/land/<?= $land['id'] ?>"><?= $land['id'] ?></a>
                  </legend>
                  <p>
                     <?php if ($land['payed'] == 0) : ?>
                        <span class="warning">
                           ⚠
                        </span>
                     <?php endif; ?>
                     📌 <?= $land['address'] ?>
                  </p>
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
               </fieldset>
            </li>

         <?php endforeach; ?>

      <?php else : ?>

         <li>
            Нет участков.
         </li>

      <?php endif; ?>
   </ul>
</section>

<section class="bills">
   <h4>Неоплаченные счета</h4>
   <ul>
      <?php if ($bills && $bills->num_rows > 0) : ?>

         <?php foreach ($bills as $bill) : ?>

            <li class="bill_li">
               <fieldset class="bill">
                  <legend>
                     <?= $bill['created_at'] ?>
                     /
                     <a href="/land/<?= $bill['land'] ?>"><?= $bill['land'] ?></a>
                  </legend>
                  <p>Сумма: <b><?= $bill['sum'] ?> ₽</b></p>
                  <?php if (isset($bill['comment'])) : ?>
                     <p><?= $bill['comment'] ?></p>
                  <?php endif; ?>

                  <form method="post" class="bill_form">
                     <input type="hidden" name="id_bill" value="<?= $bill['id'] ?>">
                     <input type="hidden" name="action" value="pay">

                     <select name="type" id="type">
                        <option value="clearing" selected>Безнал</option>
                        <option value="cash">Нал</option>
                     </select>

                     <input class="save btn" type="submit" name="submit" value="✓" />
                  </form>
               </fieldset>
            </li>

         <?php endforeach; ?>

      <?php else : ?>

         <li>
            Все счета оплачены!
         </li>

      <?php endif; ?>
   </ul>
</section>

<section class="more">
   <a href="/user/<?= $id ?>/bills">
      Посмотреть оплаченные счета
   </a>
</section>
