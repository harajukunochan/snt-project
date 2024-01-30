const select = document.getElementById('search_select');
const input = document.getElementById('search');

input.addEventListener('input', () => {
   select.querySelectorAll('option').forEach(option => {
      const fullname_and_login = option.textContent.toLowerCase();
      const search_value = input.value.toLowerCase();

      if (fullname_and_login.includes(search_value)) {
         option.removeAttribute('hidden');
      } else {
         option.setAttribute('hidden', 'true');
      }
   });
})
