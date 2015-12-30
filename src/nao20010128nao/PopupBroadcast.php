<?php

namespace nao20010128nao;

use pocketmine\scheduler\Task;
use pocketmine\block\Block;

class PopupBroadcast extends Task{
	private $l2;
	public $dst;
	function __construct($line2,$dest=null){
		$this->l2=$line2;
		$this->dst=$dest;
	}
	public function onRun($tick){
		\pocketmine\Server::getInstance()->broadcastPopup($this->l2,$this>dst);
	}
	public function disable(){
		$this->dst=array();
	}
	public function sendEveryone(){
		$this->dst=null;
	}
}
