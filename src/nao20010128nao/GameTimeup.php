<?php

namespace nao20010128nao;

use pocketmine\scheduler\Task;
use pocketmine\block\Block;

class GameTimeup extends Task{
	private $plugin;
	function __construct($p){
		$this->plugin=$p;
	}
	public function onRun($tick){
		$serv=\pocketmine\Server::getInstance();
		$plg=$this->plugin;
		
	}
}
