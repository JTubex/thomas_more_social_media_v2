<?php

namespace Drupal\thomas_more_social_media\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Defines a social menu block.
 *
 * @Block(
 *  id = "thomas_more_social_media_block",
 *  admin_label = @Translation("Social media"),
 * )
 */
class SocialMediaBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#theme' => 'social-media',
      '#attached' => ['library' => ['thomas_more_social_media/social_media']],
      '#facebook_url' => \Drupal::state()->get('thomas_more_social_media.facebook_url'),
      '#facebook_count' => $this->getSocialMediaCount('facebook'),
      '#google_plus_url' => \Drupal::state()->get('thomas_more_social_media.google_plus_url'),
      '#google_plus_count' => $this->getSocialMediaCount('google_plus'),
      '#twitter_url' => \Drupal::state()->get('thomas_more_social_media.twitter_url'),
      '#twitter_count' => $this->getSocialMediaCount('twitter'),
      '#linkedin_url' => \Drupal::state()->get('thomas_more_social_media.linkedin_url'),
      '#linkedin_count' => $this->getSocialMediaCount('linkedin'),
      '#foursquare_url' => \Drupal::state()->get('thomas_more_social_media.foursquare_url'),
      '#foursquare_count' => $this->getSocialMediaCount('foursquare'),
    ];
  }

  protected function getSocialMediaCount($network) {
    $query = \Drupal::database()->select('thomas_more_social_media_counter', 't');
    $query->condition('t.network', $network);
    return $query->countQuery()->execute()->fetchField();
  }

}
