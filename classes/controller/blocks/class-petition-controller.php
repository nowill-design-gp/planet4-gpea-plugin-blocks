<?php

namespace P4NLBKS\Controllers\Blocks;

if ( ! class_exists( 'Petition_Controller' ) ) {

	/**
	 * Class Petition_Controller
	 *
	 * @package P4NLBKS\Controllers\Blocks
	 */
	class Petition_Controller extends Controller {

		/** @const string BLOCK_NAME */
		const BLOCK_NAME = 'petition';

		/**
		 * Shortcode UI setup for the petitionblock shortcode.
		 * It is called when the Shortcake action hook `register_shortcode_ui` is called.
		 */
		public function prepare_fields() {
			$fields = array(
				array(
					'label' => __( 'Titel', 'planet4-gpnl-blocks' ),
					'attr'  => 'title',
					'type'  => 'text',
				),
				array(
					'label' => __( 'Ondertitel', 'planet4-gpnl-blocks' ),
					'attr'  => 'subtitle',
					'type'  => 'text',
				),
				array(
					'label'       => __( 'Afbeelding', 'planet4-blocks-backend' ),
					'attr'        => 'image',
					'type'        => 'attachment',
					'libraryType' => [ 'image' ],
					'addButton'   => __( 'Selecteer afbeelding', 'planet4-blocks-backend' ),
					'frameTitle'  => __( 'Selecteer afbeelding', 'planet4-blocks-backend' ),
				),
				array(
					'label' => __( 'Opt in tekst', 'planet4-gpnl-blocks' ),
					'attr'  => 'consent',
					'type'  => 'textarea',
					'value' => 'Als je dit aanvinkt, mag Greenpeace je per e-mail op de hoogte houden over onze campagnes. Ook vragen we je af en toe om steun. Afmelden kan natuurlijk altijd.',
				),
				array(
					'label' => __( 'Teken knop', 'planet4-gpnl-blocks' ),
					'attr'  => 'sign',
					'type'  => 'text',
					'value' => 'TEKEN NU',
				),
				array(
					'label' => __( 'Bedankt titel', 'planet4-gpnl-blocks' ),
					'attr'  => 'thankttitle',
					'type'  => 'text',
					'value' => 'Bedankt voor je handtekening!',
				),
				array(
					'label' => __( 'Bedankt tekst', 'planet4-gpnl-blocks' ),
					'attr'  => 'thanktext',
					'type'  => 'textarea',
				),
				array(
					'label' => __( 'Doneer knop bij bedankttekst', 'planet4-gpnl-blocks' ),
					'attr'  => 'donatebuttontext',
					'type'  => 'text',
					'value' => 'Doneer',
				),
				array(
					'label' => __( 'Link van doneerknop', 'planet4-gpnl-blocks' ),
					'attr'  => 'donatebuttonlink',
					'type'  => 'text',
					'value' => '/doneren',
				),
				array(
					'label' => __( 'Verberg sharing buttons?', 'planet4-gpnl-blocks' ),
					'attr'  => 'hidesharingbuttons',
					'type'  => 'checkbox',
				),
				array(
					'label' => __( 'Sharingtekst voor Twitter', 'planet4-gpnl-blocks' ),
					'attr'  => 'twittertext',
					'type'  => 'text',
				),
				array(
					'label' => __( 'Sharingtekst voor Whatsapp', 'planet4-gpnl-blocks' ),
					'attr'  => 'whatsapptext',
					'type'  => 'text',
				),
				array(
					'label' => __( 'Marketingcode', 'planet4-gpnl-blocks' ),
					'attr'  => 'marketingcode',
					'type'  => 'text',
				),
				array(
					'label' => __( 'Literatuurcode', 'planet4-gpnl-blocks' ),
					'attr'  => 'literaturecode',
					'type'  => 'text',
				),
				array(
					'label' => __( 'Campagnecode', 'planet4-gpnl-blocks' ),
					'attr'  => 'campaigncode',
					'type'  => 'text',
				),
				array(
					'label' => __( 'Google Analytics action', 'planet4-gpnl-blocks' ),
					'attr'  => 'ga_action',
					'type'  => 'text',
					'value' => 'Petitie',
				),
				array(
					'label' => __( 'Teller maximum', 'planet4-gpnl-blocks' ),
					'attr'  => 'countermax',
					'type'  => 'number',
				),
				array(
					'label'   => __( 'Advertentiecampagne?', 'planet4-gpnl-blocks' ),
					'attr'    => 'ad_campaign',
					'type'    => 'select',
					'options' => [
						[
							'value' => 'GP',
							'label' => ( 'Greenpeace' ),
						],
						[
							'value' => 'SB',
							'label' => ( 'Social Blue' ),
						],
						[
							'value' => 'JA',
							'label' => ( 'Jalt' ),
						],
					],
				),
				array(
					'label' => __( 'Social blue _apRef', 'planet4-gpnl-blocks' ),
					'attr'  => 'apref',
					'type'  => 'text',
					'description' => 'Vul hier de _apRef uit de Social Blue pixel bedankpagina in',
				),
				array(
					'label' => __( 'Gebruik email campaign?', 'planet4-gpnl-blocks' ),
					'attr'  => 'mailto',
					'type'  => 'checkbox',
					'description' => 'Let op! Het hangt volledig af van de instellingen van de computer van de bezoeker af of dit wel of niet zal werken. Het is echter voorlopige de beste optie.'
					),
				array(
				    'label' => __( 'Email aan', 'planet4-gpnl-blocks' ),
					'attr'  => 'to',
					'type'  => 'email',
					),
				array(
					'label' => __( 'Email tracker', 'planet4-gpnl-blocks' ),
					'attr'  => 'bcc',
					'type'  => 'email',
					'value' => 'vuiletracker@groenevrede.nl',
				),
				array(
					'label' => __( 'Email onderwerp', 'planet4-gpnl-blocks' ),
					'attr'  => 'subject',
					'type'  => 'text',
					),
				array(
					'label' => __( 'Email body', 'planet4-gpnl-blocks' ),
					'attr'  => 'body',
					'type'  => 'textarea',
					),
			);

			// Define the Shortcode UI arguments.
			$shortcode_ui_args = array(
				'label'         => __( 'GPNL | Petition', 'planet4-gpnl-blocks' ),
				'listItemImage' => '<img src="' . esc_url( plugins_url() . '/planet4-gpnl-plugin-blocks/admin/images/icon_petition.png' ) . '" />',
				'attrs'         => $fields,
				'post_type'     => P4NLBKS_ALLOWED_PAGETYPE,
			);

			shortcode_ui_register_for_shortcode( 'shortcake_' . self::BLOCK_NAME, $shortcode_ui_args );
		}

		/**
		 * Get the HTTP(S) URL of the current page.
		 *
		 * @param $server The $_SERVER superglobals array.
		 * @return string The URL.
		 */
		function current_url( $server ) {
			//Figure out whether we are using http or https.
			$http = 'http';
			//If HTTPS is present in our $_SERVER array, the URL should
			//start with https:// instead of http://
			if ( isset( $server['HTTPS'] ) ) {
				$http = 'https';
			}
			//Get the HTTP_HOST.
			$host = $server['HTTP_HOST'];
			//Get the REQUEST_URI. i.e. The Uniform Resource Identifier.
			$request_uri = strtok( $_SERVER['REQUEST_URI'], '?' );
			//Finally, construct the full URL.
			//Use the function htmlentities to prevent XSS attacks.
			return $http . '://' . htmlentities( $host ) . htmlentities( $request_uri );
		}

		function get_social_accounts( $social_menu ) : array {
			$social_accounts = [];
			if ( isset( $social_menu ) ) {

				$brands = [
					'facebook',
					'twitter',
					'youtube',
					'instagram',
				];
				foreach ( $social_menu as $social_menu_item ) {
					$url_parts = explode( '/', rtrim( $social_menu_item->url, '/' ) );
					foreach ( $brands as $brand ) {
						if ( false !== strpos( $social_menu_item->url, $brand ) ) {
							$social_accounts[ $brand ] = count( $url_parts ) > 0 ? $url_parts[ count( $url_parts ) - 1 ] : '';
						}
					}
				}
			}

			return $social_accounts;
		}

		/**
		 * Callback for the shortcake_twocolumn shortcode.
		 * It renders the shortcode based on supplied attributes.
		 *
		 * @param array  $fields Array of fields that are to be used in the template.
		 * @param string $content The content of the post.
		 * @param string $shortcode_tag The shortcode tag (shortcake_blockname).
		 *
		 * @return string The complete html of the block
		 */
		public function prepare_template( $fields, $content, $shortcode_tag ) : string {

			$fields = shortcode_atts(
				array(
					'title'              => '',
					'subtitle'           => '',
					'consent'            => '',
					'sign'               => '',
					'thanktext'          => '',
					'donatebuttontext'   => '',
					'donatebuttonlink'   => '',
					'hidesharingbuttons' => '',
					'twittertext'        => '',
					'whatsapptext'       => '',
					'marketingcode'      => '',
					'literaturecode'     => '',
					'campaigncode'       => '',
					'ga_action'          => '',
					'countermax'         => '',
					'image'              => '',
					'alt_text'           => '',
					'ad_campaign'        => '',
					'apref'              => '',
					'mailto'             => '',
					'to'                 => '',
					'bcc'                 => '',
					'subject'            => '',
					'body'               => '',
				),
				$fields,
				$shortcode_tag
			);
			// If an image is selected
			if ( isset( $fields['image'] ) ) {
				// If the selected image is succesfully found
				if ( $image = wp_get_attachment_image_src( $fields['image'], 'full' ) ) {
					// load the image from the library
					$fields['image']        = $image[0];
					$fields['alt_text']     = get_post_meta( $fields['image'], '_wp_attachment_image_alt', true );
					$fields['image_srcset'] = wp_get_attachment_image_srcset( $fields['image'], 'full', wp_get_attachment_metadata( $fields['image'] ) );
					$fields['image_sizes']  = wp_calculate_image_sizes( 'full', null, null, $fields['image'] );
				}
			}

			// Fetch the data from the social accounts and the current url for sharing buttons
			$social_menu               = wp_get_nav_menu_items( 'Footer Social' );
			$fields['social_accounts'] = $this->get_social_accounts( $social_menu );
			$fields['current_url']     = $this->current_url( $_SERVER );


			$fields['to']       = rawurlencode( str_replace( ' ', '', strip_tags( $fields['to'] ) ) );
			$fields['bcc']      = rawurlencode( str_replace( ' ', '', strip_tags( $fields['bcc'] ) ) );
			$fields['subject']  = rawurlencode( strip_tags( $fields['subject'] ) );
			$fields['body']    = rawurlencode( strip_tags( $fields['body'] ) );

			$data = [
				'fields' => $fields,
			];

			// Include de approptiate scripts for ad campaign tracking
			if ( 'SB' === $fields['ad_campaign'] ) {
				wp_enqueue_script( 'social-blue-landing-script', P4NLBKS_ASSETS_DIR . 'js/social-blue-landing.js' );
			} elseif ( 'JA' === $fields['ad_campaign'] ) {
				wp_enqueue_script( 'jalt-landing-script', P4NLBKS_ASSETS_DIR . 'js/jalt-landing.js' );
			}

			//  Include the script and styling for the counter
			wp_enqueue_script( 'petitioncounterjs', P4NLBKS_ASSETS_DIR . 'js/onload.js', array( 'jquery' ), null, true );
			wp_enqueue_script( 'jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js', array( 'jquery' ), null, true );
			wp_enqueue_style( 'petitioncountercss', P4NLBKS_ASSETS_DIR . 'css/gpnl-petition.min.css' );

			/* ========================
				C S S / JS
			   ======================== */
				// Enqueue the script:
				wp_enqueue_script( 'jquery-docready-script', P4NLBKS_ASSETS_DIR . 'js/onsubmit.js', array( 'jquery' ), null, true );

				// Pass options to frontend code
				wp_localize_script(
					'jquery-docready-script',
					'petition_form_object',
					array(
						'ajaxUrl'            => admin_url( 'admin-ajax.php' ),
						//url for php file that process ajax request to WP
						'nonce'              => wp_create_nonce( 'GPNL_Petitions' ),
						'analytics_campaign' => $fields['campaigncode'],
						'countermax'         => $fields['countermax'],
						'ga_action'          => $fields['ga_action'],
						'ad_campaign'        => $fields['ad_campaign'],
						'apref'              => $fields['apref'],
						'mailto'             => 'mailto:' . $fields['to'] . '?bcc=' . $fields['bcc'] . '&subject=' . $fields['subject'] . '&body=' . $fields['body'],
					)
				);
			// Shortcode callbacks must return content, hence, output buffering here.
			ob_start();
			$this->view->block( self::BLOCK_NAME, $data );

			return ob_get_clean();
		}
	}
}
	/* ========================
		P E T I T I O N F O R M
   ======================== */
function petition_form_process() {
	// First check if the nonce is correct
	check_ajax_referer( 'GPNL_Petitions', 'nonce' );

	// get petition specific codes for processing in the database and sanitize
	$marketingcode  = htmlspecialchars( strip_tags( $_POST['marketingcode'] ) );
	$literatuurcode = htmlspecialchars( strip_tags( $_POST['literaturecode'] ) );

	// Get and sanitize the formdata
	$naam  = strip_tags( $_POST['name'] );
	$email = strip_tags( $_POST['mail'] );
	// Accept only numeric characters in the phonenumber
	$phonenumber = preg_replace( '/[^0-9]/', '', strip_tags( $_POST['phone'] ) );
	$consent     = htmlspecialchars( strip_tags( $_POST['consent'] ) );

	// Accept only phonenumbers of 10 characters long
	$phonenumber = ( strlen( $phonenumber ) === 10 ? $phonenumber : '' );
	// Flip the consent checkbox
	$consent = ( 'on' == $consent ? 0 : 1 );

	$baseurl = 'https://www.mygreenpeace.nl/registreren/pixel.aspx';
	// $baseurl    = 'p4.local';
	$querystring = '?source=' . $marketingcode . '&per=' . $literatuurcode . '&fn=' . $naam . '&email=' . $email . '&tel=' . $phonenumber . '&stop=' . $consent;

	// initiate a cUrl request to the database
	$request = curl_init( $baseurl . $querystring );
	curl_setopt( $request, CURLOPT_FOLLOWLOCATION, 1 );
	curl_setopt( $request, CURLOPT_HEADER, 0 );
	curl_setopt( $request, CURLOPT_RETURNTRANSFER, 1 );

	$result   = curl_exec( $request );
	$httpcode = curl_getinfo( $request, CURLINFO_HTTP_CODE );
	curl_close( $request );

	// Give the appropriate response to the frontend
	if ( false === $result ) {
		wp_send_json_error(
			[
				// 'url'           => $baseurl . $querystring,
				'statuscode' => $httpcode,
				// 'cUrlresult'    => $result,
				// 'cUrlavailable' => function_exists( 'curl_version' ),
			],
			500
		);
	}
	wp_send_json_success(
		[
			// 'url'           => $baseurl . $querystring,
			'statuscode' => $httpcode,
			'phone'      => $phonenumber,
			'body'       => $fields['body'],
			// 'cUrlresult'    => $result,
			// 'cUrlavailable' => function_exists( 'curl_version' ),
		],
		200
	);

}

# use this version for if you want the callback to work for users who are logged in
add_action( 'wp_ajax_petition_form_process', 'P4NLBKS\Controllers\Blocks\petition_form_process' );
# use this version for if you want the callback to work for users who are not logged in
add_action( 'wp_ajax_nopriv_petition_form_process', 'P4NLBKS\Controllers\Blocks\petition_form_process' );
