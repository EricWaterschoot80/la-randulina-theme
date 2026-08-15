<?php
/**
 * Title: Homepagina — boekingsoproep
 * Slug: la-randulina/home-boeken
 * Categories: la-randulina
 * Description: Afsluitende band met de link naar het reserveringssysteem en naar de kamerpagina.
 *
 * @package la-randulina
 */

$lr_links = function_exists( 'la_randulina_links' ) ? la_randulina_links() : array( 'boeken' => '#' );
?>
<!-- wp:html -->
<section class="lr-band lr-band--donker">
	<div class="lr-binnen lr-sectiekop" data-onthul>

		<h2><?php esc_html_e( 'Kom je ook?', 'la-randulina' ); ?></h2>
		<p><?php esc_html_e( 'Twaalf kamers, een speelkamer, een fietshub en een dorp waar je de stilte nog echt hoort. Bekijk wanneer er plek is.', 'la-randulina' ); ?></p>

		<p class="lr-knoppen">
			<a class="wp-block-button__link wp-element-button lr-boekknop"
				href="<?php echo esc_url( $lr_links['boeken'] ); ?>"
				target="_blank" rel="noopener">
				<?php esc_html_e( 'Beschikbaarheid bekijken', 'la-randulina' ); ?>
			</a>
			<a class="wp-block-button__link wp-element-button lr-knop--omlijnd"
				href="https://larandulina.com/nl/onzekamers/">
				<?php esc_html_e( 'Onze kamers', 'la-randulina' ); ?>
			</a>
		</p>

	</div>
</section>
<!-- /wp:html -->
