;(function ($) {
    $(document).ready(function ($) {
        // News ticker.
        var $news_ticker = $('#news-ticker')
        if ($news_ticker.length > 0) {
            $news_ticker.easyTicker({
                direction: 'up',
                easing: 'swing',
                speed: 'slow',
                interval: 3000,
                height: 'auto',
                visible: 1,
                mousePause: 1,
            })
        }

        // Implement go to top.
        var $scroll_obj = $('#btn-scrollup')
        $(window).on('scroll', function () {
            if ($(this).scrollTop() > 100) {
                $scroll_obj.fadeIn()
            } else {
                $scroll_obj.fadeOut()
            }
        })

        $scroll_obj.on('click', function () {
            $('html, body').animate({ scrollTop: 0 }, 600)
            return false
        })
    })
})(jQuery)

// responsive search form in main navbar
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
