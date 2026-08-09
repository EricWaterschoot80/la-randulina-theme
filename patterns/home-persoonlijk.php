<?php
/**
 * Title: Persoonlijk blok — de familie achter de lodge
 * Slug: la-randulina/home-persoonlijk
 * Categories: la-randulina
 * Description: Wie John, Ilona, Luna en Tommy zijn, met een fotocollage van het pand en de hond.
 *
 * @package la-randulina
 */

$lr_familie = array(
	array(
		'naam' => __( 'John', 'la-randulina' ),
		'rol'  => __( "Zorgt 's ochtends voor het ontbijt en een goede kop koffie. Aan het eind van de dag staat hij in de keuken voor het avondeten.", 'la-randulina' ),
	),
	array(
		'naam' => __( 'Ilona', 'la-randulina' ),
		'rol'  => __( 'Het warme gezicht bij de ontvangst. Zij zorgt dat de kamers er vlekkeloos bij liggen en deelt de leukste regiotips voor het hele gezin.', 'la-randulina' ),
	),
	array(
		'naam' => __( 'Luna', 'la-randulina' ),
		'rol'  => __( 'Brengt de jonge energie in huis. Zij weet als geen ander hoe leuk de speelkamer is en waar de spannendste alpenavonturen te vinden zijn.', 'la-randulina' ),
	),
	array(
		'naam' => __( 'Tommy', 'la-randulina' ),
		'rol'  => __( 'Onze Engelse cocker spaniel en vaste viervoetige gastheer. Hij zorgt dat ook meereizende honden zich meteen thuis voelen.', 'la-randulina' ),
	),
);
?>
<!-- wp:html -->
<section class="lr-binnen lr-persoonlijk">

	<div class="lr-persoonlijk__beeld">
		<figure>
			<img
				src="<?php echo esc_url( get_theme_file_uri( 'assets/img/lodge.jpg' ) ); ?>"
				alt="<?php esc_attr_e( 'Familielodge La Randulina, een voormalige boerderij en bakkerij in het dorp Ramosch', 'la-randulina' ); ?>"
				width="1400" height="933" loading="lazy" decoding="async">
		</figure>
		<figure class="lr-persoonlijk__inzet">
			<img
				src="<?php echo esc_url( get_theme_file_uri( 'assets/img/tommy.jpg' ) ); ?>"
				alt="<?php esc_attr_e( 'Tommy, de Engelse cocker spaniel van de lodge, in de gang', 'la-randulina' ); ?>"
				width="900" height="1350" loading="lazy" decoding="async">
		</figure>
	</div>

	<div class="lr-persoonlijk__tekst">
		<h2><?php esc_html_e( 'Wij zijn John, Ilona en Luna', 'la-randulina' ); ?></h2>

		<p><?php esc_html_e( 'Onze reis in de gastvrijheid begon in Italië, waar we jarenlang met veel plezier onze eigen B&B runden. Daar werd onze liefde voor ongedwongen gastvrijheid en de authentieke keuken definitief verzegeld. De bergen trokken ons uiteindelijk naar het Zwitserse Ramosch, maar die Italiaanse passie voor het goede leven namen we mee. Dat proef je terug op onze kaart.', 'la-randulina' ); ?></p>

		<p><?php esc_html_e( 'Ons pand deed vroeger dienst als boerderij en bakkerij. Die authentieke sfeer voel je vandaag nog steeds, gecombineerd met heerlijke bedden, een eigen badkamer en uitzicht op de bergen.', 'la-randulina' ); ?></p>

		<ul class="lr-familie">
			<?php foreach ( $lr_familie as $lr_persoon ) : ?>
				<li>
					<strong><?php echo esc_html( $lr_persoon['naam'] ); ?></strong>
					<p><?php echo esc_html( $lr_persoon['rol'] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

</section>
<!-- /wp:html -->
