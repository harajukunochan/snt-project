<input type='checkbox' name='is_open' id='open_menu' />
<div class="content">
   <div class="mobile_block">
     <h1>
        <label for="open_menu" class="mobile_menu_button"></label>
         <a href="/">
            SNT
         </a>
      </h1>
   </div>
   <nav>
      <a href="/">Панель управления</a>

      <div class="mobile">
         <?php if ($is_admin) : ?>
            <a href='/users'>Данные пользователей</a>
            <a href='/bills'>Счета на оплату</a>
            <a href='/payed-bills'>Оплаченные счета</a>
            <a href='/lands'>Участки</a>
            <a href='/create-bills-for-all'>Создать счёт для всех</a>

            <hr>
         <?php endif; ?>

         <a href='/me'>Мои данные</a>
         <a href='/my-bills'>Счета на оплату</a>
         <a href='/my-payed-bills'>Оплаченные счета</a>
         <a href='/my-lands'>Мои участки</a>
      </div>
   </nav>
</div>
