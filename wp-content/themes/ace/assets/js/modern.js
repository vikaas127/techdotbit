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

	/* Neural-network canvas behind every page hero */
	document.querySelectorAll('.banner').forEach(function (banner) {
		var canvas = document.createElement('canvas');
		canvas.className = 'tdb-neural';
		canvas.setAttribute('aria-hidden', 'true');
		banner.insertBefore(canvas, banner.firstChild);
		var ctx = canvas.getContext('2d');
		if (!ctx) return;

		var dpr = Math.min(window.devicePixelRatio || 1, 2);
		var nodes = [], w = 0, h = 0, raf = null, visible = true;
		var pointer = { x: -9999, y: -9999 };
		var colors = ['139,92,246', '99,102,241', '34,211,238', '52,211,153'];

		function size() {
			var r = banner.getBoundingClientRect();
			w = r.width; h = r.height;
			canvas.width = w * dpr; canvas.height = h * dpr;
			ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
			var count = Math.max(24, Math.min(90, Math.round(w * h / 15000)));
			nodes = [];
			for (var i = 0; i < count; i++) {
				nodes.push({
					// Keep most nodes on the right so text stays readable.
					x: w * (0.35 + Math.random() * 0.65),
					y: Math.random() * h,
					vx: (Math.random() - 0.5) * 0.35,
					vy: (Math.random() - 0.5) * 0.35,
					r: 1.4 + Math.random() * 2,
					c: colors[i % colors.length]
				});
			}
		}

		function draw() {
			ctx.clearRect(0, 0, w, h);
			var max = Math.min(160, w / 7);
			for (var i = 0; i < nodes.length; i++) {
				var a = nodes[i];
				for (var j = i + 1; j < nodes.length; j++) {
					var b = nodes[j], dx = a.x - b.x, dy = a.y - b.y, d = Math.sqrt(dx * dx + dy * dy);
					if (d < max) {
						ctx.strokeStyle = 'rgba(' + a.c + ',' + (0.38 * (1 - d / max)).toFixed(3) + ')';
						ctx.lineWidth = 1;
						ctx.beginPath(); ctx.moveTo(a.x, a.y); ctx.lineTo(b.x, b.y); ctx.stroke();
					}
				}
				var pd = Math.hypot(a.x - pointer.x, a.y - pointer.y);
				var glow = pd < 140 ? 1 - pd / 140 : 0;
				ctx.fillStyle = 'rgba(' + a.c + ',' + (0.75 + glow * 0.25).toFixed(3) + ')';
				ctx.beginPath(); ctx.arc(a.x, a.y, a.r + glow * 2, 0, Math.PI * 2); ctx.fill();
			}
		}

		function step() {
			for (var i = 0; i < nodes.length; i++) {
				var n = nodes[i];
				n.x += n.vx; n.y += n.vy;
				if (n.x < w * 0.25 || n.x > w) n.vx *= -1;
				if (n.y < 0 || n.y > h) n.vy *= -1;
			}
			draw();
			raf = visible && !document.hidden ? window.requestAnimationFrame(step) : null;
		}
		function start() { if (!raf && !reduceMotion) raf = window.requestAnimationFrame(step); }

		size(); draw();
		window.addEventListener('resize', function () { size(); draw(); }, { passive: true });
		banner.addEventListener('pointermove', function (e) {
			var r = banner.getBoundingClientRect();
			pointer.x = e.clientX - r.left; pointer.y = e.clientY - r.top;
		}, { passive: true });
		banner.addEventListener('pointerleave', function () { pointer.x = pointer.y = -9999; });
		if ('IntersectionObserver' in window) {
			new IntersectionObserver(function (en) { visible = en[0].isIntersecting; if (visible) start(); }).observe(banner);
		}
		document.addEventListener('visibilitychange', function () { if (!document.hidden) start(); });
		start();
	});

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
