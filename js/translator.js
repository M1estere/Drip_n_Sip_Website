import translatables from './translate.js'

let lang = localStorage.getItem('lang') ? localStorage.getItem('lang') : 'en'
getTranslate(lang)

function getTranslate(lang) {
    const data = document.querySelectorAll('[data-i18]')
    data.forEach((item) => {
        if (item.placeholder) {
            item.placeholder = translatables[lang][item.dataset.i18]
            item.textContent = '';
        } else {
            item.textContent = translatables[lang][item.dataset.i18]
        }
    })

    if (lang === 'en') {
        document.querySelector('.btn-lang').innerHTML = 'Language EN-US'
    }
    if (lang === 'ru') {
        document.querySelector('.btn-lang').innerHTML = 'Язык RU-RUS'
    }

    localStorage.setItem('lang', lang)
}

function changeLanguage(event) {
    if (event.target.classList.contains('switch-lang-btn')) {
        if (!event.target.classList.contains('active-btn')) {
            lang === 'en' ? lang = 'ru' : lang = 'en'
        }

        const switchBtns = document.querySelectorAll('.switch-lang-btn')
        switchBtns.forEach((elem) => elem.classList.remove('active-btn'))
        getTranslate(lang)
    }
}
document.querySelector('.switch-lang-button').addEventListener('click', changeLanguage);