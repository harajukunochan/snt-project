<h1>Панель управления</h1>

<?php if ($is_admin) : ?>
   <section>

      <h4>Администрирование</h4>

      <ul class="tabs">
         <li>
            <a href='/users'>Данные пользователей</a>
         </li>
         <li>
            <a href='/bills'>Счета на оплату</a>
         </li>
         <li>
            <a href='/payed-bills'>Оплаченные счета</a>
         </li>
         <li>
            <a href='/lands'>Участки</a>
         </li>
         <li>
            <a href='/create-bills-for-all'>Создать счёт для всех</a>
         </li>
      </ul>

   </section>
<?php endif; ?>

<section>

   <h4>Информация</h4>

   <ul class="tabs">
      <li>
         <a href='/me'>Мои данные</a>
      </li>
      <li>
         <a href='/my-bills'>Счета на оплату</a>
      </li>
      <li>
         <a href='/my-payed-bills'>Оплаченные счета</a>
      </li>
      <li>
         <a href='/my-lands'>Мои участки</a>
      </li>
   </ul>

</section>
