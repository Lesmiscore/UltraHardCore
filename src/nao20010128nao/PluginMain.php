<?php

namespace nao20010128nao;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;

class PluginMain extends PluginBase implements Listener
{
	public function onEnable(){
		@mkdir($this->getDataFolder());
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	public function onDisable(){
	}
}