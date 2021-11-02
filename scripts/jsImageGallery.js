var jsImageGallery = function(){
  
  var slideIndex =1;
  
  
jsImageGallery.prototype.plusSlides = function(n) {
  slideIndex += n;
  this.showSlides(slideIndex);
};

jsImageGallery.prototype.currentSlide = function(n) {
  slideIndex = n;
  this.showSlides(slideIndex);
};

jsImageGallery.prototype.showSlides = function(n) {
  var i;
  var slides = window.document.getElementsByClassName("mySlides");
  //var slideIndex = 1;
  if (n > slides.length) {slideIndex = 1;}
  if (n < 1) {slideIndex = slides.length;}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  slides[slideIndex-1].style.display = "block";
  
  
  var dots = window.document.getElementsByClassName("demo");
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  dots[slideIndex-1].className += " active";
};
};