<?php
/**
 * Title: Homepagina — altijd inbegrepen
 * Slug: la-randulina/home-inbegrepen
 * Categories: la-randulina
 * Description: Wat er standaard bij een verblijf hoort, in een raster van korte blokken.
 *
 * @package la-randulina
 */

$lr_inbegrepen = array(
	array(
		'titel' => __( 'Stevig lodge-ontbijt', 'la-randulina' ),
		'tekst' => __( 'Elke ochtend staat er een uitgebreid ontbijt klaar om vol energie op pad te gaan.', 'la-randulina' ),
	),
	array(
		'titel' => __( 'De complete fietshub', 'la-randulina' ),
		'tekst' => __( 'Afgesloten bike-garage, ruim voldoende e-bike laadpunten, een professionele bikewash en een reparatiestandaard.', 'la-randulina' ),
	),
	array(
		'titel' => __( 'Regionale gastenkaart', 'la-randulina' ),
		'tekst' => __( 'Gratis of met veel korting reizen met bus en trein, en gebruikmaken van de bergliften in de regio.', 'la-randulina' ),
	),
	array(
		'titel' => __( 'Parkeren en laden', 'la-randulina' ),
		'tekst' => __( 'Gratis parkeren op eigen terrein, met een laadstation voor je elektrische auto.', 'la-randulina' ),
	),
	array(
		'titel' => __( 'Gezelligheid', 'la-randulina' ),
		'tekst' => __( 'De gezamenlijke huiskamer, de speelkamer voor de kids en in de winter de stube met openhaard.', 'la-randulina' ),
	),
	array(
		'titel' => __( 'Honden welkom', 'la-randulina' ),
		'tekst' => __( 'Je trouwe viervoeter mag na overleg gezellig mee op vakantie.', 'la-randulina' ),
	),
);
?>
<!-- wp:html -->
<section class="lr-band">
	<div class="lr-binnen">

		<div class="lr-sectiekop" data-onthul>
			<h2><?php esc_html_e( 'Altijd inbegrepen bij je verblijf', 'la-randulina' ); ?></h2>
			<p><?php esc_html_e( 'Geen verrassingen achteraf. Dit hoort er standaard bij, in elke kamer en elk seizoen.', 'la-randulina' ); ?></p>
		</div>

		<ul class="lr-kenmerken" data-onthul="1">
			<?php foreach ( $lr_inbegrepen as $lr_item ) : ?>
				<li>
					<strong><?php echo esc_html( $lr_item['titel'] ); ?></strong>
					<?php echo esc_html( $lr_item['tekst'] ); ?>
				</li>
			<?php endforeach; ?>
		</ul>

	</div>
</section>
<!-- /wp:html -->
