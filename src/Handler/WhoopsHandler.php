<?php

namespace Fluent\Whoops\Handler;

use CodeIgniter\CodeIgniter;
use Whoops\Handler\JsonResponseHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run as Whoops;
use Whoops\Util\Misc;

class WhoopsHandler
{
    /** @var Whoops */
    protected $whoops;

    /** @var array */
    protected $settings = [];
    
    /**
     * WhoopsHandler __construct
     *
     * @param  mixed $settings
     * @return void
     */
    public function __construct($settings = [])
    {
        $this->settings = array_merge([
            'enable' => true,
            'editor' => '',
            'title'  => '',
        ], $settings);
    }
    
    /**
     * Run whoops handler.
     *
     * @return void
     */
    public function run()
    {
        if ($this->settings['enable'] === false) {
            return null;
        }

        $prettyPageHandler = new PrettyPageHandler;

        if (empty($this->settings['editor']) === false) {
            $prettyPageHandler->setEditor($this->settings['editor']);
        }

        if (empty($this->settings['title']) === false) {
            $prettyPageHandler->setPageTitle($this->settings['title']);
        }

        $prettyPageHandler->addDataTable('CodeIgniter version ' . CodeIgniter::CI_VERSION, [
            'Version' => CodeIgniter::CI_VERSION,
        ]);

        $this->whoops = new Whoops();
        $this->whoops->pushHandler($prettyPageHandler);

        if (Misc::isAjaxRequest()) {
            $this->whoops->pushHandler(new JsonResponseHandler);
        }

        $this->whoops->register();

        return $this->whoops;
    }
}