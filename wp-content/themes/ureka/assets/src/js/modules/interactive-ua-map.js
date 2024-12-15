const interactiveUaMap = () => {
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
    popup.style.fontSize = '16px';
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

            if (region && isExpanded) {
                region.classList.add('highlight-by-tab');
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
        item.addEventListener('click', function () {
            setTimeout(() => {
                updateHighlightedRegions();
            }, 300); // Delay to sync with Bootstrap animation
        });
    });

    svgRegions.forEach(region => {
        region.addEventListener('mouseenter', function (e) {
            const popupData = region.getAttribute('data-popup');
            let content = '';

            if (popupData) {
                const data = JSON.parse(popupData);
                if (data.ua_company_name) {
                    content = `<div><i class="fa fa-building"></i>${data.ua_company_name}</div>`;
                }
                if (data.ua_contact_person) {
                    content += `<div><i class="fa fa-user"></i> ${data.ua_contact_person}</div>`;
                }
                if (data.ua_phone_numbers) {
                    const phoneNumbers = data.ua_phone_numbers
                        .filter(phone => phone.show_in_popup)
                        .map(phone => `<li><i class="fa fa-phone"></i>${phone.phone}</li>`)
                        .join('');
                    if (phoneNumbers) {
                        content += `<div><ul>${phoneNumbers}</ul></div>`;
                    }
                }
                if (data.ua_email) {
                    content += `<div><i class="fa fa-envelope"></i>${data.ua_email}</div>`;
                }
                if (data.ua_website) {
                    content += `<div><i class="fa fa-globe"></i>${data.ua_website}</div>`;
                }
                if (data.ua_address) {
                    content += `<div><i class="fa fa-map-marker"></i>${data.ua_address}</div>`;
                }
                if (data.ua_text_information) {
                    content += `<div>${data.ua_text_information}</div>`;
                }
            }
            if (content) {
                popup.innerHTML = content;
                popup.style.display = 'block';
                popup.style.top = e.pageY + 10 + 'px';
                popup.style.left = e.pageX + 10 + 'px';
            }
        });

        region.addEventListener('mousemove', function (e) {
            popup.style.top = e.pageY + 10 + 'px';
            popup.style.left = e.pageX + 10 + 'px';
        });

        region.addEventListener('mouseleave', function () {
            popup.style.display = 'none';
        });

        region.addEventListener('click', function () {
            const regionId = region.getAttribute('id');
            const isHighlighted = region.classList.contains('highlight-by-tab');
            const correspondingItem = Array.from(accordionItems).find(item => item.getAttribute('data-contact-id') === regionId);

            if (isHighlighted) {
                // Remove highlight class
                region.classList.remove('highlight-by-tab');

                // Close the corresponding accordion item
                if (correspondingItem) {
                    const collapse = document.querySelector(correspondingItem.getAttribute('href'));
                    if (collapse) {
                        const bootstrapCollapse = bootstrap.Collapse.getInstance(collapse);
                        if (bootstrapCollapse) {
                            bootstrapCollapse.hide();
                        }
                    }
                }
            } else {
                // Add highlight class and open the accordion item
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

    document.addEventListener('DOMContentLoaded', updateHighlightedRegions);
    updateHighlightedRegions();
    markExistingContacts();
};

export default interactiveUaMap();
