import.meta.glob([
    '../images/**',
    '../fonts/fontawesome/**',
    '../fonts/inter/**',
    '../fonts/simple-line-icons/**',
]);

// Codebase
import './bootstrap';

// Custom Scripts
import './codebase/app.min.js';
import './codebase/script.js';

import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()


