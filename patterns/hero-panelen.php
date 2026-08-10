<?php
/**
 * Title: Hero met vier doelgroeppanelen
 * Slug: la-randulina/hero-panelen
 * Categories: la-randulina
 * Description: Eén schermvullende foto, verdeeld in vier klikbare panelen naar de doelgroeppagina's. Wisselt mee met het gekozen seizoen.
 *
 * @package la-randulina
 */

/**
 * Enkele quotes binnen de url(), want deze waarde belandt in een
 * style="..."-attribuut. Met dubbele quotes breekt het attribuut af op het
 * eerste aanhalingsteken en houdt de browser alleen 'url(' over.
 */
$lr_beeld = static function ( string $bestand ): string {
	return "url('" . esc_url( get_theme_file_uri( 'assets/img/' . $bestand ) ) . "')";
};

$lr_panelen = array(
	array(
		'label' => __( 'Gezinnen', 'la-randulina' ),
		'intro' => __( 'Ruimte om te spelen, een eigen speelkamer en familiekamers zonder gedoe.', 'la-randulina' ),
		'url'   => '/nl/gezinnen/',
		'zomer' => 'paneel-gezinnen-zomer.jpg',
		'winter' => 'paneel-gezinnen-winter.jpg',
	),
	array(
		'label' => __( 'Wandelaars & fietsers', 'la-randulina' ),
		'intro' => __( 'Een volwaardige fietshub, en de minste neerslag van heel Zwitserland.', 'la-randulina' ),
		'url'   => '/nl/wandelaars-fietsers/',
		'zomer' => 'paneel-actief-zomer.jpg',
		'winter' => 'paneel-actief-winter.jpg',
	),
	array(
		'label' => __( 'Stellen', 'la-randulina' ),
		'intro' => __( 'Rust, een balkon met bergzicht en een dorp zonder massatoerisme.', 'la-randulina' ),
		'url'   => '/nl/stellen/',
		'zomer' => 'paneel-stellen-zomer.jpg',
		'winter' => 'paneel-stellen-winter.jpg',
	),
	array(
		'label' => __( 'Groepen', 'la-randulina' ),
		'intro' => __( 'Huur de complete lodge af: twaalf kamers, helemaal voor jullie alleen.', 'la-randulina' ),
		'url'   => '/nl/groepen/',
		'zomer' => 'paneel-groepen-zomer.jpg',
		'winter' => 'paneel-groepen-winter.jpg',
	),
);
?>
<!-- wp:html -->
<section
	class="lr-panelen alignfull"
	style="--lr-beeld-zomer: <?php echo $lr_beeld( 'hero-zomer.jpg' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>; --lr-beeld-winter: <?php echo $lr_beeld( 'hero-winter.jpg' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>;"
	aria-label="<?php esc_attr_e( 'Kies waarvoor je komt', 'la-randulina' ); ?>"
>
	<?php foreach ( $lr_panelen as $lr_paneel ) : ?>
		<a
			class="lr-paneel"
			href="<?php echo esc_url( $lr_paneel['url'] ); ?>"
			style="--lr-paneel-zomer: <?php echo $lr_beeld( $lr_paneel['zomer'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>; --lr-paneel-winter: <?php echo $lr_beeld( $lr_paneel['winter'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>;"
		>
			<span>
				<span class="lr-paneel__label"><?php echo esc_html( $lr_paneel['label'] ); ?></span>
				<span class="lr-paneel__intro"><?php echo esc_html( $lr_paneel['intro'] ); ?></span>
			</span>
		</a>
	<?php endforeach; ?>

	<p class="lr-panelen__ontdek">
		<a href="#inhoud"><?php esc_html_e( 'Ontdek de lodge', 'la-randulina' ); ?></a>
	</p>
</section>
<!-- /wp:html -->
