<?php
/**
 * Title: Opening met schermvullend beeld
 * Slug: la-randulina/opening
 * Categories: la-randulina
 * Description: Eén schermvullend beeld met de belofte erop. Wisselt mee met het gekozen seizoen.
 *
 * @package la-randulina
 *
 * De url() moet absoluut zijn: seizoen.css leest deze variabelen uit, en een
 * relatief pad zou daar worden opgelost ten opzichte van dát stylesheet.
 */

$lr_beeld = static function ( string $bestand ): string {
	return "url('" . esc_url( get_theme_file_uri( 'assets/img/' . $bestand ) ) . "')";
};
?>
<!-- wp:html -->
<section
	class="lr-opening alignfull"
	style="--lr-opening-zomer: <?php echo $lr_beeld( 'opening-zomer.jpg' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>; --lr-opening-winter: <?php echo $lr_beeld( 'opening-winter.jpg' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>;"
>
	<div class="lr-opening__binnen">
		<span class="lr-opening__plaats"><?php esc_html_e( 'Ramosch · Unterengadin · Zwitserland', 'la-randulina' ); ?></span>

		<h1><?php esc_html_e( 'Jouw actieve thuisbasis in de Zwitserse Alpen', 'la-randulina' ); ?></h1>

		<p class="lr-opening__belofte"><?php esc_html_e( 'De ongedwongen sfeer van een berghut, het comfort van een hotel.', 'la-randulina' ); ?></p>

		<a class="lr-opening__verder" href="#kiezen"><?php esc_html_e( 'Waarvoor kom je?', 'la-randulina' ); ?></a>
	</div>
</section>
<!-- /wp:html -->
