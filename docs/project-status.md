# Metodo IMPATTO - Stato Progetto

Ultimo aggiornamento: 2026-08-29

## Obiettivo

Realizzare la prima versione completa del sito WordPress italiano "Metodo IMPATTO" come base editoriale, con tema Gutenberg/FSE personalizzato, documentazione tecnica e predisposizione a SEO, newsletter e future automazioni.

## Fase Corrente

- Stato: Fasi 0-4 completate in una prima v1 locale, Fase 5 verificata in modo tecnico e visivo iniziale
- Modalita di lavoro: implementazione progressiva e verificabile

## Risultati dell'analisi iniziale

- Root WordPress identificata in `C:\xampp\htdocs\metodoimpatto`
- Installazione WordPress presente e funzionante a livello di file
- Versione WordPress rilevata: `7.1`
- Requisito PHP minimo dichiarato dal core: `7.4`
- Configurazione locale rilevata con database `metodoimpatto`
- Prefisso tabelle: `mi_`
- Ambiente locale attuale rilevato su `http://localhost/metodoimpatto`
- Tema attivo corrente: `twentytwentyfive`
- Plugin attivi correnti: nessuno
- Repository Git non inizializzato nella root corrente
- Nessun file `AGENTS.md` trovato nel progetto

## Contenuti e dati esistenti da preservare

- 1 pagina pubblicata: `Pagina di esempio`
- 1 pagina bozza: `Privacy Policy`
- 1 articolo pubblicato nella categoria predefinita
- Categoria predefinita esistente: `Senza categoria`
- Cartella `wp-content/uploads` presente con contenuti generati localmente
- File `.htaccess` presente e da preservare salvo motivazioni tecniche documentate
- File `wp-config.php` presente con configurazione locale e segreti ambiente-specifici da non versionare cosi come sono

## Vincoli confermati

- Nessuna informazione personale o legale non verificata verra inventata
- Nessuna integrazione esterna verra considerata completata senza configurazione manuale reale
- Nessun deploy remoto, repository remoto o pubblicazione esterna verra eseguito
- Nessuna dipendenza globale verra installata
- Le modifiche esistenti utente o ambiente locale verranno preservate

## Attivita completate

- Letto il prompt operativo completo allegato
- Analizzata la struttura filesystem del progetto
- Verificata la presenza dell'installazione WordPress
- Verificato stato iniziale di temi, plugin e contenuti principali
- Identificato il primo set di dati sensibili e di file da escludere dal versionamento
- Creati i documenti iniziali di progetto
- Definita la strategia contenuti, IA, SEO e fonti
- Creato il tema FSE `metodo-impatto`
- Aggiunti token visuali, template, template parts e pattern
- Creato lo script `scripts/setup-metodo-impatto.php`
- Create e configurate le pagine richieste
- Impostata homepage statica e pagina Articoli
- Creata tassonomia editoriale iniziale
- Predisposti punto Brevo, Measurement ID GA4 e share link leggeri
- Inizializzato Git localmente
- Creati `.gitignore` e `README.md`
- Eseguiti screenshot locali di verifica in `artifacts/screenshots/`

## Prossime attivita

- Installare e configurare manualmente Brevo, Rank Math e Complianz
- Validare dati reali per pagine legali e contatti
- Rifinire responsive e contenuti dopo un ulteriore test browser manuale con dati reali
- Avviare il primo ciclo editoriale reale del blog

## Test e verifiche eseguite

- lint PHP del tema: superato
- lint PHP script setup: superato
- verifica opzioni WordPress e pagine via CLI PHP: superata
- verifica blog senza articoli pubblicati: superata
- verifica HTML locale via `curl`: superata
- verifica visuale locale desktop e mobile con screenshot: eseguita

## Blocchi attuali

- Nessun blocco tecnico reale
- Restano configurazioni manuali esterne che non possono essere completate senza dati reali e plugin installati
