<?php

if (! function_exists('toastr'))
{
	/**
	 * Get the mini-toastr instance.
	 *
	 * @return \SeoMax\MiniToastr\MiniToastr
	 */
	function toastr()
	{
		return app('mini-toastr');
	}
}