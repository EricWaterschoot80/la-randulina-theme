<?php
/**
 * Maakt de paginastructuur uit de briefing van de klant aan.
 *
 * Wordt aangeroepen door `ddev setup`. Draai je hem nog eens, dan verandert er
 * niets aan wat er al staat: bestaande pagina's worden overgeslagen, zodat je
 * getypte teksten niet kwijtraakt.
 *
 * Dezelfde structuur staat in wp/blueprint.json voor de Playground-variant.
 * Twee bestanden voor één waarheid is niet mooi, maar de twee omgevingen
 * hebben nu eenmaal een ander mechanisme om zichzelf op te bouwen.
 */

$paginas = array(
	array( 'Home', 'home', '' ),
	array( 'Gezinnen', 'gezinnen', 'page-doelgroep' ),
	array( 'Wandelaars ' . chr( 38 ) . ' fietsers', 'wandelaars-fietsers', 'page-doelgroep' ),
	array( 'Stellen', 'stellen', 'page-doelgroep' ),
	array( 'Groepen', 'groepen', 'page-doelgroep' ),
	array( 'Over ons', 'over-ons', '' ),
	array( 'Onze kamers', 'onzekamers', '' ),
	array( 'Eten ' . chr( 38 ) . ' drinken', 'eten-en-drinken', '' ),
	array( 'Activiteiten zomer', 'activiteiten-zomer', '' ),
	array( 'Activiteiten winter', 'activiteiten-winter', '' ),
	array( 'Praktische info ' . chr( 38 ) . ' FAQ', 'praktische-info-faq', '' ),
	array( 'Contact ' . chr( 38 ) . ' route', 'contact-route', '' ),
);

$aangemaakt = 0;
$ids        = array();

foreach ( $paginas as $pagina ) {
	list( $titel, $slug, $sjabloon ) = $pagina;

	$bestaand = get_page_by_path( $slug );

	if ( $bestaand ) {
		$ids[ $slug ] = $bestaand->ID;
		continue;
	}

	$id = wp_insert_post(
		array(
			'post_type'   => 'page',
			'post_title'  => $titel,
			'post_name'   => $slug,
			'post_status' => 'publish',
		)
	);

	if ( $sjabloon ) {
		update_post_meta( $id, '_wp_page_template', $sjabloon );
	}

	$ids[ $slug ] = $id;
	$aangemaakt++;
}

update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $ids['home'] );

// De standaardpagina van WordPress hoort hier niet.
$voorbeeld = get_page_by_path( 'sample-page' );
if ( $voorbeeld ) {
	wp_delete_post( $voorbeeld->ID, true );
}

echo "   {$aangemaakt} nieuw, " . ( count( $paginas ) - $aangemaakt ) . " bestonden al\n";
