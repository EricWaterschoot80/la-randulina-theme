<?php
/**
 * Title: Veelgestelde vragen
 * Slug: la-randulina/faq
 * Categories: la-randulina
 * Description: Uitklapbare vragen en antwoorden. Werkt zonder JavaScript.
 *
 * @package la-randulina
 */

$lr_vragen = array(
	array(
		'vraag'   => __( 'Hoe laat kunnen we inchecken?', 'la-randulina' ),
		'antwoord' => __( 'Inchecken kan vanaf 15:00 uur. Kom je later aan? Laat het ons even weten, dan zorgen we dat er iemand voor je klaarstaat.', 'la-randulina' ),
	),
	array(
		'vraag'   => __( 'Is het ontbijt inbegrepen?', 'la-randulina' ),
		'antwoord' => __( 'Ja. Elke ochtend staat er een uitgebreid lodge-ontbijt klaar, inbegrepen bij alle kamers.', 'la-randulina' ),
	),
	array(
		'vraag'   => __( 'Mag onze hond mee?', 'la-randulina' ),
		'antwoord' => __( 'Graag zelfs. Onze eigen cocker spaniel Tommy ontvangt hem persoonlijk. Even overleggen bij het boeken is wel prettig.', 'la-randulina' ),
	),
	array(
		'vraag'   => __( 'Kunnen we onze elektrische auto opladen?', 'la-randulina' ),
		'antwoord' => __( 'Ja, op ons eigen terrein staat een laadstation. Parkeren is gratis en het opladen kost je niets.', 'la-randulina' ),
	),
	array(
		'vraag'   => __( 'Hoe laat wordt er gegeten?', 'la-randulina' ),
		'antwoord' => __( 'Onze keuken is open van 17:00 tot 18:30 uur. Wil je later of uitgebreider eten, dan brengt onze shuttle je om 18:30 uur naar een Italiaanse trattoria in de buurt (5 CHF per persoon).', 'la-randulina' ),
	),
	array(
		'vraag'   => __( 'Wat houdt de regionale gastenkaart in?', 'la-randulina' ),
		'antwoord' => __( 'Met de gastenkaart reis je gratis of met flinke korting met bus, trein en de bergliften in de regio. Je krijgt hem bij aankomst van ons.', 'la-randulina' ),
	),
);
?>
<!-- wp:html -->
<div class="lr-faq">
	<?php foreach ( $lr_vragen as $lr_vraag ) : ?>
		<details class="lr-faq__item">
			<summary class="lr-faq__vraag"><?php echo esc_html( $lr_vraag['vraag'] ); ?></summary>
			<div class="lr-faq__antwoord">
				<p><?php echo esc_html( $lr_vraag['antwoord'] ); ?></p>
			</div>
		</details>
	<?php endforeach; ?>
</div>
<!-- /wp:html -->
