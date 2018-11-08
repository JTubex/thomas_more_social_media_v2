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
    $form['google_plus_url'] = [
      '#type' => 'url',
      '#title' => 'Google Plus URL',
      '#default_value' => \Drupal::state()->get('thomas_more_social_media.google_plus_url'),
    ];
    $form['twitter_url'] = [
      '#type' => 'url',
      '#title' => 'Twitter URL',
      '#default_value' => \Drupal::state()->get('thomas_more_social_media.twitter_url'),
    ];
    $form['linkedin_url'] = [
      '#type' => 'url',
      '#title' => 'Linkedin URL',
      '#default_value' => \Drupal::state()->get('thomas_more_social_media.linkedin_url'),
    ];
    $form['foursquare_url'] = [
      '#type' => 'url',
      '#title' => 'Foursquare URL',
      '#default_value' => \Drupal::state()->get('thomas_more_social_media.foursquare_url'),
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
    \Drupal::state()->set('thomas_more_social_media.google_plus_url', $form_state->getValue('google_plus_url'));
    \Drupal::state()->set('thomas_more_social_media.twitter_url', $form_state->getValue('twitter_url'));
    \Drupal::state()->set('thomas_more_social_media.linkedin_url', $form_state->getValue('linkedin_url'));
    \Drupal::state()->set('thomas_more_social_media.foursquare_url', $form_state->getValue('foursquare_url'));
    \Drupal::messenger()->addStatus('De Social media links zijn succesvol opgeslagen');
  }

}
