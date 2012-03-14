<?php
/**
 * Add information to index other entities.
 * There are some modules in http://drupal.org that can give a good example of
 * custom entity indexing such as apachesolr_user_indexer, apachesolr_term
 * @param array $entity_info
 */
function hook_apachesolr_entity_info_alter(&$entity_info) {

/**
 * Build the documents before sending them to Solr.
 * The function is the follow-up for apachesolr_update_index
 *
 * @param integer $document_id
 * @param array $entity
 * @param string $entity_type
 */
function hook_apachesolr_index_document_build(ApacheSolrDocument $document, $entity, $entity_type, $env_id) {

/**
 * Build the documents before sending them to Solr.
 *
 * Supports all types of
 * hook_apachesolr_index_document_build_' . $entity_type($documents[$id], $entity, $env_id);
 *
 * The function is the follow-up for apachesolr_update_index but then for
 * specific entity types
 *
 * @param $document
 * @param $entity
 * @param $entity_type
 */
function hook_apachesolr_index_document_build_ENTITY_TYPE(ApacheSolrDocument $document, $entity, $env_id) {