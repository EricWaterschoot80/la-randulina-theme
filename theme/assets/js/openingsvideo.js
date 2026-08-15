/**
 * De video in de opening.
 *
 * CSS verbergt hem al in de zomer en bij "verminder beweging", maar verborgen
 * is niet hetzelfde als gestopt: een browser kan een video met display:none
 * gewoon door blijven decoderen. Dat kost accuduur voor beeld dat niemand
 * ziet. Hier wordt hij daarom ook echt gepauzeerd.
 */
( function () {
	'use strict';

	var video = document.querySelector( '.lr-opening__video' );

	if ( ! video ) {
		return;
	}

	var rustiger = window.matchMedia( '(prefers-reduced-motion: reduce)' );

	function hoort_te_spelen() {
		return ! rustiger.matches &&
			document.documentElement.classList.contains( 'seizoen-winter' );
	}

	function afstemmen() {
		if ( hoort_te_spelen() ) {
			// play() geeft een promise die afgewezen kan worden, bijvoorbeeld
			// als de browser autoplay blokkeert. Dat is geen fout die de
			// bezoeker iets kan schelen: de posterfoto blijft dan staan.
			var poging = video.play();

			if ( poging && typeof poging.catch === 'function' ) {
				poging.catch( function () {} );
			}

			return;
		}

		video.pause();
	}

	document.addEventListener( 'lr:seizoen', afstemmen );
	rustiger.addEventListener( 'change', afstemmen );

	// Een video die niet in beeld staat hoeft niet te draaien.
	if ( 'IntersectionObserver' in window ) {
		new IntersectionObserver( function ( items ) {
			items.forEach( function ( item ) {
				if ( item.isIntersecting ) {
					afstemmen();
					return;
				}

				video.pause();
			} );
		} ).observe( video );
	}

	afstemmen();
} )();
