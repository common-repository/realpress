<?php

if ( ! isset( $field ) ) {
	return;
}

use RealPress\Helpers\General;
use RealPress\Helpers\Media;

$max_width = $max_height = '';
if ( ! empty( $field->max_size ) ) {
	$max_width  = $field->max_size['width'];
	$max_height = $field->max_size['height'];
}
?>
    <div class="<?php echo esc_attr( ltrim( $field->class . ' ' . 'realpress-field-wrapper realpress-file-upload-wrapper' ) ); ?>">
		<?php
		if ( ! empty( $field->title ) ) {
			?>
            <div class="realpress-title-wrapper">
                <label for="<?php echo esc_attr( $field->id ); ?>"><?php echo esc_html( $field->title ); ?></label>
            </div>
			<?php
		}
		if ( $field->multiple ) {
			if ( empty( $field->value ) ) {
				$field->value = array();
			} else {
				$field->value = explode( ',', $field->value );
				if ( count( $field->value ) > $field->max_number ) {
					$field->value = array_slice( $field->value, 0, $field->max_number );
				}
			}

			$value_data = implode( ',', $field->value );
			?>
            <div class="realpress-image-info multiple" data-max-file-size="<?php echo esc_attr( $field->max_file_size ); ?>"
                 data-max-width="<?php echo esc_attr( $max_width ); ?>"
                 data-max-height="<?php echo esc_attr( $max_height ); ?>">
                <div class="realpress-gallery-inner">
                    <input type="hidden" name="<?php echo esc_attr( $field->name ); ?>"
                           data-number="<?php echo esc_attr( $field->max_number ); ?>"
                           value="<?php echo esc_attr( $value_data ); ?>" readonly/>
					<?php
					$count = count( $field->value );
					for ( $i = 0; $i < $count; $i ++ ) {
						$data_id = empty( $field->value[ $i ] ) ? '' : $field->value[ $i ];
						$img_src = '';
						if ( ! empty( wp_get_attachment_image_src( $data_id, 'thumbnail' )[0] ) ) {
							$img_src = wp_get_attachment_image_src( $data_id, 'thumbnail' )[0];
						}
						$alt_text = Media::get_image_alt( $data_id );
						?>
                        <div class="realpress-gallery-preview" data-id="<?php echo esc_attr( $data_id ); ?>">
                            <div class="realpress-gallery-centered">
                                <img src="<?php echo esc_url_raw( $img_src ); ?>"
                                     alt="<?php echo esc_attr( $alt_text ); ?>">
                            </div>
                            <span class="realpress-gallery-remove dashicons dashicons dashicons-no-alt"></span>
                        </div>
						<?php
					}
					?>
                    <button type="button"
                            class="button realpress-gallery-add"><?php echo esc_html( $field->button_title ); ?></button>
                </div>
            </div>
			<?php
			if ( ! empty( $field->description ) ) {
				?>
                <p><?php echo General::ksesHTML( $field->description ); ?></p>
				<?php
			}
		} else {
			$image_id  = $field->value['image_id'] ?? '';
			$alt_text  = Media::get_image_alt( $image_id );
			$image_url = $field->value['image_url'] ?? '';
			?>
            <div class="realpress-image-info" data-max-file-size="<?php echo esc_attr( $field->max_file_size ); ?>"
                 data-max-width="<?php echo esc_attr( $max_width ); ?>"
                 data-max-height="<?php echo esc_attr( $max_height ); ?>">
                <div class="realpress-image-inner">
                    <div class="realpress-image-preview">
                        <img src="<?php echo esc_url_raw( $image_url ); ?>" alt="<?php echo esc_attr( $alt_text ); ?>">
                    </div>
                    <div class="realpress-image-control">
                        <input type="hidden" name="<?php echo esc_attr( $field->name . '[image_id]' ); ?>"
                               value="<?php echo esc_attr( $image_id ); ?>" readonly/>
                        <input type="text" name="<?php echo esc_attr( $field->name . '[image_url]' ); ?>"
                               id="<?php echo esc_attr( $field->id ); ?>"
                               value="<?php echo esc_attr( $image_url ); ?>" readonly/>
                        <button type="button" href="#"
                                class="button button-secondary realpress-image-add"><?php esc_html_e( 'Select Image', 'realpress' ); ?></button>
                        <button type="button" href="#"
                                class="button button-secondary realpress-image-remove"><?php esc_html_e( 'Remove', 'realpress' ); ?></button>
                    </div>
                </div>
				<?php
				if ( ! empty( $field->description ) ) {
					?>
                    <p><?php echo General::ksesHTML( $field->description ); ?></p>
					<?php
				}
				?>
            </div>
			<?php
		}
		?>
    </div>
<?php
if ( ! did_action( 'wp_enqueue_media' ) ) {
	wp_enqueue_media();
}

