<?php

namespace UnNyanCat\Heal;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use UnNyanCat\Heal\command\HealCommand;

class Main extends PluginBase implements Listener
{
    /** @var $heal Config */
    public $heal;

    public static $instance;

    const PREFIX = "§7[§cUnNyanCat§eHeal§7]";

    public function onEnable()
    {
        self::$instance = $this;

        $this->getLogger()->info(self::PREFIX . " Plugin enabled with success");
        $this->getServer()->getPluginManager()->registerEvents($this,$this);

        $this->heal = new Config($this->getDataFolder() . "Heal.yml", Config::YAML);

        $this->getServer()->getCommandMap()->registerAll('Commands',
            [
                new HealCommand("", "", "")
            ]);
    }

    public function onDisable()
    {
        $this->getLogger()->info(self::PREFIX . " Plugin disabled with success");
    }

    public static function getInstance(){
        return self::$instance;
    }

    public static function getConfigName(string $fileName){
        return $fileName = new Config(Main::getInstance()->getDataFolder() . $fileName . ".yml", Config::YAML);
    }
}