<?php
/**
 *	Asserts that we can edit a search environment
 */
function testEditSearchEnvironment() {
  $this->drupalLogin($this->admin_user);
  $this->drupalGet('admin/config/search/apachesolr/settings');
  $this->clickLink(t('Edit'));
  $this->assertText(t('Example: http://localhost:8983/solr'), t('Edit page was succesfully loaded'));
  $edit = array('name' => 'new description foo bar', 'url' => 'http://localhost:8983/solr/core_does_not_exists');
  $this->drupalPost($this->getUrl(), $edit, t('Save'));
  $this->assertResponse(200);
  drupal_static_reset('apachesolr_load_all_environments');
  drupal_static_reset('apachesolr_get_solr');
  $this->drupalGet('admin/config/search/apachesolr/settings');
  $this->assertText(t('new description foo bar'), t('Search environment description was succesfully edited'));
  $this->assertText('http://localhost:8983/solr/core_does_not_exists', t('Search environment url was succesfully edited'));
}