<?php

namespace Fluent\Whoops\Config;

use CodeIgniter\Config\Config;
use CodeIgniter\Events\Events;
use Fluent\Whoops\Handler\WhoopsHandler;

/**
 * Detect event on pre system.
 */
Events::on('pre_system', function () {
    if (ENVIRONMENT !== 'production') {
        $config = Config::get('Whoops')->settings;
        $whoops = new WhoopsHandler($config);
        $whoops->run();
    }
});