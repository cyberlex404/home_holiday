<?php

namespace Drupal\home_holiday\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigManager;
use Drupal\Core\Config\ConfigFactory;

/**
 * Class HolidayConfig.
 *
 * @package Drupal\home_holiday\Form
 */
class HolidayConfig extends ConfigFormBase {

  /**
   * Drupal\Core\Config\ConfigManager definition.
   *
   * @var \Drupal\Core\Config\ConfigManager
   */
  protected $configManager;
  /**
   * Drupal\Core\Config\ConfigFactory definition.
   *
   * @var \Drupal\Core\Config\ConfigFactory
   */
  protected $configFactory;

  public function __construct(
    ConfigFactoryInterface $config_factory,
      ConfigManager $config_manager
    ) {
    parent::__construct($config_factory);
        $this->configManager = $config_manager;
    $this->configFactory = $config_factory;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('config.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'home_holiday.holidayconfig',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'holiday_config';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('home_holiday.holidayconfig');

    $form['contacts'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Contacts'),
    ];

    $form['social'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Social'),
    ];
    $form['social']['vk'] = [
      '#type' => 'url',
      '#title' => $this->t('VK.com'),
      '#maxlength' => 200,
      '#size' => 64,
      '#default_value' => $config->get('vk'),
    ];
    $form['social']['instagram'] = [
      '#type' => 'url',
      '#title' => $this->t('Instagram'),
      '#maxlength' => 200,
      '#size' => 64,
      '#default_value' => $config->get('instagram'),
    ];
    $form['social']['facebook'] = [
      '#type' => 'url',
      '#title' => $this->t('Facebook'),
      '#maxlength' => 255,
      '#size' => 64,
      '#default_value' => $config->get('facebook'),
    ];

    $form['contacts']['address'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Address'),
      '#default_value' => $config->get('address'),
    ];
    $form['contacts']['email'] = [
      '#type' => 'email',
      '#title' => $this->t('E-mail'),
      '#default_value' => $config->get('email'),
    ];
    $form['contacts']['telephone'] = [
      '#type' => 'tel',
      '#title' => $this->t('Telephone'),
      '#default_value' => $config->get('telephone'),
    ];
    $form['contacts']['skype'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Skype'),
      '#default_value' => $config->get('skype'),
    ];

    $form['geo'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('GEO-information'),
    ];
    $form['geo']['gps'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('GPS'),
    ];
    $form['geo']['gps']['lat'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Lat'),
      '#default_value' => $config->get('lat'),
    ];
    $form['geo']['gps']['lon'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Lon.'),
      '#default_value' => $config->get('lon'),
    ];

    $form['geo']['map'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Map'),
      '#default_value' => $config->get('map'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('home_holiday.holidayconfig')
      ->set('vk', $form_state->getValue('vk'))
      ->set('instagram', $form_state->getValue('instagram'))
      ->set('facebook', $form_state->getValue('facebook'))
      ->set('address', $form_state->getValue('address'))
      ->set('email', $form_state->getValue('email'))
      ->set('telephone', $form_state->getValue('telephone'))
      ->set('skype', $form_state->getValue('skype'))
      ->set('lat', $form_state->getValue('lat'))
      ->set('lon', $form_state->getValue('lon'))
      ->set('map', $form_state->getValue('map'))
      ->save();
  }

}
