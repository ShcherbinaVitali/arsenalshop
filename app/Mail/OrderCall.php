<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCall extends Mailable {
	use Queueable, SerializesModels;
	
	protected $name;
	protected $phone;
	protected $topic;
	
	public function __construct($name, $phone, $topic = null) {
		$this->name  = $name;
		$this->phone = $phone;
		$this->topic = $topic;
	}
	
	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {
		return $this->view(
			'pages.mail_templates.call-request',
			[
				'name'  => $this->name,
				'phone' => $this->phone,
				'topic' => $this->topic
			]
		);
	}
}
