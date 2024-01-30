<form class="edit_form" method="post">
   <button id="edit" form="no">✏️</button>
   <fieldset disabled>
      <legend><?= $land['id'] ?></legend>
      <ul>
         <li>
            <label>
               Кадастровый номер:
               <input type="text" name="id" value="<?= $land['id'] ?>">
            </label>
         </li>
         <li class="hidden_disabled">
            <label>
               Поиск владельца:
               <input type="text" placeholder="ФИО или логин" id="search">
            </label>
         </li>
         <li>
            <label>
               <a href="/user/<?= $land['land_lord']['id'] ?>">🔗 Владелец: </a>
               <select type="text" name="land_lord" id="search_select">
                  <?php while ($user = $all_users->fetch_assoc()) : ?>
                     <option value="<?= $user['id'] ?>" <?= $user['id'] == $land['land_lord']['id'] ? 'selected' : '' ?>>
                        <?= $user['fullname'] ?> [ <?= $user['login'] ?> ]
                     </option>
                  <?php endwhile; ?>
               </select>
            </label>
         </li>
         <li>
            <label>
               Адрес:
               <input type="text" name="address" value="<?= $land['address'] ?>">
            </label>
         </li>
         <li>
            <label>
               Площадь:
               <input type="number" name="area" value="<?= $land['area'] ?>">
            </label>
         </li>
      </ul>
      <ul class="checkboxes_list">
         <li>
            <label>
               <input type="checkbox" name="electricity" <?= $land['electricity'] == 1 ? 'checked' : '' ?>>
               ⚡ Электричество
            </label>
         </li>
         <li>
            <label>
               <input type="checkbox" name="water_pipe" <?= $land['water_pipe'] == 1 ? 'checked' : '' ?>>
               🚰 Водопровод
            </label>
         </li>
         <li>
            <label>
               <input type="checkbox" name="gas" <?= $land['gas'] == 1 ? 'checked' : '' ?>>
               ♨️ Газ
            </label>
         </li>
      </ul>

      <div class="buttons hidden_disabled">
         <input class="delete" form="delete_form" type="submit" name="submit" value="Удалить">
         <input class="save" type="submit" name="submit" value="Сохранить">
      </div>

      <input type="hidden" name="action" value="edit" required>
   </fieldset>
</form>

<form method="post" id="delete_form" class="hidden">
   <input type="hidden" name="action" value="delete" required>
   <input type="hidden" name="delete_id" value="<?= $land['id'] ?>" required>
</form>

<a href="/land/<?= $land['id'] ?>/create_bill">
   Создать счёт на оплату
</a>

<section class="bills">
   <h4>Неоплаченные счета</h4>
   <ul>
      <?php if ($bills && $bills->num_rows > 0) : ?>

         <?php foreach ($bills as $bill) : ?>

            <li class="bill_li">
               <fieldset class="bill">
                  <legend>
                     <?= $bill['created_at'] ?>
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

                     <input class="save" type="submit" name="submit" value="✓" />
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
   <a href="/land/<?= $land['id'] ?>/bills">
      Посмотреть оплаченные счета
   </a>
</section>
