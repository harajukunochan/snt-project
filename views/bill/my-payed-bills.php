<section class="bills">
   <h4>Оплаченные счета</h4>
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

                  <form method="post" class="bill_form">
                     <select disabled>
                        <option value="clearing" <?= $bill['type_payment'] == 'clearing' ? 'selected' : '' ?>>Безнал</option>
                        <option value="cash" <?= $bill['type_payment'] == 'cash' ? 'selected' : '' ?>>Нал</option>
                     </select>
                  </form>
               </fieldset>
            </li>

         <?php endforeach; ?>

      <?php else : ?>

         <li>
            Нет оплаченных счетов.
         </li>

      <?php endif; ?>
   </ul>
</section>
