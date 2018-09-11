<?php

class CRM_ConstituentsOnly_BAO_Query extends CRM_Contact_BAO_Query_Interface {

  static $_networkFields = array();

  public function &getFields() {
    return self::$_networkFields;
  }

  /**
   * @param $query
   *
   */
  public function select(&$query) {
    // hack for profile search
    $url = CRM_Utils_Array::value('q', $_GET);
    if (in_array($url, ['civicrm/profile', 'civicrm/contact/search/builder'])) {
      if (empty($query->_params)) {
        $query->_params[] = [
          'entryURL',
          '=',
          0,
          0,
          1,
        ];
      }
      $query->_paramLookup['entryURL'] = [
        'entryURL',
        '=',
        0,
        0,
        1,
      ];
    }
  }

  /**
   * @param $query
   *
   */
  public function where(&$query) {
    if (empty($query->_paramLookup['entryURL'])) {
      return;
    }

    if (CRM_Utils_Array::value('civicrm_contact', $query->_tables) && empty($query->_paramLookup['do_not_trade'])) {
      $query->_where[0][] = "( contact_a.do_not_trade IS NULL OR contact_a.do_not_trade = 0)";
    }
  }

  /**
   * @param string $name
   * @param $mode
   * @param $side
   *
   */
  public function from($name, $mode, $side) {
  }

  /**
   * @param $tables
   *
   */
  public function setTableDependency(&$tables) {
  }

  public function getPanesMapper(&$panes) {
  }

  /**
   * @param $panes
   *
   */
  public function registerAdvancedSearchPane(&$panes) {
  }

  /**
   * @param CRM_Core_Form $form
   * @param $type
   *
   */
  public function buildAdvancedSearchPaneForm(&$form, $type) {
  }

  /**
   * @param $paneTemplatePathArray
   * @param $type
   *
   */
  public function setAdvancedSearchPaneTemplatePath(&$paneTemplatePathArray, $type) {
  }

}
