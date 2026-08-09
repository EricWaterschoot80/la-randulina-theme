# La Randulina — WordPress blocktheme

Thema voor de nieuwe website van Familielodge La Randulina in Ramosch (Unterengadin, Zwitserland).

## Hoe de opzet in elkaar zit

Drie plekken, elk met één taak:

| Waar | Wat |
|---|---|
| **Deze repo** | Het thema: templates, patronen, CSS, JS, fonts |
| **WordPress-hosting** | De site zelf: pagina's, teksten, mediabibliotheek, database |
| **Google Drive** | Bronbestanden: originele foto's, briefing, referenties |

Wat in de database leeft gaat nooit in git. Pagina-inhoud en geüploade foto's synchroniseer je dus niet via deze repo — daarvoor werken we in dezelfde WordPress-omgeving.

## Samenwerken

Eric en Mary werken allebei aan dit thema, via branches:

```bash
git switch -c mary/faq-styling
# wijzigingen maken
git push -u origin mary/faq-styling
```

Daarna een pull request openen. Niet direct naar `main` pushen — dat is wat er live gaat.

Voor **pagina-inhoud** in WordPress geldt het omgekeerde: daar bestaat geen merge. Verdeel de pagina's expliciet en werk nooit tegelijk in dezelfde pagina. De verdeling staat in `Projectbriefing La Randulina.md`.

## Deploy

Elke push naar `main` stuurt het thema via GitHub Actions over SFTP naar de server. Voordat dat werkt, moeten deze secrets in de repo staan (Settings → Secrets and variables → Actions):

| Secret | Waarde |
|---|---|
| `SFTP_HOST` | hostnaam van de server |
| `SFTP_USER` | SFTP-gebruikersnaam |
| `SFTP_PASSWORD` | wachtwoord |
| `SFTP_PORT` | poort, laat leeg voor 22 |
| `SFTP_REMOTE_PATH` | `/pad/naar/wp-content/themes/la-randulina` |

## Wat er in zit

```
theme.json          kleuren, typografie, ruimte — de complete ontwerpbasis
templates/          front-page, page, page-doelgroep, page-breed, index, 404
parts/              header (met seizoenswissel), footer
patterns/           hero-panelen, seizoenswissel, seizoensblok, faq
assets/css/         fonts, algemene stijl, panelen, seizoen
assets/js/          seizoen.js
assets/img/         hero- en paneelbeelden
assets/fonts/       Fraunces en Karla, zelf gehost
```

### De vier panelen

De homepage toont één doorlopende foto, verdeeld in vier klikbare panelen naar de doelgroeppagina's — naar het voorbeeld van gradonna.at. Beweeg je over één paneel, dan verduistert de rest. Op schermen smaller dan 60rem bestaat hover niet, dus daar worden het vier gestapelde blokken met elk hun eigen foto.

### De seizoenswissel

Zon en sneeuwvlok in de header, naar het voorbeeld van dasgerstlfamily.com. Hoe het werkt:

1. PHP bepaalt het seizoen uit de URL (`?seizoen=winter`), anders uit de cookie, anders uit de kalender — november tot en met april is winter.
2. Het resultaat komt als class `seizoen-zomer` of `seizoen-winter` op het `html`-element, server-side. Daardoor staat de pagina meteen goed en zie je niet eerst het verkeerde seizoen.
3. `seizoen.js` vangt de klik af en wisselt om zonder herladen. Zonder JavaScript volgt de browser gewoon de link en handelt PHP het af.

Inhoud koppel je aan een seizoen met een `data-seizoen`-attribuut:

```html
<div data-seizoen="winter">Alleen zichtbaar in de winter</div>
```

In de blokeditor staat de seizoensclass er bewust niet op, zodat een redacteur beide varianten kan zien en bewerken.

### Vaste externe links

Boeking en kamerpagina's houden hun bestaande URL's — dat was een eis van de klant. Ze staan op één plek, in `la_randulina_links()` in `functions.php`. Voor een boekingsknop in de inhoud kun je de shortcode gebruiken:

```
[lr_boeken tekst="Bekijk beschikbaarheid"]
```

## Nog te doen

- Beelden voor de panelen zijn een voorlopige keuze. Van de 62 aangeleverde foto's zijn er maar drie professioneel én liggend, wat weinig is voor schermvullende hero's. Dit staat als openstaand punt in de projectbriefing.
- WPML inrichten voor Duits en Engels, zoals de huidige site die ook heeft.
- Redirects van oude naar nieuwe URL's.
