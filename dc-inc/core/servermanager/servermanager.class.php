<?php

class Servermanager {

    public $server = array();

    public function __construct() {
        if (permTo('manage_server')) {
            $server = Db::npquery('SELECT * FROM server');
        } else {
            $server = Db::npquery('SELECT * FROM server WHERE server_owner = '.$_SESSION['userid']);
        }
        foreach ($server as $machine) {
            $this->server[$machine['server_id']] = new $machine['server_type']($machine);
        }
    }

    public function getServerInformations() {
        $infos = [];
        foreach ($this->server as $id => $obj) {
            $infos[$id]= $obj->getServerInformations();
        }
        return $infos;
    }
}