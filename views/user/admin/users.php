<h2>Управление пользователями</h2>

<div class="search">
   <input type="text" placeholder="Поиск по ФИО" id="search">
</div>

<ul>
   <?php
   if ($result->num_rows > 0) :
      while ($row = $result->fetch_assoc()) :
         [
            "id" => $id,
            "login" => $login,
            "fullname" => $fullname,
            "email" => $email,
            "phone_number" => $phone_number,
            "address" => $address,
         ] = $row;
   ?>

         <li>
            <fieldset>
               <legend>
                  <h5>
                     <a href="/user/<?= $id ?>">
                        <span class="fullname">
                           <?= $fullname ?>
                        </span>
                        <span class="small">
                           <?= $login ?>
                        </span>
                     </a>
                  </h5>
               </legend>
               <div class="contacts">
                  <?php if (isset($phone_number)) : ?>
                     <a href="tel:<?= $phone_number ?>">📞 <?= $phone_number ?></a>
                  <?php endif; ?>
                  <?php if (isset($email)) : ?>
                     <a href="mailto:<?= $email ?>">📧 <?= $email ?></a>
                  <?php endif; ?>
               </div>

               <?php if (isset($address)) : ?>
                  <div>📌 <?= $address ?></div>
               <?php endif; ?>
            </fieldset>
         </li>

      <?php endwhile; ?>

   <?php else : ?>

      <li class="centered">
         <h4>Нет пользователей</h4>
      </li>

   <?php endif; ?>
</ul>

<div class="add_btn_container">
   <a href="user/create" class="add_btn">+</a>
</div>
