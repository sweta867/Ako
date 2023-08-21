<?php

/**
 * Root project file
 */


include 'cpt.php';

function generate_main_menu( $location = false ) {
	if ( ! $location ) {
		return;
	}

	$menuLocations = get_nav_menu_locations();
	$navLocation   = false;
	if ( isset( $menuLocations[ $location ] ) ) {
		$navLocation = $menuLocations[ $location ];
	}
	$items = wp_get_nav_menu_items( $navLocation );

	if ( ! $items ) {
		return false;
	}

	$megaMenus = Options::get( 'mega_menus' );
	//debugP( $megaMenus );

	$megaMenuClasses = false;
	if ( $megaMenus ) {
		foreach ( $megaMenus as $k => $m ) {
			if ( $m['mega_menu_connection_class'] && ! empty( $m['mega_menu_sections'] ) ) {
				$megaMenuClasses[ $k ] = $m['mega_menu_connection_class'];
			}
		}
	}

	foreach ( $items as $item ) {
		$sub = false;

		if ( $item->menu_item_parent != 0 ) {
			continue;
		}

		foreach ( $items as $i ) {
			if ( $i->menu_item_parent == $item->ID ) {
				$sub[] = $i;
			}
		}

		#is submenu
		if ( $sub ) {
			?>
			<li class="submenu <?php if ( $item->object_id == get_the_ID() ) {
				echo 'active';
			} ?> <?php echo implode( ' ', $item->classes ) ?>">
				<a href="<?php echo $item->url ?>" title="<?php echo strip_tags( $item->title ) ?>">
					<span><?php echo $item->title ?></span>
				</a>
				<div class="header__submenu">
					<nav>
						<ul>
							<?php
							foreach ( $sub as $s ) {
								?>
								<li class="<?php if ( $s->object_id == get_the_ID() ) {
									echo 'active';
								} ?>">
									<a href="<?php echo $s->url ?>" title="<?php echo strip_tags( $s->title ) ?>">
										<span><?php echo $s->title ?></span>
									</a>
								</li>
								<?php
							}
							?>
						</ul>
					</nav>
				</div>
			</li>
			<?php
		} else {

			$mmcActive = false;
			if ( $megaMenuClasses ) {
				foreach ( $megaMenuClasses as $k => $mmc ) {
					if ( in_array( $mmc, $item->classes ) ) {
						$mmcActive = $k;
					}
				}
			}

			if ( $mmcActive === false ) {
				?>
				<li class="<?php if ( $item->object_id == get_the_ID() ) {
					echo 'active';
				} ?> <?php echo implode( ' ', $item->classes ) ?>">
					<a href="<?php echo $item->url ?>" title="<?php echo strip_tags( $item->title ) ?>">
						<span><?php echo $item->title ?></span>
					</a>
				</li>
				<?php
			} else {
				$item->classes[] = 'megamenu';
				?>
				<li class="<?php if ( $item->object_id == get_the_ID() ) {
					echo 'active';
				} ?> <?php echo implode( ' ', $item->classes ) ?>">
					<a href="<?php echo $item->url ?>" title="<?php echo strip_tags( $item->title ) ?>">
						<span><?php echo $item->title ?></span>
					</a>
					<?php
					$id = 'mega_menu_' . rand( 0, 9999 );
					?>
					<div class="header__megamenu" id="<?php echo $id ?>">

						<script type="text/javascript">
							(function ($) {
								$(document).ready(function () {

									$.ajax({
										data: {
											action: 'ajax_load_mega_menu',
											class: <?php echo $mmcActive?>,
											iid: '<?php echo get_the_ID()?>',
										},
										type: 'post',
										url: ajaxurl,
										beforeSend: function (xhr) {
										},
										success: function (data) {
											$('#<?php echo $id?>').html(data);
										}
									});
								});
							})(jQuery);

						</script>

					</div>
				</li>
				<?php
			}
		}
	}
	$quoteFormData = get_quote_form_data();
	?>
	<li class="header__getquotecta">
		<a href="<?php echo esc_url( $quoteFormData['url'] ); ?>" title="Get an international shipping quote" class="btn"><?php _e( 'Get a quote', TT_D ) ?><span class="icon_right"><img src="<?php echo get_template_directory_uri() ?>/fe/assets/img/svg/btn_arrow_right.svg" alt=""></span></a>
	</li>
	<?php
}

function generate_mobile_menu( $location = false ) {
	if ( ! $location ) {
		return;
	}

	$menuLocations = get_nav_menu_locations();
	$navLocation   = false;
	if ( isset( $menuLocations[ $location ] ) ) {
		$navLocation = $menuLocations[ $location ];
	}
	$items = wp_get_nav_menu_items( $navLocation );

	if ( ! $items ) {
		return false;
	}

	$megaMenus = Options::get( 'mega_menus' );
	//debugP( $megaMenus );

	$megaMenuClasses = false;
	if ( $megaMenus ) {
		foreach ( $megaMenus as $k => $m ) {
			if ( $m['mega_menu_connection_class'] && ! empty( $m['mega_menu_sections'] ) ) {
				$megaMenuClasses[ $k ] = $m['mega_menu_connection_class'];
			}
		}
	}

	$mainMenu = false;
	$subMenus = false;

	$submenuIterations = 1;
	foreach ( $items as $item ) {
		$sub = false;

		if ( $item->menu_item_parent != 0 ) {
			continue;
		}

		foreach ( $items as $i ) {
			if ( $i->menu_item_parent == $item->ID ) {
				$sub[] = $i;
			}
		}

		if ( $sub ) {

			$active = '';
			if ( $item->object_id == get_the_ID() ) {
				$active = 'active';
			}
			$li = '<li class="' . $active . ' ' . implode( ' ', $item->classes ) . '"><a href="' . $item->url . '" mobilemenu="' . $submenuIterations . '" title="' . $item->title . '"><span>' . $item->title . '</span></a></li>';

			$mainMenu[] = $li;

			$subMenus[ $submenuIterations ][] = '<li class="back"><a href="javascript:void(0);" title="" mobilemenu="0"><span>' . $item->title . '</span></a></li>';

			foreach ( $sub as $s ) {
				$active = '';
				if ( $s->object_id == get_the_ID() ) {
					$active = 'active';
				}
				$li = '<li class="' . $active . '"><a href="' . $s->url . '" title="' . $s->title . '"><span>' . $s->title . '</span></a></li>';

				$subMenus[ $submenuIterations ][] = $li;
			}

			$submenuIterations ++;
		} else {
			$mmcActive = false;
			if ( $megaMenuClasses ) {
				foreach ( $megaMenuClasses as $k => $mmc ) {
					if ( in_array( $mmc, $item->classes ) ) {
						$mmcActive = $k;
					}
				}
			}

			if ( $mmcActive === false ) {

				$active = '';
				if ( $item->object_id == get_the_ID() ) {
					$active = 'active';
				}
				$li         = '<li class="' . $active . ' ' . implode( ' ', $item->classes ) . '"><a href="' . $item->url . '" title="' . $item->title . '"><span>' . $item->title . '</span></a></li>';
				$mainMenu[] = $li;

				//$submenuIterations ++;
			} else {
				$active = '';
				if ( $item->object_id == get_the_ID() ) {
					$active = 'active';
				}
				$li = '<li class="' . $active . ' ' . implode( ' ', $item->classes ) . '"><a href="' . $item->url . '" mobilemenu="' . $submenuIterations . '" title="' . $item->title . '"><span>' . $item->title . '</span></a></li>';
				//$li         = '<li class="' . $active . ' ' . implode( ' ', $item->classes ) . '" mobilemenu="' . $submenuIterations . '"><a href="javascript:void(0);" title="' . $item->title . '"><span>' . $item->title . '</span></a></li>';
				$mainMenu[] = $li;

				$cnt                              = count( $megaMenus[ $mmcActive ]['mega_menu_sections'] );
				$i                                = 0;
				$subMenus[ $submenuIterations ][] = '<li class="back"><a href="javascript:void(0);" title="" mobilemenu="0"><span>' . $item->title . '</span></a></li>';

				if ( $megaMenus[ $mmcActive ]['cta_link'] ) {
					$newTitle                         = '<span>' . $megaMenus[ $mmcActive ]['cta_link']['title'] . '</span>';
					$li                               = '<li class="highlight">' . tt_link( $megaMenus[ $mmcActive ]['cta_link'], '', '', $newTitle ) . '</li>';
					$subMenus[ $submenuIterations ][] = $li;
				}

				foreach ( $megaMenus[ $mmcActive ]['mega_menu_sections'] as $section ) {
					$i ++;

					$submenuLi = '<li>';
					if ( $section['section_title'] ) {
						$submenuLi .= '<span class="title">' . $section['section_title'] . '</span>';
					}
					$submenuLi .= '<ul>';

					foreach ( $section['items'] as $item ) {
						if ( ! $item['item'] ) {
							continue;
						}

						$active = '';
						if ( get_the_permalink() == $item['item']['url'] ) {
							$active = 'active';
						}
						$newTitle = '<span>' . $item['item']['title'] . '</span>';
						$submenuLi .= '<li class="' . $active . '">' . tt_link( $item['item'], '', '', $newTitle ) . '</li>';
					}

					$submenuLi .= '</ul>';
					$submenuLi .= '</li>';

					$subMenus[ $submenuIterations ][] = $submenuLi;
				}

				$submenuIterations ++;
			}
		}

	}

	if ( $mainMenu ) {
		?>
		<div mobilemenu="0" class="mobileheader__navigation__menu open">
			<nav>
				<ul>
					<?php echo implode( '', $mainMenu ) ?>
					<li class="highlight">
						<a href="javascript:void(0);" title="" mobilemenu="98">
							<span><?php _e( 'Looking for?', TT_D ) ?></span>
						</a>
					</li>
					<li class="highlight">
						<a href="javascript:void(0);" title="" mobilemenu="99">
							<span><?php _e( 'Quick links', TT_D ) ?></span>
						</a>
					</li>
				</ul>
			</nav>
		</div>
		<?php
	}

	if ( $subMenus ) {
		//debugP( $subMenus );
		foreach ( $subMenus as $key => $v ) {
			if ( empty( $v ) ) {
				continue;
			}
			?>
			<div mobilemenu="<?php echo $key ?>" class="mobileheader__navigation__menu">
				<nav>
					<ul>
						<?php
						foreach ( $v as $li ) {
							echo $li;
						}
						?>
					</ul>
				</nav>
			</div>
			<?php
		}
	}

	$menu = get_field( 'looking_for_menu' );
	if ( ! $menu ) {
		$menu = Options::get( 'looking_for_menu' );
	}

	?>
	<div mobilemenu="98" class="mobileheader__navigation__menu">
		<nav>
			<ul>
				<li class="back">
					<a href="javascript:void(0);" title="" mobilemenu="0">
						<span><?php _e( 'Looking for', TT_D ) ?></span>
					</a>
				</li>
				<?php
				wp_nav_menu( array( 'menu' => $menu, 'walker' => new tt_Nav_Walker(), 'menu_class' => '', 'items_wrap' => '%3$s' ) );
				?>
			</ul>
		</nav>
	</div>
	<div mobilemenu="99" class="mobileheader__navigation__menu">
		<nav>
			<ul>
				<li class="back">
					<a href="javascript:void(0);" title="" mobilemenu="0">
						<span><?php _e( 'Quick links', TT_D ) ?></span>
					</a>
				</li>
				<?php
				if ( has_nav_menu( 'primary_top_navigation' ) ) :
					wp_nav_menu( array(
						'theme_location' => 'primary_top_navigation',
						'walker'         => new tt_Nav_Walker(),
						'menu_class'     => '',
						'items_wrap'     => '%3$s'
					) );
				endif;
				?>
			</ul>
		</nav>
	</div>
	<?php
}

function wpb_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );

	return $buttons;
}

add_filter( 'mce_buttons_2', 'wpb_mce_buttons_2' );


function my_mce_before_init_insert_formats( $init_array ) {

	$style_formats = array(

		array(
			'title'   => 'Bullet title',
			'block'   => 'span',
			'classes' => 'bullet_title',
			'wrapper' => false,
			//'exact'   => true,
		),

	);

	
	$init_array['style_formats'] = json_encode( $style_formats );

	return $init_array;

}

add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );
