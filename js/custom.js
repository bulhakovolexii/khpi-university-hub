function toggleMenu() {
    const container = document.getElementById('main-nav')
    const menu = document.getElementById('primary-menu')
    const viewport = window.innerWidth
    const containerWidth = container.offsetWidth
    const menuItems = menu.querySelectorAll(':scope > li')
    let menuWidth = 0
    menuItems.forEach((item) => {
        menuWidth += item.offsetWidth
    })
    if (viewport > 1300 && menuWidth > containerWidth - 256) {
        container.classList.add('menu-hidden')
    } else if (viewport > 1000 && menuWidth > containerWidth - 206) {
        container.classList.add('menu-hidden')
    } else {
        container.classList.remove('menu-hidden')
    }
}

function addToggleButton() {
    const container = document.getElementById('main-nav')
    const button = document.createElement('button')
    button.id = 'show-search'
    button.textContent = ''
    container.appendChild(button)
    button.addEventListener('click', toggleMenuManually)
}

function toggleMenuManually() {
    const container = document.getElementById('main-nav')
    if (container.classList.contains('menu-hidden')) {
        container.classList.remove('menu-hidden')
    }
}

window.addEventListener('load', () => {
    const searchField = document.querySelector('#main-nav .header-search-box')

    if (searchField) {
        toggleMenu()
        addToggleButton()
    }
})
window.addEventListener('resize', () => {
    const searchField = document.querySelector('#main-nav .header-search-box')

    if (searchField) {
        toggleMenu()
    }
})

// expand all btn for su accordion
document.querySelectorAll('.su-accordion.with-expand-btn').forEach((accordion) => {
    const spoilers = accordion.querySelectorAll('.su-spoiler')
    if (spoilers.length === 0) return

    const container = document.createElement('div')
    container.classList.add('su-expand-container')
    const button = document.createElement('button')
    container.prepend(button)
    button.classList.add('su-expand-btn')
    const icon = document.createElement('i')
    button.prepend(icon)
    updateButtonText(button, spoilers)
    button.addEventListener('click', () => toggleSpoilers(button, spoilers))

    accordion.insertBefore(container, spoilers[0])

    spoilers.forEach((spoiler) => {
        spoiler.addEventListener('click', (event) => {
            event.stopPropagation()
            spoiler.classList.toggle('su-spoiler-closed')
            updateButtonText(button, spoilers)
        })
    })
})

function updateButtonText(button, spoilers) {
    const allOpen = [...spoilers].every((spoiler) => !spoiler.classList.contains('su-spoiler-closed'))
    const lang = document.documentElement.lang
    const icon = button.querySelector('i')

    if (allOpen) {
        button.textContent = lang === 'uk' ? 'Згорнути все' : 'Collapse All'
        icon.className = 'fa-solid fa-arrows-up-to-line'
    } else {
        button.textContent = lang === 'uk' ? 'Розгорнути все' : 'Expand All'
        icon.className = 'fa-solid fa-arrows-down-to-line'
    }
    button.prepend(icon)
}

function toggleSpoilers(button, spoilers) {
    const allOpen = [...spoilers].every((spoiler) => !spoiler.classList.contains('su-spoiler-closed'))
    spoilers.forEach((spoiler) => {
        spoiler.classList.toggle('su-spoiler-closed', allOpen)
    })
    updateButtonText(button, spoilers)
}
