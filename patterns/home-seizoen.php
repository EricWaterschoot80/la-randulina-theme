<?php
/**
 * Title: Homepagina — zomer en winter
 * Slug: la-randulina/home-seizoen
 * Categories: la-randulina
 * Description: Twee blokken waarvan er één zichtbaar is, afhankelijk van de schakelaar in de header. In de editor zie je ze allebei.
 *
 * @package la-randulina
 */

$lr_seizoenen = array(
	'zomer'  => array(
		'kop'    => __( 'Zomer in het Unterengadin', 'la-randulina' ),
		'tekst'  => __( 'Eindeloze singletracks, uitdagende bergpassen en ongerepte wandelpaden door het Zwitsers Nationaal Park. Dankzij ons microklimaat valt hier de minste neerslag van heel Zwitserland, dus je zit zelden binnen. Terug bij de lodge staat je fiets veilig in de bike-garage en schuif je om vijf uur aan tafel.', 'la-randulina' ),
		'knop'   => __( 'Bekijk de zomeractiviteiten', 'la-randulina' ),
		'url'    => '/nl/activiteiten-zomer/',
		'beeld'  => 'paneel-actief-zomer.jpg',
		'alt'    => __( 'Mountainbiker op een bergpad in het Unterengadin', 'la-randulina' ),
	),
	'winter' => array(
		'kop'    => __( 'Winter in het Unterengadin', 'la-randulina' ),
		'tekst'  => __( 'Het sneeuwzekere skigebied Scuol/Samnaun ligt vlakbij. Daarnaast kun je winterwandelen, rodelen of over de Eisweg Engadin schaatsen door besneeuwde bossen. Na een koude dag warm je op bij de knisperende openhaard in de stube, met de kinderen in de speelkamer ernaast.', 'la-randulina' ),
		'knop'   => __( 'Bekijk de winteractiviteiten', 'la-randulina' ),
		'url'    => '/nl/activiteiten-winter/',
		'beeld'  => 'paneel-actief-winter.jpg',
		'alt'    => __( 'Bergbaan boven het besneeuwde skigebied Scuol Motta Naluns', 'la-randulina' ),
	),
);
?>
<!-- wp:html -->
<?php foreach ( $lr_seizoenen as $lr_sleutel => $lr_seizoen ) : ?>
	<section class="lr-binnen lr-duo<?php echo 'winter' === $lr_sleutel ? ' lr-duo--omgekeerd' : ''; ?>" data-seizoen="<?php echo esc_attr( $lr_sleutel ); ?>">

		<div class="lr-duo__beeld" data-onthul="beeld">
			<img
				src="<?php echo esc_url( get_theme_file_uri( 'assets/img/' . $lr_seizoen['beeld'] ) ); ?>"
				alt="<?php echo esc_attr( $lr_seizoen['alt'] ); ?>"
				width="1000" height="667" loading="lazy" decoding="async">
		</div>

		<div class="lr-duo__tekst" data-onthul="1">
			<h2><?php echo esc_html( $lr_seizoen['kop'] ); ?></h2>
			<p><?php echo esc_html( $lr_seizoen['tekst'] ); ?></p>
			<p>
				<a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $lr_seizoen['url'] ); ?>">
					<?php echo esc_html( $lr_seizoen['knop'] ); ?>
				</a>
			</p>
		</div>

	</section>
<?php endforeach; ?>
<!-- /wp:html -->
