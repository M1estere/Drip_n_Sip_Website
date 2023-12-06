const persInfoBlock = document.getElementById("personal-info")
const billingInfoBlock = document.getElementById("billing-info")
const histInfoBlock = document.getElementById("order-history-info")

const persInfoBtn = document.getElementById("pers-info-btn")
const bilInfoBtn = document.getElementById("bil-info-btn")
const histInfoBtn = document.getElementById("hist-info-btn")

enablePersInfoFunc()

function enablePersInfoFunc() {
    controlBlock(persInfoBlock, true)
    controlBlock(billingInfoBlock, false)
    controlBlock(histInfoBlock, false)

    controlButton(persInfoBtn, true)
    controlButton(bilInfoBtn, false)
    controlButton(histInfoBtn, false)
}

function enableBillingInfoFunc() {
    controlBlock(persInfoBlock, false)
    controlBlock(billingInfoBlock, true)
    controlBlock(histInfoBlock, false)

    controlButton(persInfoBtn, false)
    controlButton(bilInfoBtn, true)
    controlButton(histInfoBtn, false)
}

function enableHistInfoFunc() {
    controlBlock(persInfoBlock, false)
    controlBlock(billingInfoBlock, false)
    controlBlock(histInfoBlock, true)

    controlButton(persInfoBtn, false)
    controlButton(bilInfoBtn, false)
    controlButton(histInfoBtn, true)
}

function signOut() {
    location.href = "auth.php";
}

function controlBlock(block, state) {
    if (state) {
        block.style.opacity = 1
        block.style.position = "relative"
        block.style.zIndex = 1
    } else {
        block.style.opacity = 0
        block.style.position = "absolute"
        block.style.zIndex = -3
    }
}

function controlButton(button, state) {
    if (state) {
        button.style.transform = "translateX(10px)"
        button.style.color = "#e2aa6a"
    } else {
        button.style.transform = null
        button.style.color = null
    }
}