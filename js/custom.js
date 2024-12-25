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
    toggleMenu()
    addToggleButton()
})
window.addEventListener('resize', toggleMenu)
