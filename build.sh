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
cp -R assets/css assets/js assets/fonts assets/img assets/video site/assets/

echo "→ site-eigen stylesheets toevoegen"
cp site/css/*.css site/assets/css/

echo "→ ontwerpwaarden genereren uit theme.json"
node tools/genereer-basis-css.mjs

# --- thema voor WordPress ---------------------------------------------------
#
# Alleen de bestanden die WordPress nodig heeft. De repo bevat ook node_modules,
# de statische site en de bouwscripts; die horen niet in een themamap thuis en
# zouden het opstarten van Playground onnodig vertragen.

echo "→ thema samenstellen voor WordPress"
THEMA=wp/themes/la-randulina
rm -rf "$THEMA"
mkdir -p "$THEMA"
cp -R assets patterns parts templates functions.php style.css theme.json "$THEMA/"

echo "✓ klaar — site/ is deploybaar, wp/themes/ is te draaien met npm start"
