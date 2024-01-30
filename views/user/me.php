<form class="edit_form" method="post">
   <button id="edit" form="no">✏️</button>
   <fieldset disabled>
      <legend>
         <?= $login ?>
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
         <a href="/logout" class="btn delete">Выйти</a>
         <input class="save" type="submit" name="submit" value="Сохранить">
      </div>

      <input type="hidden" name="action" value="edit" required>
      <input type="hidden" name="id" value="<?= $id ?>" required>

   </fieldset>
</form>

<section class="lands">
   <h4>Участки</h4>
   <ul>
      <?php if ($lands && $lands->num_rows > 0) : ?>

         <?php foreach ($lands as $land) : ?>
            <li class="land_li">
               <fieldset class="land">
                  <legend>
                     <a href="/my-land/<?= $land['id'] ?>"><?= $land['id'] ?></a>
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
                     <a href="/my-land/<?= $bill['land'] ?>"><?= $bill['land'] ?></a>
                  </legend>
                  <p>Сумма: <b><?= $bill['sum'] ?> ₽</b></p>
                  <?php if (isset($bill['comment'])) : ?>
                     <p><?= $bill['comment'] ?></p>
                  <?php endif; ?>
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
   <a href="/my-payed-bills">
      Посмотреть оплаченные счета
   </a>
</section>
