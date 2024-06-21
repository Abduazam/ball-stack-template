import.meta.glob([
    '../images/**',
    '../fonts/fontawesome/**',
    '../fonts/inter/**',
    '../fonts/simple-line-icons/**',
]);

import './bootstrap';

// Library
import './codebase/lib/jquery.min.js';

// Custom Scripts
import './codebase/app.min.js';
import './codebase/script.js';

import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()


