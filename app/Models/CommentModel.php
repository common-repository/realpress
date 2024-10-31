<?php

namespace RealPress\Models;

class CommentModel {
	private static $cache;

	private static function set_cache( $key, $val ) {
		self::$cache[ $key ] = $val;
	}

	private static function get_cache( $key ) {
		return self::$cache[ $key ] ?? null;
	}

	public static function get_comment_total( $object_id, $comment_type = 'property' ) {
		$key   = 'realpress_comment_total_' . $comment_type . '_' . $object_id;
		$cache = self::get_cache( $key );
		if ( $cache ) {
			return $cache;
		}

		global $wpdb;
		$comment_tbl = $wpdb->comments;

		$total = $wpdb->get_var(
			$wpdb->prepare(
				"SELECT COUNT($comment_tbl.comment_id) FROM $comment_tbl WHERE $comment_tbl.comment_approved='1' 
					AND $comment_tbl.comment_type='%s' AND $comment_tbl.comment_post_id=%s",
				$comment_type, $object_id
			)
		);

		self::set_cache( $key, $total );

		return empty( $total ) ? 0 : abs( $total );
	}

	public static function get_average_reviews( $object_id, $comment_type = 'property' ) {
		global $wpdb;
		$comment_tbl     = $wpdb->comments;
		$commentmeta_tbl = $wpdb->commentmeta;
		$average_reviews = $wpdb->get_var(
			$wpdb->prepare(
				"SELECT AVG ($commentmeta_tbl.meta_value) FROM $commentmeta_tbl INNER JOIN $comment_tbl ON ($comment_tbl.comment_id = $commentmeta_tbl.comment_id)
					WHERE $comment_tbl.comment_post_id = %d AND $comment_tbl.comment_type=%s AND $comment_tbl.comment_approved='1' AND $commentmeta_tbl.meta_key='realpress_fields\:review_stars'",
				$object_id, $comment_type
			)
		);

		return empty( $average_reviews ) ? 0 : round( $average_reviews, 2 );
	}

	public static function is_comment_exist( $object_id, $author_email, $comment_type = 'property' ) {
		global $wpdb;
		$comment_tbl = $wpdb->comments;

		return $wpdb->get_var(
			$wpdb->prepare(
				"SELECT EXISTS(SELECT $comment_tbl.comment_id FROM $comment_tbl WHERE $comment_tbl.comment_post_id = %d AND $comment_tbl.comment_type=%s 
					   AND $comment_tbl.comment_approved='1' AND $comment_tbl.comment_author_email =%s)",
				$object_id, $comment_type, $author_email
			)
		);
	}
}
