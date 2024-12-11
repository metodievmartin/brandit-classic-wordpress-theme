import 'bootstrap/dist/js/bootstrap.bundle.min';
import Search from './modules/Search';
import * as contactForm from './modules/contactForm.js';

console.log('JS scripts loaded...');

// Initialise the Search functionality
new Search();
contactForm.init();
