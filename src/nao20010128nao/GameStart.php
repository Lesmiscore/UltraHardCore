<?php

namespace nao20010128nao;

use pocketmine\scheduler\Task;
use pocketmine\block\Block;

class GameStart extends Task{
	private $plg;
	function __construct($tim){
		$this->plg=$tim;
	}
	public function onRun($tick){
		$plugin=$this->plg;
		$serv=$plugin->getServer();
		$plugin->start();
	}
}
