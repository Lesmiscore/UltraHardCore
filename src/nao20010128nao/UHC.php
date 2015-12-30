<?php

namespace nao20010128nao;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;

use pocketmine\level\Position;

use pocketmine\command\ConsoleCommandSender;

class UHC extends PluginBase implements Listener
{
	private $ingame,$out,$phase;
	private $system,$console;
	
	
	private $lev,$levName;
	public function onEnable(){
		@mkdir($this->getDataFolder());
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->console=new ConsoleCommandSender();
		$this->phase=0;
		/*if(file_exists($this->getDataFolder()."/system.json")){
			$this->system=json_decode(file_get_contents($this->getDataFolder()."/system.json"));
		}else{
			$this->system=$sys=array();
			$sys["lobby"]=array("level"=>"world","x"=>0,"y"=>0,"z"=>0);
			file_put_contents(json_encode($sys),$this->getDataFolder()."/system.json");
		}*/
		
		$this->onTimeup();
	}
	public function onDisable(){
		
	}
	public function onTimeup(){
		switch($this->phase){
			case 0://Waiting in the lobby
				$this->getServer()->getScheduler()->scheduleRepeatingTask(new TickClock(10*60/*sec.*/,$this,"Waiting for players..."),20,10*60);
				//$this->getServer()->getScheduler()->scheduleDelayedTask(new GameStart($this));
				$this->phase=1;
				break;
			case 1://Starting the game
				$this->phase=2;
				$this->start();
				break;
			case 2:
				break;
		}
	}
	public function start(){
		$players=$this->getServer()->getOnlinePlayers();
		if(count($players)<8){
			$this->phase=0;
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
		$this->getServer()->generateLevel($levName=$this->levName=$this->randomName());
		$lev=$this->lev=$this->getServer()->getLevelByName($levName);
		foreach($this->ingame as $ply){
			$pos=new Position();
			$ply->teleport($pos);
			$this->getLogger()->info($ply->getName());
		}
	}
	public function randName(){
		
	}
}
