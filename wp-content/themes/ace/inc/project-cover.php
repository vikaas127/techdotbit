<?php
/**
 * Designed cover art for portfolio projects (instead of stock photos):
 * a gradient chosen by project category with an animated UI mockup
 * (browser, phone, dashboard, AI network or health monitor).
 */
if ( ! function_exists( 'ace_project_cover' ) ) {

	/** Cover type and colours for a project, from its category and title. */
	function ace_project_cover_type( $post_id ) {
		$names = array();
		foreach ( array( 'tagportfolio', 'category', 'post_tag' ) as $tax ) {
			$terms = get_the_terms( $post_id, $tax );
			if ( $terms && ! is_wp_error( $terms ) ) {
				$names = array_merge( $names, wp_list_pluck( $terms, 'name' ) );
			}
		}
		$hay = strtolower( get_the_title( $post_id ) . ' ' . implode( ' ', $names ) );
		$map = array(
			'ml'       => array( '/machine|\bai\b|ai-|\bgpt|llm|prompt|chatbot|agent|neural|vision|predict|detect|surveillance|algorithm|alaya|enterprise ai/', 'network', '#1e1b4b', '#7c3aed' ),
			'crypto'   => array( '/crypto|bitcoin|blockchain|coin|token|stock|trading|fintech|\bxdc\b|axelar|bitfury|riot|bigg|fintechzoom|finance/', 'chart', '#14532d', '#eab308' ),
			'health'   => array( '/health|medic|clinic|hospital|patient/', 'pulse', '#0e7490', '#34d399' ),
			'erp'      => array( '/\berp\b|crm|inventory|manufactur|production|msme|tally|management system|dashboard|employee|portal|exam/', 'dashboard', '#0f172a', '#0e9488' ),
			'cloud'    => array( '/cloud|aws|azure|devops|server|hosting|kubernetes|docker/', 'cloud', '#0c4a6e', '#38bdf8' ),
			'security' => array( '/security|privacy|cyber|hack|secure|policy/', 'shield', '#1f2937', '#22c55e' ),
			'seo'      => array( '/seo|backlink|marketing|ranking|growth|google/', 'growth', '#3b0764', '#f472b6' ),
			'fleet'    => array( '/fleet|gps|avl|tracking|logistic|vehicle|parking/', 'map', '#064e3b', '#10b981' ),
			'stream'   => array( '/stream|video|live/', 'phone', '#7f1d1d', '#f43f5e' ),
			'dating'   => array( '/dating|match/', 'phone', '#831843', '#f472b6' ),
			'social'   => array( '/social|community|chat/', 'phone', '#1e3a8a', '#38bdf8' ),
			'food'     => array( '/food|restaurant|delivery|grocery/', 'phone', '#9a3412', '#f59e0b' ),
			'mobile'   => array( '/mobile|\bapp\b|apps|android|ios|flutter|react native/', 'phone', '#3730a3', '#06b6d4' ),
			'code'     => array( '/javascript|react|python|php|laravel|framework|code|developer|wordpress|node|programming|software|hire/', 'code', '#0f172a', '#3ead3c' ),
			'web'      => array( '/web|platform|website|renting|booking|ecommerce/', 'browser', '#065f46', '#22c55e' ),
		);
		foreach ( $map as $key => $m ) {
			if ( preg_match( $m[0], $hay ) ) {
				return array( 'key' => $key, 'mock' => $m[1], 'c1' => $m[2], 'c2' => $m[3] );
			}
		}
		return array( 'key' => 'web', 'mock' => 'browser', 'c1' => '#065f46', 'c2' => '#22c55e' );
	}

	/** Cover HTML (inline SVG, no image request). */
	function ace_project_cover( $post_id ) {
		$t    = ace_project_cover_type( $post_id );
		$seed = (int) $post_id;
		$v    = function ( $i, $min, $max ) use ( $seed ) {
			return $min + ( ( $seed * 37 + $i * 53 ) % ( $max - $min + 1 ) );
		};
		$uid  = 'pc' . $seed . wp_rand( 10, 99 );
		ob_start();
		?>
		<span class="tdb-cover tdb-cover--<?php echo esc_attr( $t['mock'] ); ?>" style="--c1: <?php echo esc_attr( $t['c1'] ); ?>; --c2: <?php echo esc_attr( $t['c2'] ); ?>;" aria-hidden="true">
			<svg viewBox="0 0 400 250" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
				<defs>
					<linearGradient id="<?php echo esc_attr( $uid ); ?>g" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="<?php echo esc_attr( $t['c1'] ); ?>"/><stop offset="1" stop-color="<?php echo esc_attr( $t['c2'] ); ?>"/></linearGradient>
					<pattern id="<?php echo esc_attr( $uid ); ?>d" width="16" height="16" patternUnits="userSpaceOnUse"><circle cx="1.5" cy="1.5" r="1.2" fill="rgba(255,255,255,.14)"/></pattern>
				</defs>
				<rect width="400" height="250" fill="url(#<?php echo esc_attr( $uid ); ?>g)"/>
				<rect width="400" height="250" fill="url(#<?php echo esc_attr( $uid ); ?>d)"/>
				<circle class="tdb-cover__orb" cx="<?php echo (int) $v( 1, 300, 360 ); ?>" cy="40" r="90" fill="rgba(255,255,255,.10)"/>
				<circle class="tdb-cover__orb tdb-cover__orb--2" cx="40" cy="230" r="70" fill="rgba(255,255,255,.08)"/>

				<?php if ( 'browser' === $t['mock'] ) : ?>
					<g class="tdb-cover__float">
						<rect x="70" y="38" width="260" height="176" rx="12" fill="#fff"/>
						<rect x="70" y="38" width="260" height="24" rx="12" fill="#f1f5f9"/><rect x="70" y="50" width="260" height="12" fill="#f1f5f9"/>
						<circle cx="86" cy="50" r="3.5" fill="#f87171"/><circle cx="98" cy="50" r="3.5" fill="#fbbf24"/><circle cx="110" cy="50" r="3.5" fill="#4ade80"/>
						<rect x="130" y="45" width="120" height="10" rx="5" fill="#e2e8f0"/>
						<rect x="86" y="76" width="<?php echo (int) $v( 2, 90, 130 ); ?>" height="12" rx="4" fill="<?php echo esc_attr( $t['c1'] ); ?>"/>
						<rect x="86" y="96" width="140" height="7" rx="3.5" fill="#cbd5e1"/><rect x="86" y="109" width="110" height="7" rx="3.5" fill="#e2e8f0"/>
						<rect class="tdb-cover__btn" x="86" y="126" width="56" height="16" rx="8" fill="<?php echo esc_attr( $t['c2'] ); ?>"/>
						<rect x="240" y="74" width="74" height="70" rx="10" fill="<?php echo esc_attr( $t['c2'] ); ?>" opacity=".25"/>
						<circle class="tdb-cover__pop" cx="277" cy="109" r="18" fill="<?php echo esc_attr( $t['c2'] ); ?>" opacity=".7"/>
						<?php for ( $i = 0; $i < 3; $i++ ) : ?>
							<rect x="<?php echo 86 + $i * 78; ?>" y="158" width="70" height="42" rx="8" fill="#f8fafc" stroke="#e2e8f0"/>
							<rect x="<?php echo 94 + $i * 78; ?>" y="167" width="20" height="20" rx="6" fill="<?php echo esc_attr( $t['c2'] ); ?>" opacity=".35"/>
							<rect x="<?php echo 120 + $i * 78; ?>" y="170" width="28" height="5" rx="2.5" fill="#cbd5e1"/><rect x="<?php echo 120 + $i * 78; ?>" y="180" width="20" height="5" rx="2.5" fill="#e2e8f0"/>
						<?php endfor; ?>
					</g>

				<?php elseif ( 'phone' === $t['mock'] ) : ?>
					<g class="tdb-cover__float">
						<rect x="150" y="22" width="104" height="206" rx="18" fill="#0f172a"/>
						<rect x="156" y="28" width="92" height="194" rx="13" fill="#fff"/>
						<rect x="186" y="32" width="32" height="6" rx="3" fill="#0f172a"/>
						<rect x="164" y="48" width="76" height="46" rx="9" fill="<?php echo esc_attr( $t['c2'] ); ?>" opacity=".85"/>
						<circle cx="180" cy="64" r="7" fill="#fff" opacity=".85"/><rect x="192" y="60" width="38" height="5" rx="2.5" fill="#fff" opacity=".85"/><rect x="172" y="78" width="54" height="5" rx="2.5" fill="#fff" opacity=".6"/>
						<?php for ( $i = 0; $i < 4; $i++ ) : ?>
							<g class="tdb-cover__row" style="--r: <?php echo (int) $i; ?>">
								<circle cx="172" cy="<?php echo 110 + $i * 26; ?>" r="8" fill="<?php echo esc_attr( $t['c1'] ); ?>" opacity=".25"/>
								<rect x="186" y="<?php echo 104 + $i * 26; ?>" width="<?php echo (int) $v( $i + 3, 34, 52 ); ?>" height="5" rx="2.5" fill="#94a3b8"/>
								<rect x="186" y="<?php echo 113 + $i * 26; ?>" width="28" height="4" rx="2" fill="#cbd5e1"/>
							</g>
						<?php endfor; ?>
						<rect x="164" y="208" width="76" height="8" rx="4" fill="#f1f5f9"/>
					</g>
					<g class="tdb-cover__float tdb-cover__float--2">
						<rect x="262" y="70" width="96" height="56" rx="12" fill="#fff"/>
						<circle cx="282" cy="98" r="10" fill="<?php echo esc_attr( $t['c2'] ); ?>"/>
						<rect x="298" y="90" width="46" height="6" rx="3" fill="#cbd5e1"/><rect x="298" y="101" width="32" height="5" rx="2.5" fill="#e2e8f0"/>
					</g>
					<g class="tdb-cover__float tdb-cover__float--3">
						<rect x="44" y="130" width="92" height="50" rx="12" fill="#fff" opacity=".95"/>
						<path class="tdb-cover__spark" d="M56 166 L72 154 L86 160 L102 146 L122 150" fill="none" stroke="<?php echo esc_attr( $t['c2'] ); ?>" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
					</g>

				<?php elseif ( 'dashboard' === $t['mock'] || 'pulse' === $t['mock'] ) : ?>
					<g class="tdb-cover__float">
						<rect x="44" y="30" width="312" height="190" rx="12" fill="#fff"/>
						<rect x="44" y="30" width="62" height="190" rx="12" fill="#f8fafc"/><rect x="94" y="30" width="12" height="190" fill="#f8fafc"/>
						<rect x="56" y="44" width="38" height="10" rx="5" fill="<?php echo esc_attr( $t['c1'] ); ?>"/>
						<?php for ( $i = 0; $i < 5; $i++ ) : ?><rect x="56" y="<?php echo 68 + $i * 18; ?>" width="<?php echo 28 + ( $i % 2 ) * 8; ?>" height="6" rx="3" fill="<?php echo 0 === $i ? esc_attr( $t['c2'] ) : '#e2e8f0'; ?>"/><?php endfor; ?>
						<?php for ( $i = 0; $i < 3; $i++ ) : ?>
							<rect x="<?php echo 118 + $i * 78; ?>" y="44" width="70" height="40" rx="8" fill="#f8fafc" stroke="#eef2f6"/>
							<rect x="<?php echo 126 + $i * 78; ?>" y="53" width="30" height="5" rx="2.5" fill="#cbd5e1"/>
							<rect x="<?php echo 126 + $i * 78; ?>" y="64" width="<?php echo (int) $v( $i + 5, 26, 44 ); ?>" height="10" rx="3" fill="<?php echo 1 === $i ? esc_attr( $t['c2'] ) : '#0f172a'; ?>" opacity=".85"/>
						<?php endfor; ?>
						<rect x="118" y="94" width="150" height="114" rx="8" fill="#f8fafc" stroke="#eef2f6"/>
						<?php if ( 'pulse' === $t['mock'] ) : ?>
							<path class="tdb-cover__line" d="M126 160 H156 L164 140 L174 182 L184 126 L194 170 L202 160 H260" fill="none" stroke="<?php echo esc_attr( $t['c2'] ); ?>" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
						<?php else : ?>
							<?php for ( $i = 0; $i < 7; $i++ ) : $h = $v( $i + 9, 24, 84 ); ?>
								<rect class="tdb-cover__bar" style="--b: <?php echo (int) $i; ?>" x="<?php echo 130 + $i * 19; ?>" y="<?php echo 198 - $h; ?>" width="11" height="<?php echo (int) $h; ?>" rx="3" fill="<?php echo 0 === $i % 2 ? esc_attr( $t['c2'] ) : esc_attr( $t['c1'] ); ?>" opacity="<?php echo 0 === $i % 2 ? '.9' : '.35'; ?>"/>
							<?php endfor; ?>
						<?php endif; ?>
						<rect x="276" y="94" width="68" height="114" rx="8" fill="#f8fafc" stroke="#eef2f6"/>
						<circle cx="310" cy="134" r="22" fill="none" stroke="#e2e8f0" stroke-width="8"/>
						<circle class="tdb-cover__ring" cx="310" cy="134" r="22" fill="none" stroke="<?php echo esc_attr( $t['c2'] ); ?>" stroke-width="8" stroke-linecap="round" stroke-dasharray="138" stroke-dashoffset="<?php echo (int) $v( 7, 30, 70 ); ?>" transform="rotate(-90 310 134)"/>
						<rect x="288" y="172" width="44" height="5" rx="2.5" fill="#cbd5e1"/><rect x="294" y="184" width="32" height="5" rx="2.5" fill="#e2e8f0"/>
					</g>

				<?php elseif ( 'code' === $t['mock'] ) : ?>
					<g class="tdb-cover__float">
						<rect x="60" y="34" width="280" height="182" rx="12" fill="#0b1220"/>
						<rect x="60" y="34" width="280" height="24" rx="12" fill="#111b2e"/><rect x="60" y="46" width="280" height="12" fill="#111b2e"/>
						<circle cx="76" cy="46" r="3.5" fill="#f87171"/><circle cx="88" cy="46" r="3.5" fill="#fbbf24"/><circle cx="100" cy="46" r="3.5" fill="#4ade80"/>
						<?php
						$cols = array( '#c084fc', '#60a5fa', '#4ade80', '#fbbf24', '#f472b6', '#94a3b8' );
						for ( $i = 0; $i < 7; $i++ ) :
							$x = 92 + ( in_array( $i, array( 2, 3, 4 ), true ) ? 18 : 0 );
							?>
							<g class="tdb-cover__code" style="--l: <?php echo (int) $i; ?>">
								<rect x="74" y="<?php echo 72 + $i * 19; ?>" width="8" height="6" rx="2" fill="#334155"/>
								<rect x="<?php echo (int) $x; ?>" y="<?php echo 72 + $i * 19; ?>" width="<?php echo (int) $v( $i + 2, 28, 54 ); ?>" height="7" rx="3.5" fill="<?php echo esc_attr( $cols[ $i % 6 ] ); ?>"/>
								<rect x="<?php echo (int) $x + $v( $i + 2, 28, 54 ) + 8; ?>" y="<?php echo 72 + $i * 19; ?>" width="<?php echo (int) $v( $i + 11, 30, 90 ); ?>" height="7" rx="3.5" fill="<?php echo esc_attr( $cols[ ( $i + 2 ) % 6 ] ); ?>" opacity=".7"/>
							</g>
						<?php endfor; ?>
						<rect class="tdb-cover__caret" x="220" y="186" width="3" height="12" fill="#e2e8f0"/>
					</g>
					<g class="tdb-cover__float tdb-cover__float--2">
						<rect x="282" y="150" width="86" height="52" rx="12" fill="#fff"/>
						<circle cx="302" cy="176" r="10" fill="<?php echo esc_attr( $t['c2'] ); ?>"/><path d="m297 176 4 4 7-8" fill="none" stroke="#fff" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
						<rect x="318" y="168" width="38" height="6" rx="3" fill="#cbd5e1"/><rect x="318" y="179" width="26" height="5" rx="2.5" fill="#e2e8f0"/>
					</g>

				<?php elseif ( 'chart' === $t['mock'] ) : ?>
					<g class="tdb-cover__float">
						<rect x="52" y="34" width="296" height="182" rx="12" fill="#fff"/>
						<rect x="68" y="48" width="70" height="8" rx="4" fill="#0f172a"/><rect x="68" y="62" width="44" height="12" rx="4" fill="<?php echo esc_attr( $t['c2'] ); ?>"/>
						<?php for ( $i = 0; $i < 4; $i++ ) : ?><line x1="68" x2="332" y1="<?php echo 96 + $i * 30; ?>" y2="<?php echo 96 + $i * 30; ?>" stroke="#eef2f6"/><?php endfor; ?>
						<?php
						$prev = 150;
						for ( $i = 0; $i < 11; $i++ ) :
							$open  = $prev;
							$close = $v( $i + 4, 100, 180 ) - $i * 3;
							$hi    = min( $open, $close ) - $v( $i + 9, 6, 16 );
							$lo    = max( $open, $close ) + $v( $i + 13, 6, 14 );
							$up    = $close < $open;
							$x     = 80 + $i * 23;
							$prev  = $close;
							?>
							<g class="tdb-cover__candle" style="--c: <?php echo (int) $i; ?>">
								<line x1="<?php echo $x + 5; ?>" x2="<?php echo $x + 5; ?>" y1="<?php echo (int) $hi; ?>" y2="<?php echo (int) $lo; ?>" stroke="<?php echo $up ? '#16a34a' : '#ef4444'; ?>" stroke-width="1.5"/>
								<rect x="<?php echo (int) $x; ?>" y="<?php echo (int) min( $open, $close ); ?>" width="10" height="<?php echo (int) max( 4, abs( $open - $close ) ); ?>" rx="2" fill="<?php echo $up ? '#16a34a' : '#ef4444'; ?>"/>
							</g>
						<?php endfor; ?>
					</g>
					<g class="tdb-cover__float tdb-cover__float--2">
						<circle cx="330" cy="58" r="26" fill="<?php echo esc_attr( $t['c2'] ); ?>"/><circle cx="330" cy="58" r="19" fill="none" stroke="#fff" stroke-width="2" opacity=".7"/>
						<text x="330" y="65" text-anchor="middle" font-family="Arial, sans-serif" font-size="20" font-weight="700" fill="#fff">&#8383;</text>
					</g>

				<?php elseif ( 'cloud' === $t['mock'] ) : ?>
					<g class="tdb-cover__float">
						<path d="M138 120a40 40 0 0 1 76-22 34 34 0 0 1 62 16 28 28 0 0 1-4 56H146a26 26 0 0 1-8-50Z" fill="#fff"/>
						<path class="tdb-cover__line" d="M180 140h40m-20-18v36" stroke="<?php echo esc_attr( $t['c2'] ); ?>" stroke-width="5" stroke-linecap="round"/>
					</g>
					<?php for ( $i = 0; $i < 3; $i++ ) : ?>
						<g class="tdb-cover__float tdb-cover__float--<?php echo 2 + ( $i % 2 ); ?>">
							<rect x="<?php echo 104 + $i * 70; ?>" y="196" width="56" height="34" rx="7" fill="#fff" opacity=".95"/>
							<rect x="<?php echo 112 + $i * 70; ?>" y="205" width="26" height="4" rx="2" fill="#cbd5e1"/><rect x="<?php echo 112 + $i * 70; ?>" y="215" width="18" height="4" rx="2" fill="#e2e8f0"/>
							<circle cx="<?php echo 150 + $i * 70; ?>" cy="213" r="3.5" fill="#4ade80"/>
						</g>
						<line class="tdb-cover__edge" x1="<?php echo 132 + $i * 70; ?>" y1="196" x2="<?php echo 190 + ( $i - 1 ) * 18; ?>" y2="172" stroke="rgba(255,255,255,.6)" stroke-width="1.5"/>
					<?php endfor; ?>

				<?php elseif ( 'shield' === $t['mock'] ) : ?>
					<g class="tdb-cover__float">
						<path d="M200 36 268 62v52c0 44-30 78-68 92-38-14-68-48-68-92V62l68-26Z" fill="#fff"/>
						<path d="M200 54 252 74v40c0 34-23 61-52 72-29-11-52-38-52-72V74l52-20Z" fill="<?php echo esc_attr( $t['c2'] ); ?>" opacity=".18"/>
						<path class="tdb-cover__line" d="m176 122 16 16 34-36" fill="none" stroke="<?php echo esc_attr( $t['c2'] ); ?>" stroke-width="9" stroke-linecap="round" stroke-linejoin="round"/>
					</g>
					<?php foreach ( array( array( 92, 80 ), array( 308, 90 ), array( 100, 182 ), array( 300, 186 ) ) as $k => $pt ) : ?>
						<g class="tdb-cover__node" style="--n: <?php echo (int) $k; ?>"><circle cx="<?php echo (int) $pt[0]; ?>" cy="<?php echo (int) $pt[1]; ?>" r="14" fill="rgba(255,255,255,.16)"/><circle cx="<?php echo (int) $pt[0]; ?>" cy="<?php echo (int) $pt[1]; ?>" r="5" fill="#fff"/></g>
					<?php endforeach; ?>

				<?php elseif ( 'growth' === $t['mock'] ) : ?>
					<g class="tdb-cover__float">
						<rect x="60" y="36" width="280" height="178" rx="12" fill="#fff"/>
						<rect x="76" y="52" width="80" height="8" rx="4" fill="#0f172a"/><rect x="76" y="66" width="52" height="12" rx="4" fill="<?php echo esc_attr( $t['c2'] ); ?>"/>
						<path d="M80 190 L130 168 L170 176 L214 138 L258 146 L320 92 V200 H80 Z" fill="<?php echo esc_attr( $t['c2'] ); ?>" opacity=".15"/>
						<path class="tdb-cover__line" d="M80 190 L130 168 L170 176 L214 138 L258 146 L320 92" fill="none" stroke="<?php echo esc_attr( $t['c2'] ); ?>" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
						<circle class="tdb-cover__pop" cx="320" cy="92" r="7" fill="<?php echo esc_attr( $t['c1'] ); ?>"/>
					</g>
					<g class="tdb-cover__float tdb-cover__float--2">
						<rect x="236" y="20" width="112" height="40" rx="12" fill="#fff"/>
						<path d="M252 46 l8-10 6 6 10-14" fill="none" stroke="#16a34a" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
						<rect x="284" y="32" width="50" height="6" rx="3" fill="#cbd5e1"/><rect x="284" y="43" width="34" height="5" rx="2.5" fill="#e2e8f0"/>
					</g>

				<?php elseif ( 'map' === $t['mock'] ) : ?>
					<g class="tdb-cover__float">
						<rect x="52" y="34" width="296" height="182" rx="12" fill="#ecfdf5"/>
						<?php for ( $i = 0; $i < 6; $i++ ) : ?><line x1="<?php echo 52 + $i * 60; ?>" y1="34" x2="<?php echo 22 + $i * 60; ?>" y2="216" stroke="#d1fae5" stroke-width="10"/><?php endfor; ?>
						<?php for ( $i = 0; $i < 3; $i++ ) : ?><line x1="52" y1="<?php echo 80 + $i * 50; ?>" x2="348" y2="<?php echo 70 + $i * 50; ?>" stroke="#d1fae5" stroke-width="10"/><?php endfor; ?>
						<path class="tdb-cover__line" d="M92 186 C130 150 150 170 182 132 S250 100 300 70" fill="none" stroke="<?php echo esc_attr( $t['c2'] ); ?>" stroke-width="5" stroke-linecap="round" stroke-dasharray="220"/>
						<circle cx="92" cy="186" r="8" fill="<?php echo esc_attr( $t['c1'] ); ?>"/>
						<path class="tdb-cover__pop" d="M300 46a14 14 0 0 1 14 14c0 11-14 24-14 24s-14-13-14-24a14 14 0 0 1 14-14Z" fill="#ef4444"/><circle cx="300" cy="60" r="5" fill="#fff"/>
					</g>

				<?php else : // AI network ?>
					<g class="tdb-cover__net">
						<?php
						$nodes = array( array( 200, 125 ), array( 110, 70 ), array( 290, 70 ), array( 90, 170 ), array( 310, 175 ), array( 200, 40 ), array( 200, 210 ), array( 150, 120 ), array( 252, 128 ) );
						foreach ( array( array( 0, 1 ), array( 0, 2 ), array( 0, 3 ), array( 0, 4 ), array( 0, 5 ), array( 0, 6 ), array( 1, 7 ), array( 2, 8 ), array( 3, 7 ), array( 4, 8 ), array( 5, 1 ), array( 5, 2 ), array( 6, 3 ), array( 6, 4 ) ) as $k => $e ) :
							?>
							<line class="tdb-cover__edge" style="--e: <?php echo (int) $k; ?>" x1="<?php echo (int) $nodes[ $e[0] ][0]; ?>" y1="<?php echo (int) $nodes[ $e[0] ][1]; ?>" x2="<?php echo (int) $nodes[ $e[1] ][0]; ?>" y2="<?php echo (int) $nodes[ $e[1] ][1]; ?>" stroke="rgba(255,255,255,.45)" stroke-width="1.5"/>
						<?php endforeach; ?>
						<?php foreach ( $nodes as $k => $n ) : if ( 0 === $k ) { continue; } ?>
							<circle class="tdb-cover__node" style="--n: <?php echo (int) $k; ?>" cx="<?php echo (int) $n[0]; ?>" cy="<?php echo (int) $n[1]; ?>" r="<?php echo $k > 6 ? 6 : 9; ?>" fill="#fff"/>
						<?php endforeach; ?>
						<rect class="tdb-cover__chip" x="172" y="97" width="56" height="56" rx="14" fill="#fff"/>
						<text x="200" y="132" text-anchor="middle" font-family="Arial, sans-serif" font-size="20" font-weight="700" fill="<?php echo esc_attr( $t['c2'] ); ?>">AI</text>
					</g>
				<?php endif; ?>
			</svg>
		</span>
		<?php
		return ob_get_clean();
	}
	if ( ! function_exists( 'ace_cover' ) ) {
		function ace_cover( $post_id ) { return ace_project_cover( $post_id ); }
	}
}
