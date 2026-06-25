# parkFIVE — Online self check-in

Jednoduchý systém pre online self check-in pre apartmány parkFIVE. Bez admin panelu, bez loginu. Dva verejné linky (jeden pre každý apartmán), ktoré zobrazia rovnaký formulár a po odoslaní ukážu prístupové informácie a kód pre konkrétny apartmán.

## Technológie

- **Laravel 13** (PHP 8.3+)
- **Blade** šablóny
- **Tailwind CSS v4** (cez Vite)
- **SQLite** (predvolené, ľahko zmeniteľné na MySQL)
- Žiadny login, žiadny admin panel

## Verejné linky

- Apartmán 1: `/checkin/apartman-1`
- Apartmán 2: `/checkin/apartman-2`

## Routes

| Metóda | URL | Popis |
|--------|-----|-------|
| GET | `/checkin/{apartment:slug}` | Zobrazí check-in formulár pre apartmán |
| POST | `/checkin/{apartment:slug}` | Uloží odoslaný formulár |
| GET | `/checkin/dakujeme/{checkin}` | Zobrazí potvrdenie a príchodové informácie |

## Inštalácia a spustenie

```bash
# 1. PHP závislosti (ak nie sú nainštalované)
composer install

# 2. NPM závislosti (ak nie sú nainštalované)
npm install

# 3. Vybudovať frontend assety
npm run build      # produkčný build
# alebo
npm run dev        # vývojový režim s hot-reload

# 4. Migrácie a seed (vytvorí tabuľky a 2 apartmány)
php artisan migrate --seed

# 5. Spustenie vývojového servera
php artisan serve
```

Aplikácia bude dostupná na `http://127.0.0.1:8000`.

> **Poznámka:** Ak by `.env` neexistoval, skopíruj ho z `.env.example` (`cp .env.example .env`) a vygeneruj kľúč (`php artisan key:generate`).

## Databáza

Predvolene sa používa **SQLite** (`database/database.sqlite`). Pre **MySQL** uprav `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=parkfive
DB_USERNAME=root
DB_PASSWORD=tvoje_heslo
```

### Tabuľky

- `apartments` — apartmány s príchodovými informáciami
- `checkins` — odoslané check-in formuláre
- `checkin_guests` — jednotliví hostia (1:N k checkins)

## Kde upraviť údaje apartmánov a kódy

Údaje apartmánov sa nastavujú v seederi:

**Súbor:** `database/seeders/ApartmentSeeder.php`

Tu nájdeš oba apartmány s poliami: `address`, `access_code`, `wifi_name`, `wifi_password`, `parking_info`, `contact_info` (a ďalšími). Nahraď hodnoty `DOPLNIŤ ...` reálnymi údajmi.

Po úprave spusti:

```bash
php artisan migrate:fresh --seed
# alebo len re-seed bez zmazania dát:
php artisan db:seed --class=ApartmentSeeder
```

> **Tip:** Ak nechceš prísť o existujúce check-in záznamy, uprav údaje priamo v databáze (tabuľka `apartments`) alebo použi `php artisan db:seed --class=ApartmentSeeder` — seeder používa `updateOrCreate`, takže existujúce apartmány podľa slugu len aktualizuje.

## Bezpečnosť

- **CSRF ochrana** — všetky formuláre používajú `@csrf`.
- **Laravel validation** — všetky vstupy sú validované server-side.
- **Escaping** — všetky výstupy v Blade sú escapované (`{{ }}`).
- **Prístupový kód nie je v URL** — kód sa zobrazí až po úspešnom odoslaní formulára, na ďakovnej stránke podľa apartmánu z linku.
- **Žiadny výber apartmánu** — hosť príde priamo na link svojho apartmánu.

## Štruktúra projektu

```
app/
├── Http/Controllers/
│   └── CheckinController.php      # Logika formulára a potvrdenia
└── Models/
    ├── Apartment.php
    ├── Checkin.php
    └── CheckinGuest.php

database/
├── migrations/
│   ├── 2025_01_01_000001_create_apartments_table.php
│   ├── 2025_01_01_000002_create_checkins_table.php
│   └── 2025_01_01_000003_create_checkin_guests_table.php
└── seeders/
    ├── ApartmentSeeder.php        # ← TU UPRAV ÚDAJE APARTMÁNOV
    └── DatabaseSeeder.php

resources/views/
├── layouts/
│   └── app.blade.php              # Layout (header, footer)
├── checkin/
│   ├── form.blade.php             # Check-in formulár
│   └── thankyou.blade.php         # Potvrdzovacia stránka s informáciami
└── welcome.blade.php              # Landing stránka

routes/
└── web.php                        # Routes
```

## Frontend funkcie

- **Dynamický počet hostí** — podľa výberu (1–8) sa zobrazí príslušný počet sekcií pre hostí.
- **Fakturačné údaje** — zobrazia sa iba po zaškrtnutí „Chcem vystaviť faktúru".
- **Zachovanie hodnôt** — pri validačnej chybe ostanú vyplnené polia zachované.
- **Skopírovať informácie** — skopíruje všetky príchodové informácie do schránky.
- **Zdieľať informácie** — použije Web Share API ak je dostupné, inak skopíruje do schránky.
- **Success/error hlášky** — vizuálne upozornenia na úspech/chybu.
- **Responsive dizajn** — optimalizované pre mobil aj desktop.