// ------------------------------------------------------ //
// Custom carousel on homepage
// ------------------------------------------------------ //

const next = document.querySelector('.next');
const prev = document.querySelector('.prev');
const slider = document.querySelector('.slider');

if (next && prev && slider) {
	let elementsCount = userPhoto.length;
	let current = 1;
	let slideWidth = 533;
	let shift = 0;

	next.addEventListener('click', () => {
		if (current < elementsCount) {
			slider.classList.toggle('move');
			shift += slideWidth;
			slider.style.transform = `translateX(-${shift}px)`;
			current++;
		} else {
			shift = 0;
			current = 1;
			slider.style.transform = `translateX(${shift}px)`;
		};
	});

	prev.addEventListener('click', () => {
		if (current > 1) {
			slider.classList.toggle('move');
			shift -= slideWidth;
			current--;
			slider.style.transform = `translateX(-${shift}px)`;
		} else if (current === 1) {
			shift = elementsCount * slideWidth - slideWidth;
			slider.classList.toggle('move');
			slider.style.transform = `translateX(-${shift}px)`;
			current = elementsCount;
		};
	});
}