function toggleMenu() {
    const menu = document.getElementById('primary-menu')
    const container = document.getElementById('main-nav')
    const viewport = window.innerWidth
    const navbar = document.querySelector('#main-nav')

    let menuWidth = 0
    const menuItems = menu.querySelectorAll(':scope > li')
    menuItems.forEach((item) => {
        menuWidth += item.offsetWidth
    })

    const containerWidth = container.offsetWidth

    if (viewport > 1300 && menuWidth > containerWidth - 256) {
        navbar.classList.add('menu-hidden')
    } else if (viewport > 1000 && menuWidth > containerWidth - 206) {
        navbar.classList.add('menu-hidden')
    } else {
        navbar.classList.remove('menu-hidden')
    }
}

window.addEventListener('load', toggleMenu)
window.addEventListener('resize', toggleMenu)
