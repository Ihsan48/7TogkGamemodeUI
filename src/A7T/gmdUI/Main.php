<?php
declare(strict_types=1);

namespace A7T\gmdUI;

use pocketmine\Server;
use pocketmine\player\GameMode;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use jojoe77777\FormAPI\SimpleForm;

class Main extends PluginBase {
    
    public function onEnable() : void{
    	$this->getLogger()->info("Plugin Enable");
    }

    public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args) : bool {
        
        if($cmd->getName() == "gmdui"){
            $this->gmdUI($sender);
        }
        
        return true;
    }
    
    public function gmdUI($player){
        $form = new SimpleForm(function(Player $player, int $data = null){
            if($data === null){
                return true;
            }
            $target = $player->getName();
            switch($data){
                case 0:
                  if($player->hasPermission("gmdui.use.creative")){
                    $player->setGamemode(GameMode::CREATIVE());
                    $player->sendMessage("Changed gamemode to Creative mode");
                  } else {
                    $player->sendMessage("§cYou Dont Have Permission This Commands");
                  }
                break;
                
                case 1:
                  if($player->hasPermission("gmdui.use.survival")){
                    $player->setGamemode(GameMode::SURVIVAL());
                    $player->sendMessage("Changed gamemode to Survival mode");
                  } else {
                    $player->sendMessage("§cYou Dont Have Permission This Commands");
                  }
                break;
                
                case 2:
                  if($player->hasPermission("gmdui.use.adventure")){
                    $player->setGamemode(GameMode::ADVENTURE());
                    $player->sendMessage("Changed gamemode to Adventure mode");
                  } else {
                    $player->sendMessage("§cYou Dont Have Permission This Commands");
                  }
                break;
                
                case 3:
                  if($player->hasPermission("gmdui.use.spectator")){
                    $player->setGamemode(GameMode::SPECTATOR());
                    $player->sendMessage("Changed gamemode to Spectator mode");
                  } else {
                    $player->sendMessage("§cYou Dont Have Permission This Commands");
                  }
                break;
            }
        });
        $form->setTitle($this->getConfig()->get("title"));
        $form->setContent($this->getConfig()->get("content"));
        $form->addButton("§l§eCreative\n§rTap To Change");
        $form->addButton("§l§eSurvival\n§rTap To Change");
        $form->addButton("§l§eAdventure\n§rTap To Change");
        $form->addButton("§l§eSpectator\n§rTap To Change");
        $form->addButton("§l§cEXIT\n§rTap To Exit");
        $form->sendToPlayer($player);
        return $form;
    }
}
