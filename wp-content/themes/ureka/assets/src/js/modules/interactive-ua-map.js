const interactiveUaMap = () => {
    const accordionItems = document.querySelectorAll('#accordion .card-custom a')
    const svgRegions = document.querySelectorAll('svg [id^="UA"]')
    const popup = document.createElement('div')
    popup.id = 'region-popup'
    popup.style.position = 'absolute'
    popup.style.display = 'none'
    popup.style.padding = '5px 10px'
    popup.style.backgroundColor = 'rgba(0, 0, 0, 0.8)'
    popup.style.color = '#fff'
    popup.style.borderRadius = '5px'
    popup.style.fontSize = '16px'
    popup.style.pointerEvents = 'none'
    document.body.appendChild(popup)

    const openRegionTab = (region, item) => {
        const collapse = document.querySelector(item.getAttribute('href'))
        if (collapse) {
            let bootstrapCollapse = bootstrap.Collapse.getInstance(collapse)
            if (!bootstrapCollapse) {
                bootstrapCollapse = new bootstrap.Collapse(collapse, { toggle: true })
            } else {
                bootstrapCollapse.show()
            }
        }
        region.classList.add('highlight-by-tab')
    }

    const closeRegionTab = (region, item) => {
        region.classList.remove('highlight-by-tab')
        if (item) {
            const collapse = document.querySelector(item.getAttribute('href'))
            if (collapse) {
                const bootstrapCollapse = bootstrap.Collapse.getInstance(collapse)
                if (bootstrapCollapse) {
                    bootstrapCollapse.hide()
                }
            }
        }
    }

    const updateHighlightedRegions = () => {
        svgRegions.forEach(r => r.classList.remove('highlight-by-tab'))
        accordionItems.forEach(i => {
            const regionId = i.getAttribute('data-contact-id')
            const region = document.getElementById(regionId)
            if (region && i.getAttribute('aria-expanded') === 'true') {
                region.classList.add('highlight-by-tab')
            }
        })
    }

    const markExistingContacts = () => {
        const regionIds = Array.from(accordionItems).map(i => i.getAttribute('data-contact-id'))
        svgRegions.forEach(r => {
            if (regionIds.includes(r.getAttribute('id'))) {
                r.classList.add('contact-exist')
            } else {
                r.classList.remove('contact-exist')
            }
        })
    }

    accordionItems.forEach(i => {
        i.addEventListener('click', () => {
            setTimeout(updateHighlightedRegions, 300)
        })
    })

    svgRegions.forEach(r => {
        r.addEventListener('mouseenter', e => {
            const popupData = r.getAttribute('data-popup')
            let content = ''
            if (popupData) {
                const data = JSON.parse(popupData)
                if (data.ua_company_name) content += `<div><i class="fa fa-building"></i>${data.ua_company_name}</div>`
                if (data.ua_contact_person) content += `<div><i class="fa fa-user"></i> ${data.ua_contact_person}</div>`
                if (data.ua_phone_numbers) {
                    const phones = data.ua_phone_numbers
                        .filter(p => p.show_in_popup)
                        .map(p => `<li><i class="fa fa-phone"></i>${p.phone}</li>`)
                        .join('')
                    if (phones) content += `<div><ul>${phones}</ul></div>`
                }
                if (data.ua_email) content += `<div><i class="fa fa-envelope"></i>${data.ua_email}</div>`
                if (data.ua_website) content += `<div><i class="fa fa-globe"></i>${data.ua_website}</div>`
                if (data.ua_address) content += `<div><i class="fa fa-map-marker"></i>${data.ua_address}</div>`
                if (data.ua_text_information) content += `<div>${data.ua_text_information}</div>`
            }
            if (content) {
                popup.innerHTML = content
                popup.style.display = 'block'
                popup.style.top = e.pageY + 10 + 'px'
                popup.style.left = e.pageX + 10 + 'px'
            }
        })

        r.addEventListener('mousemove', e => {
            popup.style.top = e.pageY + 10 + 'px'
            popup.style.left = e.pageX + 10 + 'px'
        })

        r.addEventListener('mouseleave', () => {
            popup.style.display = 'none'
        })

        r.addEventListener('click', () => {
            const regionId = r.getAttribute('id');
            const isHighlighted = r.classList.contains('highlight-by-tab')
            const correspondingItem = Array.from(accordionItems).find(i => i.getAttribute('data-contact-id') === regionId)
            if (isHighlighted) {
                closeRegionTab(r, correspondingItem)
            } else {
                accordionItems.forEach(item => {
                    const regId = item.getAttribute('data-contact-id')
                    const reg = document.getElementById(regId)
                    if (reg && reg.classList.contains('highlight-by-tab')) {
                        closeRegionTab(reg, item)
                    }
                })
                if (correspondingItem) {
                    openRegionTab(r, correspondingItem)
                }
            }
            updateHighlightedRegions()
        })
    })

    document.addEventListener('DOMContentLoaded', () => {
        updateHighlightedRegions()
        markExistingContacts()
        const detectedRegion = document.querySelector('#accordion')?.getAttribute('data-detected-region')
        if (detectedRegion) {
            const regionEl = document.getElementById(detectedRegion)
            const correspondingItem = Array.from(accordionItems).find(i => i.getAttribute('data-contact-id') === detectedRegion)
            if (regionEl && correspondingItem) {
                openRegionTab(regionEl, correspondingItem)
                updateHighlightedRegions()
            }
        }
    })
}

export default interactiveUaMap()
