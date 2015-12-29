<?php

namespace nao20010128nao;

use pocketmine\scheduler\Task;
use pocketmine\block\Block;

class TickClock extends Task{
	private $times,$plugin;
	function __construct($tim,$plugin){
		$this->times=$tim;
		$this->plugin=$plugin;
	}
	public function onRun($tick){
		$now=$this->times;
		$this->times--;
		$minutes=floor($now/60);
		$seconds=      $now%60 ;
		\pocketmine\Server::getInstance()->broadcastTip($minutes.":".($seconds<10?"0":"").$seconds);
		if($now==0){
			$this->plugin->onTimeup();
		}
	}
}
