# Projectbriefing — Nieuwe website Familielodge La Randulina

**Klant:** John, Ilona & Luna — Familielodge La Randulina, Ramosch (Unterengadin, Zwitserland)
**Bureau:** u-digital — Eric Waterschoot, samen met Mary
**Datum:** 9 augustus 2026
**Huidige site:** https://larandulina.com/nl/

---

## 1. Wat de klant wil

John heeft een complete tekstbriefing aangeleverd (`Hotel La Randulina tekst.docx`) plus 62 foto's in `nieuwe website/`. Kern van de opdracht: dezelfde lodge, maar een site die bezoekers meteen naar hun eigen situatie leidt in plaats van naar een algemene homepage.

Drie dingen moeten echt anders dan nu:

1. **Splitsing naar doelgroep** — bezoekers kiezen zichzelf: gezinnen, wandelaars & fietsers, stellen, groepen.
2. **Splitsing naar seizoen** — zomer en winter krijgen eigen pagina's én een schakelaar in de header.
3. **Chatfunctie** — komt later, in een tweede fase.

---

## 2. Referentiesites en wat ze daar precies mooi aan vinden

### Gradonna Mountain Resort — https://www.gradonna.at/

Wat ze willen overnemen: **de vier hero-blokken**. De homepage is één doorlopende schermvullende foto, verticaal verdeeld in vier panelen. Elk paneel heeft een eigen label en licht op als je eroverheen beweegt; de rest van het beeld verduistert dan. Op Gradonna zijn dat *Gourmet & Genuss*, *Nachhaltiger Urlaub*, *Berge & Natur* en *Entspannen & Wohlfühlen*.

Voor La Randulina worden dat de vier doelgroepen uit de briefing:

| Paneel | Label | Gaat naar |
|---|---|---|
| 1 | Gezinnen | `/nl/gezinnen/` |
| 2 | Wandelaars & fietsers | `/nl/wandelaars-fietsers/` |
| 3 | Stellen | `/nl/stellen/` |
| 4 | Groepen | `/nl/groepen/` |

Aandachtspunt: dit effect werkt met een muis, maar niet op mobiel. Daar worden het vier gestapelde blokken onder elkaar, elk met eigen foto. Dat moet vanaf het ontwerp meegenomen worden, niet achteraf.

### Das Gerstl Family Retreat — https://www.dasgerstlfamily.com/en/

Wat ze willen overnemen: **de seizoenswissel**. Ik heb hem in de browser nagelopen; zo werkt hij daar:

- Twee ronde icoontjes linksboven in de header, direct naast het menu: een zonnetje en een sneeuwvlok. De actieve staat is duidelijk gemarkeerd.
- Klikken wisselt het volledige hero-beeld van zomer naar winter, en ook de zwevende badges veranderen mee (in winter verschijnt bijvoorbeeld "Skiing just 600 m away").
- De URL blijft hetzelfde. Het is dus een modus over de hele site, geen aparte pagina.

Voor La Randulina combineren we beide: de schakelaar in de header stuurt beeld en accenten aan, én er komen aparte pagina's *Activiteiten zomer* en *Activiteiten winter* zoals John vraagt. De gekozen modus onthouden we in de browser, zodat een winterbezoeker niet op elke pagina opnieuw hoeft te klikken.

---

## 3. Bestaande URL's die gelijk moeten blijven

De huidige site draait al op WordPress met WPML in drie talen. **Boeking en kamerpagina's houden hun bestaande links** — dat was een expliciete eis.

| Wat | URL |
|---|---|
| Boekingssysteem | `https://la-randulina.w.mytourist.cloud/nl/availability` (MyTourist) |
| Onze kamers | `https://larandulina.com/nl/onzekamers/` |
| Menukaart | `https://larandulina.com/menu/` |
| Zomer (bestaand) | `https://larandulina.com/nl/de-omgeving/zomer/` |
| Winter (bestaand) | `https://larandulina.com/nl/de-omgeving/winter/` |
| Komoot-routes | `https://www.komoot.com/de-de/user/larandulina/collections` |

**Talen:** Duits is de hoofdtaal op de root (`/`), Nederlands op `/nl/`, Engels op `/en/`. Die verdeling houden we aan.

Voor alle overige pagina's die van adres veranderen komt een redirectlijst, anders verdwijnt de bestaande vindbaarheid in Google.

---

## 4. Sitestructuur

```
Home  ──  4 doelgroeppanelen + seizoenswissel
│
├── Gezinnen              ┐
├── Wandelaars & fietsers │  de vier doelgroeppagina's,
├── Stellen               │  elk met zomer- en winterinhoud
├── Groepen               ┘
│
├── Onze kamers           (bestaande URL behouden)
├── Eten & drinken        (menukaart + trattoria-shuttle)
├── Over ons              (John, Ilona, Luna, hond Tommy)
├── Activiteiten zomer    ┐  de seizoenssplitsing
├── Activiteiten winter   ┘
├── Praktische info & FAQ
└── Contact & route       (met contactformulier)
```

Twee assen dus, die elkaar kruisen: **wie ben je** (vier doelgroepen) en **wanneer kom je** (twee seizoenen). Elke doelgroeppagina toont zomer- of winterinhoud afhankelijk van de gekozen modus.

---

## 5. Techniek

| Onderdeel | Keuze |
|---|---|
| Platform | WordPress met een eigen blocktheme (Gutenberg, geen pagebuilder) |
| Meertaligheid | WPML, zoals nu al draait |
| Thema in versiebeheer | Privé GitHub-repo, deploy via GitHub Action naar de hosting |
| Beeld | Zelf gehoste WebP, lazy loading |
| Fonts | Zelf gehost in het thema, dus geen verbinding met Google |
| Boeking | Doorverwijzing naar MyTourist, geen eigen boekingsmodule |

---

## 6. Fase 2 — de chatbot

John wil een AI-chatbot die realtime beschikbaarheid ophaalt uit MyTourist PMS, zodat een vraag als *"Heb je van 1 tot 3 maart nog een kamer met eigen badkamer?"* direct antwoord krijgt met een boekingslink.

Dat kan technisch: MyTourist heeft een gedocumenteerde REST API en de sleutel is in hun eigen omgeving aan te maken. Maar het is een apart traject, om twee redenen:

- De API-sleutel mag nooit in de browser terechtkomen. Er is dus een server-side tussenlaag nodig die de aanvraag doorzet.
- Beschikbaarheid en prijzen tonen betekent verantwoordelijkheid voor de juistheid ervan. Dat vraagt afspraken over wat er gebeurt als de koppeling er even uit ligt.

Voorstel: eerst de site live, daarna dit als losse opdracht offreren.

---

## 7. Planning

Prototype tonen over twee tot drie weken, dus rond **24 tot 31 augustus 2026**.

| Week | Wat |
|---|---|
| Week 1 (11–17 aug) | Staging opzetten, thema-fundering, beeld verwerken, ontwerprichting |
| Week 2 (18–24 aug) | Homepage met de vier panelen en de seizoenswissel, één doelgroeppagina volledig af |
| Week 3 (25–31 aug) | **Prototype tonen aan John** + prijsindicatie |
| Daarna | Overige pagina's, vertalingen DE/EN, redirects, testen, live |

Het prototype is bewust smal: homepage plus één uitgewerkte doelgroeppagina. Genoeg om de look, de vier panelen en de seizoenswissel te beoordelen, zonder dat er elf pagina's gebouwd zijn die daarna misschien omgegooid moeten worden.

---

## 8. Prijsindicatie — urenopzet

Onderstaande urenverdeling is de basis voor de offerte. Tarief en totaal vult Eric in.

| Onderdeel | Uren (indicatie) |
|---|---|
| Ontwerp en prototype | 16 – 24 |
| Blocktheme bouwen (panelen, seizoenswissel, templates) | 32 – 40 |
| Content opbouwen Nederlands | 16 – 20 |
| WPML inrichten Duits en Engels (excl. vertaalkosten) | 10 – 14 |
| Beeldbewerking en optimalisatie | 6 – 8 |
| Formulieren, FAQ, SEO-basis, redirects | 10 – 14 |
| Testen, browsercheck, livegang | 8 – 10 |
| **Totaal** | **98 – 130 uur** |

Niet inbegrepen: de chatbot met MyTourist-koppeling (fase 2), vertaalkosten voor Duits en Engels, fotografie, en hosting.

---

## 9. Werkverdeling Eric en Mary

Het thema staat in GitHub, dus daar kunnen we allebei tegelijk aan werken via branches. Pagina-inhoud in WordPress kan dat níét: daar wint simpelweg de laatste die opslaat. Daarom verdelen we de pagina's expliciet.

| Pagina | Wie |
|---|---|
| Home (vier panelen, seizoenswissel) | Eric |
| Gezinnen | |
| Wandelaars & fietsers | |
| Stellen | |
| Groepen | |
| Onze kamers | |
| Eten & drinken | |
| Over ons | |
| Activiteiten zomer | |
| Activiteiten winter | |
| Praktische info & FAQ | |
| Contact & route | |

Beelden staan in Google Drive, gedeeld met Mary en John.

---

## 10. Controle op de briefing

Nagelopen wat John vroeg tegen wat er staat.

| Uit de briefing | Status |
|---|---|
| Menu: Home, Over ons, Onze kamers, Eten & drinken, Praktische info & FAQ, Contact & route | **compleet** — Home ontbrak eerst |
| Vier aanklikbare doelgroepblokken | staat er, elk met eigen foto per seizoen |
| Zomer/winter schakelen met zon en sneeuwvlok | staat er, wisselt opening én panelen |
| Activiteiten zomer en winter apart | pagina's aangemaakt, blok op de homepage verwijst ernaar |
| Koptekst en subkop zoals aangeleverd | staat in de opening |
| Introductietekst hoofdpagina | staat er |
| Chatbot met MyTourist-koppeling | **nog niet** — fase 2, zie hoofdstuk 6 |
| Contactformulier | **nog niet** |
| Teksten voor de overige elf pagina's | **nog niet** — pagina's bestaan wel, met het juiste sjabloon |

De homepage is dus af. De elf onderliggende pagina's zijn lege schillen met de
juiste naam, sjabloon en plek in het menu; de teksten uit de briefing moeten er
nog in.

## 11. Nog te beslissen

1. **Domein** — blijft `larandulina.com` of komt er een `.ch`-domein bij?
2. **Hosting** — nieuwe staging bij u-digital, of bouwen op een kopie van de huidige hosting?
3. **Fotografie** — zie hieronder, dit is het scherpste punt.
4. **Vertalingen** — vertaalt de klant zelf naar Duits en Engels, of moet dat begroot worden?

---

## 12. Het beeldmateriaal, na inspectie

De 62 aangeleverde foto's zijn verwerkt naar webformaat (map `03 Beeld web`, 21 MB). Daarbij kwam een paar dingen boven die van belang zijn voor het ontwerp.

**Er zijn te weinig liggende foto's voor dit ontwerp.** Van de 62 beelden zijn er 29 professioneel geschoten (de A7V-serie), maar daarvan zijn er slechts **twee liggend**. De rest is staand. Een schermvullende hero met vier panelen naast elkaar vraagt juist brede beelden. Bruikbaar bleken:

| Beeld | Waarvoor |
|---|---|
| `a7v00074.jpg` | Dal bij zonsopgang. Sterk zomer-hero, rustig genoeg voor tekst eroverheen |
| `pano0001-pano-3-2.jpg` | Dronepanorama van besneeuwd Ramosch. Sterk winter-hero |
| `a7v00845.jpg` | Stube-interieur. Goed voor Eten & drinken, niet voor de hero (voorgrond onscherp) |

De acht kleinere paneelbeelden (die alleen op mobiel zichtbaar zijn) zijn nu ingevuld met wat er is, maar dat is een voorlopige keuze. **Advies: plan een fotosessie** — een halve dag met een fotograaf die bewust liggend schiet, per doelgroep en per seizoen. Zonder dat blijft de homepage steunen op twee foto's.

**Let op bij het bestand `rodelen.jpg`:** dat is geen wintersleeën maar een zomerrodelbaan. Bij het toewijzen van beeld aan seizoen is de bestandsnaam dus geen betrouwbare gids.

**Twee foto's stonden gekanteld.** `IMG_2629` en `IMG_2630` hadden een rotatievlag in de EXIF-gegevens die door de eerste conversie werd genegeerd, en de HEIC-bestanden gingen op dezelfde manier mis. Dat is rechtgezet; alle beelden in `03 Beeld web` staan nu goed. Wie later nog foto's aanlevert: controleer dit even, want in de Finder zien ze er wél goed uit terwijl de browser ze gekanteld toont.

---

## 12. Live te bekijken

**https://ericwaterschoot80.github.io/la-randulina-theme/**

Deze link kan naar John. Er hoeft niets geïnstalleerd te worden; hij werkt op
telefoon en laptop. De pagina staat op `noindex`, dus Google neemt hem niet op.

Klik op het sneeuwvlokje rechtsboven voor de winterversie, met de dronevideo.

## 13. Wat er nu al staat

| Waar | Wat |
|---|---|
| `Prototype/index.html` | Werkende prototype. Dubbelklikken, verder niets nodig. Toont de vier panelen met hover-effect, de seizoenswissel en de mobiele weergave |
| `03 Beeld web/` | Alle 62 foto's, rechtgezet en geoptimaliseerd, klaar voor Google Drive en de mediabibliotheek |
| GitHub `la-randulina-theme` | Het WordPress-blocktheme, privé repo |

De prototype gebruikt dezelfde CSS, HTML en JavaScript als het echte thema. Wat je daar ziet, is wat de site straks doet.
