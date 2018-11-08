<?php

namespace Drupal\thomas_more_social_media\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\thomas_more_social_media\ClickManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ResetCountersForm extends FormBase {

  protected $clickManager;

  public function __construct(ClickManager $clickManager) {
    $this->clickManager = $clickManager;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('thomas_more_social_media.click_manager')
    );
  }

  public function getFormId() {
    return 'thomas_more_social_media_reset_counters_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['networks'] = [
      '#type' => 'checkboxes',
      '#options' => [
        'facebook' => 'Facebook',
        'linkedin' => 'Linkedin',
        'twitter' => 'Twitter',
        'google_plus' => 'Google+',
        'foursquare' => 'Foursquare',
      ],
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'Reset',
      '#button_type' => 'primary',
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    foreach ($form_state->getValue('networks') as $network) {
      if (!empty($network)) {
        $this->clickManager->removeClicks($network);
      }
    }
    $this->messenger()
      ->addStatus('De Social media netwerk tellers zijn succesvol gereset.')
    ;
  }

}
