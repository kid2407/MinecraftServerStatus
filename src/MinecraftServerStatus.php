<?php

/**
 * Created by Tobias Franz.
 * User: Tobias Franz
 * Date: 13.04.2017
 * Time: 18:53
 */
class MinecraftServerStatus {
    private $status = false;
    private $address = '';
    private $port;
    private $minecraftVersion = '';
    private $software = '';
    private $gameType = '';
    private $htmlMotd = '';
    private $ingameMotd = '';
    private $mapName = '';
    private $players = [];
    private $playerCount = 0;
    private $hostname = '';

    /**
     * Creates a new instance of MinecraftServerStatus.
     * $status will be false if a connection to the server couldn't be made
     *
     * @param string $address
     * @param int $port
     */
    public function __construct($address, $port = 25565) {
        $this->address = $address;
        $this->port = $port;
        $this->getInformation();
    }

    /**
     * Tries to collect information for the server.
     * Will set $status to true if connection was successfull.
     */
    private function getInformation() {
        $url = sprintf('http://mcapi.ca/query/%s:%d/extensive', $this->address, $this->port);
        $information = file_get_contents($url);
        if ($information === true) {
            $this->status = true;
            $json = json_decode($information, true);
            $this->minecraftVersion = !empty($json['version']) ? $json['version'] : null;
            $this->software = !empty($json['software']) ? $json['software'] : null;
            $this->gameType = !empty($json['game_type']) ? $json['game_type'] : null;
            $this->htmlMotd = !empty($json['htmlmotd']) ? $json['htmlmotd'] : null;
            $this->ingameMotd = !empty($json['motds']['ingame']) ? $json['motds']['ingame'] : null;
            $this->mapName = !empty($json['map']) ? $json['map'] : null;
            $this->players = !empty($json['players']) ? $json['players'] : null;
            $this->playerCount = !empty($this->players) ? count($this->players) : 0;
        }
    }

    /**
     * Returns the Minecraft version running on the server
     *
     * @return string
     */
    public function getMinecraftVersion() {
        return $this->minecraftVersion;
    }

    /**
     * Returns the serversoftware
     *
     * @return string
     */
    public function getSoftware() {
        return $this->software;
    }

    /**
     * Returns the gametype
     *
     * @return string
     */
    public function getGameType() {
        return $this->gameType;
    }

    /**
     * returns the Motd in HTML format
     *
     * @return string
     */
    public function getHtmlMotd() {
        return $this->htmlMotd;
    }

    /**
     * Returns the Motd in the format it is supplied ingame
     *
     * @return string
     */
    public function getIngameMotd() {
        return $this->ingameMotd;
    }

    /**
     * Returns the name of the current map
     *
     * @return string
     */
    public function getMapName() {
        return $this->mapName;
    }

    /**
     * Returns a list of players, which are currently online
     *
     * @return array
     */
    public function getPlayers() {
        return $this->players;
    }

    /**
     * @return int
     */
    public function getPlayerCount() {
        return $this->playerCount;
    }

    /**
     * Returns the hostname ofthe server
     *
     * @return string
     */
    public function getHostname() {
        return $this->hostname;
    }
}