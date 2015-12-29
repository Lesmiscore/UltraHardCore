<?php

namespace nao20010128nao;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;

use pocketmine\level\Position;

class UHC extends PluginBase implements Listener
{
	private $ingame,$out,$phase;
	private $system;
	public function onEnable(){
		@mkdir($this->getDataFolder());
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->phase=0;
		if(file_exists($this->getDataFolder()."/system.json")){
			$this->system=json_decode(file_get_contents($this->getDataFolder()."/system.json"));
		}else{
			$this->system=$sys=array();
			$sys["lobby"]=array("level"=>"world","x"=>0,"y"=>0,"z"=>0);
			file_put_contents(json_encode($sys),$this->getDataFolder()."/system.json");
		}
		
		$this->onTimeup();
	}
	public function onDisable(){
		
	}
	public function onTimeup(){
		switch($this->phase){
			case 0://Waiting in the lobby
				$this->getServer()->getScheduler()->scheduleRepeatingTask(new TickClock(30*60,$this),30*60,20);
				//$this->getServer()->getScheduler()->scheduleDelayedTask(new GameStart($this));
				$this->phase=1;
				break;
			case 1://Starting the game
				$this->start();
				$this->phase=2;
				break;
		}
	}
	public function start(){
		$players=$this->getServer()->getOnlinePlayers();
		if(count($players)<8){
			$phase=0;
			$this->onTimeup();
			return;
		}
		array_shuffle($players);
		array_shuffle($players);
		if(count($players)<24){
			$this->ingame=$players;
		}else{
			$this->ingame=$ing=array();
			for($i=0;$i<24;$i++){
				$ing[i]=$players[i];
			}
		}
		foreach($this->ingame as $le){
			//$le->teleport();
			$this->getLogger()->info($le->getName());
		}
	}
}
