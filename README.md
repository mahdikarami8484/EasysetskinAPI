# how to use ?
1. First you add this plugin to your server
2. Then use it in your plugin as follows:
$api = $this->getServer()->getPluginManager()->getPlugin("easySetSkin");
3. And then use its function as follows:
$api->setSkin($player, $path);
4. This function requires 2 parameters 
The first parameter is the player
And the second parameter is the skin address

# example
1. $api = $this->getServer()->getPluginManager()->getPlugin("easySetSkin");
2. $api->setSkin($player,$this->getDataFolder().'prisoner.png');
