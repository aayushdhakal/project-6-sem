// make the input field visible
const displayInputFieldBtn = document.querySelector('.search__form__btn');
const inputFieldToBeShown = document.querySelector('.search__form__field');

let visibleInputField = false;

displayInputFieldBtn.addEventListener('click', changeVisiblility);

inputFieldToBeShown.addEventListener('blur', () => {
   inputFieldToBeShown.classList.remove('search__form__field--display');
   displayInputFieldBtn.setAttribute('type', 'button');
   visibleInputField = false;
})

function changeVisiblility(e) {
   visibleInputField = !visibleInputField;
   if (visibleInputField) {
      inputFieldToBeShown.classList.add('search__form__field--display');
      inputFieldToBeShown.focus();
      setTimeout(() => { displayInputFieldBtn.setAttribute('type', 'submit') }, 100);
   } else {
      inputFieldToBeShown.classList.remove('search__form__field--display');
   }
}

