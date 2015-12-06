<?php
namespace Modular\System;

class ModuleLoader
{
    private $modulesPath;
    private $modules = [];
    private $modulesInfo = [];

    public function __construct($modulesPath)
    {
        $this->modulesPath = $modulesPath;
    }

    public function findModules()
    {
        $modules = glob($this->modulesPath . '*', GLOB_ONLYDIR);
        foreach ($modules as $modulePath)
        {
            $this->getModuleConfig(basename(realpath($modulePath)));
        }

        ksort($this->modules);
        ksort($this->modulesInfo);

        return $this;
    }

    public function getModules()
    {
        return $this->modules;
    }

    public function getModule($slug = null)
    {
        if (!isset($this->modules[$slug])) {
            throw new \Exception("No module found with the name {$slug}.");
        } 

        return $this->modules[$slug];
    }

    public function getModuleInfo($slug = null)
    {
        if (!isset($this->modulesInfo[$slug])) {
            throw new \Exception("No module found with the name {$slug}.");
        } 

        return $this->modulesInfo[$slug];
    }

    private function getModuleConfig($slug)
    {
        if (! empty($this->modules[$slug])) {
            return $this->modules[$slug];
        }

        $path = $this->modulesPath . $slug;
        $initPath = $path . '/init.php';
        
        if (is_dir($path) && is_file($initPath)) {
            $module = require_once($initPath);
            
            $moduleInfo = new \stdClass();
            $moduleInfo->slug = $slug;

            foreach ($module->info() as $key => $value) {
                $moduleInfo->{$key} = $value;
            }

            $this->modules[$slug] = $module;
            $this->modulesInfo[$slug] = $moduleInfo;
        }
    }
}