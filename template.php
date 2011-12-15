<?php
/**
 * Implements hook_preprocess_html
 * Add body classes if certain regions have content.
 * 
 * @param   array variables
 * @return  void
 */
function msingi_preprocess_html(&$variables) {
  // special regions (region name => number of sections)
  $regions = _msingi_helper_get_regions($variables);
  foreach($regions['classes'] AS $class) {
    $variables['classes_array'][] = $class;
  }
  
  if(!empty($variables['page']['highlighted'])) {
    $variables['classes_array'][] = 'highlighted';
  }
  
  $variables['classes_array'][] = 'col';
  
  // Add conditional stylesheets for IE
  //drupal_add_css(path_to_theme() . '/css/ie.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'lte IE 7', '!IE' => FALSE), 'preprocess' => FALSE));
/*
  drupal_add_css(path_to_theme() . '/css/style-ie6.css', array(
    'group' => CSS_THEME, 
    'browsers' => array('IE' => 'IE 6', '!IE' => FALSE), 
    'preprocess' => FALSE
  ));
 */
}

/**
 * Implements hook_preprocess_page
 * Override or insert variables into the page template.
 * 
 * @param   array variables
 * @return  void
 */
function msingi_preprocess_page(&$variables) {
  $regions = _msingi_helper_get_regions($variables);
  $variables['region_wrapper'] = $regions['show'];
}

/**
 * Implements hook_preprocess_block().
 */
function msingi_preprocess_block(&$vars) {
  // Adding a class to the title attributes
  $vars['title_attributes_array']['class'][] = 'block-title';

  // Add odd/even zebra classes into the array of classes
  $vars['attributes_array']['id'][] = $vars['block_html_id'];
  $vars['attributes_array']['class'] = $vars['classes_array'];
  $vars['attributes_array']['class'][] = $vars['block_zebra'];
  
  // Adding a class to the content attributes
  $vars['content_attributes_array']['class'][] = 'block-content';
  
  if(empty($vars['block']->subject) && (string) $vars['block']->subject != '0') {
    // Add a class to provide CSS for blocks without titles.
    $vars['attributes_array']['class'][] = 'block-without-title';
  }
}






/**
 * HELPERS ********************************************************************
 */

/**
 * Get the regions with subsections
 * 
 * Returns an array with:
 *  Region name => number of subsections
 * 
 * @param   void
 * @return  array
 */
function _msingi_helper_get_regions($variables = array()) {
  // we run our logic only once!
  static $sections = array();
  
  if(empty($variables)) {
    return $sections;
  }
  
  if(!empty($sections)) {
    return $sections;
  }
  
  $regions = array(
    'sidebar'     => 2,
    'page_top'    => 3,
    'page_bottom' => 3,
    'footer'      => 4,
  );
  $regionNames = array('first', 'second', 'third', 'fourth');
  $sections = array(
    'classes' => array(),
    'show'    => array(),
  );
  
  foreach($regions AS $region => $count) {
    $classes = array();
    $sections['show'][$region] = false;
    for($i=0; $i<$count; $i++) {
      $regionName = $region . '_' . $regionNames[$i];
      if(!empty($variables['page'][$regionName])) {
        $classes[] = $regionNames[$i];
      }
    }
    if(!empty($classes)) {
      $sections['show'][$region] = true;
      $sections['classes'][] = str_replace('_', '-', $region) 
                          . '-' . implode('-', $classes);
    }
  }

  return $sections;
}



/**
 * Implements theme_link
 * 
 * Adds extra <span> around link content
 */
function msingi_link($variables) {
  return '<a href="' 
    . check_plain(url($variables['path'], $variables['options'])) 
    . '"' 
    . drupal_attributes($variables['options']['attributes']) 
    . '><span>' 
    . ($variables['options']['html'] 
      ? $variables['text'] 
      : check_plain($variables['text'])) 
    . '</span></a>';
}

/**
 * Implements theme_status_messages
 */
function msingi_status_messages($variables) {
  $display = $variables['display'];
  
  $output = array();
  
  $status_heading = array(
    'status' => t('Status message'), 
    'error' => t('Error message'), 
    'warning' => t('Warning message'),
  );
  
  $message_containers = drupal_get_messages($display);
  foreach ($message_containers as $type => $messages) {
    if(!count($messages)) {
      continue;
    }
    
    $output[] = '<div class="messages ' . $type . '">';
    $output[] = '  <div class="block-close"><a href="#" title="' . t('Close') . '"><span>' . t('Close') . '</span></a></div>';
    
    if (!empty($status_heading[$type])) {
      $output[] = '  <h2 class="element-invisible">' . $status_heading[$type] . '</h2>';
    }
    
    $output[] = '  <ul>';
    $i = 1;
    $count_messages = count($messages);
    foreach ($messages as $message) {
      $classes = array();
      if($i === 1) {
        $classes[] = 'first';
      }
      if($i === $count_messages) {
        $classes[] = 'last';
      }
      $classes = (count($classes))
        ? ' class="' . implode(' ', $classes) . '"'
        : null;
      $output[] = '    <li' . $classes . '>' . $message . '</li>';
      
      $i++;
    }
    $output[] = '  </ul>';
    $output[] = '</div>';
  }
  
  return implode(PHP_EOL, $output);
}

