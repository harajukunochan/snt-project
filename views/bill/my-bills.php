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
