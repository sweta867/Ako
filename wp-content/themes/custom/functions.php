<?php

$tt_includes = array('lib/theme/theme.php', 'lib/project/project.php');

foreach ( $tt_includes as $file ) {
	if ( ! $filepath = locate_template( $file ) ) {
		trigger_error( sprintf( 'Error locating %s for inclusion', $file ), E_USER_ERROR );
	}

	require_once $filepath;
}
unset( $file, $filepath );






