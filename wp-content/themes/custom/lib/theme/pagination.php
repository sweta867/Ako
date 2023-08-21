<?php

/**
 * Pagination
 */


function tt_pagination( $pages = '', $range = 2 ) {
	$showitems = ( $range * 2 ) + 1;

	global $paged;
	if ( empty( $paged ) ) {
		$paged = 1;
	}

	if ( $pages == '' ) {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if ( ! $pages ) {
			$pages = 1;
		}
	}
	if ( 1 != $pages ) {
		echo '<ul class="pagination justify-content-center">';
		//if ($paged > 2 && $paged > $range + 1 && $showitems < $pages)
		//echo "<li><a href='" . get_pagenum_link(1) . "'><i class=\"fa fa-angle-double-left\"></i></a></li>";
		if ( $paged > 1 ) {
			echo "<li class='page-item'><a class='prev page-link' href='" . get_pagenum_link( $paged - 1 ) . "'><span class='arrow_left'>-></span></a></li>";
		}

		for ( $i = 1; $i <= $pages; $i ++ ) {
			if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
				echo ( $paged == $i ) ? "<li class='page-item'>
				<span class='page-link current'>" . $i . "</span></li>" : "<li class='page-item'><a  href='" .get_pagenum_link( $i ) . "' class='page-link'><span>" . $i . "</span></a></li>";
			}
		}

		if ( $paged < $pages  ) {
			echo "<li class='page-item'><a class='next page-link' href='" . get_pagenum_link( $paged + 1 ) . "'><span class='arrow_right'><-</span></a></li>";
		}
		if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages ) //echo "<li><a href='" . get_pagenum_link($pages) . "'><i class=\"fa fa-angle-double-right\"></i></a></li>";
		{
			echo "</ul>\n";
		}
	}
}