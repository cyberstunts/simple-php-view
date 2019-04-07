<?php

class view_library
{

	// Declare class variables
	private $viewFilesFolder = '';
	private $viewFile = '';
	private $variables = array();
	private $returnHTML = false;

	/**
	 * View constructor.
	 *
	 */
	public function __construct()
	{

		// Make sure slash is set correctly
		$this->viewFilesFolder = __DIR__ . '/../views' . DIRECTORY_SEPARATOR;

	}

	/**
	 * Parse view file and return HTML as output or as a string
	 *
	 * @param string $file
	 * @param array $variables
	 * @param bool $returnHTML
	 * @return mixed|string
	 */
	public function process($file = '', $variables = array(), $returnHTML = false)
	{

		// Location of the current view required
		$this->viewFile = $this->viewFilesFolder . $file . '.php';

		// Assign variables to be available within this class
		$this->variables = $variables;
		$this->returnHTML = $returnHTML;

		$html = 'Incorrect view file.';

		// If view filename is set, generate HTML
		if ($this->viewFile != '') {

			// Create variables from the array
			foreach ($this->variables as $variableName => $variableValue) {
				$$variableName = $variableValue;
			}

			// 1. If requires return, use buffer to catch parsed HTML
			if ($this->returnHTML == true) {
				// Start capturing buffered output
				@ob_start();
			}

			// 2. Evaluate HTML file as PHP by injecting the variables created from the array
			eval('?>' . preg_replace('/;*\s*\?>/', '; ?>', str_replace('<?=', '<?php echo ', file_get_contents($this->viewFile))));

			// 3. Used only when required to return HTML
			if ($this->returnHTML == true) {
				// Assign buffer to a string
				$html = ob_get_contents();

				// Clear the buffer to prevent returning it
				ob_end_clean();

				return $html;
			} else{
				return null;
			}

		}

		// Either echo or return as string
		if ($this->returnHTML == true) {
			return $html;
		} else {
			echo $html;
		}
	}

}
