document.addEventListener('DOMContentLoaded', () => {
	const counter = document.querySelector('.app-counter__value')

	let counterValue = parseInt(counter.textContent)

	setInterval(() => {
		counter.classList.add('active')
	
		setTimeout(() => {
			counter.textContent = ++counterValue // давайте представим что тут обращение к серверу
		}, 200)
	
		setTimeout(() => {
			counter.classList.remove('active')
		}, 400)
	}, 5000)
})