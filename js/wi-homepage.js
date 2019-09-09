// cache the dom
let mobile_hero_image = document.getElementById('mobile_hero_image');
let full_hero_image = document.getElementById('wi_header');

window.addEventListener('DOMContentLoaded', (event) => {
  toggleHeroImage(isMobileDisplay());
});



let wi_refresh_timeout;
window.addEventListener('resize', (event)=>{
  toggleHeroImage(isMobileDisplay());
});



function toggleHeroImage(isMobile){
  if(isMobile === true){
        mobile_hero_image.setAttribute("style", mobile_hero_image.getAttribute('style') + "; display:block");
        full_hero_image.setAttribute("style", "");
  }
  else{
        mobile_hero_image.setAttribute("style", mobile_hero_image.getAttribute('style') + "; display:none");
        full_hero_image.setAttribute("style", "background-image: url('http://wroughtink.local/wp-content/uploads/2019/03/IMG_0366.jpg')");
  }
}

function isMobileDisplay(){
   console.log(window.matchMedia('screen and (max-width: 812px)').matches);
   return window.matchMedia('screen and (max-width: 812px)').matches;


}
