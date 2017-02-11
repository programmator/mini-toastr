<?php
namespace SeoMax\MiniToastr;

use function GuzzleHttp\json_encode;

class MiniToastr
{
	protected $app;

	protected $messages = [];

	public function __construct($app)
	{
		$this->app = $app;
	}

	/**
	 * Add a message
	 *
	 * @param $type
	 * @param $message
	 * @param null $title
	 * @param array $config
	 */
	protected function add($type, $message, $title = null, array $config = [])
	{
		$this->messages[] = compact('type', 'message', 'title', 'config');

		$this->app->session->flash('mini-toastr::messages', $this->messages);
	}

	/**
	 * Add a success message
	 *
	 * @param $message
	 * @param null $title
	 * @param array $config
	 */
	public function success($message, $title = null, array $config = [])
	{
		$this->add('success', $message, $title, $config);
	}

	/**
	 * Add a info message
	 *
	 * @param $message
	 * @param null $title
	 * @param array $config
	 */
	public function info($message, $title = null, array $config = [])
	{
		$this->add('info', $message, $title, $config);
	}

	/**
	 * Add a warn message
	 *
	 * @param $message
	 * @param null $title
	 * @param array $config
	 */
	public function warn($message, $title = null, array $config = [])
	{
		$this->add('warn', $message, $title, $config);
	}

	/**
	 * Add a error message
	 *
	 * @param $message
	 * @param null $title
	 * @param array $config
	 */
	public function error($message, $title = null, array $config = [])
	{
		$this->add('error', $message, $title, $config);
	}

	/**
	 * @param array $config
	 *
	 * @return bool|string
	 */
	public function render(array $config = [])
	{
		$messages = $this->app->session->get('mini-toastr::messages', []);

		if (empty($messages)) return false;

		return '
<script>
	miniToastr.init('.json_encode($config).');

	var miniToastrMessages = '.json_encode($messages).';
	
	for (var id in miniToastrMessages)
		if (miniToastrMessages.hasOwnProperty(id)) {
			var message = miniToastrMessages[id];
			
			miniToastr[message.type](message.message, message.title);
		}
</script>
		';
	}

	/**
	 *
	 */
	public function flush()
	{
		$this->messages = [];
	}
}