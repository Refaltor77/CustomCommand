<?php

namespace refaltor\CustomCommands;

use pocketmine\plugin\PluginBase;
use refaltor\CustomCommands\Command\Commands;

class Main extends PluginBase
{
    public function onEnable()
    {
        $this->saveResource('config.yml');
        $array = $this->getConfig()->getAll();
        foreach ($array['commands'] as $cmd => $keys){
            $this->getServer()->getCommandMap()->register($cmd, new Commands($keys, $cmd, $keys['description'] ?? ""));
        }
    }
}