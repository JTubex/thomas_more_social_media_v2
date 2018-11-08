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
    ];
  }

}
