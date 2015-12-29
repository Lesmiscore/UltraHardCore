<?php

namespace nao20010128nao;

use pocketmine\scheduler\Task;
use pocketmine\block\Block;

class TickClock extends Task{
	private $times;
	function __construct($tim){
		$this->times=$tim;
	}
	public function onRun($tick){
		$now=$this->times;
		$this->times--;
		$minutes=floor($now/60);
		$seconds=      $now%60 ;
		\pocketmine\Server::getInstance()->broadcastTip($minutes.":".$seconds);
	}
}
