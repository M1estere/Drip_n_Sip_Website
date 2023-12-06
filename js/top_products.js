const featuredSection = document.getElementById("featured")
const hottestSection = document.getElementById("hottest")
const bestSection = document.getElementById("bestseller")

const featuredBtn = document.getElementById("featured-button")
const hottestBtn = document.getElementById("hottest-button")
const bestBtn = document.getElementById("best-button")

openFeatured()

function openFeatured() {
    changeSection(featuredSection, true)
    changeSection(hottestSection, false)
    changeSection(bestSection, false)

    controlButton(featuredBtn, true)
    controlButton(hottestBtn, false)
    controlButton(bestBtn, false)
}

function openHottest() {
    changeSection(featuredSection, false)
    changeSection(hottestSection, true)
    changeSection(bestSection, false)

    controlButton(featuredBtn, false)
    controlButton(hottestBtn, true)
    controlButton(bestBtn, false)
}

function openBest() {
    changeSection(featuredSection, false)
    changeSection(hottestSection, false)
    changeSection(bestSection, true)

    controlButton(featuredBtn, false)
    controlButton(hottestBtn, false)
    controlButton(bestBtn, true)
}

function changeSection(section, state) {
    if (state) {
        section.style.opacity = 1
        section.style.position = "relative"
        section.style.zIndex = 1
    } else {
        section.style.opacity = 0
        section.style.position = "absolute"
        section.style.zIndex = -3
    }
}

function controlButton(button, state) {
    if (state) {
        button.style.color = "white"
        button.style.backgroundColor = "#CA9960"
        button.style.boxShadow = '0px 0px 0px 0px rgba(34, 60, 80, 0)'
    } else {
        button.style.backgroundColor = null
        button.style.color = null
        button.style.boxShadow = null
    }
}