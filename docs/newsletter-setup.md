# Metodo IMPATTO - Setup Newsletter

Ultimo aggiornamento: 2026-09-04

Stato: predisposizione tecnica completata, integrazione manuale ancora necessaria.

## Scelta prevista

Preferenza iniziale per modulo Brevo incorporato e stilizzato nel tema, con fallback editoriale chiaro quando il codice embed non e ancora stato configurato.

La newsletter non viene presentata come iscrizione generica, ma come rubrica editoriale:

- Nome: Il Prompt della Settimana
- Promessa: una mail breve ogni venerdi con un caso reale, un prompt commentato e una domanda di valutazione
- CTA principale: Ricevi il prossimo prompt
- Tono: pratico, sobrio, niente spam e niente raccolte infinite di tool

## Implementato

- Pagina Newsletter dedicata
- CTA verso newsletter in home, footer e stato vuoto del blog
- Fallback visivo accessibile quando Brevo non e configurato
- Campo di configurazione in `Impostazioni > Lettura > Metodo IMPATTO`
- Pattern Gutenberg riutilizzabile `metodo-impatto/newsletter-box`
- Stili base anche per embed Brevo dentro `.mi-brevo-embed`

## Procedura manuale consigliata

1. Creare una lista dedicata in Brevo.
2. Creare il modulo con campo email e nome solo se realmente utile.
3. Attivare double opt-in.
4. Configurare testo consenso privacy separato e non preselezionato.
5. Generare il codice embed del modulo.
6. Incollare il codice in `Impostazioni > Lettura > Metodo IMPATTO`.
7. Testare iscrizione, email di conferma, conferma finale e disiscrizione.

## Sequenza editoriale iniziale

- #1 Il prompt non e magia: e brief
- #2 Prima il contesto, poi la richiesta
- #3 Come capire se ChatGPT sta inventando
- #4 Trasformare appunti confusi in una procedura
- #5 AI per piccoli business: dove non usarla

## Regole da rispettare

- Nessuna frequenza promessa se non ancora confermata
- Nessun salvataggio marketing dei contatti nel database WordPress
- Privacy Policy collegata e verificata
- Messaggi di errore e conferma leggibili anche da smartphone

## Possibili evoluzioni future

- automazioni post-iscrizione in Brevo;
- segmentazione leggera per interessi;
- connessione con workflow editoriali in bozza.
