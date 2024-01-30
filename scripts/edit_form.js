const edit_btn = document.getElementById('edit');
const fieldset = document.querySelector('fieldset');

edit_btn.addEventListener('click', () => {
   edit_btn.classList.add('hidden');
   fieldset.removeAttribute('disabled');
});

console.log(new Date())
