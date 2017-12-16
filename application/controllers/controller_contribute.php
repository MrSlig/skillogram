<?php

class Controller_Contribute extends Controller
{
	
	function action_index()
	{
		$this->view->generate('contribute_view.php', 'template_view.php');
	}
}