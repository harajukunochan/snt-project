<form class="edit_form" method="post">
   <fieldset>
      <legend>
         <h3>Создать счёт</h3>
      </legend>

      <ul>
         <li>
            <label>
               <a href="/land/<?= $land['id'] ?>">🔗 Кадастровый номер</a>:
               <input name="land_id" type="text" value="<?= $land['id'] ?>" required>
            </label>
         </li>

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
