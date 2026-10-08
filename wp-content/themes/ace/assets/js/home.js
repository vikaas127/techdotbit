/* Homepage sections: reveal on scroll, capability explorer, agent task logs. */
(function () {
	'use strict';
	var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

	// Reveal sections once they enter the viewport.
	var sections = document.querySelectorAll('[data-tdb-inview]');
	if (!('IntersectionObserver' in window) || reduce) {
		sections.forEach(function (s) { s.classList.add('is-in'); });
	} else {
		var io = new IntersectionObserver(function (entries) {
			entries.forEach(function (e) {
				if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); }
			});
		}, { threshold: 0.15 });
		sections.forEach(function (s) { io.observe(s); });
	}

	// Capability explorer: tabs that auto-advance, pause on hover/focus.
	document.querySelectorAll('[data-tdb-caps]').forEach(function (wrap) {
		var tabs = Array.prototype.slice.call(wrap.querySelectorAll('[role="tab"]'));
		var panels = Array.prototype.slice.call(wrap.querySelectorAll('[role="tabpanel"]'));
		var cur = 0, timer = null, wait = 6000;
		wrap.style.setProperty('--tdb-caps-time', wait / 1000 + 's');
		function show(i) {
			cur = (i + tabs.length) % tabs.length;
			tabs.forEach(function (t, k) { t.setAttribute('aria-selected', k === cur ? 'true' : 'false'); t.tabIndex = k === cur ? 0 : -1; });
			panels.forEach(function (p, k) { p.classList.toggle('is-active', k === cur); });
		}
		function play() { if (reduce) return; stop(); timer = setInterval(function () { show(cur + 1); }, wait); }
		function stop() { clearInterval(timer); }
		tabs.forEach(function (t, k) {
			t.addEventListener('click', function () { show(k); play(); });
			t.addEventListener('keydown', function (e) {
				if (e.key === 'ArrowDown' || e.key === 'ArrowRight') { e.preventDefault(); show(cur + 1); tabs[cur].focus(); }
				if (e.key === 'ArrowUp' || e.key === 'ArrowLeft') { e.preventDefault(); show(cur - 1); tabs[cur].focus(); }
			});
		});
		wrap.addEventListener('mouseenter', function () { stop(); wrap.classList.add('is-paused'); });
		wrap.addEventListener('mouseleave', function () { wrap.classList.remove('is-paused'); play(); });
		show(0); play();
	});

	// Agent cards: tick through each task (running -> done), then restart.
	document.querySelectorAll('[data-tdb-ticker]').forEach(function (card, n) {
		var items = card.querySelectorAll('li');
		if (!items.length) return;
		if (reduce) { items.forEach(function (li) { li.classList.add('is-done'); }); return; }
		var step = 0;
		function tick() {
			if (step === items.length) {
				setTimeout(function () {
					items.forEach(function (li) { li.classList.remove('is-run', 'is-done'); });
					step = 0; tick();
				}, 2200);
				return;
			}
			items[step].classList.add('is-run');
			setTimeout(function () {
				items[step].classList.remove('is-run');
				items[step].classList.add('is-done');
				step++; tick();
			}, 1300 + Math.random() * 700);
		}
		setTimeout(tick, 400 + n * 350);
	});
})();
