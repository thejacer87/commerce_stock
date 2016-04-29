<?php

/**
 * @file
 * Contains \Drupal\commerce_stock\StockManager.
 */


namespace Drupal\commerce_stock;


use Drupal\commerce_stock\StockManagerInterface;
use Drupal\commerce\PurchasableEntityInterface;
use Drupal\commerce_stock\StockServiceInterface;


class StockManager implements StockManagerInterface {


  /**
   * The stock services.
   *
   * @var \Drupal\commerce_stock\StockServiceInterface[]
   */
  protected $stockServices = [];
  protected $stockManagerConfig;


  function __construct() {
    $this->stockManagerConfig = new StockManagerConfig($this);
  }

  /**
   * {@inheritdoc}
   */
  public function addService(StockServiceInterface $stock_service) {
    $this->stockServices[] = $stock_service;
  }

  /**
   * {@inheritdoc}
   */
  public function getService(PurchasableEntityInterface $entity) {
    $service = $this->stockManagerConfig->getService($entity);
    return $service;
  }

  /**
   * {@inheritdoc}
   */
  public function listServices() {
    return $this->stockServices;
  }

  /**
   * {@inheritdoc}
   */
  public function listServiceIds() {
    $ids = array();
    foreach ($this->stockServices as $service) {
      $ids[$service->getID()] = $service->getName();
    }
    return $ids;
  }

}
