<section>
   <h3>Неоплаченные счета</h3>
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
                  <p>
                     Владелец:
                     <a href="/user/<?= $bill['land_lord'] ?>">
                        <?= $bill['fullname'] ?>
                     </a>
                  </p>
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
