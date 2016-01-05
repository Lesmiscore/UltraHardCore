<?php

namespace nao20010128nao;

use pocketmine\Player;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;

use pocketmine\level\Position;

use pocketmine\command\ConsoleCommandSender;

use pocketmine\item\Item;
use pocketmine\entity\Effect;

use pocketmine\event\player\PlayerJoinEvent as pjoin;
use pocketmine\event\player\PlayerQuitEvent as pquit;
use pocketmine\event\player\PlayerDeathEvent as pdied;
use pocketmine\event\player\PlayerItemConsumeEvent as pic;
use pocketmine\event\entity\EntityDamageEvent as ed;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;

class UHC extends PluginBase implements Listener
{
	public static $instance;
	
	private $ingame,$out,$phase;
	private $system,$console;
	
	private $wfp,$ph2,$ph1,$gameover,$shrinkBorder;
	private $lev,$levName;
	private $borderXZ;
	public function onEnable(){
		error_reporting(0);
		@mkdir($this->getDataFolder());
		self::$instance=$this;
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->console=new ConsoleCommandSender();
		\nao20010128nao\block\Block::pollute();
		
		$this->ph1=new PopupBroadcast("The game is running...\nPhase 1 - Collect Anything!");
		$this->ph2=new PopupBroadcast("The game is running...\nPhase 2 - Live or Die!");
		$this->gameover=new PopupBroadcast("GAME OVER");
		$this->wfp=new PopupBroadcast("Waiting for players...");
		$this->shrinkBorder=new ShrinkBorder($this);
		
		$this->phase=0;
		
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
				$this->getServer()->getScheduler()->scheduleRepeatingTask($this->wfp,10,10*60*2);
				//$this->getServer()->getScheduler()->scheduleDelayedTask(new GameStart($this));
				$this->phase=1;
				break;
			case 1://Starting the game
				$this->phase=2;
				$this->start();
				break;
			case 2://PvP Mode
				$this->ph2->dst=$this->ingame;
				$this->getServer()->getScheduler()->scheduleRepeatingTask(new TickClock(10*60/*sec.*/,$this),20,20*60);
				$this->getServer()->getScheduler()->scheduleRepeatingTask($this->ph2,10,20*60*2);
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
		$this->borderXZ=30*60+10;
		$this->getServer()->generateLevel($levName=$this->levName=$this->randomName());
		$lev=$this->lev=$this->getServer()->getLevelByName($levName);
		$this->getServer()->broadcastMessage("Fine. Let's start!");
		foreach($this->ingame as $ply){
			$pos=new Position(mt_rand(-600,600),128,mt_rand(-600,600),$levName);
			$ply->teleport($pos);
			$ply->setGamemode(0);
			$ply->setHealth(20);
			$this->getLogger()->info($ply->getName());
		}
		$this->getServer()->getScheduler()->scheduleRepeatingTask(new TickClock(10*60/*sec.*/,$this),20,10*60);
		$this->ph1->dst=$this->ingame;
		$this->getServer()->getScheduler()->scheduleRepeatingTask($this->ph1,10,10*60*2);
		$this->getServer()->getScheduler()->scheduleRepeatingTask($this->gameover,10,30*60*2);
		$this->getServer()->getScheduler()->scheduleRepeatingTask($this->shrinkBorder,10,10*60*2);
	}
	public function gameEnd(){
		$this->lev->unload();
		$this->delTree("level/".$this->levName);
		$players=$this->getServer()->getOnlinePlayers();
		foreach($players as $player){
			$player->teleport($this->getServer()->getDefaultSpawn());
			$player->setGamemode(3);
		}
		$this->getServer()->broadcastMessage("Game ended!");
		$this->ingame=$this->out=null;
		
		$this->ph2->disable();
		$this->ph1->disable();
		$this->gameover->disable();
		$this->wfp->sendEveryone();
	}
	public function randName(){
		return base64_encode(@Utils::getRandomBytes(48, false));
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
		$p->setHealth(20);
		if($wasInGame){
			$p->kill();
			$p->sendMessage("GAME OVER!");
		}
		
		$this->gameover->dst=$this->out;
		$this->ph1->dst=$this->ph2->dst=$this->ingame;
	}
	public function checkBorder($player){
		$level = $this->getServer()->getLevelByName($player["level"]);
		if($this->levName!=$player["level"]){
			return false;
		}
		$t = new Vector2($player["x"], $player["z"]);
		$s = new Vector2($this->borderXZ, $this->borderXZ);
		$worlds = [$this->getServer()->getDefaultSpawn()->getLevel()->getName()];
		foreach($worlds as $key => $value){
			if(!empty($value[$player["level"]])){
				$r = $value[$player["level"]];
			}
		}
		if($t->distance($s) >= $r){
			return true;
		}else{
			return false;
		}
	}
	public function delTree($dir) {
		$files=array_diff(scandir($dir), array('.','..'));
		foreach ($files as $file) {
			(is_dir("$dir/$file") && !is_link($dir)) ?delTree("$dir/$file") :unlink("$dir/$file");
		}
		return rmdir($dir);
	}
	
	  ////////////
	 // EVENTS //
	////////////
	public function onPlayerJoin(pjoin $ev){
		$player=$ev->getPlayer();
		switch($this->phase){
			case 1:
				$player->teleport($player->getSpawn());
				$player->setGamemode(3);
				break;
			case 2:
			case 3:
			case 0:
				$this->gameOver($player);
				break;
		}
	}
	public function onPlayerQuit(pquit $ev){
		$p=$ev->getPlayer();
		switch($this->phase){
			case 1:
				break;
			case 2:
			case 3:
			case 0:
				$this->gameOver($player);
				break;
		}
	}
	public function onPlayerDeath(pdied $ev){
		$p=$ev->getEntity();
		switch($this->phase){
			case 1:
				break;
			case 2:
			case 3:
			case 0:
				$this->gameOver($p);
				break;
		}
	}
	
	public function onPlayerMove(PlayerMoveEvent $event){
		$player = $event->getPlayer();
		if($player instanceof Player){
			$border = $this->checkBorder(array("level" => $player->getLevel()->getName(), "x" => round($player->getX()), "z" => round($player->getZ())));
			if($border){
				$event->setCancelled(true);
				$player->sendMessage("Don't go out of the border!");
			}
		}
	}

	public function onBlockPlace(BlockPlaceEvent $event){
		$block = $event->getBlock();
		if($block instanceof Block){
			$border = $this->checkBorder(array("level" => $block->getLevel()->getName(), "x" => round($block->getX()), "z" => round($block->getZ())));
			if($border){
				$event->setCancelled(true);
				$player->sendMessage("Don't place blocks out of the border!");
			}
		}
	}

	public function onBlockBreak(BlockBreakEvent $event){
		$block = $event->getBlock();
		if($block instanceof Block){
			$border = $this->checkBorder(array("level" => $block->getLevel()->getName(), "x" => round($block->getX()), "z" => round($block->getZ())));
			if($border){
				$event->setCancelled(true);
				$player->sendMessage("Don't break blocks out of the border!");
			}
		}
	}
	public function onBlockBreak2(BlockBreakEvent $event){
		$player = $event->getPlayer();
		if($player->getGamemode()==3){
			$event->setCancelled();
		}
	}
	public function onEntityDamaged(ed $ev){
		$p=$ev->getEntity();
		if(!($p instanceof Player)){
			return;
		}
		switch($this->phase){
			case 0://Waiting in the lobby
			case 1://Starting the game
				$ev->setCancelled();
				break;
			case 2:
			case 3:
				break;
		}
	}
	public function onPlayerEat(pic $ev){
		$p=$ev->getPlayer();
		$i=$ev->getItem();
		switch($this->phase){
			case 0://Waiting in the lobby
			case 1://Starting the game
				$ev->setCancelled();
				break;
			case 2:
			case 3:
				if($i->getId()==Item::GOLDEN_APPLE){
					$p->addEffect(Effect::getEffect(6)->setAmplifier(1)->setDuration(4));
				}
				break;
		}
	}
}