
<?php // As always when you start a PHP file

namespace Inactive-to-Reactive\tasks; // Use the same namespace as in your first file but add a \tasks who symbolise that this file is in the subfolder "tasks"

use pocketmine\scheduler\PluginTask; // This is the class that your task will extends to be a plugin task
use Inactive-to-Reactive\Inactive-to-ReactiveExample; // This will allow us to use our main class. It is a required argument for a plugin task.

             class MyTask extends PluginTask { // Remember that your task must have the same name as your file !

                 // First we need a __construct function which is used when you create a class to set default variables, ect...
                 public function __construct(Inactive-to-ReactiveExample $main, string $playername) { // The arguments you define here depends on what do you want to do exept for your base.
                    parent::__construct($main); // Used to meet pocketmine requirements for the tasks. You can retrieve your main class at anytime and use it's methods on your class by using $this->getOwner()
                    $this->playername = $playername; // So we can retreive the player for later.
                }


                // Then we'll create an onRun funtion wich will be called when the time has past to the execution of the task
                public function onRun(int $tick) { // $tick is the current server tick when the task executes
    $player = $this->getOwner()->getServer()->getPlayer($this->playername()); // This retreive the main class with $this->getOwner() then asks the server for the player with the name $this->playername
    if($player instanceof Player) { // Basicly checks if the player we retreive is online.
        $player->sendMessage("10 seconds has past!"); // Sends him a message !
    }
}
             }.

