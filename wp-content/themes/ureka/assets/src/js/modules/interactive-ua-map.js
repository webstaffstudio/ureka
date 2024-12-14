const interactiveUaMap = () => {


    const openAccordionItem = (contactId) => {
        // Знайти посилання з відповідним data-contact-id
        const accordionLink = document.querySelector(`a[data-contact-id="${contactId}"]`);
        if (accordionLink) {
            // Отримати href для елемента, що потрібно відкрити
            const collapseId = accordionLink.getAttribute('href');
            if (collapseId) {
                // Знайти елемент акордеону за href
                const accordionCollapse = document.querySelector(collapseId);
                if (accordionCollapse) {
                    // Використати Bootstrap Collapse для відкриття
                    const bootstrapCollapse = bootstrap.Collapse.getInstance(accordionCollapse);
                    if (!bootstrapCollapse) {
                        new bootstrap.Collapse(accordionCollapse, { toggle: true });
                    } else {
                        bootstrapCollapse.show();
                    }
                }
            }
        } else {
            console.error(`Accordion item with data-contact-id="${contactId}" not found.`);
        }
    };

// Виклик функції для відкриття айтема
    openAccordionItem('UA30');









    const accordionItems = document.querySelectorAll('#accordion .card-custom a');
    const svgRegions = document.querySelectorAll('svg [id^="UA"]');
    const popup = document.createElement('div');
    popup.id = 'region-popup';
    popup.style.position = 'absolute';
    popup.style.display = 'none';
    popup.style.padding = '5px 10px';
    popup.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';
    popup.style.color = '#fff';
    popup.style.borderRadius = '5px';
    popup.style.fontSize = '12px';
    popup.style.pointerEvents = 'none';
    document.body.appendChild(popup);

    const updateHighlightedRegions = () => {
        svgRegions.forEach(region => {
            region.classList.remove('highlight-by-tab');
        });

        accordionItems.forEach(item => {
            const regionId = item.getAttribute('data-contact-id');
            const region = document.getElementById(regionId);
            const isExpanded = item.getAttribute('aria-expanded') === 'true';

            if (region) {
                if (isExpanded) {
                    region.classList.add('highlight-by-tab');
                } else {
                    region.classList.remove('highlight-by-tab');
                }
            }
        });
    };

    const markExistingContacts = () => {
        const regionIds = Array.from(accordionItems).map(item => item.getAttribute('data-contact-id'));
        svgRegions.forEach(region => {
            if (regionIds.includes(region.getAttribute('id'))) {
                region.classList.add('contact-exist');
            } else {
                region.classList.remove('contact-exist');
            }
        });
    };

    accordionItems.forEach(item => {
        item.addEventListener('click', updateHighlightedRegions);
    });

    svgRegions.forEach(region => {
        region.addEventListener('mouseenter', function (e) {
            const regionId = region.getAttribute('id');
            const hasContact = Array.from(accordionItems).some(item => item.getAttribute('data-contact-id') === regionId);

            if (hasContact) {
                region.classList.add('highlight-hover');
                const regionName = region.getAttribute('data-name') || 'Область';
                popup.style.display = 'block';
                popup.textContent = regionName;
                popup.style.top = e.pageY + 10 + 'px';
                popup.style.left = e.pageX + 10 + 'px';
            }
        });

        region.addEventListener('mousemove', function (e) {
            if (popup.style.display === 'block') {
                popup.style.top = e.pageY + 10 + 'px';
                popup.style.left = e.pageX + 10 + 'px';
            }
        });

        region.addEventListener('mouseleave', function () {
            region.classList.remove('highlight-hover');
            popup.style.display = 'none';
        });

        region.addEventListener('click', function () {
            const regionId = region.getAttribute('id');
            const isHighlighted = region.classList.contains('highlight-by-tab');
            const correspondingItem = Array.from(accordionItems).find(item => item.getAttribute('data-contact-id') === regionId);

            if (isHighlighted) {
                // Знімаємо клас highlight-by-tab
                region.classList.remove('highlight-by-tab');

                // Закриваємо відповідний акордеон айтем
                if (correspondingItem) {
                    const collapse = document.querySelector(correspondingItem.getAttribute('data-contact-id'));
                    if (collapse) {
                        const bootstrapCollapse = bootstrap.Collapse.getInstance(collapse);
                        if (bootstrapCollapse) {
                            bootstrapCollapse.hide();
                        }
                    }
                }
            } else {
                // Додаємо клас highlight-by-tab і відкриваємо айтем
                accordionItems.forEach(item => {
                    const collapse = document.querySelector(item.getAttribute('data-contact-id'));
                    if (collapse) {
                        const bootstrapCollapse = bootstrap.Collapse.getInstance(collapse);
                        if (bootstrapCollapse) {
                            bootstrapCollapse.hide();
                        }
                    }
                });

                if (correspondingItem) {
                    const collapse = document.querySelector(correspondingItem.getAttribute('href'));
                    if (collapse) {
                        let bootstrapCollapse = bootstrap.Collapse.getInstance(collapse);
                        if (!bootstrapCollapse) {
                            bootstrapCollapse = new bootstrap.Collapse(collapse, {
                                toggle: true
                            });
                        } else {
                            bootstrapCollapse.show();
                        }
                    }
                    region.classList.add('highlight-by-tab');
                }
            }

            updateHighlightedRegions();
        });
    });

    updateHighlightedRegions();
    markExistingContacts();
};

export default interactiveUaMap();
