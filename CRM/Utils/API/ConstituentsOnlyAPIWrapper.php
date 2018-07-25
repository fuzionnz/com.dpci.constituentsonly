<?php

require_once 'api/Wrapper.php';

/**
 * Class CRM_Utils_API_ConstituentsOnlyAPIWrapper
 */
class CRM_Utils_API_ConstituentsOnlyAPIWrapper implements API_Wrapper {

  /**
   * @var CRM_Utils_API_ReloadOption
   */
  private static $_singleton = NULL;

  /**
   * @return CRM_Utils_API_ReloadOption
   */
  public static function singleton() {
    if (self::$_singleton === NULL) {
      self::$_singleton = new CRM_Utils_API_ConstituentsOnlyAPIWrapper();
    }
    return self::$_singleton;
  }

  /**
   * @inheritDoc
   */
  public function fromApiInput($apiRequest) {
    return $apiRequest;
  }

  /**
   * @inheritDoc
   */
  public function toApiOutput($apiRequest, $result) {
    $search_term = @$apiRequest['params']['name'];

    if (strlen($search_term) > 0) {
      foreach ($result['values'] as $key => $api_result) {
        try {
          $additional_result = civicrm_api3('Contact', 'get', array(
            'debug' => 1,
            'sequential' => 1,
            'contact_id' => array('=' => $api_result['id']),
          ));
        } catch (CiviCRM_API3_Exception $e) {
          $error = $e->getMessage();
        }

        // If contact is not a constituent, they are already filtered.
        // Remove that contact from the Quick Search results.
        if ($additional_result['count'] == 0) {
          unset($result['values'][$key]);
          // Decrement count
          $result['count'] -= 1;
        }
      }
    }
    return $result;
  }
}
