<?php
declare(strict_types=1);

namespace A7T\gmdUI;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;

use jojoe77777\FormAPI\SimpleForm;

class Main extends PluginBase implements Listener{
    
    public function onEnable() : void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        
        @mkdir($this->getDataFolder());
       $this->saveDefaultConfig();
       $this->getResource("config.yml");
       
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
                    $this->getServer()->dispatchCommand(new ConsoleCommandSender($this->getServer(), $this->getServer()->getLanguage()), "gamemode c ".$player->getName());
                  } else {
                    $player->sendMessage("§cYou Dont Have Permission This Commands");
                  }
                break;
                
                case 1:
                  if($player->hasPermission("gmdui.use.survival")){
                    $this->getServer()->dispatchCommand(new ConsoleCommandSender($this->getServer(), $this->getServer()->getLanguage()), "gamemode s ".$player->getName());
                  } else {
                    $player->sendMessage("§cYou Dont Have Permission This Commands");
                  }
                break;
                
                case 2:
                  if($player->hasPermission("gmdui.use.adventure")){
                    $this->getServer()->dispatchCommand(new ConsoleCommandSender($this->getServer(), $this->getServer()->getLanguage()), "gamemode a ".$player->getName());
                  } else {
                    $player->sendMessage("§cYou Dont Have Permission This Commands");
                  }
                break;
                
                case 3:
                  if($player->hasPermission("gmdui.use.spectator")){
                    $this->getServer()->dispatchCommand(new ConsoleCommandSender($this->getServer(), $this->getServer()->getLanguage()), "gamemode spectator ".$player->getName());
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