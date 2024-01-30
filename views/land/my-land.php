<form class="edit_form" method="post">
   <fieldset disabled>
      <legend><?= $land['id'] ?></legend>
      <ul>
         <li>
            <label>
               Кадастровый номер:
               <input type="text" name="id" value="<?= $land['id'] ?>">
            </label>
         </li>
         <li>
            <label>
               <a href="/me<?= $land['land_lord']['id'] ?>">🔗 Владелец: </a>
               <select type="text" name="land_lord" id="search_select">
                  <?php while ($user = $all_users->fetch_assoc()) : ?>
                     <option
                        value="<?= $user['id'] ?>"
                        <?= $user['id'] == $land['land_lord']['id'] ? 'selected' : '' ?>
                     >
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
   </fieldset>
</form>

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
   <a href="/my-land/<?= $land['id'] ?>/bills">
      Посмотреть оплаченные счета
   </a>
</section>
