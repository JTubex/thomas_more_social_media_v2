<?php

namespace Drupal\thomas_more_social_media\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Database\Connection;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\State\StateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Defines a social menu block.
 *
 * @Block(
 *  id = "thomas_more_social_media_block",
 *  admin_label = @Translation("Social media"),
 * )
 */
class SocialMediaBlock extends BlockBase implements ContainerFactoryPluginInterface {

  protected $database;

  protected $state;

  public function __construct(array $configuration, $plugin_id, $plugin_definition, Connection $database, StateInterface $state) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->database = $database;
    $this->state = $state;
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('database'),
      $container->get('state')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#theme' => 'social-media',
      '#attached' => ['library' => ['thomas_more_social_media/social_media']],
      '#facebook_url' => $this->state->get('thomas_more_social_media.facebook_url'),
      '#facebook_count' => $this->getSocialMediaCount('facebook'),
      '#google_plus_url' => $this->state->get('thomas_more_social_media.google_plus_url'),
      '#google_plus_count' => $this->getSocialMediaCount('google_plus'),
      '#twitter_url' => $this->state->get('thomas_more_social_media.twitter_url'),
      '#twitter_count' => $this->getSocialMediaCount('twitter'),
      '#linkedin_url' => $this->state->get('thomas_more_social_media.linkedin_url'),
      '#linkedin_count' => $this->getSocialMediaCount('linkedin'),
      '#foursquare_url' => $this->state->get('thomas_more_social_media.foursquare_url'),
      '#foursquare_count' => $this->getSocialMediaCount('foursquare'),
    ];
  }

  protected function getSocialMediaCount($network) {
    $query = $this->database->select('thomas_more_social_media_counter', 't');
    $query->condition('t.network', $network);
    return $query->countQuery()->execute()->fetchField();
  }

}
