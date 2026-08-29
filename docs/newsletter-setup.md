# Metodo IMPATTO - Setup Newsletter

Ultimo aggiornamento: 2026-08-29

Stato: predisposizione tecnica completata, integrazione manuale ancora necessaria.

## Scelta prevista

Preferenza iniziale per modulo Brevo incorporato e stilizzato nel tema, con fallback editoriale chiaro quando il codice embed non e ancora stato configurato.

## Implementato

- Pagina Newsletter dedicata
- CTA verso newsletter in home, footer e stato vuoto del blog
- Fallback visivo accessibile quando Brevo non e configurato
- Campo di configurazione in `Impostazioni > Lettura > Metodo IMPATTO`

## Procedura manuale consigliata

1. Creare una lista dedicata in Brevo.
2. Creare il modulo con campo email e nome solo se realmente utile.
3. Attivare double opt-in.
4. Configurare testo consenso privacy separato e non preselezionato.
5. Generare il codice embed del modulo.
6. Incollare il codice in `Impostazioni > Lettura > Metodo IMPATTO`.
7. Testare iscrizione, email di conferma, conferma finale e disiscrizione.

## Regole da rispettare

- Nessuna frequenza promessa se non ancora confermata
- Nessun salvataggio marketing dei contatti nel database WordPress
- Privacy Policy collegata e verificata
- Messaggi di errore e conferma leggibili anche da smartphone

## Possibili evoluzioni future

- automazioni post-iscrizione in Brevo;
- segmentazione leggera per interessi;
- connessione con workflow editoriali in bozza.
