# La Randulina

Nieuwe website voor Familielodge La Randulina in Ramosch (Unterengadin, Zwitserland).

Deze repo bevat **twee dingen die dezelfde ontwerpbasis delen**:

| Map | Wat | Waar het draait |
|---|---|---|
| root (`theme.json`, `templates/`, `parts/`, `patterns/`) | WordPress blocktheme | Op WordPress-hosting met PHP |
| `site/` | Statische site | Op Vercel |

`assets/` (CSS, JS, fonts, beeld) wordt door allebei gebruikt. `build.sh` kopieert die naar `site/assets/` en genereert `basis.css` uit `theme.json`, zodat de twee nooit uit elkaar kunnen lopen: pas je een kleur aan in `theme.json`, dan verandert hij op beide plekken.

```bash
bash build.sh          # bouwt site/ , klaar om te deployen
```

---

## Over inloggen — belangrijk

**Er bestaat op dit moment geen WordPress-site en dus ook geen login.** Er is nog niets geïnstalleerd. Dat is geen omissie, het volgt uit de hostingkeuze:

- **GitHub** bewaart code. Je logt daar in op de repo, niet op een website.
- **Vercel** serveert kant-en-klare bestanden. Er is een openbare URL om de site te bekijken, maar geen beheeromgeving om teksten in aan te passen.
- **WordPress** heeft PHP en een database nodig. Dat kan niet op Vercel en niet op GitHub.

Wil je kunnen inloggen om content te beheren, dan zijn er twee wegen:

### A. Statisch op Vercel, met een CMS dat via GitHub inlogt

Voeg een headless CMS toe (Sveltia CMS of Decap CMS). Hoe dat werkt:

1. Je gaat naar `larandulina.nl/admin` en logt in **met je GitHub-account** — dus met het account waar `eric.waterschoot@gmail.com` aan hangt.
2. Je bewerkt teksten in een gewone editor.
3. Opslaan schrijft een commit naar deze repo.
4. Vercel ziet die commit en zet de site binnen een minuut live.

Voordelen: geen serveronderhoud, geen updates, geen beveiligingslek, en alles staat versiebeheerd in GitHub. Mary kan hetzelfde doen met haar account. Nadeel: John moet ook een GitHub-account hebben, of we regelen een aparte inlog.

### B. Echte WordPress op PHP-hosting

Dan krijg je het vertrouwde `wp-admin` met e-mail en wachtwoord, en kan John zonder GitHub werken. Maar dan is Vercel niet de hosting — daar is een pakket met PHP en MySQL voor nodig.

**Mijn advies: A.** De site heeft geen webshop, geen inlogomgeving voor gasten en geen dagelijkse blogposts. Wat er beheerd moet worden zijn teksten, foto's en prijzen. Daar is een git-gebaseerd CMS ruim voldoende voor, en het is aanzienlijk goedkoper en veiliger in onderhoud. De boekingen lopen toch al via MyTourist.

Dit is nog niet ingebouwd — zeg het als je richting A wilt, dan zet ik het erin.

---

## Deployen naar Vercel

`vercel.json` staat klaar. In Vercel:

1. **New Project** → deze GitHub-repo koppelen.
2. Framework laat je op *Other* staan; build command en output directory komen uit `vercel.json`.
3. Deploy. Elke push naar `main` zet vanzelf een nieuwe versie live, elke pull request krijgt een eigen preview-URL.

De preview-URL van een pull request is precies wat je aan John kunt sturen om mee te kijken.

---

## Samenwerken

Eric en Mary werken allebei aan deze repo, via branches:

```bash
git switch -c mary/faq-styling
git push -u origin mary/faq-styling
```

Daarna een pull request openen. Niet direct naar `main` pushen — dat is wat live gaat.

---

## Wat er in zit

```
theme.json              kleuren, typografie, ruimte — de complete ontwerpbasis
templates/              front-page, page, page-doelgroep, page-breed, index, 404
parts/                  header (met logo en seizoenswissel), footer
patterns/               hero-panelen, logo, seizoenswissel, home-intro,
                        home-persoonlijk, home-seizoen, home-inbegrepen,
                        home-boeken, faq
assets/css/             fonts, stijl, secties, panelen, seizoen
assets/js/              seizoen.js
assets/img/             hero, panelen, sectiebeeld, logo
assets/fonts/           Fraunces en Karla, zelf gehost
site/index.html         de statische homepagina
site/css/               statisch.css — koptekst en voettekst voor de statische bouw
tools/                  generator die basis.css uit theme.json maakt
```

### De vier panelen

Eén doorlopende foto, verdeeld in vier klikbare panelen naar de doelgroepen — naar het voorbeeld van gradonna.at. Hover op één paneel en de rest verduistert. Onder 60rem bestaat hover niet, dus daar worden het vier gestapelde blokken met elk een eigen foto.

### De seizoenswissel

Zon en sneeuwvlok in de koptekst, naar dasgerstlfamily.com:

1. PHP (of bij de statische versie: JavaScript) bepaalt het seizoen uit de URL `?seizoen=winter`, anders uit de cookie, anders uit de kalender — november tot en met april is winter.
2. Het resultaat komt als class `seizoen-zomer` of `seizoen-winter` op het `html`-element, zodat de pagina meteen goed staat.
3. Klikken wisselt om zonder herladen. Zonder JavaScript volgt de browser de link en handelt de server het af.

Inhoud koppel je aan een seizoen met `data-seizoen="winter"`. In de blokeditor staat de seizoensclass er bewust niet op, zodat een redacteur beide varianten kan zien.

### Het logo

Het aangeleverde `larandulina-logo-wit.svg` bevat de naam als twaalf losse letters in het lettertype **Juice ITC**. Bezoekers hebben dat font niet, waardoor de letters over elkaar heen schuiven. Daarom gebruiken we `logo-merk-wit.svg` — alleen het beeldmerk, de zwaluw met edelweiss — en zetten we de naam in de pagina zelf in Fraunces.

**Vraag aan de ontwerper: lever een versie waarin de letters naar paden zijn omgezet.** Dan kan het logo weer als één geheel gebruikt worden.

### Vaste externe links

Boeking en kamerpagina's houden hun bestaande URL's. Ze staan op één plek, in `la_randulina_links()` in `functions.php`. In de inhoud kun je de shortcode gebruiken:

```
[lr_boeken tekst="Bekijk beschikbaarheid"]
```

---

## Nog te doen

- Beslissen tussen weg A en B hierboven, want dat bepaalt de rest.
- De overige pagina's: doelgroeppagina's, kamers, eten & drinken, praktisch & FAQ, contact.
- Meertaligheid: de huidige site draait op WPML met Duits op de root, Nederlands op `/nl/` en Engels op `/en/`. Bij de statische route regelen we dat met aparte mappen per taal.
- Redirects van oude naar nieuwe URL's.
- Betere fotografie: van de 62 aangeleverde foto's zijn er maar twee professioneel én liggend. Zie de projectbriefing.
