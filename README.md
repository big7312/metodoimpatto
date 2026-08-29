# Metodo IMPATTO

Prima versione del sito WordPress italiano "Metodo IMPATTO", pensato come base editoriale per spiegare e applicare l'AI con un metodo concreto, misurabile e orientato ai processi.

## Stack

- WordPress 7.1
- PHP 8+ su XAMPP
- Tema custom FSE: `wp-content/themes/metodo-impatto`
- Nessun page builder esterno

## Struttura principale

- Core WordPress in repository locale
- Tema custom in `wp-content/themes/metodo-impatto`
- Script setup in `scripts/setup-metodo-impatto.php`
- Documentazione in `docs/`

## Setup locale con XAMPP

1. Copia il progetto sotto `htdocs`, per esempio in `C:\xampp\htdocs\metodoimpatto`.
2. Avvia Apache e MySQL da XAMPP.
3. Crea un database MySQL, per esempio `metodoimpatto`.
4. Configura `wp-config.php` con credenziali locali non versionate.
5. Importa un database locale compatibile oppure completa l'installazione WordPress.
6. Esegui lo script di setup:

```powershell
C:\xampp\php\php.exe scripts\setup-metodo-impatto.php
```

7. Apri `http://localhost/metodoimpatto/`.

## Tema custom

Il tema FSE usa:

- `theme.json` per token e stili globali
- template e template parts HTML
- block pattern riusabili
- font locali inclusi nel tema
- fallback newsletter senza dipendenza diretta da Brevo

## Configurazioni manuali rimaste

### Brevo

- Generare il modulo embed in Brevo
- Configurare double opt-in
- Configurare testo consenso privacy
- Incollare il codice embed in `Impostazioni > Lettura > Metodo IMPATTO`

### Google Analytics 4

- Inserire il Measurement ID reale in `Impostazioni > Lettura > Metodo IMPATTO`
- Completare attivazione solo insieme al consenso cookie

### Complianz Free

- Installare e configurare il plugin
- Verificare categorie cookie e blocco preventivo
- Validare Privacy Policy e Cookie Policy

### Rank Math Free

- Installare il plugin
- Configurare sitemap, metadati e Search Console
- Rifinire title e description con le linee guida di `docs/seo-strategy.md`

## Database locale

Il progetto usa contenuti WordPress nel database locale. Per ricostruire rapidamente pagine, tassonomie, homepage statica e tema attivo, eseguire:

```powershell
C:\xampp\php\php.exe scripts\setup-metodo-impatto.php
```

## Import database in locale

1. Crea un database vuoto in MySQL.
2. Importa il dump con phpMyAdmin oppure `mysql`.
3. Aggiorna `wp-config.php` con nome database, utente e password locali.
4. Se il dump proviene da un altro dominio, aggiorna `home` e `siteurl`.
5. Vai in `Impostazioni > Permalink` e salva senza cambiare struttura.
6. Esegui di nuovo `scripts/setup-metodo-impatto.php` se vuoi riallineare pagine e configurazione base.

## Checklist sostituzione URL locali

- Aggiornare `home` e `siteurl`
- Verificare link interni nei contenuti
- Rigenerare permalink
- Controllare immagini e URL assoluti nei media
- Controllare canonical e sitemap dopo attivazione SEO plugin

## Checklist permalink

- Aprire `Impostazioni > Permalink`
- Confermare la struttura desiderata
- Salvare per rigenerare le rewrite rules
- Verificare `.htaccess` locale o regole equivalenti su hosting

## Checklist di deployment

- Non versionare `wp-config.php` reale
- Escludere `wp-content/uploads`
- Verificare credenziali, secret e Measurement ID
- Installare e configurare plugin previsti sull'ambiente target
- Validare le pagine legali con dati reali
- Testare newsletter, cookie banner e condivisione social
- Controllare Search Console, sitemap e robots

## Hosting futuro

Il progetto non e vincolato a un hosting specifico. Serve un ambiente compatibile con:

- PHP 8+
- MySQL o MariaDB
- mod_rewrite o equivalente
- WordPress recente con supporto FSE

## Note importanti

- `wp-config.php` non va committato.
- Le informative legali presenti nel sito sono bozze tecniche e non sostituiscono una verifica competente.
- Lo script di setup non inserisce credenziali reali e non configura integrazioni esterne.

