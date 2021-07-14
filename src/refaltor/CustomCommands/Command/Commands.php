<?php

namespace refaltor\CustomCommands\Command;


use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\Player;

class Commands extends Command
{

    public array $data;


    public function __construct(array $data, string $name, string $description = "", string $usageMessage = null, array $aliases = [])
    {
        $this->data = $data;
        parent::__construct($name, $description, $usageMessage, $aliases);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$sender instanceof Player) return;
        if (isset($this->data['permission'])) if (!$sender->hasPermission(strval($this->data['permission']))) return;
        if (isset($this->data['message'])) $sender->sendMessage(str_replace("<br>", "\n", strval($this->data['message'])));
        if (isset($this->data['heal'])) $sender->setHealth($sender->getHealth() + $this->data['heal']);
        if (isset($this->data['food']))$sender->setFood($this->data['food']);
        if (isset($this->data['saturation']))$sender->setFood($this->data['saturation']);
        if (isset($this->data['sound'])){
            $type = $this->data['sound']['id'];
            $sender->getLevel()->broadcastLevelSoundEvent($sender, $type);
        }
    }
}