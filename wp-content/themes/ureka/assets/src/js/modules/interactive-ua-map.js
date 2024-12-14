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

    accordionItems.forEach(item => {
        item.addEventListener('click', updateHighlightedRegions);
    });

    svgRegions.forEach(region => {
        region.addEventListener('mouseenter', function (e) {
            region.classList.add('highlight-hover');
            const regionName = region.getAttribute('data-name') || 'Область';
            popup.style.display = 'block';
            popup.textContent = regionName;
            popup.style.top = e.pageY + 10 + 'px';
            popup.style.left = e.pageX + 10 + 'px';
        });

        region.addEventListener('mousemove', function (e) {
            popup.style.top = e.pageY + 10 + 'px';
            popup.style.left = e.pageX + 10 + 'px';
        });

        region.addEventListener('mouseleave', function () {
            region.classList.remove('highlight-hover');
            popup.style.display = 'none';
        });

        region.addEventListener('click', function () {
            const regionId = region.getAttribute('id');
            accordionItems.forEach(item => {
                if (item.getAttribute('data-contact-id') === regionId) {
                    const collapse = document.querySelector(item.getAttribute('href'));
                    accordionItems.forEach(otherItem => {
                        const otherCollapse = document.querySelector(otherItem.getAttribute('href'));
                        if (otherCollapse && otherCollapse !== collapse) {
                            otherCollapse.classList.remove('show');
                            otherItem.setAttribute('aria-expanded', 'false');
                        }
                    });
                        console.log(collapse);
                    if (collapse) {
                        console.log('has collapse');
                        collapse.classList.add('show');
                        item.setAttribute('aria-expanded', 'true');
                    }
                }
            });
            updateHighlightedRegions();
        });
    });

    updateHighlightedRegions();
};

export default interactiveUaMap();
