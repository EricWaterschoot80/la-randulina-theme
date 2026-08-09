#!/usr/bin/env bash
#
# Bouwt de statische site in site/ , klaar om te deployen.
#
# De ontwerpwaarden komen uit theme.json — dezelfde bron die WordPress
# gebruikt. Zo kunnen de statische site en het thema niet uit elkaar lopen.

set -euo pipefail
cd "$(dirname "$0")"

echo "→ assets kopiëren"
rm -rf site/assets
mkdir -p site/assets
cp -R assets/css assets/js assets/fonts assets/img site/assets/

echo "→ site-eigen stylesheets toevoegen"
cp site/css/*.css site/assets/css/

echo "→ ontwerpwaarden genereren uit theme.json"
node tools/genereer-basis-css.mjs

echo "✓ klaar — site/ is deploybaar"
