<?php

namespace Dion\Admin\Sections;

/**
 * Blog sections
 */
class ThemeSettings
{	
	public static function get()
	{
		$section = array(
            'title' => __('Tema Ayarları', 'redux-framework'),
            'icon' => 'el-icon-fork',
            'fields' => array( 
                array(
                    'id'       => 'tsHomeSliderCount',
                    'type'     => 'text',
                    'multi'    => false,
                    'title'    => __('Manşette kaç tane yazı listelensin?', 'star'), 
                    'default'  => 30,
                    'subtitle' => __('Varsayılan: 30','star'),
                ),
                array(
                    'id'       => 'tsContactPage',
                    'type'     => 'select',
                    'multi'    => false,
                    'title'    => __('İletişim Sayfası', 'star'), 
                    'data' => 'pages'
                ),
            ));

		return $section;
	}
}