function setPanelState(button, panel, expanded) {
    button.setAttribute('aria-expanded', expanded ? 'true' : 'false');

    const icon = button.querySelector('.accordion-icon');
    if (icon) {
        icon.src = expanded
            ? '/images/home/menos.svg'
            : '/images/home/mas.svg';
    }

    if (expanded) {
        panel.hidden = false;        
        const target = panel.scrollHeight;
        panel.style.maxHeight = target + 'px';
    } else {
        panel.style.maxHeight = panel.scrollHeight + 'px'; 
        panel.getBoundingClientRect();
        panel.style.maxHeight = '0px';
        panel.addEventListener('transitionend', function onEnd(e) {
            if (e.propertyName === 'max-height') {
                panel.hidden = true;
                panel.removeEventListener('transitionend', onEnd);
            }
        });
    }
}

function closeSiblingsIfSingle(container, currentBtn) {
    if (container?.dataset.accordion !== 'single') return;

    const triggers = container.querySelectorAll('[data-accordion-trigger]');
    triggers.forEach((btn) => {
        if (btn === currentBtn) return;
        const panelId = btn.getAttribute('aria-controls');
        const panel = document.getElementById(panelId);
        if (btn.getAttribute('aria-expanded') === 'true') {
            setPanelState(btn, panel, false);
        }
    });
}

function initAccordion(root = document) {
    const triggers = root.querySelectorAll('[data-accordion-trigger]');
    triggers.forEach((btn) => {
        const panelId = btn.getAttribute('aria-controls');
        const panel = document.getElementById(panelId);
        const container = btn.closest('[data-accordion]');

        const expanded = btn.getAttribute('aria-expanded') === 'true';
        if (!expanded) {
            panel.hidden = true;
            panel.style.maxHeight = '0px';
        }

        btn.addEventListener('click', () => {
            const isOpen = btn.getAttribute('aria-expanded') === 'true';
            const next = !isOpen;

            if (next) {
                closeSiblingsIfSingle(container, btn);
            }
            setPanelState(btn, panel, next);
        });
    });
}

document.addEventListener("DOMContentLoaded", () => {
    initAccordion();
});



