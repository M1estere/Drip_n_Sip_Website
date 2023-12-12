const fileInput = document.getElementById("selectedFile")
const image = document.getElementById("image")

const fileInputField = document.getElementById('selectedFile')

function chooseFile() {
    fileInputField.click()
}

function recheckFile() {
    const files = fileInput.files

    for (const file of files) {
        image.src = URL.createObjectURL(file);
    }
}