<?php

namespace Drupal\home_holiday\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Map' block.
 *
 * @Block(
 *  id = "map",
 *  admin_label = @Translation("Map"),
 * )
 */
class Map extends BlockBase {

  const BRASLAV_LAT = 55.638316;
  const BRASLAV_LON = 27.029765;

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $config = \Drupal::config('home_holiday.holidayconfig');
    $drupal_settings = [
      'home_holiday' => [
        'json' => $config->get('map'),
        'center' => [self::BRASLAV_LAT, self::BRASLAV_LON],
        'home' => [$config->get('lat'), $config->get('lon')],
      ],
    ];
    $build['map'] = [
      '#type' => 'html_tag',
      '#tag' => 'div',
      '#attributes' => array(
        'class' => ['contact-map'],
        'id' => 'contact-map',
      ),
      '#attached' => [
        'library' => ['home_holiday/yamap'],
        'drupalSettings' => $drupal_settings,
      ],
    ];
    return $build;
  }

}
