<?php

namespace Dion\Admin\Sections;

/**
 * Social Media sections
 */
class SocialMedia
{	
	public static function get()
	{
		$section = array(
            'title' => __('Sosyal Medya', 'redux-framework'),
            'icon' => 'el-icon-bullhorn',
            'fields' => array(

                array(
                    'id'        => 'smFacebook',
                    'type'      => 'text',
                    'title'     => __('Facebook', 'dion'),
                    'validate'  => 'no_html',
                    'default'   => '',
                ),

                array(
                    'id'        => 'smTwitter',
                    'type'      => 'text',
                    'title'     => __('Twitter', 'dion'),
                    'validate'  => 'no_html',
                    'default'   => '',
                ),

                array(
                    'id'        => 'smInstagram',
                    'type'      => 'text',
                    'title'     => __('Instagram', 'dion'),
                    'validate'  => 'no_html',
                    'default'   => '',
                ),

            ));

		return $section;
	}
}