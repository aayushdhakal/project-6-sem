// make the input field visible
const displayInputFieldBtn = document.querySelector('.search__form__btn');
const inputFieldToBeShown = document.querySelector('.search__form__field');

let visibleInputField = false;

displayInputFieldBtn.addEventListener('click', changeVisiblility);

inputFieldToBeShown.addEventListener('blur',()=>{
   inputFieldToBeShown.classList.remove('search__form__field--display');
   visibleInputField = false;
})

function changeVisiblility(e) {
   visibleInputField = !visibleInputField;
   if (visibleInputField) {
      inputFieldToBeShown.classList.add('search__form__field--display');
      inputFieldToBeShown.focus();
   } else {
      inputFieldToBeShown.classList.remove('search__form__field--display');
   }
}

