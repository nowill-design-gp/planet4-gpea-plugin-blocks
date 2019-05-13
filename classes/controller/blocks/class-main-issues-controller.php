<?php

namespace P4NLBKS\Controllers\Blocks;

if ( ! class_exists( 'Main_Issues_Controller' ) ) {
	/**
	 * @noinspection AutoloadingIssuesInspection
	 */

	/**
	 * Class Main_Issues_Controller
	 *
	 * @package P4NLBKS\Controllers\Blocks
	 */
	class Main_Issues_Controller extends Controller {

		/** @const string BLOCK_NAME */
		const BLOCK_NAME = 'main_issues';

		/** @const string DEFAULT_LAYOUT */
		const DEFAULT_LAYOUT = 'default';

		/**
		 * Shortcode UI setup for the noindexblock shortcode.
		 * It is called when the Shortcake action hook `register_shortcode_ui` is called.
		 */
		public function prepare_fields() {

			$fields = [
				[
					'label' => __( 'Title', 'planet4-gpnl-blocks' ),
					'attr'	=> 'title',
					'type'	=> 'text',
					'meta'	=> [
						'placeholder' => __( 'Title', 'planet4-gpnl-blocks' ),
						'data-plugin' => 'planet4-gpnl-blocks',
					],
				],
				[
					'label' => __( 'Subtitle', 'planet4-gpnl-blocks' ),
					'attr'	=> 'subtitle',
					'type'	=> 'text',
					'meta'	=> [
						'placeholder' => __( 'Subtitle', 'planet4-gpnl-blocks' ),
						'data-plugin' => 'planet4-gpnl-blocks',
					],
				],
				[
					'label' => __( 'Description', 'planet4-gpnl-blocks' ),
					'attr'	=> 'description',
					'type'	=> 'textarea',
					'meta'	=> [
						'placeholder' => __( 'Description', 'planet4-gpnl-blocks' ),
						'data-plugin' => 'planet4-gpnl-blocks',
					],
				],
				// [
				// 	'label'		  => __( 'Issues', 'planet4-gpnl-blocks' ),
				// 	'attr'	   => 'issue_ids',
				// 	'type'	   => 'term_select',
				// 	'taxonomy' => 'category',
				// 	'multiple' => 'multiple',
				// 	'meta'	   => [
				// 		'select2_options' => [
				// 			'allowClear'			 => true,
				// 			'placeholder'			 => __( 'Select issues', 'planet4-gpnl-blocks' ),
				// 			'closeOnSelect'			 => false,
				// 			'minimumInputLength'	 => 0,
				// 			'multiple'				 => true,
				// 			'maximumSelectionLength' => 20,
				// 			'width'					 => '80%',
				// 		],
				// 	],
				// ],
			];

			// Define the Shortcode UI arguments.
			$shortcode_ui_args = [
				'label'			=> __( 'LATTE | Main Issues', 'planet4-gpnl-blocks' ),
				'listItemImage' => '<img src="' . esc_url( plugins_url() . '/planet4-gpnl-plugin-blocks/admin/img/main_issues.png' ) . '" />',
				'attrs'			=> $fields,
				'post_type'		=> P4NLBKS_ALLOWED_PAGETYPE,
			];

			shortcode_ui_register_for_shortcode( 'shortcake_' . self::BLOCK_NAME, $shortcode_ui_args );

		}

		/**
		 * Get all the data that will be needed to render the block correctly.
		 *
		 * @param array	 $attributes This is the array of fields of this block.
		 * @param string $content This is the post content.
		 * @param string $shortcode_tag The shortcode tag of this block.
		 *
		 * @return array The data to be passed in the View.
		 */
		public function prepare_data( $attributes, $content = '', $shortcode_tag = 'shortcake_' . self::BLOCK_NAME ) : array {

			// if( isset( $attributes[ 'issue_ids' ] ) ) {

			// 	$categories = get_categories( array(
			// 		'include' => explode(',', $attributes['issue_ids']),
			// 		'orderby' => 'include',
			// 	) );
			// 	$attributes['categories'] = $categories;

			// 	// TODO remove this magic constant 'issues'
			// 	$issues_obj = get_category_by_slug( 'issues' );
			// 	$issues_url = get_category_link( $issues_obj->term_id );
			// 	$attributes['issues_url'] = $issues_url;
			// }

			$formatted_posts = [];

			$posts = get_posts( array(
				'order'		  => 'desc',
				'orderby'	  => 'date',
				'post_type'	  => 'page',
				'numberposts' => 20,
				'tax_query' => array(
					array(
						'taxonomy' => 'p4_post_attribute',
						'field' => 'slug',
						'terms' => 'main-issue',
					)
				)
			) );

			if( $posts ) {
				foreach( $posts as $post ) {
					$post = (array) $post;
					if ( has_post_thumbnail( $post['ID'] ) ) {
						$img_id = get_post_thumbnail_id( $post['ID'] );
						$img_data = wp_get_attachment_image_src( $img_id , 'medium_large' );
						$post['img_url'] = $img_data[0];
					}
					$formatted_posts[] = $post;
				}
			}
			$attributes['categories'] = $formatted_posts;
			$attributes['layout'] = isset( $attributes['layout'] ) ? $attributes['layout'] : self::DEFAULT_LAYOUT;

			return [
				'fields' => $attributes,
			];

		}

		/**
		 * Callback for the shortcake_noindex shortcode.
		 * It renders the shortcode based on supplied attributes.
		 *
		 * @param array	 $fields		Array of fields that are to be used in the template.
		 * @param string $content		The content of the post.
		 * @param string $shortcode_tag The shortcode tag (shortcake_blockname).
		 *
		 * @return string The complete html of the block
		 */
		public function prepare_template( $fields, $content, $shortcode_tag ) : string {

			$data = $this->prepare_data( $fields );

			// Shortcode callbacks must return content, hence, output buffering here.
			ob_start();

			$this->view->block( self::BLOCK_NAME, $data );
			// echo '<pre>' . var_export($data, true) . '</pre>';

			return ob_get_clean();
		}

	}
}
