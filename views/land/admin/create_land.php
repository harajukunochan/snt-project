<form class="edit_form" method="post">
   <fieldset>
      <legend>
         <h3>Создать участок</h3>
      </legend>
      <ul>
         <li>
            <label>
               Кадастровый номер:
               <input type="text" name="id">
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
               Владелец:
               <select type="text" name="land_lord" id="search_select">
                  <?php while ($user = $all_users->fetch_assoc()) : ?>
                     <option value="<?= $user['id'] ?>">
                        <?= $user['fullname'] ?> [ <?= $user['login'] ?> ]
                     </option>
                  <?php endwhile; ?>
               </select>
            </label>
         </li>
         <li>
            <label>
               Адрес:
               <input type="text" name="address">
            </label>
         </li>
         <li>
            <label>
               Площадь:
               <input type="number" name="area">
            </label>
         </li>
      </ul>
      <ul class="checkboxes_list">
         <li>
            <label>
               <input type="checkbox" name="electricity">
               ⚡ Электричество
            </label>
         </li>
         <li>
            <label>
               <input type="checkbox" name="water_pipe">
               🚰 Водопровод
            </label>
         </li>
         <li>
            <label>
               <input type="checkbox" name="gas">
               ♨️ Газ
            </label>
         </li>
      </ul>

      <div class="buttons hidden_disabled">
         <input class="save" type="submit" name="submit" value="Сохранить">
      </div>

      <input type="hidden" name="action" value="create" required>
   </fieldset>
</form>
