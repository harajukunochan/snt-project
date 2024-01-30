const input = document.getElementById('search');

input.addEventListener('input', () => {
   document.querySelectorAll('.fullname').forEach(node => {
      const li = node.closest('li');
      const fullname = node.textContent.toLowerCase();
      const search_value = input.value.toLowerCase();

      if (fullname.includes(search_value)) {
         li.classList.remove('hidden');
      } else {
         li.classList.add('hidden');
      }
   });
})
