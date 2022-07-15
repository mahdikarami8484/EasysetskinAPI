<?php

declare(strict_types=1);

namespace mahdikarami8484\EasysetskinAPI;

use pocketmine\plugin\PluginBase;
use pocketmine\player\Player;
use pocketmine\command\{Command , CommandSender};
use pocketmine\utils\TextFormat as c;
use pocketmine\entity\Skin;
use pocketmine\event\Listener;

class main extends PluginBase implements Listener{
   
    public function onEnable():void 
    {
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
    }


    public function onCommand(CommandSender $player, Command $cmd, String $label, array $args) : bool
    {
        switch ($cmd->getName()) {
            case "easysetskin":
                $player->sendMessage(C::RED . "Developer name: " . C::BLUE . "Mahdi");
                $player->sendMessage(C::RED . "Developer github: " . C::BLUE . "https://github.com/mahdikarami8484");
        }
        return true;
    }

    public static function getSkinData(string $path, bool $destroyImage = true): string
    {
		
        $image = @imagecreatefrompng($path);
        $size = imagesx($image) * imagesx($image) * 4;
        $width = self::SKIN_WIDTH_MAP[$size];
        $height = self::SKIN_HEIGHT_MAP[$size];

        $skinData = "";

        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
                $rgba = imagecolorat($image, $x, $y);
                $a = (127 - (($rgba >> 24) & 0x7F)) * 2;
                $r = ($rgba >> 16) & 0xff;
                $g = ($rgba >> 8) & 0xff;
                $b = $rgba & 0xff;
                $skinData .= main . phpchr($r) . chr($b) . chr($a);
            }
        }
        if ($destroyImage) imagedestroy($image);
        return $skinData;
    }

    public const SKIN_WIDTH_MAP = [
        64 * 32 * 4 => 64,
        64 * 64 * 4 => 64,
        128 * 128 * 4 => 128
    ];

    public const SKIN_HEIGHT_MAP = [
        64 * 32 * 4 => 32,
        64 * 64 * 4 => 64,
        128 * 128 * 4 => 128
];

	public function setSkin(Player $player , string $path){
		$player->setSkin(new Skin(
            $player->getSkin()->getSkinId(),
            self::getSkinData($path)
        ));
        $player->sendSkin();
	}
}