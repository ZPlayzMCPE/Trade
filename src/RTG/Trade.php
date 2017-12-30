<?php

/**
	* Copyrights (C) RTGNetwork!
	* @author InspectorGadget
	* This GitHub repository is protected, illegal use may lead to unwanted legal issues!
	* @link https://rtgnetwork.tk/
	* GNU License!
*/

namespace RTG;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\enchantment\Enchantment;
use pocketmine\item\Item;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\event\EntityDamageEvent;

class Trade extends PluginBase implements Listener {

	public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
		switch(strtolower($cmd->getName())) {
		
				case "trade":
					$hid = $sender->getInventory()->getItemInHand()->getId();
					
					$sender->sendMessage("-- Trade V 1.0.1 --");
					$sender->sendMessage("");
					$sender->sendMessage("Your item in hand!\n- $hid");
					$sender->sendMessage(TF::RED . "Only Items can be trade not blocks or items with enchantments!");
				        return true;
					
						if(isset($args[0])) {
							switch(strtolower($args[0])) {
							
								case "confirm":
								
									$hand = $sender->getInventory()->getItemInHand();
									$name = $hand->getCustomName();
								
									$id = $hand->getId();
								
								
									$item = Item::get(276, 0, 1);
									
									if($hand->hasEnchantments()) {
										if($id === $item) {
											$money = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI")->myMoney($sender);
											if($money < 2500) {
									
												$sender->getInventory()->removeItem($item);
												$item1 = Item::get(267, 0, 1);
										
												$sharpness = Enchantment::get(9);
												$sharpness->setLevel(2);
									
												$item1->addEnchantment($sharpness);
										
												$cname = $item1->setCustomName("§bDiamond Sword\n§eSharpness II\nConfuser II");
										
												$sender->getInventory()->addItem($item1);
										
												$item->setCustomName($cname);
										
												$sender->sendMessage("[Trade] Succeeded, check your inventory!");
												return true;
											}
											else {
												$sender->sendMessage("[Trade] You need atleast 2500!");
												return true;
											}
										}
										else {
											$sender->sendMessage("[Trade] You need to hold a Diamond Sword in your hand!");
											return true;
										}
									}
									else {
										$sender->sendMessage("[Trade] Your item is enchanted! Please take it off to use this plugin.");
									}
									return true;
								break;
							}
						}
					return true;
				break;
		}
	}
	
	public function onDamage(EntityDamageEvent $e)
    {
        if($e instanceof EntityDamageByEntityEvent) {
            $damager = $e->getDamager();
            $sword = $damager->getInventory()->getItemInHand();
            $hitget = $e->getEntity();
            $x = $damaged->getX();
            $y = $damaged->getY();
            $z = $damaged->getZ();
            $level = $damager->getLevel();
            
           if($sword->getId() === 276 && $sword->getCustomName() === "§bDiamond Sword\n§eSharpness II\nConfuser II") {
							$hitget->addEffect(Effect::getEffect(9)->setDuration(13 * 20)->setAmplifier(1));
							$hitget->sendMessage("[CE] You have been effected by a Custom Enchanted Sword! You better get rid of it!");
		                                        return true;
           }
				}
	}

	
	public function onDisable() {
	}
	
}
