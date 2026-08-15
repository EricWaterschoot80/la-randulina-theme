<?php
/**
 * Title: Logo met naam
 * Slug: la-randulina/logo
 * Categories: la-randulina
 * Description: Het beeldmerk — een zwaluw met edelweiss — met de naam ernaast in de themalettertypes.
 * Inserter: no
 *
 * @package la-randulina
 *
 * Het aangeleverde logo bevat de naam als losse letters in het lettertype
 * Juice ITC. Bezoekers hebben dat font niet, waardoor de letters over elkaar
 * heen schuiven. Daarom gebruiken we alleen het beeldmerk en zetten we de
 * naam in de pagina zelf. Zodra er een versie met omgezette letters is,
 * kan dit vervangen worden door één afbeelding.
 */

?>
<!-- wp:html -->
<a class="lr-kop__titel" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
	<img class="lr-kop__merk"
		src="<?php echo esc_url( get_theme_file_uri( 'assets/img/logo-merk-wit.svg' ) ); ?>"
		width="283" height="240" alt="">
	<span class="lr-kop__naam">
		<?php esc_html_e( 'Familielodge', 'la-randulina' ); ?>
		<strong><?php echo esc_html( get_bloginfo( 'name' ) ); ?></strong>
	</span>
</a>
<!-- /wp:html -->
