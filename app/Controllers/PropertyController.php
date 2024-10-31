<?php

namespace RealPress\Controllers;

use RealPress\Helpers\Price;
use RealPress\Helpers\RestApi;
use RealPress\Helpers\Template;
use RealPress\Helpers\Config;
use RealPress\Helpers\Settings;
use RealPress\Helpers\General;
use RealPress\Models\PropertyModel;
use WP_REST_Server;

/**
 * Class PropertyController
 * @package RealPress\Controllers
 */
class PropertyController {
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );
		add_filter( 'manage_edit-' . REALPRESS_PROPERTY_CPT . '_columns', array( $this, 'add_header_thumbnail_column' ) );
		add_filter(
			'manage_' . 'posts' . '_custom_column',
			array(
				$this,
				'add_content_thumbnail_column',
			),
			10,
			2
		);
	}

	/**
	 * @param $column
	 * @param $post_id
	 *
	 * @return void
	 */
	public function add_content_thumbnail_column( $column, $post_id ) {
		switch ( $column ) {
			case 'realpress-property-thumbnail':
				$image_url = get_the_post_thumbnail_url( $post_id, 'realpress-custom-size-675x468' );
				if ( empty( $image_url ) ) {
					$image_url = General::get_image_place_holder();
				}
				?>
				<img src="<?php echo esc_url_raw( $image_url ); ?>" alt="<?php echo get_the_title( $post_id ); ?>">
				<?php
				break;
			default:
				break;
		}
	}

	/**
	 * @param $columns
	 *
	 * @return mixed
	 */
	public function add_header_thumbnail_column( $columns ) {
		$columns['realpress-property-thumbnail'] = esc_html__( 'Thumbnail', 'realpress' );

		return $columns;
	}

	/**
	 * @return void
	 */
	public function register_rest_routes() {
		register_rest_route(
			RestApi::generate_namespace(),
			'/property-list',
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => array( $this, 'get_properties' ),
				'args'                => array(
					'posts_per_page' => array(
						'required'    => false,
						'type'        => 'integer',
						'description' => 'The posts per page must be an integer',
					),
					'offset'         => array(
						'required'    => false,
						'type'        => 'integer',
						'description' => 'The offset must be an integer',
					),
				),
				'permission_callback' => '__return_true',
			),
		);
	}

	/**
	 * @param \WP_REST_Request $request
	 *
	 * @return \WP_REST_Response
	 */
	public function get_properties( \WP_REST_Request $request ) {
		$params = $request->get_params();

		$args = $this->parse_args( $params );

		$data = array();

		$query = new \WP_Query( $args );

		$template = Template::instance();

		$properties = array();
		//Content
		ob_start();
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				if ( $params['template'] === 'agent_detail' ) {
					$template->get_frontend_template_type_classic( 'agent-detail/property-item.php' );
				} elseif ( $params['template'] === 'similar_property' ) {
					$template->get_frontend_template_type_classic( 'single-property/section/similar-property-item.php' );
				} else {
					$template->get_frontend_template_type_classic(
						apply_filters( 'realpress/layout/archive-property/property-item', 'archive-property/property-item.php' )
					);
				}
				$properties[] = $this->get_property_data();
			}
			wp_reset_postdata();
		} else {
			return RestApi::success( esc_html__( 'No properties found', 'realpress' ), array() );
		}

		$data['content']  = ob_get_clean();
		$data['property'] = $properties;

		//Paginate
		ob_start();
		$current_page = $args['paged'];
		$max_pages    = intval( $query->max_num_pages );
		$totals       = $query->found_posts;
		$from         = 1 + ( $current_page - 1 ) * $args['posts_per_page'];
		$to           = ( $current_page * $args['posts_per_page'] > $totals ) ? $totals : $current_page * $args['posts_per_page'];
		if ( 0 === $totals ) {
			$from_to = '';
		} elseif ( 1 === $totals ) {
			$from_to = esc_html__( 'Showing only one result', 'realpress' );
		} else {
			if ( $from == $to ) {
				$from_to = sprintf( esc_html__( 'Showing last property of %s results', 'realpress' ), $totals );
			} else {
				$from_to = $from . '-' . $to;
				$from_to = sprintf( esc_html__( 'Showing %1$s of %2$s results', 'realpress' ), $from_to, $totals );
			}
		}

		$template->get_frontend_template_type_classic(
			'shared/pagination.php',
			array(
				'max_page'     => $max_pages,
				'current_page' => $current_page,
			)
		);
		$data ['pagination'] = ob_get_clean();
		$data ['totals']     = $totals;
		$data ['from_to']    = $from_to;

		return RestApi::success( '', $data );
	}

	/**
	 * @param $params
	 *
	 * @return array
	 */
	public function parse_args( $params ) {
		$args = array(
			'posts_per_page' => $params['posts_per_page'] ?? Settings::get_property_per_page(),
			'paged'          => $params['offset'] ?? 1,
			'orderby'        => $params['orderby'] ?? 'date',
			'order'          => $params['order'] ?? 'asc',
			'post_type'      => REALPRESS_PROPERTY_CPT,
		);

		if ( isset( $params['template'] ) && $params['template'] === 'similar_property' ) {
			$args['post__not_in'] = array( $params['post_id'] );

			$types    = PropertyModel::get_property_terms( $params['post_id'], 'realpress-type' );
			$term_ids = array();

			if ( ! empty( $types ) ) {
				$term_ids = array_map(
					function ( $types ) {
						return $types->term_id;
					},
					$types
				);
			}

			$args['tax_query'] = array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'realpress-type',
					'field'    => 'id',
					'terms'    => $term_ids,
					'operator' => 'IN',
				),
			);
		}

		if ( isset( $params['author'] ) ) {
			$args['author'] = $params['author'];
		}

		//sort
		if ( $args['orderby'] == 'rating' ) {
			$args['meta_key'] = REALPRESS_PREFIX . '_property_average_review';
			$args['orderby']  = 'meta_value_num';
		}

		if ( $args['orderby'] == 'price' ) {
			$args['meta_key'] = 'realpress_group:information:section:general:fields:price';
			$args['orderby']  = 'meta_value_num';
		}

		//search
		if ( ! empty( $params['keyword'] ) ) {
			$args['s'] = $params['keyword'];
		}

		$meta_keys = array( 'rooms', 'bedrooms', 'bathrooms' );

		foreach ( $meta_keys as $key ) {
			if ( isset( $params[ $key ] ) ) {
				$args['meta_query'][] = array(
					'key'     => 'realpress_group:information:section:general:fields:' . $key,
					'type'    => 'DECIMAL',
					'value'   => $params[ $key ],
					'compare' => '>=',
				);
			}
		}

		if ( isset( $params['year_built'] ) ) {
			$args['meta_query'][] = array(
				'key'     => 'realpress_group:information:section:general:fields:year_built',
				'value'   => $params['year_built'],
				'compare' => '=',
			);
		}

		//For taxonomy archive
		if ( isset( $params['term_id'] ) && isset( $params['taxonomy'] ) ) {
			$args['tax_query'][] = array(
				'taxonomy' => $params['taxonomy'],
				'terms'    => array( $params['term_id'] ),
				'operator' => 'IN',
			);
		}

		//Advanced Search
		$taxonomies = array_keys( Config::instance()->get( 'property-type:taxonomies' ) );

		foreach ( $taxonomies as $taxonomy ) {
			$key = str_replace( array( 'realpress-', '-' ), array( '', '_' ), $taxonomy );
			if ( isset( $params[ $key ] ) ) {
				$args['tax_query'][] = array(
					'taxonomy' => $taxonomy,
					'terms'    => array( $params[ $key ] ),
					'operator' => 'IN',
				);
			}
		}

		//Price
		if ( isset( $params['min-price'] ) && isset( $params['max-price'] ) ) {
			$args['meta_query'][] = array(
				'key'     => 'realpress_group:information:section:general:fields:price',
				'value'   => array( $params['min-price'], $params['max-price'] ),
				'type'    => 'DECIMAL',
				'compare' => 'BETWEEN',
			);
		}

		if ( ! empty( $params['has_coordinates'] ) ) {
			$args['meta_query'][] = array(
				'key'     => 'realpress_group:map:section:enable_map:fields:enable',
				'value'   => 'on',
				'type'    => 'CHAR',
				'compare' => '=',
			);

			$args['meta_query'][] = array(
				'key'     => 'realpress_group:map:section:map:fields:lat',
				'value'   => '',
				'type'    => 'CHAR',
				'compare' => '!=',
			);

			$args['meta_query'][] = array(
				'key'     => 'realpress_group:map:section:map:fields:lon',
				'value'   => '',
				'type'    => 'CHAR',
				'compare' => '!=',
			);
		}

		if ( isset( $args['meta_query'] ) ) {
			$args['meta_query']['relation'] = 'AND';
		}

		if ( isset( $args['tax_query'] ) ) {
			$args['tax_query']['relation'] = 'AND';
		}

		return $args;
	}

	/**
	 * @return array
	 */
	public function get_property_data() {
		$property_id = get_the_ID();
		$types       = PropertyModel::get_property_terms( $property_id, 'realpress-type' );
		$term        = $types[0] ?? null;
		$type_name   = '';
		$type_link   = '';
		if ( ! empty( $term ) ) {
			$type_name = $term->name;
			$type_link = get_term_link( $term, 'realpress-type' );
		}

		$price = PropertyModel::get_price( $property_id );
		$price = Price::get_formatted_price( $price );

		return array(
			'property_id'      => $property_id,
			'title'            => get_the_title(),
			'permalink'        => get_permalink(),
			'thumbnail'        => get_the_post_thumbnail_url( $property_id, 'realpress-custom-size-675x468' ),
			'price'            => $price,
			'text_after_price' => PropertyModel::get_text_after_price( $property_id ),
			'lat_lon'          => PropertyModel::get_lat_lon( $property_id ),
			'type_name'        => $type_name,
			'type_link'        => $type_link,
		);
	}
}
