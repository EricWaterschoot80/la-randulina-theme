<?php
/**
 * La Randulina — thema-functies.
 *
 * @package la-randulina
 */

defined( 'ABSPATH' ) || exit;

const LA_RANDULINA_VERSION = '0.1.0';

/**
 * Stylesheets en scripts inladen, zowel op de site als in de blokeditor.
 */
function la_randulina_assets(): void {
	$dir = get_template_directory();
	$uri = get_template_directory_uri();

	$bestanden = array(
		'la-randulina-fonts'    => 'assets/css/fonts.css',
		'la-randulina-stijl'    => 'assets/css/stijl.css',
		'la-randulina-panelen'  => 'assets/css/panelen.css',
		'la-randulina-seizoen'  => 'assets/css/seizoen.css',
	);

	foreach ( $bestanden as $handle => $pad ) {
		$absoluut = $dir . '/' . $pad;
		if ( ! file_exists( $absoluut ) ) {
			continue;
		}
		wp_enqueue_style( $handle, $uri . '/' . $pad, array(), (string) filemtime( $absoluut ) );
	}
}
add_action( 'wp_enqueue_scripts', 'la_randulina_assets' );
add_action( 'enqueue_block_assets', 'la_randulina_assets' );

/**
 * De seizoenswissel als script. Alleen op de site, niet in de editor:
 * in de editor moet de redacteur beide seizoenen kunnen zien.
 */
function la_randulina_seizoen_script(): void {
	$pad      = '/assets/js/seizoen.js';
	$absoluut = get_template_directory() . $pad;

	if ( ! file_exists( $absoluut ) ) {
		return;
	}

	wp_enqueue_script(
		'la-randulina-seizoen',
		get_template_directory_uri() . $pad,
		array(),
		(string) filemtime( $absoluut ),
		array( 'strategy' => 'defer' )
	);
}
add_action( 'wp_enqueue_scripts', 'la_randulina_seizoen_script' );

/**
 * Bepaal het actieve seizoen voor deze paginaweergave.
 *
 * Volgorde: expliciete keuze in de URL, dan de eerder opgeslagen keuze uit de
 * cookie, en anders de kalender. Zo krijgt een bezoeker in januari meteen
 * winterbeeld te zien zonder iets te hoeven klikken.
 */
function la_randulina_actief_seizoen(): string {
	static $seizoen = null;

	if ( null !== $seizoen ) {
		return $seizoen;
	}

	$toegestaan = array( 'zomer', 'winter' );

	$uit_url = isset( $_GET['seizoen'] ) ? sanitize_key( wp_unslash( $_GET['seizoen'] ) ) : '';
	if ( in_array( $uit_url, $toegestaan, true ) ) {
		return $seizoen = $uit_url;
	}

	$uit_cookie = isset( $_COOKIE['lr_seizoen'] ) ? sanitize_key( wp_unslash( $_COOKIE['lr_seizoen'] ) ) : '';
	if ( in_array( $uit_cookie, $toegestaan, true ) ) {
		return $seizoen = $uit_cookie;
	}

	// November tot en met april is winterseizoen in het Unterengadin.
	$maand = (int) current_time( 'n' );

	return $seizoen = ( $maand >= 11 || $maand <= 4 ) ? 'winter' : 'zomer';
}

/**
 * Zet het seizoen als class op het html-element, zodat de CSS er direct
 * op kan sturen zonder dat de pagina eerst verkeerd in beeld komt.
 */
function la_randulina_html_class( string $output ): string {
	if ( is_admin() ) {
		return $output;
	}

	return trim( $output . ' seizoen-' . la_randulina_actief_seizoen() );
}
add_filter( 'language_attributes', 'la_randulina_html_class' );

/**
 * Eigen patrooncategorie, zodat onze patronen niet ondersneeuwen tussen
 * de tientallen standaardpatronen van WordPress.
 */
function la_randulina_patrooncategorie(): void {
	register_block_pattern_category(
		'la-randulina',
		array( 'label' => __( 'La Randulina', 'la-randulina' ) )
	);
}
add_action( 'init', 'la_randulina_patrooncategorie' );

/**
 * De vaste externe links op één plek. Deze URL's moeten gelijk blijven aan
 * de huidige site — dat was een expliciete eis van de klant.
 */
function la_randulina_links(): array {
	return array(
		'boeken' => 'https://la-randulina.w.mytourist.cloud/nl/availability',
		'menu'   => 'https://larandulina.com/menu/',
		'komoot' => 'https://www.komoot.com/de-de/user/larandulina/collections',
	);
}

/**
 * Shortcode voor de boekingsknop, zodat de URL nooit ergens hardgecodeerd
 * in de database belandt en met één wijziging overal aanpast.
 */
function la_randulina_boekknop( $attributen ): string {
	$attributen = shortcode_atts(
		array( 'tekst' => __( 'Beschikbaarheid bekijken', 'la-randulina' ) ),
		$attributen,
		'lr_boeken'
	);

	$links = la_randulina_links();

	return sprintf(
		'<a class="wp-block-button__link wp-element-button lr-boekknop" href="%s" target="_blank" rel="noopener">%s</a>',
		esc_url( $links['boeken'] ),
		esc_html( $attributen['tekst'] )
	);
}
add_shortcode( 'lr_boeken', 'la_randulina_boekknop' );
