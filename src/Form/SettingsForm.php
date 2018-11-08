<?php

namespace Drupal\thomas_more_social_media\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class SettingsForm extends FormBase {

  public function getFormId() {
    return 'thomas_more_social_media_settings_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['facebook_url'] = [
      '#type' => 'url',
      '#title' => 'Facebook URL',
      '#default_value' => \Drupal::state()->get('thomas_more_social_media.facebook_url'),
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Opslaan',
      '#button_type' => 'primary',
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    \Drupal::state()->set('thomas_more_social_media.facebook_url', $form_state->getValue('facebook_url'));
    \Drupal::messenger()->addStatus('De Social media links zijn succesvol opgeslagen');
  }

}
