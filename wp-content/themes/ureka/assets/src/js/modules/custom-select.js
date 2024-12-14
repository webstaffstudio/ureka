const customSelect = (select, classSelect = 'default-custom-select', removeDefaultClass = false) => {
    if (!select) return;

    const wrapperDiv = document.createElement('div'),
        customOptionsContainer = document.createElement('div'),
        options = select.querySelectorAll('option');

    // Check if we should remove the default class
    if (removeDefaultClass) {
        wrapperDiv.classList.add(classSelect);
    } else {
        wrapperDiv.classList.add('ureka-custom-select-container', 'default-custom-select', classSelect);
    }

    customOptionsContainer.classList.add('ureka-custom-select');
    select.insertAdjacentElement('beforebegin', wrapperDiv);
    wrapperDiv.appendChild(select);

    // Hide original select
    select.classList.add('hidden-select');

    if (options) {
        const wrapperOptionsValue = document.createElement('div'),
            wrapperValue = document.createElement('div'),
            valueText = document.createElement('div'),
            wrapperOptions = document.createElement('div');

        wrapperOptionsValue.classList.add('ureka-custom-select__options-value');
        wrapperOptions.classList.add('ureka-custom-select__options');
        wrapperValue.classList.add('ureka-custom-select__value');
        valueText.classList.add('ureka-custom-select__value-text');
        valueText.innerHTML = select.selectedOptions[0]?.innerHTML ?? '';

        const customImage = select.selectedOptions[0]?.getAttribute('data-img-url');
        if (customImage) {
            const customOptionImage = document.createElement('div');
            customOptionImage.classList.add('ureka-custom-select__img-option');
            customOptionImage.style.backgroundImage = `url(${customImage})`;
            valueText.appendChild(customOptionImage);
        }

        // Build options
        options.forEach((option) => {
            const customOption = document.createElement('div');
            customOption.classList.add('ureka-custom-select__option');
            customOption.innerHTML = option.innerHTML ?? '';
            customOption.dataset.value = option.value ?? '';
            customOption.setAttribute('data-value', option.value ?? '');

            const customImage = option.getAttribute('data-img-url');
            if (customImage) {
                const customOptionImage = document.createElement('div');
                customOptionImage.classList.add('ureka-custom-select__img-option');
                customOptionImage.style.backgroundImage = `url(${customImage})`;
                customOption.appendChild(customOptionImage);
            }

            if (option.value === select.value) customOption.classList.add('selected');
            wrapperOptions.appendChild(customOption);
        });

        // Append built divs
        wrapperValue.appendChild(valueText);
        wrapperOptionsValue.appendChild(wrapperValue);
        wrapperOptionsValue.appendChild(wrapperOptions);
        customOptionsContainer.appendChild(wrapperOptionsValue);
        select.parentNode.insertBefore(customOptionsContainer, select.nextSibling);
    }
};


const eventClickCustomSelect = () => {
    const changeEvent = new Event('change', {
        bubbles: true,
        cancelable: false
    });
    document.addEventListener('keydown', function (event) {
        //hide options dropdown on Escape
        if (event.key === 'Escape' && document.querySelector('.ureka-custom-select__options.show')) {
            document.querySelector('.ureka-custom-select__options.show').classList.remove('show')
            document.querySelector('.ureka-custom-select__value.open').classList.remove('open')
        }
    });

    document.addEventListener('click', (event) => {
        const target = event.target.closest('.ureka-custom-select__value') ?? event.target.closest('.ureka-custom-select__option'),
            targetClasses = target ? target.classList : null;

        if (targetClasses && (targetClasses.contains('ureka-custom-select__value') || targetClasses.contains('ureka-custom-select__option'))) {
            //Get parent container select
            const containerSelect = target.closest('.ureka-custom-select-container');
            if (targetClasses.contains('ureka-custom-select__value')) {
                const options = target.nextSibling.classList;
                if (options.contains('ureka-custom-select__options')) {
                    //If some open dropdown - close
                    const selectValueOpen = document.querySelector('.ureka-custom-select__value.open');
                    const optionsShowOur = document.querySelector('.ureka-custom-select__options.show');
                    if (selectValueOpen && target !== selectValueOpen) {
                        selectValueOpen.classList.remove('open');
                        optionsShowOur.classList.remove('show');
                    }
                    //On click value open or close options dropdown
                    targetClasses.contains('open') ? targetClasses.remove('open') : targetClasses.add('open');
                    options.contains('show') ? options.remove('show') : options.add('show');
                }
            } else if (targetClasses.contains('ureka-custom-select__option')) {
                const selectedValueEl = containerSelect.querySelector('.selected'),
                    selectOriginal = containerSelect.querySelector('select'),
                    selectValue = containerSelect.querySelector('.ureka-custom-select__value .ureka-custom-select__value-text'),
                    optionsShow = containerSelect.querySelector('.ureka-custom-select__options.show'),
                    valueOpen = containerSelect.querySelector('.ureka-custom-select__value.open');
                //Remove if have selected
                if (selectedValueEl) selectedValueEl.classList.remove('selected');
                //Change value original select
                selectOriginal.value = target.getAttribute('data-value');
                //Add selected target el
                target.classList.add('selected');
                //Dispatch event change on original select
                selectOriginal.dispatchEvent(changeEvent);
                //Change value text after select
                selectValue.innerHTML = target.innerHTML ?? '';
                //Hide options dropdown
                if (optionsShow) optionsShow.classList.remove('show');
                if (valueOpen) valueOpen.classList.remove('open');
            }
        } else if (document.querySelector('.ureka-custom-select__options.show')) {
            //Hide Dropdown options if click outside
            document.querySelector('.ureka-custom-select__options.show').classList.remove('show')
            document.querySelector('.ureka-custom-select__value.open').classList.remove('open')
        }

    })
}

export {customSelect, eventClickCustomSelect}
