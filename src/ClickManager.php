<?php

namespace Drupal\thomas_more_social_media;

use Drupal\Component\Datetime\TimeInterface;
use Drupal\Core\Database\Connection;

class ClickManager {

  protected $connection;

  protected $time;

  public function __construct(Connection $connection, TimeInterface $time) {
    $this->connection = $connection;
    $this->time = $time;
  }

  public function addClick(string $network) {
    $this->connection->insert('thomas_more_social_media_counter')
      ->fields([
        'network' => $network,
        'time_clicked' => $this->time->getRequestTime(),
      ])->execute()
    ;
  }

  public function getClicks(string $network) {
    $query = $this->connection->select('thomas_more_social_media_counter', 't');
    $query->condition('t.network', $network);
    return $query->countQuery()->execute()->fetchField();
  }

}