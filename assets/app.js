    /*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

import $ from 'jquery';
window.jQuery = $;
window.$ = $;

require('./js/aos');
require('./js/bootstrap-datepicker');
require('./js/bootstrap.min');
require('./js/jquery-3.2.1.min');
require('./js/jquery-migrate-3.0.1.min');
require('./js/jquery.animateNumber.min');
require('./js/jquery.easing.1.3');
require('./js/jquery.magnific-popup.min');
require('./js/jquery.min');
require('./js/jquery.stellar.min');
require('./js/jquery.timepicker.min');
require('./js/jquery.waypoints.min');
require('./js/main');
require('./js/owl.carousel.min');
require('./js/popper.min');
require('./js/range');
require('./js/scrollax.min');
require('./js/popup');