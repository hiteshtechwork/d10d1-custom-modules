<?php

namespace Drupal\errormod\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses of node metatags.
 */
class Http4xxController extends ControllerBase
{

    /**
     * Gets meta tags for a node.
     */
    public function on404()
    {
        // \Drupal::logger('my_module')->notice($message);

        \Drupal::logger("errormod")->notice("hello........");
        // Return a render array using the template.
        return [
            '#theme' => 'test1',
        ];
    }

}