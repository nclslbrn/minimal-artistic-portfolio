export default function () {
	const gallery = document.querySelector(".ext-gallery");
	if (null !== gallery && window.innerHeight < window.innerWidth) {
		gallery.onwheel = (event) => {
			event.preventDefault();
			gallery.scrollLeft += event.deltaY;
		};
	}
}
