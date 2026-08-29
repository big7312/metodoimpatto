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
<!-- wp:group {"className":"mi-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group mi-card">
	<!-- wp:paragraph {"className":"mi-kicker"} -->
	<p class="mi-kicker">Newsletter</p>
	<!-- /wp:paragraph -->
	<!-- wp:heading {"level":2} -->
	<h2>Ti mando solo contenuti che aiutano a leggere meglio il lavoro e l'uso concreto dell'AI.</h2>
	<!-- /wp:heading -->
	<!-- wp:paragraph -->
	<p>La newsletter e il luogo in cui seguo piu da vicino il progetto: idee, verifiche, errori da evitare e criteri per usare l'AI senza perdersi negli strumenti.</p>
	<!-- /wp:paragraph -->
	<!-- wp:shortcode -->
	[mi_newsletter]
	<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
