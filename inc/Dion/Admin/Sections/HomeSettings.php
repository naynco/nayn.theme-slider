<?php

namespace Dion\Admin\Sections;

/**
 * Blog sections
 */
class HomeSettings
{	
	public static function get()
	{
		$section = array(
            'title' => __('Ana Sayfa', 'redux-framework'),
            'icon' => 'el-icon-home',
            'fields' => array(                
                array(
                    'id'         => 'hsPageCode',
                    'type'       => 'ace_editor',
                    'full_width' => true,
                    'title'      => __( 'Ana Sayfa Kodları', 'redux-framework-demo' ),
                    'subtitle'   => __( '', 'redux-framework-demo' ),
                    'mode'       => 'php',
                    'theme'      => 'chrome',
                    'desc'       => '',
                    'default'    => '<?php '
                ),
            ));

		return $section;
	}
}