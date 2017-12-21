<?php
/**
 * Class Controller_Main
 */
class   Controller_Main extends Controller  {
	function    __construct()  {
		$this->model = new Model_Main();
		$this->view = new View();
	}
	
	function    action_index()  {
		$data = $this->model->get_data();		
		$this->view->generate('main_view.php', 'template_view.php', $data);
	}

	function    action_rated()  {
		$data = $this->model->get_dataRate();
		$this->view->generate('main_view.php', 'template_view.php', $data);
	}

	function    action_search() {
		$data = $this->model->get_dataSearch();
		$this->view->generate('main_view.php', 'template_view.php', $data);
	}
}

// 2 do: start session, check cookies, sql db connection, check if user logged, check user actions, etc (here or in model file?)


// В метод generate экземпляра класса View передаются имена файлов общего шаблона и вида c контентом страницы.
// Помимо индексного действия в контроллере конечно же могут содержаться и другие действия.