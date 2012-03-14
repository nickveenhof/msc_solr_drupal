<?php
/**
 * Batch Operation Callback
 */
function apachesolr_index_batch_index_entities($env_id, &$context) {

/**
 * Send up to $limit entities of each type into the index.
 */
function apachesolr_index_entities($env_id, $limit) {

/**
 * Returns an array of rows from a query based on an indexing environment.
 * @todo Remove the read only because it is not environment specific
 */
function apachesolr_index_get_entities_to_index($env_id, $entity_type, $limit) {

/**
 * Delete an entity from the indexer.
 */
function apachesolr_index_delete_entity_from_index($env_id, $entity_type, $entity) {

/**
 *
 * @param type $type
 * @return type
 * @todo Add Type support
 */
function apachesolr_index_mark_for_reindex($env_id, $entity_type = NULL) {

/**
 * Sets what bundles on the specified entity type should be indexed.
 *
 * @param string $env_id
 *   The Solr core for which to index entities.
 * @param string $entity_type
 *   The entity type to index.
 * @param array $bundles
 *   The machine names of the bundles to index.
 */
function apachesolr_index_set_bundles($env_id, $entity_type, array $bundles) {

/**
 * Returns last changed and last ID for an environment and entity type.
 */
function apachesolr_get_last_index_position($env_id, $entity_type) {

/**
 * Sets last changed and last ID for an environment and entity type.
 */
function apachesolr_set_last_index_position($env_id, $entity_type, $last_changed, $last_entity_id) {

/**
 * Set the timestamp of the last index update
 * @param $timestamp
 *   A timestamp or zero. If zero, the variable is deleted.
 */
function apachesolr_set_last_index_updated($env_id, $timestamp = 0) {

/**
 * Semaphore that indicates whether a search has been done. Blocks use this
 * later to decide whether they should load or not.
 *
 * @param $searched
 *   A boolean indicating whether a search has been executed.
 *
 * @return
 *   TRUE if a search has been executed.
 *   FALSE otherwise.
 */
function apachesolr_has_searched($env_id, $searched = NULL) {

/**
 * Semaphore that indicates whether Blocks should be suppressed regardless
 * of whether a search has run.
 *
 * @param $suppress
 *   A boolean indicating whether to suppress.
 *
 * @return
 *   TRUE if a search has been executed.
 *   FALSE otherwise.
 */
function apachesolr_suppress_blocks($env_id, $suppress = NULL) {

/**
 * Get a named variable, or return the default.
 *
 * @see variable_get()
 */
function apachesolr_environment_variable_get($env_id, $name, $default = NULL) {

/**
 * Set a named variable, or return the default.
 *
 * @see variable_set()
 */
function apachesolr_environment_variable_set($env_id, $name, $value) {

/**
 * Get a named variable, or return the default.
 *
 * @see variable_del()
 */
function apachesolr_environment_variable_del($env_id, $name) {

/**
 * Static getter/setter for the current query. Only set once per page.
 */
function apachesolr_current_query($env_id, DrupalSolrQueryInterface $query = NULL) {

/**
 * Gets a list of the bundles on the specified entity type that should be indexed.
 *
 * @param string $core
 *   The Solr environment for which to index entities.
 * @param string $entity_type
 *   The entity type to index.
 * @return array
 *   The bundles that should be indexed.
 */
function apachesolr_get_index_bundles($env_id, $entity_type) {