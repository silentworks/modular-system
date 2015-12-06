<?php
require "vendor/autoload.php";

$loader = new Modular\System\ModuleLoader(__DIR__ . '/modules/');
$loader->findModules();

$modulea = $loader->getModule('modulea');
$modulea->render();

$moduleb = $loader->getModule('moduleb');
$moduleb->render();