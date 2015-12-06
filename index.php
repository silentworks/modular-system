<?php
require "vendor/autoload.php";

function coreTwig()
{
    $loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
    return new Twig_Environment($loader, ['autoescape' => false]);
}

$loader = new Modular\System\ModuleLoader(__DIR__ . '/modules/');
$loader->findModules();

$modulea = $loader->getModule('modulea');
$moduleb = $loader->getModule('moduleb');

$template = coreTwig()->loadTemplate('index.html');
echo $template->render([
    'modulea' => $modulea->render(),
    'moduleb' => $moduleb->render(),
]);