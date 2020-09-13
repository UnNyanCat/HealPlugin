<?php

namespace UnNyanCat\Heal\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use UnNyanCat\Heal\Main;

class HealCommand extends Command
{
    public function __construct(string $name, string $description = "", string $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
    }

    public function execute(CommandSender $player, string $commandLabel, array $args)
    {
        if($player instanceof Player) {
            if(count($args) == 1){
                $arg1 = $args[0];

                $config = Main::getConfigName("Heal");

                $player2 = $player->getServer()->getPlayer($arg1);

                if($player2 instanceof Player){
                    $player->sendMessage(Main::getConfigName("Heal")->get("heal-prefix") . " §a$arg1 " . Main::getConfigName("Heal")->get("heal-other"));
                    $player2->sendMessage(Main::getConfigName("Heal")->get("heal-prefix") . Main::getConfigName("Heal")->get("healed-by-other") . $player->getName() . ".");
                    $player2->setHealth(Main::getConfigName("Heal")->get("heal-amount"));
                }else {
                    $player->sendMessage(Main::getConfigName("Heal")->get("heal-prefix") . " §c$arg1 " . Main::getConfigName("Heal")->get("not-player"));
                }
            } else {
                $player->sendMessage(Main::getConfigName("Heal")->get("heal-prefix") . Main::getConfigName("Heal")->get("forget-name"));
                $player->sendMessage(Main::getConfigName("Heal")->get("heal-prefix"). Main::getConfigName("Heal")->get("healed-because-no-name"));
                $player->setHealth(Main::getConfigName("Heal")->get("heal-amount"));
            }
            $player->sendMessage(Main::getConfigName("Heal")->get("be-player"));
        }else{
            $player->sendMessage(Main::getConfigName("Heal")->get("be-console"));
        }
    }
}