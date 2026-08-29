# Metodo IMPATTO - Decisioni Tecniche

Ultimo aggiornamento: 2026-08-29

## Decisioni iniziali confermate

1. Il progetto verra sviluppato come tema WordPress nativo Full Site Editing.
2. I contenuti strategici saranno gestiti tramite editor WordPress, template, pattern e campi configurabili, evitando hardcode non necessario.
3. Il core WordPress presente nel progetto verra trattato come parte versionabile, ma con esclusioni rigorose per segreti, upload, cache e file ambiente-specifici.
4. L'identita visiva verra implementata tramite `theme.json`, CSS del tema e asset locali, senza dipendenze frontend pesanti.
5. Il sito restera funzionale anche senza Rank Math, Brevo, Complianz o GA4 attivi.
6. Le integrazioni esterne verranno predisposte con punti di configurazione chiari e fallback editoriali accessibili.
7. Il blog partira volutamente vuoto, ma con archivio e stato empty progettati.
8. La documentazione guidera sia il setup locale sia la futura pubblicazione su hosting WordPress/PHP compatibile.

## Decisioni operative derivate dall'analisi

- Non esiste ancora un tema custom nel progetto: verra creato in `wp-content/themes/` con prefisso dedicato `mi_`.
- Non esiste un repository Git attivo: la preparazione al versionamento fara parte della Fase 2.
- Esistono contenuti seed di WordPress: verranno preservati finche non sara disponibile una strategia sicura di sostituzione o riuso.
- `wp-config.php` contiene configurazione locale e segreti non adatti al repository: verra definita una strategia di sample/configurazione sicura.
- La presenza di `uploads` implica l'esclusione dal repository e attenzione a eventuali media gia usati nel sito.

## Decisioni rinviate

- Nome definitivo del tema custom
- Font open source definitivi da ospitare localmente
- Meccanismo finale di incorporamento Brevo
- Eventuale uso di un piccolo plugin mu o plugin custom per configurazioni trasversali

## Direzione visiva approvata per la v1

- Palette principale: blu notte `#10233F`, blu profondo `#173863`, corallo `#FF7A59`, bianco caldo `#F7F3EC`, grigio acciaio `#5D6C81`
- Tipografia: `Literata` per titoli e `Fira Sans` per testi lunghi, entrambi serviti localmente
- Interfaccia: editoriale, leggibile, con CTA misurate e superfici morbide invece di estetica "AI futuristica"
- Hero: blocco ad alto contrasto con promessa chiara e una sola CTA primaria
- Metodo IMPATTO: griglia di card accessibili, leggibili anche senza animazioni

## Decisioni sulle integrazioni

- Brevo: il tema espone un punto di configurazione in `Impostazioni > Lettura`, ma mostra un fallback editoriale finche l'embed non e disponibile
- GA4: il Measurement ID ha un punto di configurazione, ma il tema non inietta tracciamento automatico per evitare attivazioni improprie prima del consenso
- Rank Math e Complianz: previsti e supportati a livello di struttura, ma non resi obbligatori per il rendering del sito

## Principi di implementazione

- Accessibilita prima delle animazioni
- Prestazioni prima degli effetti
- Semantica e contenuti prima degli abbellimenti
- Versionabilita e manutenzione prima delle scorciatoie
- Predisposizione editoriale prima dell'automazione
