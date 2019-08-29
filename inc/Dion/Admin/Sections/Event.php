<?php

namespace Dion\Admin\Sections;

/**
 * Event sections
 */
class Category
{	
	public static function get()
	{
		$section = array(
            'title' => __('Kategoriler', 'redux-framework'),
            'icon' => 'el-icon-group',
            'fields' => array(
                array(
                    'id'        => 'SCPost',
                    'type'      => 'text',
                    'title'     => __('Kategorinin öne çıkan haberinin id\'si', 'star'),
                    'validate'  => 'no_html',
                    'default'   => '',
                ),
            ));

		return $section;
	}
}