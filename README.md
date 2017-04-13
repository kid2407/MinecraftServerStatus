# MinecraftServerStatus
This small library provides some information about a requested minecraft server.

####Usage Example

```PHP
$server = new MinecraftServerStatus('myserver.com');

if ($server->getStatus()){
    echo "On server $server->getHostName() are $server->getPlayerCount() players online.\n\n";
    echo "The Minecraft version is $server->getMinecraftVersion()";
    if ($server->getPlayerCount() > 0){
        echo "List of online players:\n";
        foreach ($server->getPlayerCount() as $player){
            echo ' - ' . $player;
        }
    }
}
```

After you created an instance of MinecraftServerStatus, you can check via `$server->getStatus()` if the connection was successful. When you've connected to the server, you can access its different properties.