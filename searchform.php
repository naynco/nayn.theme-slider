<?php
/**
 * Template for displaying search forms in Star
 *
 */
?>
<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" autocomplete="on">
	<input id="search" name="s" type="text" placeholder="<?php echo esc_attr_x( 'bir arama başlat!', 'placeholder', 'star' ); ?>" value="<?php echo get_search_query(); ?>" >
	<i class="pull-right">
		<img src="<?php echo DION_THEME_URL; ?>/assets/images/search-icon.png" alt="">
	</i>
</form>