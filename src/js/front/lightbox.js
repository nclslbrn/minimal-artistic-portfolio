import baguetteBox from 'baguettebox.js';

export default function () {
	const container = document.querySelectorAll(".wp-block-gallery, .entry-content:has(.fluidbox)");
	const options = {
		leftArrow: '<span>←</span>',
		rightArrow: '<span>→</span>',
		closeX: '<span>✕</span>'
	}
	if (container.length > 0) {
		baguetteBox.run('.wp-block-gallery, .entry-content:has(.fluidbox)', options)
	}
}
