<?php

namespace nao20010128nao;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;

use pocketmine\level\Position;

use pocketmine\command\ConsoleCommandSender;

use pocketmine\event\player\PlayerJoinEvent as pjoin;
use pocketmine\event\player\PlayerQuitEvent as pquit;

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
	
	  //////////
	 // MISC //
	//////////
	public function onTimeup(){
		switch($this->phase){
			case 0://Waiting in the lobby
				$this->getServer()->getScheduler()->scheduleRepeatingTask(new TickClock(10*60/*sec.*/,$this),20,10*60);
				$this->getServer()->getScheduler()->scheduleRepeatingTask(new PopupBroadcast("Waiting for players..."),10,10*60*2);
				//$this->getServer()->getScheduler()->scheduleDelayedTask(new GameStart($this));
				$this->phase=1;
				break;
			case 1://Starting the game
				$this->phase=2;
				$this->start();
				break;
			case 2://PvP Mode
				$this->getServer()->getScheduler()->scheduleRepeatingTask(new TickClock(10*60/*sec.*/,$this),20,20*60);
				$this->getServer()->getScheduler()->scheduleRepeatingTask(new PopupBroadcast("The game is running...\nPhase 2 - Live or Die!"),10,20*60*2);
				$this->phase=3;
				break;
			case 3://End of the game
				$this->gameEnd();
				$this->phase=0;
				break;
		}
	}
	public function start(){
		$this->getServer()->broadcastMessage("Time up!");
		$players=$this->getServer()->getOnlinePlayers();
		if(count($players)<8){
			$this->phase=0;
			$this->onTimeup();
			$this->getServer()->broadcastMessage("Players are not enough...");
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
		$this->out=array();
		$this->getServer()->generateLevel($levName=$this->levName=$this->randomName());
		$lev=$this->lev=$this->getServer()->getLevelByName($levName);
		$this->getServer()->broadcastMessage("Fine. Let's start!");
		foreach($this->ingame as $ply){
			$pos=new Position(mt_rand(-600,600),128,mt_rand(-600,600),$levName);
			while(true){
				$b=$lev->getBlock($pos);
				if($b->getId()==0){
					$pos->x--;
					continue;
				}else{
					$pos->x++;
					break;
				}
			}
			$ply->teleport($pos);
			$ply->setGamemode(0);
			$this->getLogger()->info($ply->getName());
		}
		$this->getServer()->getScheduler()->scheduleRepeatingTask(new TickClock(10*60/*sec.*/,$this),20,10*60);
		$this->getServer()->getScheduler()->scheduleRepeatingTask(new PopupBroadcast("The game is running...\nPhase 1 - Collect Anything!",$this->ingame),10,10*60*2);
		$this->getServer()->getScheduler()->scheduleRepeatingTask(new PopupBroadcast("GAME OVER",$this->out),10,30*60*2);
	}
	public function gameEnd(){
		$this->lev->unload();
		$players=$this->getServer()->getOnlinePlayers();
		foreach($players as $player){
			$player->teleport($this->getServer()->getDefaultSpawn());
			$player->setGamemode(3);
		}
		$this->getServer()->broadcastMessage("Game ended!");
		$this->ingame=$this->out=null;
	}
	public function randName(){
		return /*substr(*/base64_encode(@Utils::getRandomBytes(48, false))/*, 3, 10)*/;
	}
	public function gameOver($p){
		$wasInGame=false;
		if(in_array($p,$this->out)){
			return;
		}
		if(in_array($p,$this->ingame)){
			unset($this->ingame[in_array($p,$this->ingame)]);
			$wasInGame=true;
		}
		$this->out[]=$p;
		$p->setGamemode(3);
		if($wasInGame){
			$p->kill();
			$p->sendMessage("GAME OVER!");
		}
	}
	
	
	  ////////////
	 // EVENTS //
	////////////
	public funtion onPlayerJoin(pjoin $ev){
		$player=$ev->getPlayer();
		switch($this->phase){
			case 0://Waiting in the lobby
				$player->teleport($this->getServer()->getDefaultSpawn());
				$player->setGamemode(3);
				break;
			case 1://Starting the game
			case 2:
			case 3:
				$this->gameOver($player);
				break;
		}
	}
	public function onPlayerQuit(pquit $ev){
		$p=$ev->getPlayer();
		if(in_array($p,$this->out)){
			unset($this->out[in_array($p,$this->out)]);
		}
		if(in_array($p,$this->ingame)){
			unset($this->ingame[in_array($p,$this->ingame)]);
			$this->gameOver($p);
		}
	}
}
