<?php
/**
 * Created by PhpStorm.
 * User: Timo
 * Date: 19.09.2015
 * Time: 10:55
 */

const DB_HOST = "127.0.0.3";
const DB_NAME = "Datenbankname";
const DB_USER = "Datenbankuser";
const DB_PASS = "Datenbankpasswort";

class Database {
    public $link;
    public function __construct() {
        $this->link = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        /* check connection */
        if ($this->link->connect_errno) {
            printf("Connect failed: %s\n", $this->link->connect_error);
            exit();
        }
    }
}

function dbQuery($querySPrintF, $args=NULL) {
    $db = new Database();
    $arg_list = func_get_args();
    unset($arg_list[0]);

    foreach ($arg_list as &$item) {
        if (is_string($item)) {
            $item = dbEsc($item);
        }
    }

    $res = $db->link->query(vsprintf($querySPrintF, $arg_list));

    if (!$res) {
        echo($db->link->error);
    }

    return $res;
}
function dbEsc($strToEscape) {
    $db = new Database();
    return $db->link->real_escape_string($strToEscape);
}