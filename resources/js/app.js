import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('submit', (event) => {
    const form = event.target;
    if (form.dataset.confirm && !window.confirm(form.dataset.confirm)) event.preventDefault();
    if (!form.dataset.confirm) {
        const button = form.querySelector('button[type="submit"]');
        if (button && !button.dataset.noLoading) { button.disabled = true; button.classList.add('opacity-70', 'cursor-wait'); }
    }
});

window.rentalForm = () => ({ lines: [{ gear_id: '', qty: 1 }] });
