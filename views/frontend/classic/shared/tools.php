<?php
if ( ! isset( $data ) ) {
	return;
}
$favoriteClass = '';
if ( $data['is_wishlist'] ) {
	$favoriteClass = 'realpress-wishlist';
}
?>
<ul class="realpress-property-item-tools">
	<li class="<?php echo esc_attr( rtrim( 'realpress-property-wishlist' . ' ' . $favoriteClass ) ); ?>">
		<span><i class="fas fa-heart"></i></span>
	</li>
</ul>
