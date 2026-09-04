<?php
/**
 * Title: Metodo IMPATTO - Box newsletter
 * Slug: metodo-impatto/newsletter-box
 * Categories: metodo-impatto
 * Description: Box editoriale con modulo Brevo o fallback.
 *
 * @package MetodoImpatto
 */
?>
<!-- wp:group {"className":"mi-newsletter-editorial","layout":{"type":"constrained"}} -->
<div class="wp-block-group mi-newsletter-editorial">
	<!-- wp:paragraph {"className":"mi-kicker"} -->
	<p class="mi-kicker">Il Prompt della Settimana</p>
	<!-- /wp:paragraph -->
	<!-- wp:heading {"level":2} -->
	<h2>AI meno rumorosa, piu utile.</h2>
	<!-- /wp:heading -->
	<!-- wp:paragraph -->
	<p>Una mail breve ogni venerdi: un caso reale, un prompt commentato e una domanda per capire se l'AI sta davvero aiutando il lavoro.</p>
	<!-- /wp:paragraph -->
	<!-- wp:html -->
	<ul class="mi-newsletter-bullets">
		<li><strong>1 prompt</strong><span>da copiare, adattare e capire.</span></li>
		<li><strong>1 caso</strong><span>per vedere dove il metodo regge.</span></li>
		<li><strong>1 criterio</strong><span>per scegliere meglio il prossimo test.</span></li>
	</ul>
	<!-- /wp:html -->
	<!-- wp:shortcode -->
	[mi_newsletter]
	<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
