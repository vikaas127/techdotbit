/**
 * Glossy 3D "knot" drawn on a canvas for the AI Landing Page hero.
 * A (2,5) torus knot is rotated in 3D, cut into short segments, sorted
 * back-to-front and each segment is stroked in layers (dark rim -> body ->
 * light -> specular line) so it reads as a smooth shiny tube.
 * No WebGL or libraries; pauses off-screen and respects reduced motion.
 */
(function () {
	'use strict';

	var canvas = document.querySelector('.tdb-orb');
	if (!canvas || !canvas.getContext) return;
	var ctx = canvas.getContext('2d');
	var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	var dpr = Math.min(window.devicePixelRatio || 1, 2);

	// Brand palette along the tube: green -> emerald -> teal -> cyan -> lime -> green.
	var palette = [[62, 173, 60], [16, 185, 129], [20, 184, 166], [34, 211, 238], [132, 204, 22], [62, 173, 60]];
	function colorAt(t) {
		var x = t * (palette.length - 1), i = Math.floor(x), f = x - i, a = palette[i], b = palette[Math.min(i + 1, palette.length - 1)];
		return [a[0] + (b[0] - a[0]) * f, a[1] + (b[1] - a[1]) * f, a[2] + (b[2] - a[2]) * f];
	}
	function rgb(c, k, alpha) {
		return 'rgba(' + Math.round(Math.min(255, c[0] * k)) + ',' + Math.round(Math.min(255, c[1] * k)) + ',' + Math.round(Math.min(255, c[2] * k)) + ',' + (alpha == null ? 1 : alpha) + ')';
	}

	var N = 720, SEG = 6, P = 2, Q = 5;
	// [width, brightness] from the rim inwards: a soft cylindrical gradient.
	var LAYERS = [[1, .28], [.92, .42], [.83, .56], [.73, .7], [.62, .84], [.5, .98], [.38, 1.12], [.26, 1.28]];
	var base = [], pts = new Array(N), segs = [];
	for (var i = 0; i < N; i++) {
		var t = i / N * Math.PI * 2, rr = 1 + 0.45 * Math.cos(Q * t);
		base.push({ x: rr * Math.cos(P * t), y: rr * Math.sin(P * t), z: 0.72 * Math.sin(Q * t), c: colorAt(i / N) });
	}
	for (var s = 0; s < N; s += SEG) segs.push({ from: s, z: 0 });

	var w, h, cx, cy, scale;
	function resize() {
		var rect = canvas.getBoundingClientRect();
		w = rect.width; h = rect.height;
		canvas.width = Math.round(w * dpr); canvas.height = Math.round(h * dpr);
		ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
		cx = w * 0.6; cy = h * 0.56;
		scale = Math.min(w, h) * 0.28;
	}

	function frame(time) {
		var t = (time || 0) / 1000;
		var ay = t * 0.16, ax = 0.95 + Math.sin(t * 0.19) * 0.22, az = t * 0.06;
		var sy = Math.sin(ay), cyy = Math.cos(ay), sx = Math.sin(ax), cxx = Math.cos(ax), sz = Math.sin(az), czz = Math.cos(az);
		for (var i = 0; i < N; i++) {
			var p = base[i];
			var x = p.x * czz - p.y * sz, y = p.x * sz + p.y * czz, z = p.z;
			var x2 = x * cyy + z * sy, z2 = -x * sy + z * cyy;
			var y3 = y * cxx - z2 * sx, z3 = y * sx + z2 * cxx;
			var persp = 3.4 / (3.4 + z3);
			pts[i] = { x: cx + x2 * scale * persp, y: cy + y3 * scale * persp, z: z3, s: persp };
		}
		for (var k = 0; k < segs.length; k++) {
			var a = pts[segs[k].from], b = pts[(segs[k].from + SEG) % N];
			segs[k].z = (a.z + b.z) / 2;
		}
		segs.sort(function (m, n) { return n.z - m.z; });

		ctx.clearRect(0, 0, w, h);
		ctx.lineCap = 'butt';
		ctx.lineJoin = 'round';
		var tube = scale * 0.30;
		for (var j = 0; j < segs.length; j++) {
			var from = segs[j].from, mid = pts[(from + (SEG >> 1)) % N];
			var depth = Math.max(0, Math.min(1, (segs[j].z + 1.4) / 2.8)); // 0 near, 1 far
			var light = 1.12 - depth * 0.55;
			var col = base[from].c, wdt = tube * mid.s;

			// Overlap neighbours by two samples with flat ends so joints vanish.
			var st = pts[(from - 2 + N) % N];
			ctx.beginPath();
			ctx.moveTo(st.x, st.y);
			for (var q = -1; q <= SEG + 2; q++) {
				var pt = pts[(from + q + N) % N];
				ctx.lineTo(pt.x, pt.y);
			}
			// rim, body, light core, specular line (offset up-left)
			for (var L = 0; L < LAYERS.length; L++) {
				ctx.strokeStyle = rgb(col, LAYERS[L][1] * light);
				ctx.lineWidth = wdt * LAYERS[L][0];
				ctx.stroke();
			}
			ctx.save();
			ctx.translate(-wdt * 0.12, -wdt * 0.14);
			ctx.strokeStyle = 'rgba(255,255,255,' + (0.55 * (1 - depth * 0.7)).toFixed(3) + ')';
			ctx.lineWidth = wdt * 0.13;
			ctx.stroke();
			ctx.restore();
		}
	}

	var running = false, visible = true;
	function loop(time) {
		frame(time);
		running = visible && !document.hidden && !reduce;
		if (running) window.requestAnimationFrame(loop);
	}
	function start() { if (!running && !reduce) { running = true; window.requestAnimationFrame(loop); } }

	resize(); frame(4000);
	canvas.classList.add('is-ready');
	window.addEventListener('resize', function () { resize(); frame(performance.now()); }, { passive: true });
	if ('IntersectionObserver' in window) {
		new IntersectionObserver(function (e) { visible = e[0].isIntersecting; if (visible) start(); }).observe(canvas);
	}
	document.addEventListener('visibilitychange', function () { if (!document.hidden) start(); });
	start();
})();

/**
 * Style B: glowing light streaks orbiting on concentric arcs.
 */
(function () {
	'use strict';
	var canvas = document.querySelector('.tdb-streaks');
	if (!canvas || !canvas.getContext) return;
	var ctx = canvas.getContext('2d');
	var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	var dpr = Math.min(window.devicePixelRatio || 1, 2);
	var w, h, cx, cy, rings = [];

	function resize() {
		var r = canvas.getBoundingClientRect();
		w = r.width; h = r.height;
		canvas.width = Math.round(w * dpr); canvas.height = Math.round(h * dpr);
		ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
		cx = w * 0.62; cy = h * 0.5;
		rings = [];
		var max = Math.max(w, h) * 0.75;
		for (var i = 0; i < 16; i++) {
			rings.push({
				r: max * (0.18 + i / 16 * 0.82),
				squash: 0.82 + (i % 3) * 0.06,
				start: Math.random() * Math.PI * 2,
				speed: (0.05 + Math.random() * 0.12) * (i % 2 ? 1 : -1),
				len: 0.18 + Math.random() * 0.35,
				hue: i % 4 === 0 ? '47,158,58' : '13,148,136',
				bright: i % 3 !== 1
			});
		}
	}

	function draw(time) {
		var t = (time || 0) / 1000;
		ctx.clearRect(0, 0, w, h);
		ctx.lineCap = 'round';
		for (var i = 0; i < rings.length; i++) {
			var g = rings[i];
			ctx.save();
			ctx.translate(cx, cy);
			ctx.scale(1, g.squash);
			// faint full ring
			ctx.strokeStyle = 'rgba(100,116,139,0.08)';
			ctx.lineWidth = 1;
			ctx.beginPath(); ctx.arc(0, 0, g.r, 0, Math.PI * 2); ctx.stroke();
			if (g.bright) {
				// comet: tail fades into the head
				var head = g.start + t * g.speed, steps = 14, dir = g.speed > 0 ? -1 : 1;
				for (var k = 0; k < steps; k++) {
					var a0 = head + dir * g.len * (k / steps), a1 = head + dir * g.len * ((k + 1) / steps);
					var alpha = (1 - k / steps);
					ctx.strokeStyle = 'rgba(' + g.hue + ',' + (0.85 * alpha * alpha).toFixed(3) + ')';
					ctx.lineWidth = 2.2 * alpha + 0.4;
					ctx.beginPath();
					ctx.arc(0, 0, g.r, Math.min(a0, a1), Math.max(a0, a1));
					ctx.stroke();
				}
				// glow at the head
				ctx.strokeStyle = 'rgba(' + g.hue + ',0.18)';
				ctx.lineWidth = 8;
				ctx.beginPath(); ctx.arc(0, 0, g.r, head - 0.03, head + 0.03); ctx.stroke();
			}
			ctx.restore();
		}
	}

	var running = false, visible = true;
	function loop(time) { draw(time); running = visible && !document.hidden && !reduce; if (running) requestAnimationFrame(loop); }
	function start() { if (!running && !reduce) { running = true; requestAnimationFrame(loop); } }
	resize(); draw(2500);
	window.addEventListener('resize', function () { resize(); draw(performance.now()); }, { passive: true });
	if ('IntersectionObserver' in window) new IntersectionObserver(function (e) { visible = e[0].isIntersecting; if (visible) start(); }).observe(canvas);
	document.addEventListener('visibilitychange', function () { if (!document.hidden) start(); });
	start();
})();

/**
 * Style C: type the prompt text in the agents panel (text is already in the
 * HTML, so it is readable without JavaScript).
 */
(function () {
	'use strict';
	var el = document.querySelector('.tdb-prompt__text');
	if (!el || (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches)) return;
	var text = el.getAttribute('data-text') || el.textContent, i = 0;
	el.textContent = '';
	function type() {
		el.textContent = text.slice(0, ++i);
		if (i < text.length) setTimeout(type, 38 + Math.random() * 40);
	}
	setTimeout(type, 400);
})();

/**
 * Accessible tabs for the dashboard showcase.
 */
(function () {
	'use strict';
	document.querySelectorAll('[data-tdb-tabs]').forEach(function (root) {
		var tabs = Array.prototype.slice.call(root.querySelectorAll('[role="tab"]'));
		function select(tab) {
			tabs.forEach(function (t) {
				var on = t === tab;
				t.setAttribute('aria-selected', on ? 'true' : 'false');
				t.tabIndex = on ? 0 : -1;
				var panel = document.getElementById(t.getAttribute('aria-controls'));
				if (panel) panel.hidden = !on;
			});
		}
		tabs.forEach(function (tab, i) {
			tab.addEventListener('click', function () { select(tab); });
			tab.addEventListener('keydown', function (e) {
				var next = e.key === 'ArrowRight' ? tabs[(i + 1) % tabs.length] : e.key === 'ArrowLeft' ? tabs[(i - 1 + tabs.length) % tabs.length] : null;
				if (next) { e.preventDefault(); select(next); next.focus(); }
			});
		});
	});
})();

/**
 * AI agent workflow: light up each step in turn (Understand -> ... -> Learn)
 * while the section is on screen.
 */
(function () {
	'use strict';
	var flow = document.querySelector('[data-tdb-loop]');
	if (!flow || (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches)) return;
	var steps = flow.querySelectorAll('.tdb-loop__step');
	var i = 0, timer = null;
	function tick() {
		steps.forEach(function (s) { s.classList.remove('is-active'); });
		steps[i].classList.add('is-active');
		i = (i + 1) % steps.length;
	}
	function start() { if (!timer) { tick(); timer = setInterval(tick, 1300); } }
	function stop() { clearInterval(timer); timer = null; }
	if ('IntersectionObserver' in window) {
		new IntersectionObserver(function (e) { if (e[0].isIntersecting) start(); else stop(); }, { threshold: 0.25 }).observe(flow);
	} else {
		start();
	}
})();

/**
 * Homepage agent console: type the request, run each step (lighting up the
 * tool it uses), show the verified result, then replay while on screen.
 */
(function () {
	'use strict';
	var root = document.querySelector('[data-tdb-console]');
	if (!root) return;
	var typed = root.querySelector('.tdb-console__typed');
	var steps = Array.prototype.slice.call(root.querySelectorAll('.tdb-console__steps li'));
	var tools = root.querySelectorAll('.tdb-console__tools span');
	var text = typed.getAttribute('data-text') || '';
	var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	var timers = [], visible = true, running = false;

	function later(fn, ms) { timers.push(setTimeout(fn, ms)); }
	function setTool(name) { tools.forEach(function (t) { t.classList.toggle('is-on', t.getAttribute('data-tool') === name); }); }
	function finalState() {
		typed.textContent = text;
		steps.forEach(function (s) { s.className = 'is-done'; });
		setTool(null);
		root.classList.add('is-complete');
	}
	if (reduce) { finalState(); return; }

	function run() {
		running = true;
		timers.forEach(clearTimeout); timers = [];
		root.classList.remove('is-complete');
		steps.forEach(function (s) { s.className = ''; });
		setTool(null);
		typed.textContent = '';
		var t = 300;
		for (var i = 1; i <= text.length; i++) {
			(function (n) { later(function () { typed.textContent = text.slice(0, n); }, t); })(i);
			t += 32;
		}
		t += 400;
		steps.forEach(function (s, idx) {
			later(function () { s.className = 'is-running'; setTool(s.getAttribute('data-tool')); }, t);
			t += 1100;
			later(function () { s.className = 'is-done'; }, t);
			t += 150;
		});
		later(function () { setTool(null); root.classList.add('is-complete'); }, t);
		later(function () { running = false; if (visible && !document.hidden) run(); }, t + 4200);
	}
	if ('IntersectionObserver' in window) {
		new IntersectionObserver(function (e) { visible = e[0].isIntersecting; if (visible && !running) run(); }).observe(root);
	} else {
		run();
	}
})();

/**
 * "How AI agents work": highlight each step in turn; the systems on the
 * right light up while the Execute step is active.
 */
(function () {
	'use strict';
	var root = document.querySelector('[data-tdb-how]');
	if (!root || (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches)) return;
	var steps = root.querySelectorAll('.tdb-how__step');
	var out = root.querySelector('.tdb-how__side--out');
	var i = 0, timer = null;
	function tick() {
		steps.forEach(function (s) { s.classList.remove('is-active'); });
		steps[i].classList.add('is-active');
		if (out) out.classList.toggle('is-live', i === 3);
		i = (i + 1) % steps.length;
	}
	function start() { if (!timer) { tick(); timer = setInterval(tick, 1600); } }
	function stop() { clearInterval(timer); timer = null; }
	if ('IntersectionObserver' in window) {
		new IntersectionObserver(function (e) { if (e[0].isIntersecting) start(); else stop(); }, { threshold: 0.2 }).observe(root);
	} else { start(); }
})();

/**
 * Reveal workflow chains (use cases, demonstrations) step by step when they
 * scroll into view.
 */
(function () {
	'use strict';
	var items = document.querySelectorAll('[data-tdb-reveal-chain]');
	if (!items.length) return;
	if (!('IntersectionObserver' in window) || (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches)) {
		items.forEach(function (el) { el.classList.add('is-in'); });
		return;
	}
	var io = new IntersectionObserver(function (entries) {
		entries.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); } });
	}, { threshold: 0.35 });
	items.forEach(function (el) { io.observe(el); });
})();
