<?php

namespace App\Mail;

use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderProduct extends Mailable {
	use Queueable, SerializesModels;
	
	protected $name;
	protected $phone;
	protected $product;
	protected $count;
	
	/**
	 * OrderProduct constructor.
	 * @param $name
	 * @param $phone
	 * @param Product $product
	 * @param $count
	 */
	public function __construct($name, $phone, Product $product, $count) {
		$this->name    = $name;
		$this->phone   = $phone;
		$this->product = $product;
		$this->count   = $count;
	}
	
	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {
		return $this->view(
			'pages.mail_templates.order-product',
			[
				'name'    => $this->name,
				'phone'   => $this->phone,
				'product' => $this->product->title,
				'count'   => $this->count
			]
		);
	}
}
