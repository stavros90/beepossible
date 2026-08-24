import "./../styles/styles.scss"
import "./modules/particles"
import "./modules/menu-difference"
import initLightbox from "./modules/lightbox";
import initCampaign from "./modules/campaign";
import AOS from 'aos';
AOS.init({
  startEvent: 'DOMContentLoaded'
});

document.addEventListener('DOMContentLoaded', initLightbox);
document.addEventListener('DOMContentLoaded', initCampaign);