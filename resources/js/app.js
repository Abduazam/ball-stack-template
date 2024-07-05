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

import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import mask from '@alpinejs/mask';

Alpine.plugin(mask);

Livewire.start();


