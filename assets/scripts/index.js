import "./../styles/styles.scss"
import "./modules/particles"
import "./modules/menu-difference"
import initLightbox from "./modules/lightbox";
import AOS from 'aos';
AOS.init({
  startEvent: 'DOMContentLoaded'
});

document.addEventListener('DOMContentLoaded', initLightbox);