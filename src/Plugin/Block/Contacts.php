<?php

namespace Drupal\home_holiday\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigFactory;


/**
 * Provides a 'Contacts' block.
 *
 * @Block(
 *  id = "contacts",
 *  admin_label = @Translation("Contacts"),
 * )
 */
class Contacts extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\Core\Config\ConfigFactory definition.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;
  /**
   * Construct.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param string $plugin_definition
   *   The plugin implementation definition.
   */
  public function __construct(
        array $configuration,
        $plugin_id,
        $plugin_definition,
        ConfigFactory $config_factory
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->configFactory = $config_factory;
  }
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('config.factory')
    );
  }
  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $config = \Drupal::config('home_holiday.holidayconfig');
    $build['contacts'] = [
      '#theme' => 'holiday_contacts',
      '#tel' => $config->get('telephone'),
      '#address' => $config->get('address'),
      '#email' => $config->get('email'),
      '#skype' => $config->get('skype'),
    ];

    return $build;
  }

}
