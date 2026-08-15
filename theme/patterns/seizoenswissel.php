<?php
/**
 * Title: Seizoenswissel
 * Slug: la-randulina/seizoenswissel
 * Categories: la-randulina
 * Description: Twee ronde knoppen, zon en sneeuwvlok, die de site tussen zomer en winter wisselen.
 * Inserter: no
 *
 * @package la-randulina
 */

$lr_actief = function_exists( 'la_randulina_actief_seizoen' ) ? la_randulina_actief_seizoen() : 'zomer';
?>
<!-- wp:html -->
<div class="lr-seizoenswissel" role="group" aria-label="<?php esc_attr_e( 'Kies een seizoen', 'la-randulina' ); ?>">
	<a
		class="lr-seizoenswissel__knop lr-seizoenswissel__knop--zomer"
		href="<?php echo esc_url( add_query_arg( 'seizoen', 'zomer' ) ); ?>"
		data-lr-seizoen="zomer"
		aria-pressed="<?php echo 'zomer' === $lr_actief ? 'true' : 'false'; ?>"
		title="<?php esc_attr_e( 'Toon de zomer', 'la-randulina' ); ?>"
	>
		<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
			<circle cx="12" cy="12" r="4.2" />
			<path d="M12 2.4v2.6M12 19v2.6M2.4 12h2.6M19 12h2.6M5.2 5.2l1.9 1.9M16.9 16.9l1.9 1.9M18.8 5.2l-1.9 1.9M7.1 16.9l-1.9 1.9" />
		</svg>
		<span class="screen-reader-text"><?php esc_html_e( 'Zomer', 'la-randulina' ); ?></span>
	</a>

	<a
		class="lr-seizoenswissel__knop lr-seizoenswissel__knop--winter"
		href="<?php echo esc_url( add_query_arg( 'seizoen', 'winter' ) ); ?>"
		data-lr-seizoen="winter"
		aria-pressed="<?php echo 'winter' === $lr_actief ? 'true' : 'false'; ?>"
		title="<?php esc_attr_e( 'Toon de winter', 'la-randulina' ); ?>"
	>
		<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
			<path d="M12 2.2v19.6M3.5 7.1l17 9.8M3.5 16.9l17-9.8" />
			<path d="M9.4 4.4 12 6.9l2.6-2.5M9.4 19.6 12 17.1l2.6 2.5M4.6 10.9l.5 3.5 3.3-1.2M19.4 13.1l-.5-3.5-3.3 1.2M4.6 13.1l.5-3.5 3.3 1.2M19.4 10.9l-.5 3.5-3.3-1.2" />
		</svg>
		<span class="screen-reader-text"><?php esc_html_e( 'Winter', 'la-randulina' ); ?></span>
	</a>
</div>
<!-- /wp:html -->
