/**
 * Genereert site/assets/css/basis.css uit theme.json.
 *
 * WordPress maakt deze CSS-variabelen zelf aan uit theme.json. De statische
 * site heeft geen WordPress, dus doen we het hier. Door dezelfde bron te
 * gebruiken kunnen de twee niet uit elkaar lopen: pas je een kleur aan in
 * theme.json, dan verandert hij op beide plekken.
 */

import { readFileSync, writeFileSync, mkdirSync } from 'node:fs';
import { dirname, resolve } from 'node:path';
import { fileURLToPath } from 'node:url';

const wortel = resolve(dirname(fileURLToPath(import.meta.url)), '..');
const thema = JSON.parse(readFileSync(resolve(wortel, 'theme/theme.json'), 'utf8'));

const inst = thema.settings;
const stijl = thema.styles;
const regels = [];

/** '1.25rem' -> 1.25, of null als het geen rem-waarde is. */
const remGetal = (waarde) => {
	const n = Number.parseFloat(String(waarde).replace('rem', ''));
	return String(waarde).endsWith('rem') && Number.isFinite(n) ? n : null;
};

for (const kleur of inst.color.palette) {
	regels.push(`--wp--preset--color--${kleur.slug}: ${kleur.color};`);
}

for (const fam of inst.typography.fontFamilies) {
	regels.push(`--wp--preset--font-family--${fam.slug}: ${fam.fontFamily};`);
}

for (const maat of inst.typography.fontSizes) {
	let waarde = maat.size;

	if (maat.fluid && typeof maat.fluid === 'object') {
		const lo = remGetal(maat.fluid.min);
		const hi = remGetal(maat.fluid.max);

		if (lo !== null && hi !== null) {
			// Lineair tussen een viewport van 20rem (320px) en 80rem (1280px).
			const helling = ((hi - lo) / 60).toFixed(5);
			waarde = `clamp(${maat.fluid.min}, calc(${lo}rem + ${helling} * (100vw - 20rem)), ${maat.fluid.max})`;
		}
	}

	regels.push(`--wp--preset--font-size--${maat.slug}: ${waarde};`);
}

for (const ruimte of inst.spacing.spacingSizes) {
	regels.push(`--wp--preset--spacing--${ruimte.slug}: ${ruimte.size};`);
}

const tekst = stijl.typography;
const knop = stijl.elements.button;
const kop = stijl.elements.heading.typography;
const link = stijl.elements.link;

const css = `/*
 * AUTOMATISCH GEGENEREERD uit theme.json — niet handmatig aanpassen.
 * Draai \`npm run build\` of \`bash build.sh\` om dit bestand te vernieuwen.
 */

:root {
${regels.map((r) => `\t${r}`).join('\n')}
}

*, *::before, *::after { box-sizing: border-box; }

body {
	margin: 0;
	background-color: ${stijl.color.background};
	color: ${stijl.color.text};
	font-family: ${tekst.fontFamily};
	font-size: ${tekst.fontSize};
	line-height: ${tekst.lineHeight};
	-webkit-font-smoothing: antialiased;
}

h1, h2, h3, h4 {
	font-family: ${kop.fontFamily};
	font-weight: ${kop.fontWeight};
	line-height: ${kop.lineHeight};
	letter-spacing: ${kop.letterSpacing};
	text-wrap: balance;
}

h1 { font-size: var(--wp--preset--font-size--hero); }
h2 { font-size: var(--wp--preset--font-size--xx-large); }
h3 { font-size: var(--wp--preset--font-size--x-large); }

p { text-wrap: pretty; }

a { color: ${link.color.text}; }
a:hover { color: ${link[':hover'].color.text}; }

.wp-element-button {
	display: inline-block;
	background-color: ${knop.color.background};
	color: ${knop.color.text};
	border: ${knop.border.width ?? '0'} ${knop.border.style ?? 'solid'} ${knop.border.color ?? 'transparent'};
	border-radius: ${knop.border.radius};
	padding: ${knop.spacing.padding.top} ${knop.spacing.padding.right};
	font-family: ${knop.typography.fontFamily};
	font-size: ${knop.typography.fontSize};
	font-weight: ${knop.typography.fontWeight};
	letter-spacing: ${knop.typography.letterSpacing};
	text-transform: ${knop.typography.textTransform ?? 'none'};
	text-decoration: none;
	cursor: pointer;
	transition: background-color 260ms ease, color 260ms ease, border-color 260ms ease;
}

.wp-element-button:hover {
	background-color: ${knop[':hover'].color.background};
	color: ${knop[':hover'].color.text};
}

.screen-reader-text {
	position: absolute;
	width: 1px;
	height: 1px;
	overflow: hidden;
	clip-path: inset(50%);
	white-space: nowrap;
}
`;

const doel = resolve(wortel, 'site/assets/css');
mkdirSync(doel, { recursive: true });
writeFileSync(resolve(doel, 'basis.css'), css);

console.log(`   ${regels.length} variabelen geschreven naar site/assets/css/basis.css`);
