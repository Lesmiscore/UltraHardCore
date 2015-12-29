<?php

namespace nao20010128nao;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;

class UHC extends PluginBase implements Listener
{
	public function onEnable(){
		@mkdir($this->getDataFolder());
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getServer()->getScheduler()->scheduleRepeatingTask(new TickClock(100),100,20);
	}
	public function onDisable(){
	}
}
