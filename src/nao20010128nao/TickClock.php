<?php

namespace nao20010128nao;

use pocketmine\scheduler\Task;
use pocketmine\block\Block;

class TickClock extends Task{
	private $times,$plugin,$l2;
	function __construct($tim,$plugin,$line2=null){
		$this->times=$tim;
		$this->plugin=$plugin;
		$this->l2=$line2;
	}
	public function onRun($tick){
		$now=$this->times;
		$this->times--;
		$minutes=floor($now/60);
		$seconds=      $now%60 ;
		\pocketmine\Server::getInstance()->broadcastTip($minutes.":".($seconds<10?"0":"").$seconds);
		if(null!=$this->l2)
			\pocketmine\Server::getInstance()->broadcastPopup($this->l2);
		if($now==0){
			$this->plugin->onTimeup();
		}
	}
}
