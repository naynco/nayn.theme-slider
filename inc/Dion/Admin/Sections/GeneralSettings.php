<?php

namespace Dion\Admin\Sections;

/**
 * General Settings sections
 */
class GeneralSettings
{
	
	public static function get()
	{
		$section = array(
            'icon'   => 'el-icon-cogs',
            'title'  => __('Genel Ayarlar', 'dion'),
            'fields' => array(
                array(
                    'id' => 'logo',
                    'type' => 'media',
                    'url' => true,
                    'title' => __('Logo', 'dion'),
                    'compiler' => 'true',
                    'subtitle' => __('Sitenin genel logosu','dion'),
                    'default' => array('url' => get_template_directory_uri().'/assets/images/logo.png'),
                ),
                array(
                    'id' => 'logoFooter',
                    'type' => 'media',
                    'url' => true,
                    'title' => __('Logo: Alt Kısım', 'dion'),
                    'compiler' => 'true',
                    'subtitle' => __('Sitenin altına eklenilen logo','dion'),
                    'default' => array('url' => get_template_directory_uri().'/assets/images/footer-logo.png'),
                ),
                array(
                    'id' => 'favicon',
                    'type' => 'media',
                    'url' => true,
                    'title' => __('Favicon', 'dion'),
                    'compiler' => 'true',
                    'subtitle' => __('16x16px <br/><br/>Tarayıcı sekmenizin sol tarafından görünen 16x16px\'lik ufak favicondur.', 'dion'),
                    'default' => array('url' => get_template_directory_uri().'/img/ico/favicon.ico'),
                ),
                array(
                    'id' => 'favicon512',
                    'type' => 'media',
                    'url' => true,
                    'title' => __('Favicon 512', 'dion'),
                    'compiler' => 'true',
                    'subtitle' => __('512x512px <br/><br/>Mobil ve Tablet\'de sayfayı kaydettiğinizde düzgün görünmesini sağlayan ikondur.', 'dion'),
                    'default' => array('url' => get_template_directory_uri().'/img/ico/favicon-512.png'),
                ),
                array(
                    'id' => 'customCSS',
                    'type' => 'ace_editor',
                    'title' => __('Özel CSS Kodu', 'dion'),
                    'subtitle' => __('Tema dosyanızı değiştirmeden buradan CSS\'lerinizi tanımlayabilirsiniz.', 'dion'),
                    'mode' => 'css',
                    'theme' => 'monokai',
                    'default' => "#header{\nmargin: 0 auto;\n}"
                ),
                array(
                    'id' => 'customJS',
                    'type' => 'ace_editor',
                    'title' => __('Özel JS Kodu', 'dion'),
                    'subtitle' => __('Tema dosyanızı değiştirmeden buradan JS\'lerinizi tanımlayabilirsiniz.', 'dion'),
                    'mode' => 'javascript',
                    'theme' => 'chrome',
                    'default' => "jQuery(document).ready(function(){\n\n});"
                ),
                array(
                    'id' => 'googleAnalytics',
                    'type' => 'text',
                    'title' => __('Google Analiz', 'dion'),
                    'subtitle' => __('Google analiz kodunu buraya yazarak izlemeleri etkinleştirebilirsiniz. <br/><br/>Örnek kullanım: UA-12345678-9', 'dion'),
                ),
            )
        );
		return $section;
	}
}