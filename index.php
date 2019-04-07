<?php

// Get views class that generates html
require_once 'libraries/view_library.php';

/**
 * Your own class
 *
 * Class testPage
 */
class indexPage {

	private $view;

	/**
	 * Test page constructor. Initialise variables before when instance created.
	 */
	public function __construct()
	{
		// Use this if project is in subdirectory e.g. 'http://localhost/simple-php-view'
	   $localhostPath = '../views';
	   $this->view = new view_library($localhostPath);

		// Use this if the project has it's own domain e.g. 'http://localhost' and not in subdirectory
		// $this->view = new view();
	}

	/**
	 * Generate HTML with a view template and returns as string
	 */
	public function getView1HTML()
	{

		// Just separate variables from function properties for maintenance
		$variables = array(
			'greeting'=>'Hello',
			'projectName'=>'Simple PHP view'
		);

		// Generate HTML
		$html = $this->view->process('test_view', $variables, true);

		return $html; // Or you can use 'return $html' to further generate HTML;

	}

	/**
	 * Generate HTML with a view template and returns as string
	 */
	public function getView2HTML()
	{

		// Just separate variables from function properties for maintenance
		$variables = array(
			'firstVariable' => array('one'=>1, 'two'=>2),
			'secondVariable' => 123
		);

		// Generate HTML
		$html = $this->view->process('test_view_2', $variables, true);

		return $html; // Or you can use 'return $html' to further generate HTML;

	}

	public function indexPage($view1 = '', $view2 = '')
	{
		$this->view->process('index_page_view', array('view1'=>$view1, 'view2'=>$view2));
	}

}

/**
 *
 *
 * All the magic combined.
 * Usage of current class with 'view_library' printing main page, which is fed strings of HTML generated
 *
 *
 */

// Initialise this class to work with
$testPage = new indexPage();

// Print the contents of the template
$viewString1 = $testPage->getView1HTML();	// Requires echo, because the HTML is returned
$viewString2 = $testPage->getView2HTML();	// Requires echo, because the HTML is returned

// Doesn't require echo, and prints the combined HTML
$testPage->indexPage($viewString1, $viewString2);
