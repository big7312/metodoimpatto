<?php
/**
 * Configures the initial Metodo IMPATTO site structure.
 */

declare(strict_types=1);

require __DIR__ . '/../wp-load.php';

if ( ! function_exists( 'wp_insert_post' ) ) {
	exit( "WordPress non disponibile.\n" );
}

/**
 * Upserts a page by slug.
 *
 * @param string $slug Page slug.
 * @param array  $args Post args.
 * @return int
 */
function mi_upsert_page( string $slug, array $args ): int {
	$page = get_page_by_path( $slug, OBJECT, 'page' );

	if ( ! $page && 'home' === $slug ) {
		$sample = get_page_by_title( 'Pagina di esempio', OBJECT, 'page' );
		if ( $sample instanceof WP_Post ) {
			$page = $sample;
		}
	}

	if ( ! $page && 'privacy-policy' === $slug ) {
		$draft = get_page_by_title( 'Privacy Policy', OBJECT, 'page' );
		if ( $draft instanceof WP_Post ) {
			$page = $draft;
		}
	}

	$postarr = array_merge(
		array(
			'post_type'   => 'page',
			'post_status' => 'publish',
			'post_name'   => $slug,
		),
		$args
	);

	if ( $page instanceof WP_Post ) {
		$postarr['ID'] = $page->ID;
		return (int) wp_update_post( wp_slash( $postarr ) );
	}

	return (int) wp_insert_post( wp_slash( $postarr ) );
}

/**
 * Returns a shortcode block string.
 *
 * @param string $shortcode Shortcode.
 * @return string
 */
function mi_shortcode_block( string $shortcode ): string {
	return "<!-- wp:shortcode -->\n{$shortcode}\n<!-- /wp:shortcode -->";
}

$avatar_url = content_url( 'themes/metodo-impatto/assets/images/avatar-placeholder.svg' );

$pages = array(
	'home'                         => array(
		'title'   => 'Home',
		'order'   => 0,
		'content' => <<<'HTML'
<!-- wp:group {"align":"wide","className":"mi-hero","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide mi-hero">
	<!-- wp:group {"layout":{"type":"constrained"}} -->
	<div class="wp-block-group">
		<!-- wp:paragraph {"className":"mi-eyebrow"} -->
		<p class="mi-eyebrow">Metodo IMPATTO</p>
		<!-- /wp:paragraph -->
		<!-- wp:heading {"level":1,"fontSize":"display"} -->
		<h1 class="has-display-font-size">AI utile, prima degli strumenti.</h1>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"fontSize":"l"} -->
		<p class="has-l-font-size">Dall'obiettivo aziendale a un processo misurabile: un modo pratico per capire dove l'intelligenza artificiale puo aiutare davvero piccole imprese e professionisti.</p>
		<!-- /wp:paragraph -->
		<!-- wp:group {"className":"mi-cta-row","layout":{"type":"flex","flexWrap":"wrap"}} -->
		<div class="wp-block-group mi-cta-row">
			<!-- wp:shortcode -->
			[mi_page_link slug="newsletter"]Ricevi il Prompt della Settimana[/mi_page_link]
			<!-- /wp:shortcode -->
			<!-- wp:shortcode -->
			[mi_page_link slug="il-metodo-impatto" variant="outline"]Leggi il metodo[/mi_page_link]
			<!-- /wp:shortcode -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:html -->
	<div class="mi-editorial-note">
		<p><strong>Il punto di partenza.</strong></p>
		<p>Non si parte dal tool del momento. Si parte da una domanda piu scomoda e piu utile: quale risultato deve migliorare il lavoro?</p>
		<div class="mi-metric-strip">
			<div><strong>I</strong><span>identificare il risultato</span></div>
			<div><strong>M</strong><span>mappare il processo reale</span></div>
			<div><strong>T</strong><span>testare prima di trasformare in metodo</span></div>
		</div>
	</div>
	<!-- /wp:html -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","className":"mi-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide mi-section">
	<!-- wp:group {"className":"mi-offset-grid","layout":{"type":"constrained"}} -->
	<div class="wp-block-group mi-offset-grid">
		<!-- wp:group {"layout":{"type":"constrained"}} -->
		<div class="wp-block-group">
			<!-- wp:paragraph {"className":"mi-kicker"} -->
			<p class="mi-kicker">Il problema</p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"level":2,"className":"mi-large-statement"} -->
			<h2 class="mi-large-statement">L'AI non fallisce sempre per colpa dello strumento. Spesso fallisce per mancanza di processo.</h2>
			<!-- /wp:heading -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"layout":{"type":"constrained"}} -->
		<div class="wp-block-group">
			<!-- wp:paragraph -->
			<p>Vedo un rischio molto comune: si prova un'app, poi un'altra, poi un prompt copiato da qualche parte. Per qualche giorno sembra tutto interessante, ma non cambia davvero il modo di lavorare.</p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph -->
			<p>Metodo IMPATTO nasce per rimettere ordine: risultato, processo, test, dati. Solo dopo ha senso parlare di AI.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","className":"mi-section mi-section--dark","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide mi-section mi-section--dark">
	<!-- wp:paragraph {"className":"mi-kicker"} -->
	<p class="mi-kicker">Le sette fasi</p>
	<!-- /wp:paragraph -->
	<!-- wp:heading {"level":2,"className":"mi-large-statement"} -->
	<h2 class="mi-large-statement">IMPATTO e una sequenza di domande, non una decorazione.</h2>
	<!-- /wp:heading -->
	<!-- wp:html -->
	<div class="mi-method-ledger">
		<div class="mi-method-row"><strong>I</strong><h3>Identifica il risultato</h3><p>Che cosa vogliamo ottenere?</p></div>
		<div class="mi-method-row"><strong>M</strong><h3>Mappa il processo</h3><p>Come viene svolto oggi il lavoro?</p></div>
		<div class="mi-method-row"><strong>P</strong><h3>Progetta la soluzione</h3><p>Quale nuovo processo vogliamo costruire?</p></div>
		<div class="mi-method-row"><strong>A</strong><h3>Applica l'intelligenza artificiale</h3><p>Quale ruolo assegniamo all'AI?</p></div>
		<div class="mi-method-row"><strong>T</strong><h3>Testa sul campo</h3><p>Funziona in una situazione reale?</p></div>
		<div class="mi-method-row"><strong>T</strong><h3>Trasforma il test in metodo</h3><p>Come lo rendiamo ripetibile?</p></div>
		<div class="mi-method-row"><strong>O</strong><h3>Ottimizza attraverso i dati</h3><p>Come miglioriamo risultati, costi e qualita?</p></div>
	</div>
	<!-- /wp:html -->
	<!-- wp:shortcode -->
	[mi_page_link slug="il-metodo-impatto"]Approfondisci il metodo[/mi_page_link]
	<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","className":"mi-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide mi-section">
	<!-- wp:paragraph {"className":"mi-kicker"} -->
	<p class="mi-kicker">Dove cominciare</p>
	<!-- /wp:paragraph -->
	<!-- wp:heading {"level":2} -->
	<h2>La prima area di lavoro e molto concreta: clienti, vendite, contenuti, richieste.</h2>
	<!-- /wp:heading -->
	<!-- wp:html -->
	<div class="mi-application-list">
		<div><h3>Acquisizione clienti</h3><p>Mettere ordine tra richieste, follow-up e priorita commerciali prima di aggiungere automazioni.</p></div>
		<div><h3>Marketing e contenuti</h3><p>Usare l'AI per chiarire messaggi, riusare idee e preparare bozze migliori, senza produrre rumore.</p></div>
		<div><h3>Processi ripetitivi</h3><p>Individuare passaggi manuali, dati copiati a mano e attivita che possono essere assistite con controllo umano.</p></div>
	</div>
	<!-- /wp:html -->
	<!-- wp:shortcode -->
	[mi_page_link slug="come-applicare-ai-in-azienda" variant="outline"]Vedi le applicazioni[/mi_page_link]
	<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","className":"mi-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide mi-section">
	<!-- wp:columns {"align":"wide"} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column {"width":"58%"} -->
		<div class="wp-block-column" style="flex-basis:58%">
			<!-- wp:paragraph {"className":"mi-kicker"} -->
			<p class="mi-kicker">Per chi e</p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"level":2} -->
			<h2>Per chi vuole capire prima di automatizzare.</h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph -->
			<p>Parlo soprattutto a piccoli imprenditori, professionisti, consulenti, commercianti e piccoli team che vogliono un approccio semplice, realistico e misurabile.</p>
			<!-- /wp:paragraph -->
			<!-- wp:shortcode -->
			[mi_page_link slug="per-chi-e" variant="outline"]Capisci se fa per te[/mi_page_link]
			<!-- /wp:shortcode -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"className":"mi-person-card","layout":{"type":"constrained"}} -->
			<div class="wp-block-group mi-person-card">
				<!-- wp:image {"id":0,"sizeSlug":"full","linkDestination":"none"} -->
				<figure class="wp-block-image size-full"><img src="%AVATAR_URL%" alt="Avatar segnaposto del progetto Metodo IMPATTO"/></figure>
				<!-- /wp:image -->
				<!-- wp:group {"layout":{"type":"constrained"}} -->
				<div class="wp-block-group">
					<!-- wp:heading {"level":3} -->
					<h3>Dario Buccigrossi</h3>
					<!-- /wp:heading -->
					<!-- wp:paragraph -->
					<p>CRM, digitalizzazione e integrazione di processi. Metodo IMPATTO e il luogo in cui sto trasformando questo lavoro in una traccia comprensibile sull'AI per piccole imprese.</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","className":"mi-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide mi-section">
	<!-- wp:paragraph {"className":"mi-kicker"} -->
	<p class="mi-kicker">Articoli</p>
	<!-- /wp:paragraph -->
	<!-- wp:query {"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false},"layout":{"type":"constrained"}} -->
	<div class="wp-block-query">
		<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
		<!-- wp:group {"className":"mi-post-card","layout":{"type":"constrained"}} -->
		<div class="wp-block-group mi-post-card">
			<!-- wp:post-title {"isLink":true,"level":3} /-->
			<!-- wp:post-excerpt {"excerptLength":20} /-->
		</div>
		<!-- /wp:group -->
		<!-- /wp:post-template -->
		<!-- wp:query-no-results -->
		<!-- wp:group {"className":"mi-archive-empty","layout":{"type":"constrained"}} -->
		<div class="wp-block-group mi-archive-empty">
			<!-- wp:heading {"level":2} -->
			<h2>Il blog parte vuoto di proposito.</h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph -->
			<p>Prima viene il criterio editoriale. Gli articoli arriveranno quando avranno un problema chiaro, una domanda utile e un collegamento reale al metodo.</p>
			<!-- /wp:paragraph -->
			<!-- wp:shortcode -->
			[mi_page_link slug="newsletter"]Segui i primi contenuti[/mi_page_link]
			<!-- /wp:shortcode -->
		</div>
		<!-- /wp:group -->
		<!-- /wp:query-no-results -->
	</div>
	<!-- /wp:query -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","className":"mi-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide mi-section">
	<!-- wp:pattern {"slug":"metodo-impatto/newsletter-box"} /-->
</div>
<!-- /wp:group -->
HTML
		),
		'il-metodo-impatto'           => array(
			'title'   => 'Il Metodo IMPATTO',
			'order'   => 1,
			'content' => <<<'HTML'
<!-- wp:group {"className":"mi-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group mi-card">
	<!-- wp:paragraph {"className":"mi-kicker"} -->
	<p class="mi-kicker">Pillar page</p>
	<!-- /wp:paragraph -->
	<!-- wp:heading {"level":1} -->
	<h1>Il Metodo IMPATTO</h1>
	<!-- /wp:heading -->
	<!-- wp:paragraph -->
	<p>Quando si parte dagli strumenti, spesso si collezionano prove scollegate. Il Metodo IMPATTO nasce per fare il contrario: chiarire il risultato, osservare il processo, progettare una soluzione, usare l'AI in un ruolo preciso e misurare cosa succede davvero.</p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|l"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--l)">
	<!-- wp:heading {"level":2} -->
	<h2>Perche il risultato viene prima della tecnologia</h2>
	<!-- /wp:heading -->
	<!-- wp:paragraph -->
	<p>Se un'azienda dice "voglio usare l'AI", non ha ancora definito il problema. Se invece dice "voglio rispondere piu in fretta alle richieste, qualificare meglio i contatti o ridurre il tempo speso in attivita ripetitive", abbiamo gia una base su cui lavorare.</p>
	<!-- /wp:paragraph -->
	<!-- wp:paragraph -->
	<p>Il metodo serve proprio a questo: trasformare una curiosita generica in un percorso con priorita, criteri di test e decisioni piu leggibili.</p>
	<!-- /wp:paragraph -->
	<!-- wp:pattern {"slug":"metodo-impatto/method-phases"} /-->
</div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|l"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--l)">
	<!-- wp:column -->
	<div class="wp-block-column"><!-- wp:group {"className":"mi-detail-card","layout":{"type":"constrained"}} --><div class="wp-block-group mi-detail-card"><!-- wp:heading {"level":3} --><h3>Come si collegano le fasi</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Ogni fase prepara la successiva. Se salto la mappatura, progetto male. Se salto il test, non so se la soluzione regge. Se salto i dati, non so come migliorarla.</p><!-- /wp:paragraph --></div><!-- /wp:group --></div>
	<!-- /wp:column -->
	<!-- wp:column -->
	<div class="wp-block-column"><!-- wp:group {"className":"mi-detail-card","layout":{"type":"constrained"}} --><div class="wp-block-group mi-detail-card"><!-- wp:heading {"level":3} --><h3>Perche test e misurazione contano</h3><!-- /wp:heading --><!-- wp:paragraph --><p>L'AI puo aiutare molto, ma non basta vedere un output convincente. Serve capire se migliora tempi, qualita, continuita e affidabilita dentro una situazione reale.</p><!-- /wp:paragraph --></div><!-- /wp:group --></div>
	<!-- /wp:column -->
	<!-- wp:column -->
	<div class="wp-block-column"><!-- wp:group {"className":"mi-detail-card","layout":{"type":"constrained"}} --><div class="wp-block-group mi-detail-card"><!-- wp:heading {"level":3} --><h3>Che errori aiuta a evitare</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Comprare strumenti prima di capire il bisogno, moltiplicare le prove senza metodo, non definire responsabilita e non prevedere una revisione umana degli output.</p><!-- /wp:paragraph --></div><!-- /wp:group --></div>
	<!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|l"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--l)">
	<!-- wp:heading {"level":2} -->
	<h2>Un esempio ipotetico per capire il metodo</h2>
	<!-- /wp:heading -->
	<!-- wp:paragraph -->
	<p>Immagina un piccolo studio che riceve molte richieste da form web e email. L'obiettivo non e "mettere l'AI ovunque", ma rispondere meglio e qualificare prima i contatti. A quel punto posso osservare il processo attuale, ridisegnare il flusso, decidere che ruolo dare all'AI nella prima analisi della richiesta e testare il nuovo assetto su un campione di casi reali.</p>
	<!-- /wp:paragraph -->
	<!-- wp:paragraph -->
	<p>Se il test funziona, lo trasformo in metodo. Se non funziona, non lo travesto da successo: capisco dove si blocca e correggo.</p>
	<!-- /wp:paragraph -->
	<!-- wp:pattern {"slug":"metodo-impatto/newsletter-box"} /-->
</div>
<!-- /wp:group -->
HTML
		),
		'come-applicare-ai-in-azienda' => array(
			'title'   => 'Come applicare l’AI in azienda',
			'order'   => 2,
			'content' => <<<'HTML'
<!-- wp:group {"className":"mi-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group mi-card">
	<!-- wp:paragraph {"className":"mi-kicker"} -->
	<p class="mi-kicker">Guida pratica</p>
	<!-- /wp:paragraph -->
	<!-- wp:heading {"level":1} -->
	<h1>Come applicare l'AI in azienda</h1>
	<!-- /wp:heading -->
	<!-- wp:paragraph -->
	<p>Per me ha piu senso partire dai processi che dai tool. Quello che conta e capire dove c'e un collo di bottiglia, che tipo di dato passa da quel punto e quale miglioramento vale davvero la pena misurare.</p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|l"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--l)">
	<!-- wp:column -->
	<div class="wp-block-column"><!-- wp:group {"className":"mi-application-card","layout":{"type":"constrained"}} --><div class="wp-block-group mi-application-card"><!-- wp:heading {"level":2} --><h2>Marketing e contenuti</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong>Obiettivo:</strong> produrre contenuti piu coerenti e utili.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Processo da osservare:</strong> raccolta idee, pianificazione, stesura, revisione.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Ruolo possibile dell'AI:</strong> supporto nella ricerca, nella sintesi e nella variazione di formati.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Rischi e limiti:</strong> omologazione del tono, errori fattuali, contenuti vaghi.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Dato da misurare:</strong> tempo di produzione, qualita percepita, tasso di risposta.</p><!-- /wp:paragraph --></div><!-- /wp:group --></div>
	<!-- /wp:column -->
	<!-- wp:column -->
	<div class="wp-block-column"><!-- wp:group {"className":"mi-application-card","layout":{"type":"constrained"}} --><div class="wp-block-group mi-application-card"><!-- wp:heading {"level":2} --><h2>Ricerca e qualificazione contatti</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong>Obiettivo:</strong> capire prima quali richieste meritano attenzione immediata.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Processo da osservare:</strong> arrivo richieste, prima risposta, follow-up, classificazione.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Ruolo possibile dell'AI:</strong> analisi del contenuto, classificazione iniziale, sintesi per l'operatore.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Rischi e limiti:</strong> valutazioni troppo automatiche, falsi positivi o negativi.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Dato da misurare:</strong> tempo di risposta, percentuale di richieste ben indirizzate.</p><!-- /wp:paragraph --></div><!-- /wp:group --></div>
	<!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide">
	<!-- wp:column -->
	<div class="wp-block-column"><!-- wp:group {"className":"mi-application-card","layout":{"type":"constrained"}} --><div class="wp-block-group mi-application-card"><!-- wp:heading {"level":2} --><h2>Vendite e CRM</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong>Obiettivo:</strong> mantenere continuita nel lavoro commerciale.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Processo da osservare:</strong> presa in carico lead, note, follow-up, aggiornamento CRM.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Ruolo possibile dell'AI:</strong> riassunti, promemoria, supporto alla preparazione dei contatti.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Rischi e limiti:</strong> dati sporchi, eccesso di fiducia negli output, perdita di contesto.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Dato da misurare:</strong> qualita dati CRM, puntualita follow-up, conversione.</p><!-- /wp:paragraph --></div><!-- /wp:group --></div>
	<!-- /wp:column -->
	<!-- wp:column -->
	<div class="wp-block-column"><!-- wp:group {"className":"mi-application-card","layout":{"type":"constrained"}} --><div class="wp-block-group mi-application-card"><!-- wp:heading {"level":2} --><h2>Richieste e assistenza</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong>Obiettivo:</strong> rispondere in modo piu ordinato e coerente.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Processo da osservare:</strong> ricezione, smistamento, risposta, storico.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Ruolo possibile dell'AI:</strong> bozze di risposta, sintesi ticket, classificazione.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Rischi e limiti:</strong> tono inadeguato, risposte sbagliate, dati sensibili gestiti male.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Dato da misurare:</strong> tempi medi, errori, soddisfazione percepita.</p><!-- /wp:paragraph --></div><!-- /wp:group --></div>
	<!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide">
	<!-- wp:column -->
	<div class="wp-block-column"><!-- wp:group {"className":"mi-application-card","layout":{"type":"constrained"}} --><div class="wp-block-group mi-application-card"><!-- wp:heading {"level":2} --><h2>Attivita amministrative ripetitive</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong>Obiettivo:</strong> togliere tempo speso in passaggi manuali poco utili.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Processo da osservare:</strong> raccolta dati, compilazione documenti, ricontrolli.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Ruolo possibile dell'AI:</strong> estrazione informazioni, assistenza alla compilazione, supporto operativo.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Rischi e limiti:</strong> errori nei dati, compliance, controllo insufficiente.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Dato da misurare:</strong> minuti risparmiati, riduzione errori, necessita di correzione.</p><!-- /wp:paragraph --></div><!-- /wp:group --></div>
	<!-- /wp:column -->
	<!-- wp:column -->
	<div class="wp-block-column"><!-- wp:group {"className":"mi-application-card","layout":{"type":"constrained"}} --><div class="wp-block-group mi-application-card"><!-- wp:heading {"level":2} --><h2>Dati e conoscenza interna</h2><!-- /wp:heading --><!-- wp:paragraph --><p><strong>Obiettivo:</strong> recuperare piu facilmente informazioni utili al lavoro.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Processo da osservare:</strong> ricerca documenti, passaggio di conoscenza, aggiornamento materiali.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Ruolo possibile dell'AI:</strong> sintesi, ricerca semantica, supporto all'organizzazione.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Rischi e limiti:</strong> informazioni non aggiornate, allucinazioni, accessi impropri.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p><strong>Dato da misurare:</strong> tempo di recupero, precisione, riuso della documentazione.</p><!-- /wp:paragraph --></div><!-- /wp:group --></div>
	<!-- /wp:column -->
</div>
<!-- /wp:columns -->
HTML
		),
		'per-chi-e'                    => array(
			'title'   => 'Per chi è',
			'order'   => 3,
			'content' => <<<'HTML'
<!-- wp:group {"className":"mi-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group mi-card">
	<!-- wp:paragraph {"className":"mi-kicker"} -->
	<p class="mi-kicker">Destinatari</p>
	<!-- /wp:paragraph -->
	<!-- wp:heading {"level":1} -->
	<h1>Per chi e Metodo IMPATTO</h1>
	<!-- /wp:heading -->
	<!-- wp:paragraph -->
	<p>Questo progetto e pensato soprattutto per chi lavora in contesti piccoli o medi e vuole usare l'AI in modo piu chiaro, piu disciplinato e piu utile.</p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|l"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--l)">
	<!-- wp:column -->
	<div class="wp-block-column"><!-- wp:group {"className":"mi-detail-card","layout":{"type":"constrained"}} --><div class="wp-block-group mi-detail-card"><!-- wp:heading {"level":2} --><h2>Piccoli imprenditori</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Per chi deve far crescere l'azienda senza disperdere tempo tra prove casuali e strumenti sovrapposti.</p><!-- /wp:paragraph --></div><!-- /wp:group --></div>
	<!-- /wp:column -->
	<!-- wp:column -->
	<div class="wp-block-column"><!-- wp:group {"className":"mi-detail-card","layout":{"type":"constrained"}} --><div class="wp-block-group mi-detail-card"><!-- wp:heading {"level":2} --><h2>Professionisti e consulenti</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Per chi vuole organizzare meglio il lavoro, migliorare la continuita operativa e capire dove l'AI puo alleggerire il carico.</p><!-- /wp:paragraph --></div><!-- /wp:group --></div>
	<!-- /wp:column -->
	<!-- wp:column -->
	<div class="wp-block-column"><!-- wp:group {"className":"mi-detail-card","layout":{"type":"constrained"}} --><div class="wp-block-group mi-detail-card"><!-- wp:heading {"level":2} --><h2>Commercianti e piccoli team</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Per chi gestisce attivita, richieste, clienti e processi quotidiani con poco margine per errori e perdite di tempo.</p><!-- /wp:paragraph --></div><!-- /wp:group --></div>
	<!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|l"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--l)">
	<!-- wp:heading {"level":2} -->
	<h2>Quando questo approccio non e adatto</h2>
	<!-- /wp:heading -->
	<!-- wp:list -->
	<ul>
		<li>Se cerchi solo una lista di strumenti da provare in fretta</li>
		<li>Se vuoi automatizzare tutto senza test, controllo umano o revisione</li>
		<li>Se stai cercando promesse facili o risultati garantiti</li>
		<li>Se il problema vero non e ancora stato messo a fuoco</li>
	</ul>
	<!-- /wp:list -->
</div>
<!-- /wp:group -->
HTML
		),
		'articoli'                     => array(
			'title'   => 'Articoli',
			'order'   => 4,
			'content' => '<!-- wp:paragraph --><p>Archivio editoriale del progetto Metodo IMPATTO.</p><!-- /wp:paragraph -->',
		),
		'chi-sono'                     => array(
			'title'   => 'Chi sono',
			'order'   => 5,
			'content' => <<<'HTML'
<!-- wp:group {"className":"mi-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group mi-card">
	<!-- wp:paragraph {"className":"mi-kicker"} -->
	<p class="mi-kicker">Chi sono</p>
	<!-- /wp:paragraph -->
	<!-- wp:heading {"level":1} -->
	<h1>Chi sono</h1>
	<!-- /wp:heading -->
	<!-- wp:paragraph -->
	<p>Mi chiamo Dario Buccigrossi. La mia esperienza professionale si muove tra CRM, digitalizzazione e integrazione dei processi, con un interesse concreto per il modo in cui l'intelligenza artificiale puo diventare utile nel lavoro quotidiano delle piccole imprese.</p>
	<!-- /wp:paragraph -->
	<!-- wp:paragraph -->
	<p>Con Metodo IMPATTO voglio sperimentare, verificare e trasformare l'uso dell'AI in un metodo comprensibile e misurabile. Non mi interessa aggiungere altro rumore: mi interessa capire che cosa funziona, in quali condizioni e con quali limiti.</p>
	<!-- /wp:paragraph -->
	<!-- wp:image {"id":0,"sizeSlug":"full","linkDestination":"none"} -->
	<figure class="wp-block-image size-full"><img src="%AVATAR_URL%" alt="Avatar segnaposto sobrio e sostituibile per la pagina Chi sono"/></figure>
	<!-- /wp:image -->
	<!-- wp:group {"className":"mi-warning-card","layout":{"type":"constrained"}} -->
	<div class="wp-block-group mi-warning-card">
		<!-- wp:heading {"level":2} -->
		<h2>Nota editoriale</h2>
		<!-- /wp:heading -->
		<!-- wp:paragraph -->
		<p>Questa pagina usa solo informazioni confermate. Eventuali dettagli biografici aggiuntivi verranno inseriti solo dopo verifica e sono tracciati in <code>docs/content-gaps.md</code>.</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
HTML
		),
		'contatti'                     => array(
			'title'   => 'Contatti',
			'order'   => 6,
			'content' => <<<'HTML'
<!-- wp:group {"className":"mi-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group mi-card">
	<!-- wp:paragraph {"className":"mi-kicker"} -->
	<p class="mi-kicker">Contatti</p>
	<!-- /wp:paragraph -->
	<!-- wp:heading {"level":1} -->
	<h1>Contatti</h1>
	<!-- /wp:heading -->
	<!-- wp:paragraph -->
	<p>Per ora il modo piu semplice per seguire il progetto e iscriverti alla newsletter. Sto completando anche i dati di contatto pubblici, ma non li pubblico finche non sono verificati.</p>
	<!-- /wp:paragraph -->
	<!-- wp:shortcode -->
	[mi_page_link slug="newsletter"]Vai alla newsletter[/mi_page_link]
	<!-- /wp:shortcode -->
	<!-- wp:group {"className":"mi-warning-card","layout":{"type":"constrained"}} -->
	<div class="wp-block-group mi-warning-card">
		<!-- wp:heading {"level":2} -->
		<h2>Dati in attesa di conferma</h2>
		<!-- /wp:heading -->
		<!-- wp:list -->
		<ul>
			<li>Email di contatto pubblica</li>
			<li>Eventuale PEC o riferimenti legali</li>
			<li>Dati societari o professionali da esporre</li>
		</ul>
		<!-- /wp:list -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
HTML
		),
		'newsletter'                   => array(
			'title'   => 'Il Prompt della Settimana',
			'order'   => 7,
			'content' => <<<'HTML'
<!-- wp:group {"align":"wide","className":"mi-newsletter-page","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide mi-newsletter-page">
	<!-- wp:paragraph {"className":"mi-kicker"} -->
	<p class="mi-kicker">Il Prompt della Settimana</p>
	<!-- /wp:paragraph -->
	<!-- wp:heading {"level":1} -->
	<h1>Una mail breve da tenere aperta mentre lavori.</h1>
	<!-- /wp:heading -->
	<!-- wp:paragraph -->
	<p>AI meno rumorosa, piu utile. Ogni venerdi ricevi un esempio pratico per usare l'AI in modo piu lucido: cosa chiedere, cosa evitare, come valutare il risultato.</p>
	<!-- /wp:paragraph -->

	<!-- wp:html -->
	<div class="mi-newsletter-manifesto">
		<div><strong>Un prompt commentato</strong><span>non solo da copiare: da capire e adattare al tuo contesto.</span></div>
		<div><strong>Un caso operativo</strong><span>marketing, vendite, organizzazione o contenuti, sempre collegato a un processo reale.</span></div>
		<div><strong>Una domanda scomoda</strong><span>per distinguere automazione utile, entusiasmo momentaneo e lavoro fatto meglio.</span></div>
	</div>
	<!-- /wp:html -->

	<!-- wp:paragraph -->
	<p>Niente spam, niente raccolte infinite di tool. Solo strumenti, metodo e casi pratici. Quando Brevo sara configurato, l'iscrizione usera double opt-in e consenso privacy separato.</p>
	<!-- /wp:paragraph -->

	<!-- wp:shortcode -->
	[mi_newsletter]
	<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
HTML
		),
		'privacy-policy'               => array(
			'title'   => 'Privacy Policy',
			'order'   => 8,
			'content' => <<<'HTML'
<!-- wp:group {"className":"mi-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group mi-card">
	<!-- wp:paragraph {"className":"mi-kicker"} -->
	<p class="mi-kicker">Bozza tecnica</p>
	<!-- /wp:paragraph -->
	<!-- wp:heading {"level":1} -->
	<h1>Privacy Policy</h1>
	<!-- /wp:heading -->
	<!-- wp:paragraph -->
	<p>Questa pagina contiene una struttura iniziale da completare con i dati reali del titolare del trattamento e con le verifiche necessarie prima della pubblicazione definitiva.</p>
	<!-- /wp:paragraph -->
	<!-- wp:heading {"level":2} -->
	<h2>Titolare del trattamento</h2>
	<!-- /wp:heading -->
	<!-- wp:paragraph -->
	<p>[DATI DEL TITOLARE DA CONFERMARE]</p>
	<!-- /wp:paragraph -->
	<!-- wp:heading {"level":2} -->
	<h2>Dati trattati</h2>
	<!-- /wp:heading -->
	<!-- wp:list -->
	<ul>
		<li>dati di navigazione;</li>
		<li>dati inviati tramite eventuali moduli;</li>
		<li>dati necessari all'iscrizione alla newsletter, quando configurata.</li>
	</ul>
	<!-- /wp:list -->
	<!-- wp:heading {"level":2} -->
	<h2>Finalita e basi giuridiche</h2>
	<!-- /wp:heading -->
	<!-- wp:paragraph -->
	<p>[FINALITA, BASI GIURIDICHE E TEMPI DI CONSERVAZIONE DA VALIDARE]</p>
	<!-- /wp:paragraph -->
	<!-- wp:paragraph {"className":"mi-legal-note"} -->
	<p class="mi-legal-note">Le informative generate o predisposte tecnicamente devono essere verificate e approvate dal titolare del trattamento o da un consulente competente prima della pubblicazione.</p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
HTML
		),
		'cookie-policy'                => array(
			'title'   => 'Cookie Policy',
			'order'   => 9,
			'content' => <<<'HTML'
<!-- wp:group {"className":"mi-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group mi-card">
	<!-- wp:paragraph {"className":"mi-kicker"} -->
	<p class="mi-kicker">Bozza tecnica</p>
	<!-- /wp:paragraph -->
	<!-- wp:heading {"level":1} -->
	<h1>Cookie Policy</h1>
	<!-- /wp:heading -->
	<!-- wp:paragraph -->
	<p>Questa pagina verra completata insieme alla configurazione di Complianz Free e alla verifica dei cookie effettivamente presenti nel sito.</p>
	<!-- /wp:paragraph -->
	<!-- wp:heading {"level":2} -->
	<h2>Categorie previste</h2>
	<!-- /wp:heading -->
	<!-- wp:list -->
	<ul>
		<li>tecnici necessari;</li>
		<li>statistici, solo se configurati correttamente;</li>
		<li>eventuali terze parti, solo dopo verifica reale.</li>
	</ul>
	<!-- /wp:list -->
	<!-- wp:heading {"level":2} -->
	<h2>Configurazione e consenso</h2>
	<!-- /wp:heading -->
	<!-- wp:paragraph -->
	<p>Google Analytics 4 non verra caricato prima del consenso quando il consenso sara richiesto e la configurazione manuale sara stata completata.</p>
	<!-- /wp:paragraph -->
	<!-- wp:paragraph {"className":"mi-legal-note"} -->
	<p class="mi-legal-note">Le informative generate o predisposte tecnicamente devono essere verificate e approvate dal titolare del trattamento o da un consulente competente prima della pubblicazione.</p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
HTML
		),
	);

update_option( 'blogname', 'Metodo IMPATTO' );
update_option( 'blogdescription', "Dall'obiettivo aziendale a un processo AI misurabile." );
update_option( 'show_on_front', 'page' );

$page_ids = array();

foreach ( $pages as $slug => $config ) {
	$content = str_replace( '%AVATAR_URL%', esc_url( $avatar_url ), $config['content'] );
	$page_ids[ $slug ] = mi_upsert_page(
		$slug,
		array(
			'post_title'   => $config['title'],
			'menu_order'   => $config['order'],
			'post_content' => $content,
		)
	);
}

if ( isset( $page_ids['newsletter'] ) ) {
	update_post_meta( $page_ids['newsletter'], '_wp_page_template', 'newsletter-landing' );
}

update_option( 'page_on_front', $page_ids['home'] );
update_option( 'page_for_posts', $page_ids['articoli'] );
update_option( 'stylesheet', 'metodo-impatto' );
update_option( 'template', 'metodo-impatto' );

$categories = array(
	'AI per acquisire clienti',
	'AI e processi aziendali',
	'Automazioni',
	'Prompt e strumenti',
	'Metodo IMPATTO',
	'Esperimenti e verifiche',
);

foreach ( $categories as $category_name ) {
	if ( ! term_exists( $category_name, 'category' ) ) {
		wp_insert_term( $category_name, 'category' );
	}
}

$sample_posts = get_posts(
	array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => 10,
	)
);

foreach ( $sample_posts as $sample_post ) {
	if ( in_array( $sample_post->post_title, array( 'Hello world!', 'Ciao mondo!' ), true ) ) {
		wp_update_post(
			array(
				'ID'          => $sample_post->ID,
				'post_status' => 'draft',
			)
		);
	}
}

echo "Setup completato.\n";
