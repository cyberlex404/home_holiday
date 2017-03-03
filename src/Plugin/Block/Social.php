<?php

namespace Drupal\home_holiday\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Social' block.
 *
 * @Block(
 *  id = "social",
 *  admin_label = @Translation("Social"),
 * )
 */
class Social extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $config = \Drupal::config('home_holiday.holidayconfig');
    $build['social'] = [
      '#theme' => 'holiday_social',
      '#vk' => $config->get('vk'),
      '#facebook' => $config->get('facebook'),
      '#instagram' => $config->get('instagram'),
    ];
    return $build;
  }

}
