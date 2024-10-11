import baguetteBox from 'baguettebox.js';

export default function () {
	const imageLink = document.querySelectorAll(".wp-block-gallery");
	const options = {
		leftArrow: '<span>←</span>',
		rightArrow: '<span>→</span>',
		closeX: '<span>✕</span>'
	}
	if (imageLink.length > 0) {
		baguetteBox.run('.wp-block-gallery', options)
	}
}
