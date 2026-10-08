<?php
/**
 * Designed cover art for portfolio projects (instead of stock photos):
 * a gradient chosen by project category with an animated UI mockup
 * (browser, phone, dashboard, AI network or health monitor).
 */
if ( ! function_exists( 'ace_project_cover' ) ) {

	/** Cover type and colours for a project, from its category and title. */
	function ace_project_cover_type( $post_id ) {
		$terms = get_the_terms( $post_id, 'tagportfolio' );
		$hay   = strtolower( get_the_title( $post_id ) . ' ' . ( $terms && ! is_wp_error( $terms ) ? implode( ' ', wp_list_pluck( $terms, 'name' ) ) : '' ) );
		$map   = array(
			'ml'     => array( '/machine|\bai\b|ai-|vision|predict|detect|surveillance|algorithm/', 'network', '#1e1b4b', '#7c3aed' ),
			'health' => array( '/health|medic|clinic|hospital|patient/', 'pulse', '#0e7490', '#34d399' ),
			'crm'    => array( '/crm|erp|management system|dashboard|employee|portal|exam/', 'dashboard', '#0f172a', '#0e9488' ),
			'stream' => array( '/stream|video|live/', 'phone', '#7f1d1d', '#f43f5e' ),
			'dating' => array( '/dating|match/', 'phone', '#831843', '#f472b6' ),
			'social' => array( '/social|community|chat/', 'phone', '#1e3a8a', '#38bdf8' ),
			'food'   => array( '/food|restaurant|delivery|grocery/', 'phone', '#9a3412', '#f59e0b' ),
			'mobile' => array( '/mobile|app\b|android|ios/', 'phone', '#3730a3', '#06b6d4' ),
			'web'    => array( '/web|platform|website|portal|renting|booking/', 'browser', '#065f46', '#22c55e' ),
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
}
