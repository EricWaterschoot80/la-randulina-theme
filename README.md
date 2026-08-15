# La Randulina

Alles voor de nieuwe website van Familielodge La Randulina in Ramosch (Unterengadin, Zwitserland) staat in deze ene map.

```
theme/          het WordPress blocktheme — de site zelf
site/           statische variant, gaat naar GitHub Pages
docs/           briefing van de klant, aangeleverde tekst, logo
beeld/web/      62 foto's, verwerkt en klaar voor gebruik
.ddev/          de lokale WordPress-omgeving
wp/             WordPress zelf, door DDEV neergezet (niet in git)
.playground/    blueprint voor de wegwerpversie
tools/          generator die basis.css uit theme.json maakt
```

Wat er bewust **niet** in staat: WordPress core (vijftig megabyte die je nooit aanpast, `ddev setup` haalt het op), `node_modules`, de gegenereerde `site/assets`, en de originele camerabestanden — die 77 MB blijft in Dropbox als archief.

---

## Lokaal draaien

Twee manieren. De eerste is de normale, de tweede is voor een snelle controle.

### DDEV — de werkomgeving

Hier bouw je in. Content blijft bewaard, en het is een echte MySQL met echte PHP, net als op de server straks.

Eenmalig: [Docker Desktop](https://www.docker.com/products/docker-desktop/) en [DDEV](https://ddev.readthedocs.io/en/stable/users/install/ddev-installation/) installeren. Daarna:

```bash
ddev start
ddev setup
```

`ddev setup` haalt WordPress op, koppelt het thema en maakt alle twaalf pagina's aan met de juiste sjablonen. Draai je het nog eens, dan blijft bestaande inhoud staan.

| | |
|---|---|
| Site | https://la-randulina.ddev.site |
| Beheer | https://la-randulina.ddev.site/wp-admin |
| Inloggen | `admin` / `admin` |

Het thema zit er met een **symlink** in: pas je iets aan in `theme/`, dan zie je het meteen. Geen bouwstap, geen upload.

### Playground — de wegwerpversie

```bash
npm install && npm start
```

Draait WordPress met PHP als WebAssembly en SQLite — geen Docker nodig. Alles wat je erin aanklikt is weg zodra je stopt, dus niet om content in op te bouwen. Wel handig om te controleren of het thema het ook doet in een volledig schone installatie.

### Alleen de statische site

```bash
npm run site
```

---

## Wat waar hoort

De regel die alles bepaalt: **wat in de database leeft, gaat nooit in git.** Pagina-inhoud en geüploade foto's synchroniseer je niet via deze repo. Alleen het thema en de opbouw van de site staan erin.

Voor **code** kunnen Eric en Mary tegelijk werken, via branches:

```bash
git switch -c mary/faq-styling
git push -u origin mary/faq-styling
```

Voor **pagina-inhoud** kan dat niet: daar wint simpelweg de laatste die opslaat. Verdeel de pagina's expliciet; de tabel staat in `docs/projectbriefing.md`.

---

## Online

| | |
|---|---|
| Statische site | https://ericwaterschoot80.github.io/la-randulina-theme/ |
| Wordt gebouwd door | `.github/workflows/pages.yml` |

Elke push naar `main` publiceert opnieuw. Een andere branch publiceren kan handmatig via de Actions-tab, mits die branch in de Pages-omgeving is toegestaan.

`.github/workflows/deploy.yml` staat klaar om het thema via SFTP naar echte hosting te sturen, zodra die er is. Vijf secrets invullen en het loopt.

---

## Het ontwerp

### De opening

Eén schermvullend beeld met de belofte erop, en verder niets. Pas als je scrolt volgen de vier doelgroeppanelen. Die volgorde komt van gradonna.at: eerst sfeer, dan pas de keuze. In de winter draait er een dronevideo achter de tekst.

### De vier panelen

Gezinnen, Wandelaars & fietsers, Stellen, Groepen — elk met een eigen foto per seizoen. Beweeg je over één paneel, dan verduistert de rest. Onder 60rem worden het gestapelde blokken, want hover bestaat daar niet.

### De seizoenswissel

Zon en sneeuwvlok in de koptekst:

1. PHP bepaalt het seizoen uit `?seizoen=winter`, anders uit de cookie, anders uit de kalender — november tot en met april is winter.
2. Het resultaat komt als class op het `html`-element, server-side, zodat de pagina meteen goed staat.
3. Klikken wisselt om zonder herladen. Zonder JavaScript volgt de browser de link en handelt de server het af.

Inhoud koppel je aan een seizoen met `data-seizoen="winter"`. In de blokeditor staat die class er bewust niet op, zodat een redacteur beide varianten ziet.

### Twee valkuilen die hier zijn opgelost

**Relatieve `url()` in een CSS-variabele.** Die wordt opgelost ten opzichte van het stylesheet dat hem gebruikt, niet ten opzichte van de pagina — je krijgt dan een 404 met een dubbel pad, zonder foutmelding. De patronen gebruiken daarom `get_theme_file_uri()`.

**Blokafstand vóór het eerste blok.** WordPress zet daar standaard ruimte, waardoor een absoluut geplaatste koptekst buiten het beeld eronder valt. `.lr-opening` en `.lr-panelen` zetten `margin-block-start: 0`.

### Het logo

Het aangeleverde `docs/logo-origineel.svg` bevat de naam als losse letters in het lettertype Juice ITC, dat bezoekers niet hebben — zonder dat font schuiven ze over elkaar heen. We gebruiken alleen het beeldmerk (de zwaluw met edelweiss) en zetten de naam ernaast in Fraunces.

**Vraag aan de ontwerper: lever een versie met de letters omgezet naar paden.**

---

## Nog te doen

- De elf onderliggende pagina's vullen met de teksten uit `docs/klanttekst-john.docx`
- Contactformulier
- Meertaligheid: de huidige site draait op WPML met Duits op de root, Nederlands op `/nl/`, Engels op `/en/`
- Redirects van oude naar nieuwe URL's
- Fotografie: van de 62 foto's zijn er maar twee professioneel én liggend. Zie de projectbriefing.
- De chatbot met MyTourist-koppeling — fase 2
