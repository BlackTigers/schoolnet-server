<?php
/**
 * Created by PhpStorm.
 * User: Timo
 * Date: 19.09.2015
 * Time: 10:57
 */

ini_set('session.cookie_lifetime', 60 * 60 * 24 * 3); // Eine Session ist 3 Tage gültig
ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 3);
session_start();