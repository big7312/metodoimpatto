<?php
/**
 * Theme bootstrap for Metodo IMPATTO.
 *
 * @package MetodoImpatto
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MI_THEME_VERSION', '0.1.0' );

/**
 * Sets up theme supports and editor features.
 */
function mi_theme_setup() {
	add_editor_style( 'assets/css/front.css' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-spacing' );
	add_theme_support( 'appearance-tools' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );

	register_block_pattern_category(
		'metodo-impatto',
		array(
			'label' => __( 'Metodo IMPATTO', 'metodo-impatto' ),
		)
	);
}
add_action( 'after_setup_theme', 'mi_theme_setup' );

/**
 * Enqueues frontend assets.
 */
function mi_enqueue_assets() {
	$theme = wp_get_theme();
	$style_path = get_theme_file_path( 'assets/css/front.css' );
	$script_path = get_theme_file_path( 'assets/js/front.js' );

	wp_enqueue_style(
		'mi-front',
		get_theme_file_uri( 'assets/css/front.css' ),
		array(),
		file_exists( $style_path ) ? (string) filemtime( $style_path ) : $theme->get( 'Version' )
	);

	wp_enqueue_script(
		'mi-front',
		get_theme_file_uri( 'assets/js/front.js' ),
		array(),
		file_exists( $script_path ) ? (string) filemtime( $script_path ) : $theme->get( 'Version' ),
		true
	);

	wp_localize_script(
		'mi-front',
		'miThemeData',
		array(
			'copiedLabel' => __( 'Link copiato', 'metodo-impatto' ),
			'copyLabel'   => __( 'Copia link', 'metodo-impatto' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'mi_enqueue_assets' );

/**
 * Adds excerpt support to pages for future editorial flexibility.
 */
function mi_add_page_excerpt_support() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'mi_add_page_excerpt_support' );

/**
 * Registers customizer-agnostic settings under Reading for light setup.
 */
function mi_register_settings() {
	register_setting(
		'reading',
		'mi_brevo_embed_code',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'mi_sanitize_embed_code',
			'default'           => '',
		)
	);

	register_setting(
		'reading',
		'mi_ga4_measurement_id',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'mi_sanitize_measurement_id',
			'default'           => '',
		)
	);

	add_settings_section(
		'mi_reading_section',
		__( 'Metodo IMPATTO', 'metodo-impatto' ),
		'mi_render_settings_intro',
		'reading'
	);

	add_settings_field(
		'mi_brevo_embed_code',
		__( 'Codice modulo Brevo', 'metodo-impatto' ),
		'mi_render_brevo_field',
		'reading',
		'mi_reading_section'
	);

	add_settings_field(
		'mi_ga4_measurement_id',
		__( 'Google Analytics 4 Measurement ID', 'metodo-impatto' ),
		'mi_render_ga4_field',
		'reading',
		'mi_reading_section'
	);
}
add_action( 'admin_init', 'mi_register_settings' );

/**
 * Sanitizes the Brevo embed code while allowing the expected markup.
 *
 * @param string $value Raw option value.
 * @return string
 */
function mi_sanitize_embed_code( $value ) {
	$allowed_html = array(
		'div'    => array(
			'class' => true,
			'id'    => true,
			'style' => true,
		),
		'form'   => array(
			'class'           => true,
			'id'              => true,
			'action'          => true,
			'method'          => true,
			'target'          => true,
			'novalidate'      => true,
			'data-type'       => true,
			'accept-charset'  => true,
			'aria-label'      => true,
		),
		'label'  => array(
			'for'   => true,
			'class' => true,
		),
		'input'  => array(
			'type'         => true,
			'name'         => true,
			'id'           => true,
			'value'        => true,
			'class'        => true,
			'placeholder'  => true,
			'checked'      => true,
			'required'     => true,
			'aria-required'=> true,
			'aria-label'   => true,
			'minlength'    => true,
			'maxlength'    => true,
			'autocomplete' => true,
		),
		'button' => array(
			'type'  => true,
			'class' => true,
		),
		'p'      => array(
			'class' => true,
		),
		'span'   => array(
			'class' => true,
		),
		'a'      => array(
			'href'   => true,
			'target' => true,
			'rel'    => true,
			'class'  => true,
		),
		'script' => array(
			'src'   => true,
			'type'  => true,
			'async' => true,
			'defer' => true,
		),
	);

	return wp_kses( $value, $allowed_html );
}

/**
 * Sanitizes a GA4 Measurement ID.
 *
 * @param string $value Raw option value.
 * @return string
 */
function mi_sanitize_measurement_id( $value ) {
	$value = strtoupper( trim( (string) $value ) );

	if ( '' === $value ) {
		return '';
	}

	if ( preg_match( '/^G-[A-Z0-9]+$/', $value ) ) {
		return $value;
	}

	add_settings_error(
		'mi_ga4_measurement_id',
		'mi_invalid_ga4_id',
		__( 'Il Measurement ID deve avere un formato simile a G-XXXXXXXXXX.', 'metodo-impatto' )
	);

	return '';
}

/**
 * Renders settings intro.
 */
function mi_render_settings_intro() {
	echo '<p>' . esc_html__( 'Configura qui i punti di integrazione manuale. Il codice GA4 non viene caricato automaticamente dal tema per evitare tracciamento senza una configurazione privacy completa.', 'metodo-impatto' ) . '</p>';
}

/**
 * Renders the Brevo field.
 */
function mi_render_brevo_field() {
	$value = get_option( 'mi_brevo_embed_code', '' );

	echo '<textarea class="large-text code" rows="10" name="mi_brevo_embed_code">' . esc_textarea( $value ) . '</textarea>';
	echo '<p class="description">' . esc_html__( 'Incolla qui il codice embed del modulo Brevo quando disponibile. In sua assenza il tema mostra un fallback editoriale accessibile.', 'metodo-impatto' ) . '</p>';
}

/**
 * Renders the GA4 field.
 */
function mi_render_ga4_field() {
	$value = get_option( 'mi_ga4_measurement_id', '' );

	echo '<input class="regular-text code" type="text" name="mi_ga4_measurement_id" value="' . esc_attr( $value ) . '" placeholder="G-XXXXXXXXXX" />';
	echo '<p class="description">' . esc_html__( 'Campo predisposto solo come promemoria di configurazione. L\'attivazione effettiva va completata insieme al consenso cookie.', 'metodo-impatto' ) . '</p>';
}

/**
 * Outputs newsletter markup or a fallback.
 *
 * @return string
 */
function mi_get_newsletter_markup() {
	$embed_code = trim( (string) get_option( 'mi_brevo_embed_code', '' ) );

	if ( '' !== $embed_code ) {
		return '<div class="mi-brevo-embed">' . $embed_code . '</div>';
	}

	ob_start();
	?>
	<div class="mi-newsletter-fallback" aria-live="polite">
		<p class="mi-eyebrow"><?php esc_html_e( 'Newsletter in preparazione', 'metodo-impatto' ); ?></p>
		<h3><?php esc_html_e( 'La struttura e pronta, il modulo verra collegato a Brevo dopo la configurazione finale.', 'metodo-impatto' ); ?></h3>
		<p><?php esc_html_e( 'Qui andra il modulo di iscrizione con double opt-in, consenso privacy separato e messaggi accessibili di conferma o errore.', 'metodo-impatto' ); ?></p>
		<form class="mi-newsletter-shell" action="#" method="post">
			<p>
				<label for="mi-newsletter-email"><?php esc_html_e( 'Email', 'metodo-impatto' ); ?></label>
				<input id="mi-newsletter-email" type="email" placeholder="nome@azienda.it" disabled />
			</p>
			<p>
				<label for="mi-newsletter-name"><?php esc_html_e( 'Nome (facoltativo)', 'metodo-impatto' ); ?></label>
				<input id="mi-newsletter-name" type="text" placeholder="<?php esc_attr_e( 'Come ti chiami', 'metodo-impatto' ); ?>" disabled />
			</p>
			<p class="mi-newsletter-consent">
				<input id="mi-newsletter-consent" type="checkbox" disabled />
				<label for="mi-newsletter-consent"><?php esc_html_e( 'Acconsento al trattamento dei dati secondo l\'informativa privacy.', 'metodo-impatto' ); ?></label>
			</p>
			<p class="mi-newsletter-actions">
				<button type="submit" disabled><?php esc_html_e( 'Modulo da configurare', 'metodo-impatto' ); ?></button>
			</p>
		</form>
		<p class="mi-small-note"><?php esc_html_e( 'La configurazione tecnica non salva i contatti nel database WordPress.', 'metodo-impatto' ); ?></p>
	</div>
	<?php
	return (string) ob_get_clean();
}

/**
 * Shortcode for newsletter rendering.
 *
 * @return string
 */
function mi_newsletter_shortcode() {
	return mi_get_newsletter_markup();
}
add_shortcode( 'mi_newsletter', 'mi_newsletter_shortcode' );

/**
 * Renders social share links.
 *
 * @return string
 */
function mi_share_links_shortcode() {
	$url   = rawurlencode( get_permalink() );
	$title = rawurlencode( wp_strip_all_tags( get_the_title() ) );

	ob_start();
	?>
	<div class="mi-share-links" aria-label="<?php esc_attr_e( 'Condividi questo articolo', 'metodo-impatto' ); ?>">
		<span class="mi-share-links__label"><?php esc_html_e( 'Condividi', 'metodo-impatto' ); ?></span>
		<a href="<?php echo esc_url( 'https://www.linkedin.com/sharing/share-offsite/?url=' . $url ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'LinkedIn', 'metodo-impatto' ); ?></a>
		<a href="<?php echo esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . $url ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Facebook', 'metodo-impatto' ); ?></a>
		<a href="<?php echo esc_url( 'https://wa.me/?text=' . rawurlencode( get_the_title() . ' ' . get_permalink() ) ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'WhatsApp', 'metodo-impatto' ); ?></a>
		<button type="button" class="mi-copy-link" data-url="<?php echo esc_attr( get_permalink() ); ?>"><?php esc_html_e( 'Copia link', 'metodo-impatto' ); ?></button>
	</div>
	<?php
	return (string) ob_get_clean();
}
add_shortcode( 'mi_share_links', 'mi_share_links_shortcode' );

/**
 * Renders a link to a page by slug.
 *
 * @param array  $atts Shortcode attributes.
 * @param string $content Shortcode content.
 * @return string
 */
function mi_page_link_shortcode( $atts, $content = '' ) {
	$atts = shortcode_atts(
		array(
			'slug'    => '',
			'variant' => 'solid',
		),
		$atts
	);

	$page = get_page_by_path( sanitize_title( $atts['slug'] ) );

	if ( ! $page instanceof WP_Post ) {
		return '';
	}

	$classes = 'wp-element-button mi-page-link';

	if ( 'outline' === $atts['variant'] ) {
		$classes .= ' mi-link-outline';
	}

	return sprintf(
		'<a class="%1$s" href="%2$s">%3$s</a>',
		esc_attr( $classes ),
		esc_url( get_permalink( $page ) ),
		esc_html( $content )
	);
}
add_shortcode( 'mi_page_link', 'mi_page_link_shortcode' );
