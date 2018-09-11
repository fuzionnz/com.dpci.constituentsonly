<?php

require_once 'constituentsonly.civix.php';
use CRM_ConstituentsOnly_ExtensionUtil as E;

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

/**
 * Implements hook_civicrm_queryObjects().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_queryObjects
 */
function constituentsonly_civicrm_queryObjects(&$queryObjects, $type) {
  if ($type == 'Contact') {
    $queryObjects[] = new CRM_ConstituentsOnly_BAO_Query();
  }
}

/**
 * Implements hook_civicrm_contactListQuery().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_contactListQuery
 */
function constituentsonly_civicrm_contactListQuery(&$query, $queryText, $context, $id) {
  $replace = 'WHERE (cc.do_not_trade IS NULL OR cc.do_not_trade = 0) AND ';
  $query = str_replace('WHERE ', $replace, $query);
}

/**
 * Implements hook_civicrm_selectWhereClause().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_selectWhereClause
 */
function constituentsonly_civicrm_selectWhereClause($entity, &$clauses) {
  if ($entity == 'Contact') {
    $url = CRM_Utils_Array::value('q', $_GET);
    if (strpos($url, 'civicrm/report') === FALSE) {
      return;
    }
    $clauses['do_not_trade'] = ' = 0';
  }
}
