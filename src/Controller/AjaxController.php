<?php

namespace Drupal\thomas_more_social_media\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AjaxController extends ControllerBase {

  protected $database;

  public function __construct(Connection $database) {
    $this->database = $database;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database')
    );
  }

  public function counter(Request $request) {
    if (!$this->currentUser()->hasPermission('skip tracking clicks')) {
      $this->database->insert('thomas_more_social_media_counter')
        ->fields([
          'network' => $request->get('network'),
          'time_clicked' => \Drupal::time()->getRequestTime(),
        ])->execute()
      ;
    }

    return new Response('Ok');
  }

}
