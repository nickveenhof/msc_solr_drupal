<?php
/**
 *	Asserts that we create a new search page and remove it again
 */
function testNewAndRemoveSearchPage() {
  // Create a new search page
  $this->drupalLogin($this->admin_user);
  $this->drupalGet('admin/config/search/apachesolr/search-pages');
  $this->assertText(t('Add search page'), t('Create new search page link is available'));
  $this->clickLink(t('Add search page'));
  $this->assertText(t('The human-readable name of the search page configuration.'), t('Search page creation page succesfully added'));
  $edit = array(
    'page_id' => 'solr_testingsuite',
    'env_id' => 'solr',
    'label' => 'Test Search Page',
    'description' => 'Test Description',
    'page_title' => 'Test Title',
    'search_path' => 'search/searchdifferentpath',
  );
  $this->drupalPost($this->getUrl(), $edit, t('Save configuration'));
  $this->assertResponse(200);
  // Make sure the menu is recognized
  drupal_static_reset('apachesolr_search_page_load');
  menu_cache_clear_all();
  menu_rebuild();
  $this->drupalGet('admin/config/search/apachesolr/search-pages');
  $this->assertText(t('Test Search Page'), t('Search Page was succesfully created'));

  // Remove the same environment
  $this->clickLink(t('Delete'));
  $this->assertText(t('search page configuration will be deleted.This action cannot be undone.'), t('Delete confirmation page was succesfully loaded'));
  $this->drupalPost($this->getUrl(), array(), t('Delete page'));
  $this->assertResponse(200);
  drupal_static_reset('apachesolr_search_page_load');
  $this->drupalGet('admin/config/search/apachesolr/search-pages');
  $this->assertNoText(t('Test Search Page'), t('Search Environment was succesfully deleted'));
}