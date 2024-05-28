<?php
// CommonServices.php

namespace Drupal\global;

use Drupal\Core\Site\Settings;

class CommonServices
{

    protected $settings;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    public function getVar2()
    {
        return $this->settings->get('var2');
    }
}