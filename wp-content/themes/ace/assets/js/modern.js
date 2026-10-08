/**
 * TechDotBit UI enhancements: scroll progress, compact header, scroll
 * reveal and card spotlight. Vanilla JS, no dependencies.
 */
(function () {
	'use strict';

	var root = document.documentElement;
	var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	root.classList.add('tdb-js');

	/* Scroll progress + compact header */
	var bar = document.createElement('div');
	bar.className = 'tdb-progress';
	bar.setAttribute('aria-hidden', 'true');
	document.body.appendChild(bar);

	var ticking = false;
	function onScroll() {
		if (ticking) return;
		ticking = true;
		window.requestAnimationFrame(function () {
			var max = root.scrollHeight - window.innerHeight;
			var y = window.pageYOffset || root.scrollTop;
			root.style.setProperty('--tdb-progress', max > 0 ? Math.min(1, y / max).toFixed(4) : 0);
			root.classList.toggle('tdb-scrolled', y > 40);
			ticking = false;
		});
	}
	window.addEventListener('scroll', onScroll, { passive: true });
	onScroll();

	/* Scroll cue on the home hero */
	var hero = document.querySelector('.home .banner');
	if (hero) {
		var cue = document.createElement('span');
		cue.className = 'tdb-scroll-cue';
		cue.setAttribute('aria-hidden', 'true');
		hero.appendChild(cue);
	}

	/* Scroll reveal for blocks the theme does not already animate */
	var selectors = [
		'.blog .article',
		'.related-post > div',
		'#portfolio-list .portfolio-item',
		'.footer-top .col',
		'#site-footer .module-top .col',
		'.faq-list > li',
		'.contact-form',
		'.single-blog-post .entry-content > *',
		'.lqd-section .ld-fancy-heading'
	];
	var items = [];
	selectors.forEach(function (sel) {
		document.querySelectorAll(sel).forEach(function (el) {
			// Leave elements the Liquid theme already animates alone.
			if (el.closest('[data-custom-animations], [data-split-text], .carousel-items, .banner')) return;
			if (el.querySelector('[data-custom-animations], [data-split-text]')) return;
			if (items.indexOf(el) === -1) items.push(el);
		});
	});

	if (!reduceMotion && 'IntersectionObserver' in window && items.length) {
		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-in');
					io.unobserve(entry.target);
				}
			});
		}, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });

		items.forEach(function (el) {
			// Stagger siblings that share a parent.
			var siblings = Array.prototype.filter.call(el.parentNode.children, function (c) { return items.indexOf(c) !== -1; });
			var index = siblings.indexOf(el);
			el.style.setProperty('--tdb-delay', Math.min(index, 6) * 0.08 + 's');
			el.setAttribute('data-tdb-reveal', '');
			io.observe(el);
		});
	}

	/* Cursor spotlight on service cards */
	if (!reduceMotion && window.matchMedia('(hover: hover)').matches) {
		document.addEventListener('pointermove', function (e) {
			var card = e.target.closest && e.target.closest('.services .iconbox');
			if (!card) return;
			var r = card.getBoundingClientRect();
			card.style.setProperty('--mx', (e.clientX - r.left) + 'px');
			card.style.setProperty('--my', (e.clientY - r.top) + 'px');
		}, { passive: true });
	}
})();
