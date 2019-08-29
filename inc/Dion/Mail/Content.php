<?php namespace Dion\Mail;


class Content {


	public static function content($content = null)
	{
		$message = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
				<html>
				    <head>
				        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
				        <title></title>
				    </head>
				    <body>
				        <div>';
        $message .= $content;
		$message .=    '</div>
				     </body>
				 </html>';
		return $message;
	}


	public static function signup($args)
	{

		extract($args);


		$content = '<div>';
		$content .= '<p>Hoşgeldiniz</p>
					<p>sevgilibebek.com adresine e-posta adresi ve şifreniz ile giriş yapabilirsiniz</p>
					<p>Sevgili Bebek Ekibi</p>';





		return static::content($content);
	}

	
	public static function register($args)
	{
		extract($args);


		$content = '<div>';
		$content .= '<p>Hoşgeldiniz</p>
					<p>sevgilibebek.com`da '.$email.' e-posta adresi ile ilk kayıt aşamasını tamamladınız. </p><p>Sevgili Bebek Ekibi</p>';




		return static::content($content);
	}


	public static function passwordRetrieve($args)
	{
		extract($args);


		$content = '<div>';
		$content .= '<p>Merhaba,</p>
					<p>Sevgili Bebek`deki bu e-posta adresli kullanıcınız için `şifremi
					unuttum başvurusu yapıldı.</p><p> Şifrenizi yenilemek için 
					<a href="'.$obj->link.'">'.$obj->link.'</a> adresine giderek yeni şifrenizi alabilirsiniz.

					 </p><p>Sevgili Bebek Ekibi</p></div>';




		return static::content($content);
	}




}