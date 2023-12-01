const openAboutButton = document.getElementById("open-about-button")
const closeAboutButton = document.getElementById("close-about-popup")

const aboutPopup = document.getElementById("about-popup")


const openDelivButton = document.getElementById("open-deliv-button")
const closeDelivButton = document.getElementById("close-deliv-popup")

const delivPopup = document.getElementById("delivery-popup")


const openContButton = document.getElementById("open-contacts-button")
const closeContButton = document.getElementById("close-cont-popup")

const contactPopup = document.getElementById("contacts-popup")

setOnClicks(aboutPopup, openAboutButton, closeAboutButton)
setOnClicks(delivPopup, openDelivButton, closeDelivButton)
setOnClicks(contactPopup, openContButton, closeContButton)

function setOnClicks(popup, openButton, closeButton) {
    openButton.addEventListener("click", () => {
        popup.classList.add("open")
    })

    closeButton.addEventListener("click", () => {
        popup.classList.remove("open")
    })
}