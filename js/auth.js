const switchTime = 6

const head = document.getElementById('head')
const images = [
    'assets/carousel/shop-2.webp',
    'assets/carousel/shop-4.jpg',
    'assets/carousel/shop-3.jpg',
    'assets/carousel/shop-6.jpg',
    'assets/carousel/shop-1.jpg',
    'assets/carousel/shop-7.png',
    'assets/carousel/shop-5.jpg',
]

let timer = setInterval(changeImageNoButton, switchTime * 1000)
let i = 0

function changeImageNoButton() {
    head.style.background = "linear-gradient(rgba(0, 0, 0, 0.60), rgba(0, 0, 0, 0.60)), url(" + images[i] + ")"
    head.style.backgroundRepeat = "no-repeat"
    head.style.backgroundSize = "cover"

    i = i + 1
    if (i == images.length) {
        i = 0
    }
}

let login_field = document.getElementById("login")
let reg_field = document.getElementById("register")

let log_button = document.getElementById("login-button")
let reg_button = document.getElementById("register-button")

let t = localStorage.getItem("lastActiveElement");
if (t == null || t == 0)
    register()
else
    login()

function register() {
    controlButton(log_button, false)
    controlButton(reg_button, true)

    controlFields(reg_field, true)
    controlFields(login_field, false)

    localStorage.setItem("lastActiveElement", 0);
}

function login() {
    controlButton(log_button, true)
    controlButton(reg_button, false)

    controlFields(reg_field, false)
    controlFields(login_field, true)

    localStorage.setItem("lastActiveElement", 1);
}

function controlFields(fields, state) {
    if (state) {
        fields.style.opacity = 1
        fields.style.position = "relative"
        fields.style.zIndex = 1
    } else {
        fields.style.opacity = 0
        fields.style.position = "absolute"
        fields.style.zIndex = -3
    }
}

function controlButton(button, state) {
    if (state) {
        button.style.borderBottom = "2px solid black";
        button.style.color = "black"
    } else {
        button.style.borderBottom = null;
        button.style.color = null
    }
}