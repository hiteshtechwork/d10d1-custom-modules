<?php

namespace Drupal\ajax\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class AjaxAddForm extends FormBase
{
    /**
     * {@inheritDoc}
     */

    public function getFormId()
    {
        return 'ajaxAddForm';
    }

    /**
     * {@inheritDoc}
     */

    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Name'),
            '#required' => true,
            '#ajax' => [
                'callback' => '::validateNameAjax',
                'event' => 'change',

            ],
        ];

        $form['email'] = [
            '#type' => 'email',
            '#title' => $this->t('Email'),
            '#required' => true,
            '#ajax' => [
                'callback' => '::validateEmailAjax',
                'event' => 'change',

            ],
        ];

        $form['phone'] = [
            '#type' => 'tel',
            '#title' => $this->t('Phone'),
            '#required' => true,
            '#ajax' => [
                'callback' => '::validatePhoneAjax',
                'event' => 'change',

            ],
        ];

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),

        ];

        return $form;

    }

    // public function validateForm(array &$form, FormStateInterface $form_state)
    // {

    // }

    /**
     * {@inheritDoc}
     */

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $values = $form_state->getValues();
        echo "<pre>";
        print_r($values);
        echo "</pre>";
        exit();

        // $form_state->setRebuild();
    }

    public function validateNameAjax(array &$form, FormStateInterface $form_state)
    {
        $name = $form_state->getValue('name');

        if (strlen($name) < 5) {
            $response = new AjaxResponse();
            $response->addCommand(
                new HtmlCommand('#name-error', $this->t('<div class="error">Name should be at least 5 characters long.</div>'))
            );
            return $response;
        } else {
            $response = new AjaxResponse();
            $response->addCommand(
                new HtmlCommand('#name-error', '')
            );
            return $response;
        }
    }

    public function validateEmailAjax(array &$form, FormStateInterface $form_state)
    {
        $email = $form_state->getValue('email');
        $pattern = '/^[\w-]+(\.[\w-]+)*@([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}$/';

        if (!preg_match($pattern, $email)) {
            $form_state->setErrorByName('email', $this->t('Please enter a valid email address.'));
        }
    }

    public function validatePhoneAjax(array &$form, FormStateInterface $form_state)
    {
        $phone = $form_state->getValue('phone');
        $pattern = '/^\d{10}$/';

        if (!preg_match($pattern, $phone)) {
            $form_state->setErrorByName('phone', $this->t('Please enter a valid 10-digit phone number.'));
        }
    }

    // public function submitFormAjax(array &$form, FormStateInterface $form_state)
    // {
    //     // AJAX callback when form is submitted.
    //     $response = new AjaxResponse();
    //     // You can add any AJAX response here if needed.
    //     return $response;
    // }
}