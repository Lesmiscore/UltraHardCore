<?php

namespace nao20010128nao;

use pocketmine\scheduler\Task;
use pocketmine\block\Block;

class PopupBroadcast extends Task{
	private $l2;
	function __construct($line2){
		$this->l2=$line2;
	}
	public function onRun($tick){
		\pocketmine\Server::getInstance()->broadcastPopup($this->l2);
	}
}
