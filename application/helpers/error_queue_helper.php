<?php

class Error_Queue {
	private $queue = null;

	public function __construct()
	{
		$this->queue = array();
	}

	public function enqueue($parameter, $msg)
	{
		$this->queue[] = array('parameter' => $parameter, 'msg' => $msg);
	}

	public function length()
	{
		return count($this->queue);
	}

	public function get_queue()
	{
		return $this->queue;
	}

	public function clear()
	{
		$this->queue = array();
	}
}