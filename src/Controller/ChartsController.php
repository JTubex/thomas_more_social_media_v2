<?php

namespace Drupal\thomas_more_social_media\Controller;

use Drupal\Component\Render\FormattableMarkup;
use Drupal\Core\Controller\ControllerBase;
use Drupal\thomas_more_social_media\ClickManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ChartsController extends ControllerBase {

  protected $clickManager;

  public function __construct(ClickManager $clickManager) {
    $this->clickManager = $clickManager;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('thomas_more_social_media.click_manager')
    );
  }

  public function buildCharts() {
    return [
      '#markup' => new FormattableMarkup('<div id="chart" style="width: 900px; height: 500px;">Chart will be displayed here.</div>', []),
      '#attached' => [
        'library' => ['thomas_more_social_media/data_charts'],
        'drupalSettings' => [
          'chart_data' => [
            'facebook' => $this->clickManager->getClicks('facebook'),
            'linkedin' => $this->clickManager->getClicks('linkedin'),
            'twitter' => $this->clickManager->getClicks('twitter'),
            'foursquare' => $this->clickManager->getClicks('foursquare'),
            'google_plus' => $this->clickManager->getClicks('google_plus'),
          ],
        ],
      ],
    ];
  }
  
}
