#!/usr/bin/env bash
#
# Bouwt twee dingen uit dezelfde bron:
#
#   site/            de statische site, klaar om te deployen
#   wp/themes/       een schone kopie van het thema, om WordPress mee te draaien
#
# De ontwerpwaarden komen uit theme.json — dezelfde bron die WordPress
# gebruikt. Zo kunnen de statische site en het thema niet uit elkaar lopen.

set -euo pipefail
cd "$(dirname "$0")"

# --- statische site ---------------------------------------------------------

echo "→ assets kopiëren"
rm -rf site/assets
mkdir -p site/assets
cp -R theme/assets/css theme/assets/js theme/assets/fonts theme/assets/img theme/assets/video site/assets/

echo "→ site-eigen stylesheets toevoegen"
cp site/css/*.css site/assets/css/

echo "→ ontwerpwaarden genereren uit theme.json"
node tools/genereer-basis-css.mjs

# --- thema voor Playground --------------------------------------------------
#
# Alleen voor de wegwerpversie (npm start). DDEV heeft dit niet nodig: daar
# hangt theme/ er met een symlink in, zodat een wijziging meteen zichtbaar is.
#
# Deze kopie staat bewust niet in wp/ — die map is van DDEV, waar WordPress
# zelf komt te staan.

echo "→ thema samenstellen voor Playground"
THEMA=.playground/themes/la-randulina
rm -rf "$THEMA"
mkdir -p "$THEMA"
cp -R theme/assets theme/patterns theme/parts theme/templates theme/functions.php theme/style.css theme/theme.json "$THEMA/"

echo "✓ klaar — site/ is deploybaar, .playground/themes/ is te draaien met npm start"
