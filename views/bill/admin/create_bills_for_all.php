<form class="edit_form" method="post">
   <fieldset>
      <legend>
         <h5>Создать счёт для всех</h5>
      </legend>

      <ul>
         <li>
            <label>
               Сумма (₽):
               <input name="sum" type="number" required>
            </label>
         </li>

         <li>
            <label>
               Сообщение:
               <textarea name="comment" placeholder="Комментарий" required></textarea>
            </label>
         </li>

      <input class="btn save mt-1" type="submit" name="submit" value="Создать">
   </fieldset>
</form>
