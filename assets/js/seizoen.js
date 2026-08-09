/**
 * Zomer/winter-schakelaar.
 *
 * De knoppen zijn in de HTML gewone links naar ?seizoen=winter of
 * ?seizoen=zomer. Werkt JavaScript, dan vangen we de klik af en wisselen we
 * direct om zonder de pagina opnieuw te laden. Werkt het niet, dan volgt de
 * browser de link en handelt PHP het af. Beide wegen komen op hetzelfde uit.
 */
( function () {
	'use strict';

	var SEIZOENEN = [ 'zomer', 'winter' ];
	var COOKIE = 'lr_seizoen';
	var wortel = document.documentElement;

	function bewaar( seizoen ) {
		// Een jaar houdbaar; SameSite=Lax omdat de keuze niet gevoelig is.
		document.cookie =
			COOKIE + '=' + seizoen + ';path=/;max-age=31536000;SameSite=Lax' +
			( location.protocol === 'https:' ? ';Secure' : '' );
	}

	function huidig() {
		return wortel.classList.contains( 'seizoen-winter' ) ? 'winter' : 'zomer';
	}

	function toepassen( seizoen ) {
		if ( SEIZOENEN.indexOf( seizoen ) === -1 || seizoen === huidig() ) {
			return;
		}

		SEIZOENEN.forEach( function ( naam ) {
			wortel.classList.toggle( 'seizoen-' + naam, naam === seizoen );
		} );

		bewaar( seizoen );
		knoppenBijwerken( seizoen );

		// Zodat andere onderdelen (straks bijvoorbeeld de chatbot) kunnen
		// meebewegen zonder dat ze dit bestand hoeven te kennen.
		document.dispatchEvent(
			new CustomEvent( 'lr:seizoen', { detail: { seizoen: seizoen } } )
		);
	}

	function knoppenBijwerken( seizoen ) {
		document.querySelectorAll( '[data-lr-seizoen]' ).forEach( function ( knop ) {
			knop.setAttribute(
				'aria-pressed',
				knop.dataset.lrSeizoen === seizoen ? 'true' : 'false'
			);
		} );
	}

	document.addEventListener( 'click', function ( gebeurtenis ) {
		var knop = gebeurtenis.target.closest( '[data-lr-seizoen]' );

		if ( ! knop ) {
			return;
		}

		gebeurtenis.preventDefault();
		toepassen( knop.dataset.lrSeizoen );
	} );

	// De cookie is bij het eerste bezoek nog niet gezet, terwijl PHP wel al
	// een seizoen op basis van de kalender heeft gekozen. Die keuze leggen we
	// hier vast, zodat server en browser het daarna eens zijn.
	if ( document.cookie.indexOf( COOKIE + '=' ) === -1 ) {
		bewaar( huidig() );
	}

	knoppenBijwerken( huidig() );
} )();
