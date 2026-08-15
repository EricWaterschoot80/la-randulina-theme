/**
 * Secties komen rustig in beeld tijdens het scrollen.
 *
 * Dit is wat een site als gradonna.at kalm laat aanvoelen: de inhoud staat er
 * niet al, hij arriveert. Randvoorwaarden:
 *
 * - Zonder JavaScript is alles gewoon zichtbaar. De verbergende CSS wordt hier
 *   pas aangezet, dus een bezoeker zonder scripts mist niets.
 * - Wie "verminder beweging" aan heeft staan, krijgt geen animatie.
 * - Alles wat het venster al gepasseerd is, moet zichtbaar zijn. Dat klinkt
 *   vanzelfsprekend, maar het is precies waar een IntersectionObserver hier
 *   op stukliep: bij een sprong naar een anker, of bij scrollherstel na de
 *   terugknop, gaat een element van "onder beeld" naar "boven beeld" zonder
 *   ooit te kruisen. De waarnemer meldt dan niets en het blok blijft leeg.
 *   Daarom kijken we simpelweg naar de positie, elke frame dat er scrolt.
 */
( function () {
	'use strict';

	var rustiger = window.matchMedia( '(prefers-reduced-motion: reduce)' );

	if ( rustiger.matches ) {
		return;
	}

	var doelen = Array.prototype.slice.call( document.querySelectorAll( '[data-onthul]' ) );

	if ( ! doelen.length ) {
		return;
	}

	// Pas nu aanzetten: staat dit in de CSS zelf, dan blijft de pagina leeg
	// als dit script niet laadt.
	document.documentElement.classList.add( 'lr-onthult' );

	var bezig = false;
	var klok = 0;

	function onthul( element, meteen ) {
		if ( ! meteen ) {
			var trap = parseInt( element.dataset.onthul, 10 );
			if ( trap ) {
				element.style.setProperty( '--lr-onthul-wacht', trap * 90 + 'ms' );
			}
		}

		element.classList.add( 'is-zichtbaar' );
	}

	function nalopen() {
		var grens = window.innerHeight * 0.88;

		doelen = doelen.filter( function ( element ) {
			if ( element.getBoundingClientRect().top > grens ) {
				return true;
			}

			onthul( element );
			return false;
		} );

		if ( ! doelen.length ) {
			window.removeEventListener( 'scroll', plannen );
			window.removeEventListener( 'resize', plannen );
			window.clearInterval( klok );
		}
	}

	/*
	 * Direct nalopen, niet via requestAnimationFrame. Die vuurt namelijk niet
	 * in een tab die op de achtergrond staat, en dan zou de inhoud onzichtbaar
	 * blijven tot de bezoeker gaat scrollen. Het nalopen zelf is goedkoop: het
	 * gaat om een handvol elementen en de lijst krimpt tot nul, waarna de
	 * luisteraars zichzelf opruimen.
	 */
	function plannen() {
		if ( bezig ) {
			return;
		}

		bezig = true;
		nalopen();
		bezig = false;
	}

	// Wat bij het laden al in beeld staat, verschijnt zonder vertraging.
	doelen = doelen.filter( function ( element ) {
		if ( element.getBoundingClientRect().top > window.innerHeight ) {
			return true;
		}

		onthul( element, true );
		return false;
	} );

	if ( doelen.length ) {
		// Reageert onmiddellijk tijdens gewoon scrollen.
		window.addEventListener( 'scroll', plannen, { passive: true } );
		window.addEventListener( 'resize', plannen );

		/*
		 * En een klok als vangnet. Dat lijkt omslachtig naast een scroll-
		 * luisteraar, maar het dekt de gevallen waarin die niets meldt:
		 * een sprong naar een anker, scrollherstel na de terugknop, of een
		 * pagina die in een achtergrondtab is geopend. In die laatste situatie
		 * ligt ook requestAnimationFrame stil — een timer niet.
		 *
		 * Zonder dit vangnet kan inhoud permanent op opacity 0 blijven staan,
		 * en onzichtbare tekst is een veel groter probleem dan een animatie
		 * die een fractie later begint. De klok stopt zichzelf zodra alles
		 * onthuld is.
		 */
		klok = window.setInterval( plannen, 300 );
	}

	// Blokken kunnen ook zichtbaar worden door de seizoenswissel, zonder dat
	// er gescrold is. Dan alsnog nalopen, anders blijft zo'n blok leeg.
	document.addEventListener( 'lr:seizoen', plannen );
} )();
