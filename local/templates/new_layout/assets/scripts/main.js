const activeClass = "active";

document.querySelectorAll('input[type="tel"]').forEach((elem) => {
	const phoneMask = IMask(elem, {
		mask: '+{7} (000) 000-00-00'
	}); 
})

// Переключение табов
// demo
// button(data-tab-id="tabId1", data-tab-control="tab1") 1
// button(data-tab-id="tabId1", data-tab-control="tab2") 2
// .tab-block(data-tab-id="tabId1", data-tab-block="tab1") 1
// .tab-block(data-tab-id="tabId1", data-tab-block="tab2") 2
const tabIdList = document.querySelectorAll("[data-tab-id]");
if (tabIdList) {
	let tabGroupList = new Set();
	for (const tabId of tabIdList) {
		tabGroupList.add(tabId.dataset.tabId);
	}

	function tabSwith(name, tab, tabGroup) {
		for (const control of tab.controlList) control.classList.remove(activeClass);
		for (const block of tab.blockList) block.style.display = "none";
		document.querySelector(`[data-tab-id="${tabGroup}"][data-tab-control="${name}"]`).classList.add(activeClass);
		document.querySelector(`[data-tab-id="${tabGroup}"][data-tab-block="${name}"]`).style.display = "";
	}

	for (const tabGroup of tabGroupList) {
		const tab = {
			controlList: document.querySelectorAll(`[data-tab-id="${tabGroup}"][data-tab-control]`),
			blockList: document.querySelectorAll(`[data-tab-id="${tabGroup}"][data-tab-block]`),
		};
		// console.log(tab);
		tabSwith(tab.controlList[0].dataset.tabControl, tab, tabGroup);

		for (const control of tab.controlList) {
			control.addEventListener("click", () => {
				tabSwith(control.dataset.tabControl, tab, tabGroup);
			});
		}
	}
}

//sliders
const swiper = new Swiper('.swiper-oneslide', {
	// Optional parameters
	loop: true,
	speed: 500,

	// If we need pagination
	pagination: {
		el: '.swiper-pagination',
	},

	// Navigation arrows
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},
})

const cardsSwiper = new Swiper('.cards__slider .swiper-fourslide', {
	// Optional parameters
	loop: false,
	speed: 500,
	slidesPerView: 1,
	spaceBetween: 20,

	breakpoints: {
		500: {
			slidesPerView: 2,
		},
		700: {
			slidesPerView: 3,
		},
		1024: {
			slidesPerView: 4,
		}
	},

	// Navigation arrows
	navigation: {
		nextEl: '.cards__slider .swiper-button-next',
		prevEl: '.cards__slider .swiper-button-prev',
	},
})

const swiperWithoutPag = new Swiper('.slider-withone .swiper-container', {
	// Optional parameters
	loop: true,
	speed: 500,

	// Navigation arrows
	navigation: {
		nextEl: '.slider-withone .swiper-button-next',
		prevEl: '.slider-withone .swiper-button-prev',
	},
})

const thumbsSwiper = new Swiper('.swiper-thumbs', {
	// Optional parameters
	speed: 500,
	slidesPerView: 5,
	spaceBetween: 20,
})
const sliderWithThumbs = new Swiper('.swiper-with-thumbs', {
	// Optional parameters
	speed: 500,
	allowTouchMove: false,

	// Navigation arrows
	navigation: {
		nextEl: '.swiper-with-thumbs .swiper-button-next',
		prevEl: '.swiper-with-thumbs .swiper-button-prev',
	},
	thumbs: {
		swiper: thumbsSwiper,
	}
})

const toggleFullMenu = document.querySelector('[data-catalog-toggle]');
const fullMenu = document.querySelector('[data-full-menu');
const closeBtn = document.querySelector('[data-close]');
const searchBtn = document.querySelector('.search-form__btn');
const burgerBtn = document.querySelector('[data-burger]')
const moreBtn = document.querySelector('[data-more-text]');
const overlayForClose = document.querySelector('.overlay')
const body = document.body;

window.onclick = (event) => {
	//header

	if (event.target == toggleFullMenu) {
		fullMenu.classList.add('show')
		body.style.overflow = 'hidden'
	}

	if (event.target == closeBtn) {
		fullMenu.classList.remove('show')
		body.removeAttribute('style')
	}

	if (event.target == searchBtn) {
		searchBtn.nextElementSibling.classList.add('show')
	} else if (event.target !== searchBtn.nextElementSibling.childNodes[1]) {
		searchBtn.nextElementSibling.classList.remove('show')
	}

	if (event.target == burgerBtn) {
		const header = document.querySelector('.header')
		header.classList.toggle('active')

		if (header.classList.contains('active')) {
			body.style.overflow = 'hidden'
		} else {
			body.removeAttribute('style')
		}
	}

	//about block
	if (event.target == moreBtn) {
		moreBtn.previousElementSibling.classList.toggle('isOpen');

		if (moreBtn.previousElementSibling.classList.contains('isOpen')) {
			moreBtn.innerHTML = 'Свернуть'
		} else {
			moreBtn.innerHTML = 'Развернуть'
		}
	}
	
	// modal
	const modalTriggerButtons = document.querySelectorAll('[data-modal-trigger]');

	modalTriggerButtons.forEach((triggerModal) => {
		if (event.target == triggerModal) {
			const triggerData = triggerModal.getAttribute('data-modal-trigger')
			const modals = document.querySelectorAll('.modal')

			modals.forEach((modal) => {
				const modalId = modal.id
				modal.classList.remove('active')

				if (triggerData === modalId) {
					modal.classList.add('active')
					openedWindow(modal);
				}

				if (modal.classList.contains('active')) {
					closeWindow(modal)
				}
			})
		}
	})	
}

function openedWindow(elem) {
	if (elem.classList.contains('active')) {
		overlayForClose.classList.add('active')
		body.style.overflowY = 'hidden'
	}
}

function closeWindow(elem) {
	const closeModal = elem.querySelector('[data-close]')
	const cancelBtn = elem.querySelector('[data-cancel-btn]')

	closeModal.addEventListener('click', function() {
		elem.classList.remove('active')
		overlayForClose.classList.remove('active');
		body.removeAttribute('style')
	})

	overlayForClose.addEventListener('click', function(event) {
		elem.classList.remove('active')
		overlayForClose.classList.remove('active')
		body.removeAttribute('style')
	})

	if (cancelBtn) {
		cancelBtn.addEventListener('click', function() {
			elem.classList.remove('active')
			overlayForClose.classList.remove('active');
			body.removeAttribute('style')
		})
	}
}

//popup
function popup() {
	const selectCity = document.querySelector('#select-city');
	const selectCityBtns = document.querySelectorAll('[data-modal-trigger="select-city"]');
	
	openedWindow(selectCity)
	closeWindow(selectCity)
	
	
	selectCityBtns.forEach((item) => {
		item.addEventListener('click', function() {
			selectCity.classList.add('active')
			openedWindow(selectCity)
			closeWindow(selectCity)
		})
	})
}

popup()


// accordion
if (document.querySelectorAll('.accordion').length) {
	const newBtn = document.querySelectorAll('.accordion__btn');
	const accordions = document.querySelectorAll('.accordion');

	accordions.forEach((accordion) => {
		new Accordion(accordion);

		// newBtn.forEach((item) => {
		// 	item.addEventListener('click', function() {
		// 		accordion.open()
		// 	})
		// })
	})
}


// input
const fileFields = document.querySelectorAll('[data-file-field]');

fileFields.forEach((item) => {
	const label = item.querySelector('label span');
	const input = item.querySelector('input[type="file"]');

	input.addEventListener('change', () => {
		label.innerHTML = input.files[0].name
	})
})
