<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____  
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \ 
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/ 
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_| 
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 * 
 *
*/

/**
 * All Block classes are in here
 */
namespace nao20010128nao\block;

use pocketmine\entity\Entity;


use pocketmine\item\Item;
use pocketmine\item\Tool;
use pocketmine\level\Level;
use pocketmine\level\MovingObjectPosition;
use pocketmine\level\Position;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Vector3;
use pocketmine\metadata\Metadatable;
use pocketmine\metadata\MetadataValue;
use pocketmine\Player;
use pocketmine\plugin\Plugin;


class Block extends \pocketmine\block\Block{
	const AIR = 0;
	const STONE = 1;
	const GRASS = 2;
	const DIRT = 3;
	const COBBLESTONE = 4;
	const COBBLE = 4;
	const PLANK = 5;
	const PLANKS = 5;
	const WOODEN_PLANK = 5;
	const WOODEN_PLANKS = 5;
	const SAPLING = 6;
	const SAPLINGS = 6;
	const BEDROCK = 7;
	const WATER = 8;
	const STILL_WATER = 9;
	const LAVA = 10;
	const STILL_LAVA = 11;
	const SAND = 12;
	const GRAVEL = 13;
	const GOLD_ORE = 14;
	const IRON_ORE = 15;
	const COAL_ORE = 16;
	const WOOD = 17;
	const TRUNK = 17;
	const LOG = 17;
	const LEAVES = 18;
	const LEAVE = 18;
	const SPONGE = 19;
	const GLASS = 20;
	const LAPIS_ORE = 21;
	const LAPIS_BLOCK = 22;

	const SANDSTONE = 24;

	const BED_BLOCK = 26;


	const COBWEB = 30;
	const TALL_GRASS = 31;
	const BUSH = 32;
	const DEAD_BUSH = 32;
	const WOOL = 35;
	const DANDELION = 37;
	const ROSE = 38;
	const POPPY = 38;
	const RED_FLOWER = 38;
	const BROWN_MUSHROOM = 39;
	const RED_MUSHROOM = 40;
	const GOLD_BLOCK = 41;
	const IRON_BLOCK = 42;
	const DOUBLE_SLAB = 43;
	const DOUBLE_SLABS = 43;
	const SLAB = 44;
	const SLABS = 44;
	const BRICKS = 45;
	const BRICKS_BLOCK = 45;
	const TNT = 46;
	const BOOKSHELF = 47;
	const MOSS_STONE = 48;
	const MOSSY_STONE = 48;
	const OBSIDIAN = 49;
	const TORCH = 50;
	const FIRE = 51;
	const MONSTER_SPAWNER = 52;
	const WOOD_STAIRS = 53;
	const WOODEN_STAIRS = 53;
	const OAK_WOOD_STAIRS = 53;
	const OAK_WOODEN_STAIRS = 53;
	const CHEST = 54;

	const DIAMOND_ORE = 56;
	const DIAMOND_BLOCK = 57;
	const CRAFTING_TABLE = 58;
	const WORKBENCH = 58;
	const WHEAT_BLOCK = 59;
	const FARMLAND = 60;
	const FURNACE = 61;
	const BURNING_FURNACE = 62;
	const LIT_FURNACE = 62;
	const SIGN_POST = 63;
	const DOOR_BLOCK = 64;
	const WOODEN_DOOR_BLOCK = 64;
	const WOOD_DOOR_BLOCK = 64;
	const LADDER = 65;

	const COBBLE_STAIRS = 67;
	const COBBLESTONE_STAIRS = 67;
	const WALL_SIGN = 68;

	const IRON_DOOR_BLOCK = 71;

	const REDSTONE_ORE = 73;
	const GLOWING_REDSTONE_ORE = 74;
	const LIT_REDSTONE_ORE = 74;

	const SNOW = 78;
	const SNOW_LAYER = 78;
	const ICE = 79;
	const SNOW_BLOCK = 80;
	const CACTUS = 81;
	const CLAY_BLOCK = 82;
	const REEDS = 83;
	const SUGARCANE_BLOCK = 83;

	const FENCE = 85;
	const PUMPKIN = 86;
	const NETHERRACK = 87;
	const SOUL_SAND = 88;
	const GLOWSTONE = 89;
	const GLOWSTONE_BLOCK = 89;


	const LIT_PUMPKIN = 91;
	const JACK_O_LANTERN = 91;
	const CAKE_BLOCK = 92;

	const TRAPDOOR = 96;
	const WOODEN_TRAPDOOR = 96;
	const WOOD_TRAPDOOR = 96;

	const STONE_BRICKS = 98;
	const STONE_BRICK = 98;

	const IRON_BAR = 101;
	const IRON_BARS = 101;
	const GLASS_PANE = 102;
	const GLASS_PANEL = 102;
	const MELON_BLOCK = 103;
	const PUMPKIN_STEM = 104;
	const MELON_STEM = 105;
	const VINE = 106;
	const VINES = 106;
	const FENCE_GATE = 107;
	const BRICK_STAIRS = 108;
	const STONE_BRICK_STAIRS = 109;
	const MYCELIUM = 110;
	const WATER_LILY = 111;
	const LILY_PAD = 111;
	const NETHER_BRICKS = 112;
	const NETHER_BRICK_BLOCK = 112;
	const NETHER_BRICK_FENCE = 113;
	const NETHER_BRICKS_STAIRS = 114;

	const ENCHANTING_TABLE = 116;
	const ENCHANT_TABLE = 116;
	const ENCHANTMENT_TABLE = 116;
	const BREWING_STAND = 117;
	const END_PORTAL_FRAME = 120;
	const END_STONE = 121;

	const SANDSTONE_STAIRS = 128;
	const EMERALD_ORE = 129;

	const EMERALD_BLOCK = 133;
	const SPRUCE_WOOD_STAIRS = 134;
	const SPRUCE_WOODEN_STAIRS = 134;
	const BIRCH_WOOD_STAIRS = 135;
	const BIRCH_WOODEN_STAIRS = 135;
	const JUNGLE_WOOD_STAIRS = 136;
	const JUNGLE_WOODEN_STAIRS = 136;

	const COBBLE_WALL = 139;
	const STONE_WALL = 139;
	const COBBLESTONE_WALL = 139;
	const FLOWER_POT_BLOCK = 140;
	const CARROT_BLOCK = 141;
	const POTATO_BLOCK = 142;

	const ANVIL = 145;
	const TRAPPED_CHEST = 146;

	const REDSTONE_BLOCK = 152;

	const QUARTZ_BLOCK = 155;
	const QUARTZ_STAIRS = 156;
	const DOUBLE_WOOD_SLAB = 157;
	const DOUBLE_WOODEN_SLAB = 157;
	const DOUBLE_WOOD_SLABS = 157;
	const DOUBLE_WOODEN_SLABS = 157;
	const WOOD_SLAB = 158;
	const WOODEN_SLAB = 158;
	const WOOD_SLABS = 158;
	const WOODEN_SLABS = 158;
	const STAINED_CLAY = 159;
	const STAINED_HARDENED_CLAY = 159;

	const LEAVES2 = 161;
	const LEAVE2 = 161;
	const WOOD2 = 162;
	const TRUNK2 = 162;
	const LOG2 = 162;
	const ACACIA_WOOD_STAIRS = 163;
	const ACACIA_WOODEN_STAIRS = 163;
	const DARK_OAK_WOOD_STAIRS = 164;
	const DARK_OAK_WOODEN_STAIRS = 164;

	const IRON_TRAPDOOR = 167;
	const HAY_BALE = 170;
	const CARPET = 171;
	const HARDENED_CLAY = 172;
	const COAL_BLOCK = 173;
	const PACKED_ICE = 174;
	const DOUBLE_PLANT = 175;

	const FENCE_GATE_SPRUCE = 183;
	const FENCE_GATE_BIRCH = 184;
	const FENCE_GATE_JUNGLE = 185;
	const FENCE_GATE_DARK_OAK = 186;
	const FENCE_GATE_ACACIA = 187;

	const GRASS_PATH = 198;

	const PODZOL = 243;
	const BEETROOT_BLOCK = 244;
	const STONECUTTER = 245;
	const GLOWING_OBSIDIAN = 246;

	/** @var \SplFixedArray */
	public static $list = null;
	/** @var \SplFixedArray */
	public static $fullList = null;

	/** @var \SplFixedArray */
	public static $light = null;
	/** @var \SplFixedArray */
	public static $lightFilter = null;
	/** @var \SplFixedArray */
	public static $solid = null;
	/** @var \SplFixedArray */
	public static $hardness = null;
	/** @var \SplFixedArray */
	public static $transparent = null;

	/**
	 * Backwards-compatibility with old way to define block properties
	 *
	 * @deprecated
	 *
	 * @param string $key
	 *
	 * @return mixed
	 */
	public function __get($key){
		static $map = [
			"hardness" => "getHardness",
			"lightLevel" => "getLightLevel",
			"frictionFactor" => "getFrictionFactor",
			"name" => "getName",
			"isPlaceable" => "canBePlaced",
			"isReplaceable" => "canBeReplaced",
			"isTransparent" => "isTransparent",
			"isSolid" => "isSolid",
			"isFlowable" => "canBeFlowedInto",
			"isActivable" => "canBeActivated",
			"hasEntityCollision" => "hasEntityCollision"
		];
		return isset($map[$key]) ? $this->{$map[$key]}() : null;
	}

	public static function init(){
		if(parent::$list === null){
			parent::$list = new \SplFixedArray(256);
			parent::$fullList = new \SplFixedArray(4096);
			parent::$light = new \SplFixedArray(256);
			parent::$lightFilter = new \SplFixedArray(256);
			parent::$solid = new \SplFixedArray(256);
			parent::$hardness = new \SplFixedArray(256);
			parent::$transparent = new \SplFixedArray(256);
			parent::$list[self::AIR] = Air::class;
			parent::$list[self::STONE] = Stone::class;
			parent::$list[self::GRASS] = Grass::class;
			parent::$list[self::DIRT] = Dirt::class;
			parent::$list[self::COBBLESTONE] = Cobblestone::class;
			parent::$list[self::PLANKS] = Planks::class;
			parent::$list[self::SAPLING] = Sapling::class;
			parent::$list[self::BEDROCK] = Bedrock::class;
			parent::$list[self::WATER] = Water::class;
			parent::$list[self::STILL_WATER] = StillWater::class;
			parent::$list[self::LAVA] = Lava::class;
			parent::$list[self::STILL_LAVA] = StillLava::class;
			parent::$list[self::SAND] = Sand::class;
			parent::$list[self::GRAVEL] = Gravel::class;
			parent::$list[self::GOLD_ORE] = GoldOre::class;
			parent::$list[self::IRON_ORE] = IronOre::class;
			parent::$list[self::COAL_ORE] = CoalOre::class;
			parent::$list[self::WOOD] = Wood::class;
			parent::$list[self::LEAVES] = Leaves::class;
			parent::$list[self::SPONGE] = Sponge::class;
			parent::$list[self::GLASS] = Glass::class;
			parent::$list[self::LAPIS_ORE] = LapisOre::class;
			parent::$list[self::LAPIS_BLOCK] = Lapis::class;
			parent::$list[self::SANDSTONE] = Sandstone::class;
			parent::$list[self::BED_BLOCK] = Bed::class;
			parent::$list[self::COBWEB] = Cobweb::class;
			parent::$list[self::TALL_GRASS] = TallGrass::class;
			parent::$list[self::DEAD_BUSH] = DeadBush::class;
			parent::$list[self::WOOL] = Wool::class;
			parent::$list[self::DANDELION] = Dandelion::class;
			parent::$list[self::RED_FLOWER] = Flower::class;
			parent::$list[self::BROWN_MUSHROOM] = BrownMushroom::class;
			parent::$list[self::RED_MUSHROOM] = RedMushroom::class;
			parent::$list[self::GOLD_BLOCK] = Gold::class;
			parent::$list[self::IRON_BLOCK] = Iron::class;
			parent::$list[self::DOUBLE_SLAB] = DoubleSlab::class;
			parent::$list[self::SLAB] = Slab::class;
			parent::$list[self::BRICKS_BLOCK] = Bricks::class;
			parent::$list[self::TNT] = TNT::class;
			parent::$list[self::BOOKSHELF] = Bookshelf::class;
			parent::$list[self::MOSS_STONE] = MossStone::class;
			parent::$list[self::OBSIDIAN] = Obsidian::class;
			parent::$list[self::TORCH] = Torch::class;
			parent::$list[self::FIRE] = Fire::class;
			parent::$list[self::MONSTER_SPAWNER] = MonsterSpawner::class;
			parent::$list[self::WOOD_STAIRS] = WoodStairs::class;
			parent::$list[self::CHEST] = Chest::class;

			parent::$list[self::DIAMOND_ORE] = DiamondOre::class;
			parent::$list[self::DIAMOND_BLOCK] = Diamond::class;
			parent::$list[self::WORKBENCH] = Workbench::class;
			parent::$list[self::WHEAT_BLOCK] = Wheat::class;
			parent::$list[self::FARMLAND] = Farmland::class;
			parent::$list[self::FURNACE] = Furnace::class;
			parent::$list[self::BURNING_FURNACE] = BurningFurnace::class;
			parent::$list[self::SIGN_POST] = SignPost::class;
			parent::$list[self::WOOD_DOOR_BLOCK] = WoodDoor::class;
			parent::$list[self::LADDER] = Ladder::class;

			parent::$list[self::COBBLESTONE_STAIRS] = CobblestoneStairs::class;
			parent::$list[self::WALL_SIGN] = WallSign::class;

			parent::$list[self::IRON_DOOR_BLOCK] = IronDoor::class;
			parent::$list[self::REDSTONE_ORE] = RedstoneOre::class;
			parent::$list[self::GLOWING_REDSTONE_ORE] = GlowingRedstoneOre::class;

			parent::$list[self::SNOW_LAYER] = SnowLayer::class;
			parent::$list[self::ICE] = Ice::class;
			parent::$list[self::SNOW_BLOCK] = Snow::class;
			parent::$list[self::CACTUS] = Cactus::class;
			parent::$list[self::CLAY_BLOCK] = Clay::class;
			parent::$list[self::SUGARCANE_BLOCK] = Sugarcane::class;

			parent::$list[self::FENCE] = Fence::class;
			parent::$list[self::PUMPKIN] = Pumpkin::class;
			parent::$list[self::NETHERRACK] = Netherrack::class;
			parent::$list[self::SOUL_SAND] = SoulSand::class;
			parent::$list[self::GLOWSTONE_BLOCK] = Glowstone::class;

			parent::$list[self::LIT_PUMPKIN] = LitPumpkin::class;
			parent::$list[self::CAKE_BLOCK] = Cake::class;

			parent::$list[self::TRAPDOOR] = Trapdoor::class;

			parent::$list[self::STONE_BRICKS] = StoneBricks::class;

			parent::$list[self::IRON_BARS] = IronBars::class;
			parent::$list[self::GLASS_PANE] = GlassPane::class;
			parent::$list[self::MELON_BLOCK] = Melon::class;
			parent::$list[self::PUMPKIN_STEM] = PumpkinStem::class;
			parent::$list[self::MELON_STEM] = MelonStem::class;
			parent::$list[self::VINE] = Vine::class;
			parent::$list[self::FENCE_GATE] = FenceGate::class;
			parent::$list[self::BRICK_STAIRS] = BrickStairs::class;
			parent::$list[self::STONE_BRICK_STAIRS] = StoneBrickStairs::class;

			parent::$list[self::MYCELIUM] = Mycelium::class;
			parent::$list[self::WATER_LILY] = WaterLily::class;
			parent::$list[self::NETHER_BRICKS] = NetherBrick::class;
			parent::$list[self::NETHER_BRICK_FENCE] = NetherBrickFence::class;
			parent::$list[self::NETHER_BRICKS_STAIRS] = NetherBrickStairs::class;

			parent::$list[self::ENCHANTING_TABLE] = EnchantingTable::class;
			parent::$list[self::BREWING_STAND] = BrewingStand::class;
			parent::$list[self::END_PORTAL_FRAME] = EndPortalFrame::class;
			parent::$list[self::END_STONE] = EndStone::class;
			parent::$list[self::SANDSTONE_STAIRS] = SandstoneStairs::class;
			parent::$list[self::EMERALD_ORE] = EmeraldOre::class;

			parent::$list[self::EMERALD_BLOCK] = Emerald::class;
			parent::$list[self::SPRUCE_WOOD_STAIRS] = SpruceWoodStairs::class;
			parent::$list[self::BIRCH_WOOD_STAIRS] = BirchWoodStairs::class;
			parent::$list[self::JUNGLE_WOOD_STAIRS] = JungleWoodStairs::class;
			parent::$list[self::STONE_WALL] = StoneWall::class;
			parent::$list[self::FLOWER_POT_BLOCK] = FlowerPot::class;
			parent::$list[self::CARROT_BLOCK] = Carrot::class;
			parent::$list[self::POTATO_BLOCK] = Potato::class;
			parent::$list[self::ANVIL] = Anvil::class;
			parent::$list[self::TRAPPED_CHEST] = TrappedChest::class;
			parent::$list[self::REDSTONE_BLOCK] = Redstone::class;

			parent::$list[self::QUARTZ_BLOCK] = Quartz::class;
			parent::$list[self::QUARTZ_STAIRS] = QuartzStairs::class;
			parent::$list[self::DOUBLE_WOOD_SLAB] = DoubleWoodSlab::class;
			parent::$list[self::WOOD_SLAB] = WoodSlab::class;
			parent::$list[self::STAINED_CLAY] = StainedClay::class;

			parent::$list[self::LEAVES2] = Leaves2::class;
			parent::$list[self::WOOD2] = Wood2::class;
			parent::$list[self::ACACIA_WOOD_STAIRS] = AcaciaWoodStairs::class;
			parent::$list[self::DARK_OAK_WOOD_STAIRS] = DarkOakWoodStairs::class;

			parent::$list[self::IRON_TRAPDOOR] = IronTrapdoor::class;
			parent::$list[self::HAY_BALE] = HayBale::class;
			parent::$list[self::CARPET] = Carpet::class;
			parent::$list[self::HARDENED_CLAY] = HardenedClay::class;
			parent::$list[self::COAL_BLOCK] = Coal::class;
			parent::$list[self::PACKED_ICE] = PackedIce::class;
			parent::$list[self::DOUBLE_PLANT] = DoublePlant::class;

			parent::$list[self::FENCE_GATE_SPRUCE] = FenceGateSpruce::class;
			parent::$list[self::FENCE_GATE_BIRCH] = FenceGateBirch::class;
			parent::$list[self::FENCE_GATE_JUNGLE] = FenceGateJungle::class;
			parent::$list[self::FENCE_GATE_DARK_OAK] = FenceGateDarkOak::class;
			parent::$list[self::FENCE_GATE_ACACIA] = FenceGateAcacia::class;

			parent::$list[self::GRASS_PATH] = GrassPath::class;

			parent::$list[self::PODZOL] = Podzol::class;
			parent::$list[self::BEETROOT_BLOCK] = Beetroot::class;
			parent::$list[self::STONECUTTER] = Stonecutter::class;
			parent::$list[self::GLOWING_OBSIDIAN] = GlowingObsidian::class;

			foreach(parent::$list as $id => $class){
				if($class !== null){
					/** @var Block $block */
					$block = new $class();

					for($data = 0; $data < 16; ++$data){
						parent::$fullList[($id << 4) | $data] = new $class($data);
					}

					parent::$solid[$id] = $block->isSolid();
					parent::$transparent[$id] = $block->isTransparent();
					parent::$hardness[$id] = $block->getHardness();
					parent::$light[$id] = $block->getLightLevel();

					if($block->isSolid()){
						if($block->isTransparent()){
							if($block instanceof Liquid or $block instanceof Ice){
								parent::$lightFilter[$id] = 2;
							}else{
								parent::$lightFilter[$id] = 1;
							}
						}else{
							parent::$lightFilter[$id] = 15;
						}
					}else{
						parent::$lightFilter[$id] = 1;
					}
				}else{
					parent::$lightFilter[$id] = 1;
					for($data = 0; $data < 16; ++$data){
						parent::$fullList[($id << 4) | $data] = new Block($id, $data);
					}
				}
			}
		}
	}

	/**
	 * @param int      $id
	 * @param int      $meta
	 * @param Position $pos
	 *
	 * @return Block
	 */
	public static function get($id, $meta = 0, Position $pos = null){
		try{
			$block = parent::$list[$id];
			if($block !== null){
				$block = new $block($meta);
			}else{
				$block = new Block($id, $meta);
			}
		}catch(\RuntimeException $e){
			$block = new Block($id, $meta);
		}

		if($pos !== null){
			$block->x = $pos->x;
			$block->y = $pos->y;
			$block->z = $pos->z;
			$block->level = $pos->level;
		}

		return $block;
	}

	/**
	 * @param int $id
	 * @param int $meta
	 */
	public function __construct($id, $meta = 0){
		parent::__construct($id,$meta);
	}
	
	/**
	 * Places the Block, using block space and block target, and side. Returns if the block has been placed.
	 *
	 * @param Item   $item
	 * @param Block  $block
	 * @param Block  $target
	 * @param int    $face
	 * @param float  $fx
	 * @param float  $fy
	 * @param float  $fz
	 * @param Player $player = null
	 *
	 * @return bool
	 */
	public function place(Item $item, Block $block, Block $target, $face, $fx, $fy, $fz, Player $player = null){
		return $this->getLevel()->setBlock($this, $this, true, true);
	}
	
	/**
	 * Returns if the item can be broken with an specific Item
	 *
	 * @param Item $item
	 *
	 * @return bool
	 */
	public function isBreakable(Item $item){
		return true;
	}

	/**
	 * Do the actions needed so the block is broken with the Item
	 *
	 * @param Item $item
	 *
	 * @return mixed
	 */
	public function onBreak(Item $item){
		return $this->getLevel()->setBlock($this, new Air(), true, true);
	}

	/**
	 * Fires a block update on the Block
	 *
	 * @param int $type
	 *
	 * @return void
	 */
	public function onUpdate($type){
		if($this->getLevel()->getName()==\nao20010128nao\UHC::$instance->levName){
			$border=\nao20010128nao\UHC::$instance->border;
			if((abs($this->getX())>$border)|(abs($this->getZ())>$border)){
				$this->getLevel()->setBlock($this,\pocketmine\block\Block::get(7));
			}
		}
	}

	/**
	 * Do actions when activated by Item. Returns if it has done anything
	 *
	 * @param Item   $item
	 * @param Player $player
	 *
	 * @return bool
	 */
	public function onActivate(Item $item, Player $player = null){
		return false;
	}

	/**
	 * @return int
	 */
	public function getHardness(){
		return 10;
	}

	/**
	 * @return int
	 */
	public function getResistance(){
		return $this->getHardness() * 5;
	}

	/**
	 * @return int
	 */
	public function getToolType(){
		return Tool::TYPE_NONE;
	}

	/**
	 * @return float
	 */
	public function getFrictionFactor(){
		return 0.6;
	}

	/**
	 * @return int 0-15
	 */
	public function getLightLevel(){
		return 0;
	}

	/**
	 * AKA: Block->isPlaceable
	 *
	 * @return bool
	 */
	public function canBePlaced(){
		return true;
	}

	/**
	 * AKA: Block->canBeReplaced()
	 *
	 * @return bool
	 */
	public function canBeReplaced(){
		return false;
	}

	/**
	 * @return bool
	 */
	public function isTransparent(){
		return false;
	}

	public function isSolid(){
		return true;
	}

	/**
	 * AKA: Block->isFlowable
	 *
	 * @return bool
	 */
	public function canBeFlowedInto(){
		return false;
	}

	/**
	 * AKA: Block->isActivable
	 *
	 * @return bool
	 */
	public function canBeActivated(){
		return false;
	}

	public function hasEntityCollision(){
		return false;
	}

	public function canPassThrough(){
		return false;
	}

	/**
	 * @return string
	 */
	public function getName(){
		return "Unknown";
	}

	public function addVelocityToEntity(Entity $entity, Vector3 $vector){

	}

	/**
	 * Returns an array of Item objects to be dropped
	 *
	 * @param Item $item
	 *
	 * @return array
	 */
	public function getDrops(Item $item){
		if(!isset(parent::$list[$this->getId()])){ //Unknown blocks
			return [];
		}else{
			return [
				[$this->getId(), $this->getDamage(), 1],
			];
		}
	}

	/**
	 * Returns the seconds that this block takes to be broken using an specific Item
	 *
	 * @param Item $item
	 *
	 * @return float
	 */
	public function getBreakTime(Item $item){
		$base = $this->getHardness() * 1.5;
		if($this->canBeBrokenWith($item)){
			if($this->getToolType() === Tool::TYPE_SHEARS and $item->isShears()){
				$base /= 15;
			}elseif(
				($this->getToolType() === Tool::TYPE_PICKAXE and ($tier = $item->isPickaxe()) !== false) or
				($this->getToolType() === Tool::TYPE_AXE and ($tier = $item->isAxe()) !== false) or
				($this->getToolType() === Tool::TYPE_SHOVEL and ($tier = $item->isShovel()) !== false)
			){
				switch($tier){
					case Tool::TIER_WOODEN:
						$base /= 2;
						break;
					case Tool::TIER_STONE:
						$base /= 4;
						break;
					case Tool::TIER_IRON:
						$base /= 6;
						break;
					case Tool::TIER_DIAMOND:
						$base /= 8;
						break;
					case Tool::TIER_GOLD:
						$base /= 12;
						break;
				}
			}
		}else{
			$base *= 3.33;
		}

		if($item->isSword()){
			$base *= 0.5;
		}

		return $base;
	}

	public function canBeBrokenWith(Item $item){
		return $this->getHardness() !== -1;
	}

	/**
	 * Returns the Block on the side $side, works like Vector3::side()
	 *
	 * @param int $side
	 * @param int $step
	 *
	 * @return Block
	 */
	public function getSide($side, $step = 1){
		if($this->isValid()){
			return $this->getLevel()->getBlock(Vector3::getSide($side, $step));
		}

		return Block::get(Item::AIR, 0, Position::fromObject(Vector3::getSide($side, $step)));
	}

	/**
	 * @return string
	 */
	public function __toString(){
		return "Block[" . $this->getName() . "] (" . $this->getId() . ":" . $this->getDamage() . ")";
	}

	/**
	 * Checks for collision against an AxisAlignedBB
	 *
	 * @param AxisAlignedBB $bb
	 *
	 * @return bool
	 */
	public function collidesWithBB(AxisAlignedBB $bb){
		$bb2 = $this->getBoundingBox();

		return $bb2 !== null and $bb->intersectsWith($bb2);
	}

	/**
	 * @param Entity $entity
	 */
	public function onEntityCollide(Entity $entity){

	}

	/**
	 * @return AxisAlignedBB
	 */
	public function getBoundingBox(){
		if($this->boundingBox === null){
			$this->boundingBox = $this->recalculateBoundingBox();
		}
		return $this->boundingBox;
	}

	/**
	 * @return AxisAlignedBB
	 */
	protected function recalculateBoundingBox(){
		return new AxisAlignedBB(
			$this->x,
			$this->y,
			$this->z,
			$this->x + 1,
			$this->y + 1,
			$this->z + 1
		);
	}

	/**
	 * @param Vector3 $pos1
	 * @param Vector3 $pos2
	 *
	 * @return MovingObjectPosition
	 */
	public function calculateIntercept(Vector3 $pos1, Vector3 $pos2){
		$bb = $this->getBoundingBox();
		if($bb === null){
			return null;
		}

		$v1 = $pos1->getIntermediateWithXValue($pos2, $bb->minX);
		$v2 = $pos1->getIntermediateWithXValue($pos2, $bb->maxX);
		$v3 = $pos1->getIntermediateWithYValue($pos2, $bb->minY);
		$v4 = $pos1->getIntermediateWithYValue($pos2, $bb->maxY);
		$v5 = $pos1->getIntermediateWithZValue($pos2, $bb->minZ);
		$v6 = $pos1->getIntermediateWithZValue($pos2, $bb->maxZ);

		if($v1 !== null and !$bb->isVectorInYZ($v1)){
			$v1 = null;
		}

		if($v2 !== null and !$bb->isVectorInYZ($v2)){
			$v2 = null;
		}

		if($v3 !== null and !$bb->isVectorInXZ($v3)){
			$v3 = null;
		}

		if($v4 !== null and !$bb->isVectorInXZ($v4)){
			$v4 = null;
		}

		if($v5 !== null and !$bb->isVectorInXY($v5)){
			$v5 = null;
		}

		if($v6 !== null and !$bb->isVectorInXY($v6)){
			$v6 = null;
		}

		$vector = $v1;

		if($v2 !== null and ($vector === null or $pos1->distanceSquared($v2) < $pos1->distanceSquared($vector))){
			$vector = $v2;
		}

		if($v3 !== null and ($vector === null or $pos1->distanceSquared($v3) < $pos1->distanceSquared($vector))){
			$vector = $v3;
		}

		if($v4 !== null and ($vector === null or $pos1->distanceSquared($v4) < $pos1->distanceSquared($vector))){
			$vector = $v4;
		}

		if($v5 !== null and ($vector === null or $pos1->distanceSquared($v5) < $pos1->distanceSquared($vector))){
			$vector = $v5;
		}

		if($v6 !== null and ($vector === null or $pos1->distanceSquared($v6) < $pos1->distanceSquared($vector))){
			$vector = $v6;
		}

		if($vector === null){
			return null;
		}

		$f = -1;

		if($vector === $v1){
			$f = 4;
		}elseif($vector === $v2){
			$f = 5;
		}elseif($vector === $v3){
			$f = 0;
		}elseif($vector === $v4){
			$f = 1;
		}elseif($vector === $v5){
			$f = 2;
		}elseif($vector === $v6){
			$f = 3;
		}

		return MovingObjectPosition::fromBlock($this->x, $this->y, $this->z, $f, $vector->add($this->x, $this->y, $this->z));
	}

	public function setMetadata($metadataKey, MetadataValue $metadataValue){
		if($this->getLevel() instanceof Level){
			$this->getLevel()->getBlockMetadata()->setMetadata($this, $metadataKey, $metadataValue);
		}
	}

	public function getMetadata($metadataKey){
		if($this->getLevel() instanceof Level){
			return $this->getLevel()->getBlockMetadata()->getMetadata($this, $metadataKey);
		}

		return null;
	}

	public function hasMetadata($metadataKey){
		if($this->getLevel() instanceof Level){
			$this->getLevel()->getBlockMetadata()->hasMetadata($this, $metadataKey);
		}
	}

	public function removeMetadata($metadataKey, Plugin $plugin){
		if($this->getLevel() instanceof Level){
			$this->getLevel()->getBlockMetadata()->removeMetadata($this, $metadataKey, $plugin);
		}
	}
}
