<?php

require_once 'constituentsonly.civix.php';
use CRM_ConstituentsOnly_ExtensionUtil as E;

/**
 * Implements hook_civicrm_queryObjects().
 */
function constituentsonly_civicrm_queryObjects(&$queryObjects, $type) {
  if ($type == 'Contact') {
    $queryObjects[] = new CRM_ConstituentsOnly_BAO_Query();
  }
}

/**
 * Implements hook_civicrm_apiWrappers().
 */
function constituentsonly_civicrm_apiWrappers(&$wrappers, $apiRequest) {
  if ($apiRequest['entity'] == 'Contact' && $apiRequest['action'] == 'getquick') {
    $wrappers[] = new CRM_Utils_API_ConstituentsOnlyAPIWrapper();
  }
}


/**
 * Implementation of hook_civicrm_alterReportVar().
 */
function constituentsonly_civicrm_alterReportVar($varType, &$var, &$object) {
  $instanceValue = $object->getVar('_instanceValues');
  if (!empty($instanceValue) &&
    in_array(
      $instanceValue['report_id'],
      array(
        'contact/summary',
        'contact/detail',
        'contact/currentEmployer',
      )
    )
  ) {
    if ($varType == 'sql') {
      $var->_columnHeaders['civicrm_contact_do_not_trade'] = array(
        'type' => 1,
        'title' => 'Constituent',
        'no_display' => TRUE,
      );
      $var->_select .= ' , contact_civireport.do_not_trade as civicrm_contact_do_not_trade ';

      $where = $var->getVar('_where');
      $where .= ' AND contact_civireport.do_not_trade <> 1';
      $var->setVar('_where', $where);
    }
  }
}



/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function constituentsonly_civicrm_config(&$config) {
  _constituentsonly_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function constituentsonly_civicrm_xmlMenu(&$files) {
  _constituentsonly_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function constituentsonly_civicrm_install() {
  _constituentsonly_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function constituentsonly_civicrm_postInstall() {
  _constituentsonly_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function constituentsonly_civicrm_uninstall() {
  _constituentsonly_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function constituentsonly_civicrm_enable() {
  _constituentsonly_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function constituentsonly_civicrm_disable() {
  _constituentsonly_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function constituentsonly_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _constituentsonly_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function constituentsonly_civicrm_managed(&$entities) {
  _constituentsonly_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function constituentsonly_civicrm_caseTypes(&$caseTypes) {
  _constituentsonly_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function constituentsonly_civicrm_angularModules(&$angularModules) {
  _constituentsonly_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function constituentsonly_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _constituentsonly_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function constituentsonly_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function constituentsonly_civicrm_navigationMenu(&$menu) {
  _constituentsonly_civix_insert_navigation_menu($menu, NULL, array(
    'label' => E::ts('The Page'),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _constituentsonly_civix_navigationMenu($menu);
} // */
