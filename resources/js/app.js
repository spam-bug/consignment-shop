import './bootstrap';

import.meta.glob([
    '../images/**',
]);

class Formatter
{
    numbers_only(event) {
        const element = event.target;
        const value = element.value;

        element.value = value.replace(/[^0-9]/g, '');
    }
}

window.formatter = new Formatter;
