<?php

namespace Drupal\nodeuserdata\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\nodeuserdata\DataService;
use Symfony\Component\DependencyInjection\ContainerInterface as DependencyInjectionContainerInterface;

// use Symfony\Component\DependencyInjection\ContainerInterface as DependencyInjectionContainerInterface;

class NodeUserDataController extends ControllerBase
{

    protected $dataService;

    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    public static function create(DependencyInjectionContainerInterface $container)
    {
        return new static(
            $container->get('nodeuserdata.data_service')
        );
    }

    public function getNodeUserData()
    {

        // $dataService1 = \Drupal::service('nodeuserdata.data_service');
        // $data = $dataService1->getAllData();
        $data = $this->dataService->getAllData();
        return [
            '#markup' => '<pre>' . print_r($data, true) . '</pre>',
        ];
    }
}