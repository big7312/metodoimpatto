# Metodo IMPATTO - Automation Readiness

Ultimo aggiornamento: 2026-08-29

Stato: predisposizione iniziale completata.

## Principi confermati

- Nessuna pubblicazione automatica diretta
- Stato `draft` obbligatorio per contenuti generati
- Revisione umana obbligatoria
- Nessuna disabilitazione della REST API

## Aree da documentare

- Endpoint WordPress rilevanti
- Campi richiesti
- Sicurezza e autenticazione futura
- Logging
- Prevenzione duplicati
- Gestione errori

## Architettura prevista

- Un sistema esterno genera contenuti solo in bozza
- WordPress riceve i contenuti via REST API autenticata
- Un revisore umano controlla titolo, excerpt, corpo, categorie, tag e SEO prima della pubblicazione

## Endpoint WordPress rilevanti

- `POST /wp-json/wp/v2/posts`
- `POST /wp-json/wp/v2/media`
- `GET /wp-json/wp/v2/categories`
- `GET /wp-json/wp/v2/tags`
- `GET /wp-json/wp/v2/users`

## Campi richiesti per i draft

- `title`
- `status` obbligatoriamente `draft`
- `content`
- `excerpt`
- `featured_media` quando disponibile
- `categories`
- `tags`
- `author`

## Sicurezza

- Nessuna credenziale nel repository
- Application Passwords o meccanismo equivalente solo quando davvero necessario
- Revisione umana prima di ogni pubblicazione
- Validazione lato automazione per prevenire invii vuoti o incompleti

## Logging ed errori

- Log degli invii con timestamp, slug, autore tecnico e risposta API
- Gestione esplicita di timeout, errori di validazione e media mancanti
- Retry limitato solo per errori transitori

## Prevenzione duplicati

- Controllo sullo slug proposto
- Controllo su titolo simile negli ultimi draft
- Eventuale meta tecnica futura per ID esterno sorgente
