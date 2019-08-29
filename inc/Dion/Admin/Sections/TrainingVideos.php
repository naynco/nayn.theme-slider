<?php

namespace Dion\Admin\Sections;

/**
 * General Settings sections
 */
class TrainingVideos
{
	
	public static function get()
	{
		$section = array(
            'icon'   => 'el-icon-video',
            'title'  => __('Eğitim Videoları', 'dion'),
            'fields' => array(
                array(
                    'id'       => 'tvFirstVideo',
                    'type'     => 'raw',
                    'title'    => __('1. Genel tanıtım, Yazı ve Video Ekleme, Profil bilgilerini güncelleme','star'),
                    'content'  => '<iframe width="711" height="400" src="https://www.youtube.com/embed/XcFkXh6E3b0" frameborder="0" allowfullscreen></iframe>',
                ),
                array(
                    'id'       => 'tvSecondVideo',
                    'type'     => 'raw',
                    'title'    => __('2. 1 Usta 1 Hikaye','star'),
                    'content'  => '<iframe width="711" height="400" src="https://www.youtube.com/embed/ZaGwZdsVh-E" frameborder="0" allowfullscreen></iframe>',
                ),
                array(
                    'id'       => 'tvThirdVideo',
                    'type'     => 'raw',
                    'title'    => __('3. Etkinlik Ekleme','star'),
                    'content'  => '<iframe width="711" height="400" src="https://www.youtube.com/embed/3vUfGvvhzbI" frameborder="0" allowfullscreen></iframe>',
                ),
                array(
                    'id'       => 'tvFourthVideo',
                    'type'     => 'raw',
                    'title'    => __('4. Etkinlik Ayarları','star'),
                    'content'  => '<iframe width="711" height="400" src="https://www.youtube.com/embed/RKeCZQA7FrU" frameborder="0" allowfullscreen></iframe>',
                ),
                array(
                    'id'       => 'tvFifthVideo',
                    'type'     => 'raw',
                    'title'    => __('5. Menüler, Sosyal Medya, Alt Kısım ve Sözleşme','star'),
                    'content'  => '<iframe width="711" height="400" src="https://www.youtube.com/embed/aUyr1jJf0WI" frameborder="0" allowfullscreen></iframe>',
                ),
                array(
                    'id'       => 'tvSeventhVideo',
                    'type'     => 'raw',
                    'title'    => __('6. Bileşenler ','star'),
                    'content'  => '<iframe width="711" height="400" src="https://www.youtube.com/embed/sVb0xtS9UJY" frameborder="0" allowfullscreen></iframe>',
                ),
                array(
                    'id'       => 'tvSixthVideo',
                    'type'     => 'raw',
                    'title'    => __('7. Blog ayarları ve Genel Ayarlar','star'),
                    'content'  => '<iframe width="711" height="400" src="https://www.youtube.com/embed/XcwnWkdYMwU" frameborder="0" allowfullscreen></iframe>',
                ),
            )
        );
		return $section;
	}
}