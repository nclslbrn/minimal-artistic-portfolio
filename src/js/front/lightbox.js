import baguetteBox from "baguettebox.js";

export default function () {
	const container = document.querySelectorAll(
		".wp-block-gallery, .entry-content:has(.fluidbox)",
	);
	const options = {
		leftArrow:
			'<svg class="icon icon-chevron-left"><use xlink:href="#icon-chevron-left"></use></svg>',
		rightArrow:
			'<svg class="icon icon-chevron-right"><use xlink:href="#icon-chevron-right"></use></svg>',
		closeX:
			'<svg class="icon icon-times"><use xlink:href="#icon-times"></use></svg>',
	};
	if (container.length > 0) {
		baguetteBox.run(
			".wp-block-gallery, .entry-content:has(.fluidbox)",
			options,
		);
	}
}
