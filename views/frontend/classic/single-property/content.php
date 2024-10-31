<?php
/**
 * Template part for displaying single content property
 *
 */

use RealPress\Helpers\Template;
use RealPress\Models\PropertyModel;
use RealPress\Models\CommentModel;

global $post;
$template      = Template::instance();
$data          = array();
$property_id   = get_the_ID();
$data['id']    = $property_id;
$data['title'] = get_the_title();
$data['time']  = get_the_time( 'U' );
//$data['meta_data']    = PropertyModel::get_meta_data( get_the_ID() );

$data['types']        = PropertyModel::get_property_terms( $property_id, 'realpress-type' );
$data['status']       = PropertyModel::get_property_terms( $property_id, 'realpress-status' );
$data['labels']       = PropertyModel::get_property_terms( $property_id, 'realpress-labels' );
$data['locations']    = PropertyModel::get_property_terms( $property_id, 'realpress-location' );
$data['features']     = PropertyModel::get_property_terms( $property_id, 'realpress-feature' );
$data['energy-class'] = PropertyModel::get_property_terms( $property_id, 'realpress-energy-class' );

$data['address_name']           = PropertyModel::get_address_name( $property_id );
$data['lat_lon']                = PropertyModel::get_lat_lon( $property_id );
$data['price']                  = PropertyModel::get_price( $property_id );
$data['text_after_price']       = PropertyModel::get_text_after_price( $property_id );
$data['gallery']                = PropertyModel::get_galleries( $property_id );
$data['vr_video']               = PropertyModel::get_vr_video( $property_id );
$data['video']                  = PropertyModel::get_video( $property_id );
$data['property_id']            = PropertyModel::get_property_id( $property_id );
$data['bedrooms']               = PropertyModel::get_bedrooms( $property_id );
$data['bathrooms']              = PropertyModel::get_bathrooms( $property_id );
$data['area_size']              = PropertyModel::get_area_size( $property_id );
$data['area_size_postfix']      = PropertyModel::get_area_size_postfix( $property_id );
$data['land_area_size']         = PropertyModel::get_land_area_size( $property_id );
$data['land_area_size_postfix'] = PropertyModel::get_land_area_size_postfix( $property_id );
$data['year_built']             = PropertyModel::get_year_built( $property_id );
$data['additional_details']     = PropertyModel::get_additional_details( $property_id );
$data['rooms']                  = PropertyModel::get_rooms( $property_id );
$data['floor_plans']            = PropertyModel::get_floor_plans( $property_id );
$data['map_enable']             = PropertyModel::is_enable_map( $property_id );

$data['review_total'] = CommentModel::get_comment_total( $property_id, 'property' );
$data['rating']       = get_post_meta( $property_id, REALPRESS_PREFIX . '_property_average_review', true );
$data['agent']        = PropertyModel::get_agent_info( $property_id );
$data['is_wishlist']  = false;
if ( is_user_logged_in() ) {
	$user_id   = get_current_user_id();
	$favorites = get_user_meta( $user_id, REALPRESS_PREFIX . '_my_wishlist', true );
	if ( ! empty( $favorites ) ) {
		$data['is_wishlist'] = in_array( $property_id, $favorites );
	}
}
?>

<div id="realpress-single-property-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="realpress-container">
		<?php
		do_action( 'realpress/single-property/frontend/breadcrumb' );
		?>
        <div class="realpress-single-property-breadcrumb">
			<?php
			$template->get_frontend_template_type_classic( 'shared/breadcrumb.php', compact( 'data' ) );
			?>
        </div>
		<?php
		do_action( 'realpress/single-property/frontend/header' );
		$template->get_frontend_template_type_classic( 'single-property/header.php', compact( 'data' ) );
		$template->get_frontend_template_type_classic( 'single-property/section/media.php', compact( 'data' ) );
		?>
        <div class="realpress-single-property-content">
			<?php
			do_action( 'realpress/single-property/frontend/section' );
			$sections = array(
				'overview',
				'description',
				'address-location',
				'detail',
				'energy-class',
				'features',
				'floor-plans',
				'video',
				'virtual-tour',
				'yelp-near-by',
				'walkscore',
				'mortgage-calculator',
				'reviews',
				'similar-property',
			);
			foreach ( $sections as $section ) {
				$template->get_frontend_template_type_classic(
					'single-property/section/' . $section . '.php',
					compact( 'data' )
				);
			}
			?>
        </div>
		<?php do_action( 'realpress/single-property/frontend/sidebar' ); ?>
        <div class="realpress-single-property-sidebar">
			<?php
			if ( is_active_sidebar( 'realpress-single-property-sidebar' ) ) {
				dynamic_sidebar( 'realpress-single-property-sidebar' );
			}
			?>
        </div>
    </div>
    <footer>
    </footer>
</div>
