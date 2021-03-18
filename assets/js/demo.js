const demoBx = document.querySelectorAll('.demo-img');
demoBx.forEach(popup => popup.addEventListener('click', () => {
    popup.classList.toggle('active')
}))

const boxs = document.querySelectorAll('.demo-box');
boxs.forEach(popup => popup.addEventListener('click', () => {
    popup.classList.toggle('active')
}))


const button = document.querySelectorAll('.gorila');
button.forEach(popup => popup.addEventListener('click', () => {
    popup.classList.toggle('active')
}))