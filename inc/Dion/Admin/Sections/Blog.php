<?php

namespace Dion\Admin\Sections;

/**
 * Blog sections
 */
class Blog
{	
	public static function get()
	{
		$section = array(
            'title' => __('Blog', 'redux-framework'),
            'icon' => 'el-icon-wordpress',
            'fields' => array(
                array(
                    'id'        => 'bDescription',
                    'type'      => 'textarea',
                    'title'     => __('Açıklama', 'star'),
                    'validate'  => 'no_html',
                    'default'   => '',
                ),               
                array(
                    'id'       => 'bBlog',
                    'type'     => 'select',
                    'multi'    => true,
                    'title'    => __('Blog Kategorisi', 'star'), 
                    'data'     => 'terms',
                    'args'     => array(
                                    'taxonomies' => array( 'category' ),
                                ),
                ),  
                array(
                    'id'       => 'bCategory',
                    'type'     => 'select',
                    'multi'    => true,
                    'title'    => __('Sayfada görünecek kategorilerin listesi', 'star'), 
                    'data' => 'terms',
                    'args' => array(
                        'taxonomies' => array( 'category' ),
                    )
                )
            ));

		return $section;
	}
}