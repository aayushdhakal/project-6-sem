//for corousel 
let slideIndex = 1;
let slides = document.getElementsByClassName("slides");

showSlides(slideIndex);

// function plusSlides(n) {
//    showSlides(slideIndex += n);
// }

function currentSlide(n) {
   showSlides(slideIndex = n);
}


function showSlides(n) {
   // console.log(slideIndex);   
   let i;
   let dots = document.getElementsByClassName("dot");
   // if (n > slides.length) { slideIndex = 1 }
   // if (n < 1) { slideIndex = slides.length }
   for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
   }
   for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
   }
   slides[slideIndex-1].style.display = "block";
   dots[slideIndex-1].className += " active"; 
}

setInterval(() => {
   let temp = slideIndex || 1;
   if (slideIndex > slides.length){
      slideIndex=1;
   }else{
      slideIndex;
   }
   currentSlide(slideIndex);
   slideIndex++;
}, 4000)
