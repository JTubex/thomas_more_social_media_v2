<?php

namespace Drupal\thomas_more_social_media\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AjaxController extends ControllerBase {

  public function counter(Request $request) {
    \Drupal::database()->insert('thomas_more_social_media_counter')
      ->fields([
        'network' => $request->get('network'),
        'time_clicked' => \Drupal::time()->getRequestTime(),
      ])->execute()
    ;
    return new Response('Ok');
  }

}
