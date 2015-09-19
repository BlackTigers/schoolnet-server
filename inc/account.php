<?php
/**
 * Created by PhpStorm.
 * User: Timo
 * Date: 19.09.2015
 * Time: 11:00
 */

//region Functions
function isLoggedIn() {
    return isValid($_SESSION["username"], $_SESSION["passwordhash"]);
}
function isValid($username, $passwordhash) {
    if (isset($username) && isset($passwordhash)) {
        $res = dbQuery("select * from schoolnet_accounts where username = '%s' and passwordhash = '%s' limit 1", $username, $passwordhash);
        return $res->num_rows == 1;
    } else {
        return false;
    }
}
function login($account, $passwordhash) {
    if (isValid($account, $passwordhash)) {
        session_reset();
        session_regenerate_id(true);
        $_SESSION["account"] = $account;
        $_SESSION["passwordhash"] = $passwordhash;

        return true;
    } else {
        return false;
    }
}
function logout() {
    session_destroy();
}
//endregion
