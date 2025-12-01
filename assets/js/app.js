/**
 * CampusConnect interactions: nav drawer, accordion, swipe cards.
 */
(function () {
    const navToggle = document.querySelector('.nav-toggle');
    const drawer = document.querySelector('.mobile-drawer');
    const backdrop = document.querySelector('.drawer-backdrop');
    const drawerClose = document.querySelector('.drawer-close');
    const accordionTriggers = document.querySelectorAll('.accordion-trigger');
    const swipeTrack = document.querySelector('[data-swipe-track] .swipe-track');

    const toggleAria = (expanded) => {
        if (navToggle) {
            navToggle.setAttribute('aria-expanded', expanded);
        }
    };

    const openDrawer = () => {
        drawer?.classList.add('open');
        backdrop?.classList.add('visible');
        toggleAria(true);
        document.body.style.overflow = 'hidden';
    };

    const closeDrawer = () => {
        drawer?.classList.remove('open');
        backdrop?.classList.remove('visible');
        toggleAria(false);
        document.body.style.overflow = '';
    };

    navToggle?.addEventListener('click', openDrawer);
    drawerClose?.addEventListener('click', closeDrawer);
    backdrop?.addEventListener('click', closeDrawer);
    document.addEventListener('keydown', (evt) => {
        if (evt.key === 'Escape') closeDrawer();
    });

    accordionTriggers.forEach((trigger) => {
        trigger.addEventListener('click', () => {
            const expanded = trigger.getAttribute('aria-expanded') === 'true';
            trigger.setAttribute('aria-expanded', String(!expanded));

            const panel = trigger.nextElementSibling;
            panel?.classList.toggle('open', !expanded);
        });
    });

    if (swipeTrack) {
        let isPointerDown = false;
        let startX = 0;
        let scrollLeft = 0;

        const startDrag = (clientX) => {
            isPointerDown = true;
            startX = clientX;
            scrollLeft = swipeTrack.scrollLeft;
            swipeTrack.classList.add('dragging');
        };

        const moveDrag = (clientX) => {
            if (!isPointerDown) return;
            const delta = clientX - startX;
            swipeTrack.scrollLeft = scrollLeft - delta;
        };

        const endDrag = () => {
            isPointerDown = false;
            swipeTrack.classList.remove('dragging');
        };

        swipeTrack.addEventListener('pointerdown', (e) => {
            swipeTrack.setPointerCapture(e.pointerId);
            startDrag(e.clientX);
        });

        swipeTrack.addEventListener('pointermove', (e) => moveDrag(e.clientX));
        swipeTrack.addEventListener('pointerup', endDrag);
        swipeTrack.addEventListener('pointerleave', endDrag);
        swipeTrack.addEventListener('pointercancel', endDrag);

        swipeTrack.addEventListener('touchstart', (e) => startDrag(e.touches[0].clientX), { passive: true });
        swipeTrack.addEventListener('touchmove', (e) => moveDrag(e.touches[0].clientX), { passive: true });
        swipeTrack.addEventListener('touchend', endDrag);
    }
})();

