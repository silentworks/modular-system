<?php 
use Modular\System\ModuleInterface;

class ModuleB implements ModuleInterface
{
    private $twig;

    public function __construct()
    {
        $loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
        $this->twig = new Twig_Environment($loader);
    }

    public function info()
    {
        return [
            'name' => 'ModuleB',
            'author' => 'Andrew',
            'description' => 'Here is some description.',
            'type' => 'extra'
        ];
    }

    public function render() 
    {
        $template = $this->twig->loadTemplate('index.html');
        echo $template->render([]);
    }
}

