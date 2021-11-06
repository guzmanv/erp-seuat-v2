<?php

	class Plantel extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function Plantel()
		{
			$data['page_id'] = 4;
			$data['page_tag'] = "Planteles";
			$data['page_title'] = "Lista de planteles <small>SEUAT</small>";
			$data['page_name'] = "plantel";
			$data['page_content'] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum molestie metus vitae porta dapibus. Nulla vehicula erat viverra elit bibendum, in hendrerit eros faucibus. Nunc metus libero, ornare et ultricies eget, bibendum vitae risus. Nullam facilisis ipsum eu ipsum interdum, id porttitor augue tempus.";
			$this->views->getView($this,"plantel",$data);
		}
	}
?>