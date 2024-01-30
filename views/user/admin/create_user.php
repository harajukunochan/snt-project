<form method="post">
   <fieldset>
      <legend>
         <h3>Создать пользователя</h3>
      </legend>

      <ul>
         <li>
            <label>
               ФИО:
               <input name="fullname" placeholder="Фамилия Имя Отчество" type="text" required>
            </label>
         </li>

         <li>
            <label>
               E-mail:
               <input name="email" placeholder="Электронная почта" type="text" required>
            </label>
         </li>

         <li>
            <label>
               Номер телефона:
               <input name="phone_number" placeholder="Номер телефона" type="text" required>
            </label>
         </li>

         <li>
            <label>
               Адрес
               <input name="address" placeholder="Адрес" type="text" required>
            </label>
         </li>

         <li>
            <label>
               Логин:
               <input name="login" placeholder="Логин" type="text" required>
            </label>
         </li>

         <li>
            <label>
               Пароль:
               <input name="password" placeholder="Пароль" type="password" required>
            </label>
         </li>
      </ul>
      <ul class="checkboxes_list">
         <li>
            <label>
              <input name="pd" type="checkbox" required>
               Согласен на обработку персональных данных.
            </label>
         </li>
      </ul>

      <input class="btn save mt-1" type="submit" name="submit" value="Сохранить">
   </fieldset>
</form>
