<?php

class Controller {
	
	// i don't like public. What's the point, exactly? Can we do it other way?
	public $model;
	public $view;
	
	function __construct()
	{
		$this->view = new View();
	}
	
	function action_index()
	{

	}
}

// Метод action_index — это действие, вызываемое по умолчанию, его мы перекроем при реализации классов потомков.