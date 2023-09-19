import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import tippy, {delegate} from 'tippy.js';
import 'tippy.js/dist/tippy.css';
import 'tippy.js/animations/shift-toward-subtle.css';


window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();


// Default configuration for Tippy with event delegation (https://atomiks.github.io/tippyjs/v6/addons/#event-delegation
delegate('body', {
    interactive: true,
    allowHTML: true,
    animation: 'shift-toward-subtle',
    target: '[data-tippy-content]',
});

tippy('.th img', {
    placement: 'right',
    allowHTML: true,
});

tippy('.cw div', {
    placement: 'bottom',
    allowHTML: true,
});
