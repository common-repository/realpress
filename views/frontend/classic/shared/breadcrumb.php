<?php

use RealPress\Helpers\Page;
use RealPress\Helpers\Settings;

if ( ! isset( $data ) ) {
	return;
}

?>
<ul class="realpress-breadcrumb-list">
	<li><a href="<?php echo home_url(); ?>"><?php esc_html_e( 'Home', 'realpress' ); ?></a>
	</li>
	<?php
	if ( is_singular( REALPRESS_PROPERTY_CPT ) ) {
		$types = $data['types'];
		$title = $data['title'];
		if ( ! empty( $types ) ) {
			foreach ( $types as $term ) {
				?>
				<li><a href="<?php echo get_term_link( $term ); ?>">
						<?php
						echo esc_html( $term->name );
						?>
					</a></li>
				<?php
			}
		}
		?>
		<li><?php echo esc_html( $title ); ?></li>
		<?php
	} elseif ( Page::is_property_taxonomy_archive() ) {
		$term_id        = get_queried_object()->term_id;
		$term           = get_term( $term_id );
		$term_parent_id = $term->parent;
		if ( ! empty( $term_parent_id ) ) {
			$term_parent = get_term( $term_parent_id );
			?>
			<li><a href="<?php echo get_term_link( $term_parent ); ?>">
					<?php
					echo esc_html( $term_parent->name );
					?>
				</a></li>
			<?php
		}
		?>
		<li><?php echo esc_html( $term->name ); ?></li>
		<?php
	} elseif ( Page::is_agent_list_page() ) {
		$agent_list_page_id = Settings::get_page_id( 'agent_list_page' );
		?>
		<li><?php echo get_the_title( $agent_list_page_id ); ?></li>
		<?php
	} elseif ( Page::is_agent_detail_page() ) {
		$agent_list_page_id = Settings::get_page_id( 'agent_list_page' );
		?>
		<li>
			<a href="<?php echo get_permalink( $agent_list_page_id ); ?>"><?php echo get_the_title( $agent_list_page_id ); ?></a>
		</li>
		<li><?php echo esc_html( get_query_var( 'author_name' ) ); ?></li>
		<?php
	} elseif ( Page::is_wishlist_page() ) {
		$wishlist_id = Settings::get_page_id( 'wishlist_page' );
		?>
        <li><?php echo get_the_title( $wishlist_id ); ?></li>
		<?php
	}
	?>
</ul>




