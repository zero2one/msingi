<?php
/**
 * @file
 */

/******************************************************************************
 * Settings
 ******************************************************************************/

/**
 * Implements hook_form_system_theme_settings_alter
 *
 * @param $form
 * @param $form_state
 */
function msingi_form_system_theme_settings_alter(&$form, $form_state) {
  $form['theme_settings']['show_breadcrumbs'] = array(
    '#type'          => 'checkbox',
    '#title'         => t('Show breadcrumbs'),
    '#default_value' => theme_get_setting('show_breadcrumbs'),
    '#description'   => t("Show or hide the breadcrumbs in this theme."),
  );
}