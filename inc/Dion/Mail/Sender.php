<?php namespace Dion\Mail;

class Sender {

	public $to;

	public $subject;

	public $message;

	public static function mail($to,$subject,$message)
	{
		$mail = new self($to,$subject,$message);

		$mail->send();
	}

	private function __construct($to,$subject,$message)
	{
		$this->to      = $to;
		$this->subject = $subject;
		$this->message = $message;
	}


	public function send()
	{
		add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));

		return wp_mail( $this->to,$this->subject,$this->message );
	}


}






