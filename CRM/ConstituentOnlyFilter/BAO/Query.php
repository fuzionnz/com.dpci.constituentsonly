<?php

class CRM_ConstituentOnlyFilter_BAO_Query extends CRM_Contact_BAO_Query_Interface {


  /**
   * static field for all the export/import attentively fields
   *
   * @var array
   * @static
   */
  static $_networkFields = array();


  public function &getFields() {
    return self::$_networkFields;
  }

  /**
   * build select for Attentively
   *
   * @return void
   * @access public
   */
  public function select(&$query) { }

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
    $panes['Social Media'] = 'social';
  }

  public function buildAdvancedSearchPaneForm(&$form, $type) {
    if ($type  == 'social') {
      $form->add('hidden', 'hidden_social', 1);
      self::buildSearchForm($form);
      $form->setDefaults(array('network_toggle' => 2));
    }
  }

  public function setAdvancedSearchPaneTemplatePath(&$paneTemplatePathArray, $type) {
    if ($type  == 'social') {
      $paneTemplatePathArray['social'] = 'CRM/Attentively/Form/Search/Criteria.tpl';
    }
  }

}

