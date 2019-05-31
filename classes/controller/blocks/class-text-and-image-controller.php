<?php
/**
 * Free text/image block class
 *
 * @package P4EABKS
 * @since 0.1
 */

namespace P4EABKS\Controllers\Blocks;

if ( ! class_exists( 'Text_And_Image_Controller' ) ) {
	/**
	 * Class Text_And_Image_Controller
	 *
	 * @package P4EABKS\Controllers\Blocks
	 */
	class Text_And_Image_Controller extends Controller {

		/**
		 * The block name constant.
		 *
		 * @const string BLOCK_NAME
		 */
		const BLOCK_NAME = 'text_and_image';

		/**
		 * The block default layout.
		 *
		 * @const string BLOCK_NAME
		 */
		const DEFAULT_LAYOUT = 'light';

		/**
		 * Shortcode UI setup for the noindexblock shortcode.
		 * It is called when the Shortcake action hook `register_shortcode_ui` is called.
		 */
		public function prepare_fields() {

			$fields = [
				[
					'label' => 'Select the layout',
					'description' => 'Select the layout',
					'attr' => 'layout',
					'type' => 'radio',
					'options' => [
						[
							'value' => 'light',
							'label' => __( 'Light background, dark text - issue color', 'planet4-gpea-blocks' ),
							'desc'  => 'Dark text on light background. The main color changes, based on the issue.',
							'image' => esc_url( plugins_url() . '/planet4-gpea-plugin-blocks/admin/img/latte.png' ),
						],
						[
							'value' => 'dark',
							'label' => __( 'Dark background, light text - issue color', 'planet4-gpea-blocks' ),
							'desc'  => 'Dark text on light background. The main color changes, based on the issue.',
							'image' => esc_url( plugins_url() . '/planet4-gpea-plugin-blocks/admin/img/latte.png' ),
						],
						[
							'value' => 'plain_light',
							'label' => __( 'White background, black', 'planet4-gpea-blocks' ),
							'desc'  => 'Black text on white background.',
							'image' => esc_url( plugins_url() . '/planet4-gpea-plugin-blocks/admin/img/latte.png' ),
						],
					],
				],
				[
					'label' => __( 'Title', 'planet4-gpea-blocks' ),
					'attr'  => 'title',
					'type'  => 'text',
					'meta'  => [
						'placeholder' => __( 'Title', 'planet4-gpea-blocks' ),
						'data-plugin' => 'planet4-gpea-blocks',
					],
				],
				[
					'label' => __( 'Paragraph', 'planet4-gpea-blocks' ),
					'attr'  => 'paragraph',
					'type'  => 'textarea',
					'meta'  => [
						'placeholder' => __( 'Paragraph', 'planet4-gpea-blocks' ),
						'data-plugin' => 'planet4-gpea-blocks',
					],
				],
				[
					'label' => __( 'Link label', 'planet4-gpea-blocks' ),
					'attr'  => 'link_label',
					'type'  => 'text',
					'meta'  => [
						'placeholder' => __( 'Link label', 'planet4-gpea-blocks' ),
						'data-plugin' => 'planet4-gpea-blocks',
					],
				],
				[
					'label' => __( 'Link URL', 'planet4-gpea-blocks' ),
					'attr'  => 'link_url',
					'type'  => 'url',
					'meta'  => [
						'placeholder' => __( 'Link URL', 'planet4-gpea-blocks' ),
						'data-plugin' => 'planet4-gpea-blocks',
					],
				],
				[
					'label' => __( 'Optional image(s)', 'planet4-gpea-blocks' ),
					'attr'        => 'images',
					'type'        => 'attachment',
					'libraryType' => array( 'image' ),
					'multiple'    => true,
					'addButton'   => __( 'Select image(s)', 'planet4-gpea-blocks' ),
					'frameTitle'  => __( 'Select image(s)', 'planet4-gpea-blocks' ),
				],
			];

			// Define the Shortcode UI arguments.
			$shortcode_ui_args = [
				'label'         => __( 'GPEA | Free text/image', 'planet4-gpea-blocks' ),
				'listItemImage' => '<img src="' . esc_url( plugins_url() . '/planet4-gpea-plugin-blocks/admin/img/latte.png' ) . '" />',
				'attrs'         => $fields,
				'post_type'     => P4EABKS_ALLOWED_PAGETYPE,
			];

			shortcode_ui_register_for_shortcode( 'shortcake_' . self::BLOCK_NAME, $shortcode_ui_args );

		}

		/**
		 * Get all the data that will be needed to render the block correctly.
		 *
		 * @param array  $attributes This is the array of fields of this block.
		 * @param string $content This is the post content.
		 * @param string $shortcode_tag The shortcode tag of this block.
		 *
		 * @return array The data to be passed in the View.
		 */
		public function prepare_data( $attributes, $content = '', $shortcode_tag = 'shortcake_' . self::BLOCK_NAME ) : array {

			if ( isset( $attributes['images'] ) ) {
				$attributes['images'] = array_map(function( $img_id ) {
					return wp_get_attachment_url( $img_id );
				}, explode( ',', $attributes['images'] ) );
			}

			$attributes['layout'] = isset( $attributes['layout'] ) ? $attributes['layout'] : self::DEFAULT_LAYOUT;

			return [
				'fields' => $attributes,
			];

		}

		/**
		 * Callback for the shortcake_noindex shortcode.
		 * It renders the shortcode based on supplied attributes.
		 *
		 * @param array  $fields        Array of fields that are to be used in the template.
		 * @param string $content       The content of the post.
		 * @param string $shortcode_tag The shortcode tag (shortcake_blockname).
		 *
		 * @return string The complete html of the block
		 */
		public function prepare_template( $fields, $content, $shortcode_tag ) : string {

			$data = $this->prepare_data( $fields );

			// Shortcode callbacks must return content, hence, output buffering here.
			ob_start();
			$this->view->block( self::BLOCK_NAME, $data );
			return ob_get_clean();
		}


	}
}
