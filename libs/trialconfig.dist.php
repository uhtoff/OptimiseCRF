<?php
DB::setDB( "db", "db_user", "db_password" );
$db = 'db';
$trial = 'Trial';
Config::set('userdb', $db);
Config::set('database', $db);
Config::set('trial', $trial);
Config::set('idName', 'Trial ID');
Config::set('test', true);
session_name('Trial');