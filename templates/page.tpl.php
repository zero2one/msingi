<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['page_top_first']
 * - $page['page_top_second']
 * - $page['page_top_last']
 * - $page['content_top']: Content above
 * - $page['content']: The main content of the current page.
 * - $page['content_bottom']: Content below
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['page_bottom_first']
 * - $page['page_bottom_second']
 * - $page['page_bottom_last']
 * - $page['header']: Items for the header region.
 * - $page['footer-first']: Items for the footer region.
 * - $page['footer-second']: Items for the footer region.
 * - $page['footer-third']: Items for the footer region.
 * - $page['footer-fourth']: Items for the footer region.
 * - $page['footer']: Items for the footer region (powered by).
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 */
?>

<div id="page-wrapper"><div id="page">
  <div id="header-wrapper"><div id="header" class="clearfix">
    <?php if($secondary_menu): ?>
      <div id="secondary-navigation">
        <?php print theme('links__system_secondary_menu', array('links' => $secondary_menu, 'attributes' => array('id' => 'secondary-menu', 'class' => array('links', 'inline', 'clearfix')), 'heading' => t('Secondary menu'))); ?>
      </div><!-- /#secondary-navigation -->
    <?php endif; ?>

    <div id="branding">
      <?php if ($logo): ?>
        <div id="logo">
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
            <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
          </a>
        </div>
      <?php endif; ?>
      
      <?php if ($site_name || $site_slogan): ?>
        <?php if ($site_name): ?>
          <?php if ($title): ?>
            <div id="site-name">
              <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
            </div>
          <?php else: /* Use h1 when the content title is empty */ ?>
            <h1 id="site-name">
              <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
            </h1>
          <?php endif; ?>
        <?php endif; ?>

        <?php if ($site_slogan): ?>
          <div id="site-slogan"><?php print $site_slogan; ?></div>
        <?php endif; ?>
      <?php endif; ?>    
    </div><!-- /#branding -->
    
    <?php print render($page['header']); ?>
    
    <?php if ($main_menu || $secondary_menu): ?>
      <div id="navigation"><div class="section">
        <?php print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('id' => 'main-menu', 'class' => array('links', 'inline', 'clearfix')), 'heading' => t('Main menu'))); ?>
      </div></div> <!-- /.section, /#navigation -->
    <?php endif; ?>
    
  </div></div> <!-- /#header, /#header-wrapper -->

  <?php if ($show_breadcrumb && $breadcrumb): ?>
    <div id="breadcrumb-wrapper"><div id="breadcrumb">
      <?php print $breadcrumb; ?>
    </div></div>
  <?php endif; ?>

  <?php if($messages): ?>
    <div id="messages-wrapper"><div id="messages">
      <?php print $messages; ?>
    </div></div>
  <?php endif; ?>
  
  <?php if($region_wrapper['page_top']): ?>
    <div id="page-top-wrapper"><div id="page-top" class="clearfix">
      <?php if($page['page_top_first']): ?>
        <div id="page-top-first">
          <?php print render($page['page_top_first']); ?>
        </div>
      <?php endif; ?>
      <?php if($page['page_top_second']): ?>
        <div id="page-top-second">
          <?php print render($page['page_top_second']); ?>
        </div>
      <?php endif; ?>
      <?php if($page['page_top_third']): ?>
        <div id="page-top-third">
          <?php print render($page['page_top_third']); ?>
        </div>
      <?php endif; ?>
    </div></div> <!--  /#page-top, /#page-top-wrapper -->
  <?php endif; ?>

  <?php if (!empty($page['highlighted'])): ?>
    <div id="highlighted-wrapper"><div id="highlighted" class="clearfix">
        <?php print render($page['highlighted']); ?>
    </div></div> <!--  /#highlighted, /#highlighted-wrapper -->
  <?php endif; ?>


  <div id="main-wrapper"><div id="main" class="clearfix">
    <div id="content" class="column"><div class="section clearfix">
      <a id="main-content"></a>
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <div id="page-title-wrapper">
          <h1 class="title" id="page-title"><?php print $title; ?></h1>
        </div>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php if ($tabs && (!empty($tabs['#primary']) || !empty($tabs['#secondary']))): ?>
        <div id="tabs" class="clearfix"><?php print render($tabs); ?></div>
      <?php endif; ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <div id="action-links" class="clearfix">
          <ul class="action-links">
            <?php print render($action_links); ?>
          </ul>
        </div>
      <?php endif; ?>
      
      <?php if (!empty($page['content_top'])): ?>
        <div id="content-top-wrapper"><div id="content-top">
          <?php print render($page['content_top']); ?>
        </div></div>
      <?php endif; ?>
      
      <?php print render($page['content']); ?>
      
      <?php if (!empty($page['content_bottom'])): ?>
        <div id="content-bottom-wrapper"><div id="content-bottom">
          <?php print render($page['content_bottom']); ?>
        </div></div>
      <?php endif; ?>
      
      <?php print $feed_icons; ?>
    </div></div> <!-- /.section, /#content -->

    <?php if (!empty($page['sidebar_first'])): ?>
      <div id="sidebar-first" class="column sidebar"><div class="section clearfix">
        <?php print render($page['sidebar_first']); ?>
      </div></div> <!-- /.section, /#sidebar-first -->
    <?php endif; ?>

    <?php if (!empty($page['sidebar_second'])): ?>
      <div id="sidebar-second" class="column sidebar"><div class="section clearfix">
        <?php print render($page['sidebar_second']); ?>
      </div></div> <!-- /.section, /#sidebar-second -->
    <?php endif; ?>
  </div></div> <!-- /#main, /#main-wrapper -->
  
  
  
  <?php if($region_wrapper['page_bottom']): ?>
    <div id="page-bottom-wrapper"><div id="page-bottom" class="clearfix">
      <?php if($page['page_bottom_first']): ?>
        <div id="page-bottom-first">
          <?php print render($page['page_bottom_first']); ?>
        </div>
      <?php endif; ?>
      <?php if($page['page_bottom_second']): ?>
        <div id="page-bottom-second">
          <?php print render($page['page_bottom_second']); ?>
        </div>
      <?php endif; ?>
      <?php if($page['page_bottom_third']): ?>
        <div id="page-bottom-third">
          <?php print render($page['page_bottom_third']); ?>
        </div>
      <?php endif; ?>
    </div></div><!--  /#page-bottom, /#page-bottom-wrapper -->
  <?php endif; ?>

  <div id="footer-wrapper"><div id="footer" class="clearfix">
    <?php if($region_wrapper['footer']): ?>
      <div id="footer-sections-wrapper"><div id="footer-sections" class="clearfix">
        <?php if($page['footer_first']): ?>
          <div id="footer-first">
            <?php print render($page['footer_first']); ?>
          </div>
        <?php endif; ?>
        <?php if($page['footer_second']): ?>
          <div id="footer-second">
            <?php print render($page['footer_second']); ?>
          </div>
        <?php endif; ?>
        <?php if($page['footer_third']): ?>
          <div id="footer-third">
            <?php print render($page['footer_third']); ?>
          </div>
        <?php endif; ?>
        <?php if($page['footer_fourth']): ?>
          <div id="footer-fourth">
            <?php print render($page['footer_fourth']); ?>
          </div>
        <?php endif; ?>
      </div></div>
    <?php endif; ?>
    <?php if($page['footer']): ?>
      <?php print render($page['footer']); ?>
    <?php endif; ?>
    
  </div></div> <!-- /#footer, /#footer-wrapper -->

</div></div> <!-- /#page, /#page-wrapper -->
