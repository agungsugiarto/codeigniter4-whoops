<?php

namespace Fluent\Whoops\Config;

use CodeIgniter\Config\BaseConfig;

class Whoops extends BaseConfig
{
    public $settings = [
        /**
         * Enable whoops handler
         */
        'enable' => true,

        /**
         * Editor to open like sublime or vscode.
         */
        'editor' => '',

        /**
         * Change deafult title.
         */
        'title'  => '',
    ];
}