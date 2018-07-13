<?php

class CRM_ConstituentsOnly_BAO_Query extends CRM_Contact_BAO_Query_Interface {

  static $_networkFields = array();

  public function &getFields() {
    return self::$_networkFields;
  }

  public function select(&$query) { }

  /**
   * Build where clause for ConstituentsOnly
   *
   * @return void
   * @access public
   */
  public function where(&$query) {
    $grouping = 0;
    $statement = "NOT (contact_a.do_not_trade <=> 1)";
    $query->_where[$grouping][] = $statement;
  }

  public function from($name, $mode, $side) {
    $from = NULL;
    return $from;
  }

  public function setTableDependency(&$tables) {
  }

  public function getPanesMapper(&$panes) {
  }

  public function registerAdvancedSearchPane(&$panes) {
  }

  public function buildAdvancedSearchPaneForm(&$form, $type) {
  }

  public function setAdvancedSearchPaneTemplatePath(&$paneTemplatePathArray, $type) {
  }

}

