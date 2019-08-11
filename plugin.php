<?php

namespace Inactive-to-Reactive;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\TextFormat;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class Inactive-to-ReactiveExample extends PluginBase implements Listener{
        public function onEnable(){
            $this->getServer()->getPluginManager()->registerEvents($this,$this);
            $this->getLogger()->info("Plugin Enabled");
            $this->saveDefaultConfig(); // Saves config.yml if not created.
            $this->reloadConfig(); // Fix bugs sometimes by getting configs values
            $keyFromConfig = $this->getConfig()->get("key"); // This will return the element "key" from the config.
            $this->reloadConfig();
            $this->getConfig()->set("key", "example"); // This will set the element "key" of the config.to example.
            $this->getConfig()->save(); // Saves the config

        }
        public function onJoin(PlayerJoinEvent $event){
            $player = $event->getPlayer();
            $name = $player->getName();
            $this->getServer()->broadcastMessage(TextFormat::GREEN."$name Joined The Inactive-to-Reactive test Server! Awesome!");
        }
        public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
            if($cmd->getName() == "test"){
                if(!$sender instanceof Player){
                    $sender->sendMessage("This Command Only Works for players! Please perform this command IN GAME!");
                    $task = new tasks\MyTask($this, $sender->getName()); // Create the new class Task by calling
                    $this->getServer()->getScheduler()->scheduleRepeatingTask($task, 10*20); // Counted in ticks (1 second = 20 ticks)
                }else{
                    if(!isset($args[0]) or (is_int($args[0]) and $args[0] > 0)) { // Check if argument 0 is an integer and is more than 0.
                        $args[0] = 4; // Defining $args[0] with value 4
                    }
                    $sender->getInventory()->addItem(Item::get(364,0,$args[0]));
                    $sender->sendMessage("You have just recieved" .count($args[0]). " steak!");
                }
            }
            return true;
        }
    }