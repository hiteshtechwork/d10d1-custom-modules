<?php

namespace Drupal\global\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\global\CommonServices;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a global form.
 */
class GlobalForm extends FormBase
{

    protected $commonServices;

    public function __construct(CommonServices $commonServices)
    {
        $this->commonServices = $commonServices;
    }

    public static function create(ContainerInterface $container)
    {
        return new static(
            $container->get('global.common_services')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'global_form';
    }

    /**
     * {@inheritdoc}
     */

    public function buildForm(array $form, FormStateInterface $form_state)
    {

        // $value = $GLOBALS['my_global_variable1'];
        // $value2 = \Drupal::service('settings')->get('var2');
        $var2 =

        $value3 = $this->commonServices->getVar2();

        $form['name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Name'),
            '#required' => true,
        ];

        $form['email'] = [
            '#type' => 'email',
            '#title' => $this->t('Email'),
            '#required' => true,
        ];

        $form['api_key'] = [
            '#type' => 'textfield',
            '#title' => $this->t('API Key'),
            '#required' => true,
            '#default_value' => $value3 ?? "test....",
        ];

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // Handle form submission.
        // You can access submitted values using $form_state->getValue('element_name').
        // For example:
        // $name = $form_state->getValue('name');
        // $email = $form_state->getValue('email');
        // $api_key = $form_state->getValue('api_key').
    }
}