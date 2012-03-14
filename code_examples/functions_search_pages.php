<?php

/**
 * Menu callback for the overview page showing custom search pages and blocks.
 * @return array $build
 */
function apachesolr_search_page_list_all() {

/**
 * Listing of all the search pages
 * @return array $build
 */
function apachesolr_search_page_list_pages() {

/**
 * Listing of all the search blocks
 * @return array $build
 */
function apachesolr_search_page_list_blocks() {

/**
 * Menu callback/form-builder for the form to create or edit a search page.
 * This function signature also involves a validate and submit functions, but 
 * are not shown in this document.
 */
function apachesolr_search_page_settings_form($form, &$form_state, $search_page = NULL) {

/**
 * Callback element needs only select the portion of the form to be updated.
 * Since #ajax['callback'] return can be HTML or a renderable array (or an
 * array of commands), we can just return a piece of the form.
 */
function apachesolr_search_ajax_search_page_default($form, $form_state, $search_page = NULL) {

/**
 * Used as a callback function to generate a title for the taxonomy term
 * depending on the input in the configuration screen
 * @param integer $search_page_id
 * @param integer $value
 * @return String
 */
function apachesolr_search_get_taxonomy_term_title($search_page_id = NULL, $value = NULL) {

/**
 * Used as a callback function to generate a title for a user name depending
 * on the input in the configuration screen
 * @param integer $search_page_id
 * @param integer $value
 * @return String
 */
function apachesolr_search_get_user_title($search_page_id = NULL, $value = NULL) {

/**
 * Used as a callback function to generate a title for a node/page depending
 * on the input in the configuration screen
 * @param integer $search_page_id
 * @param integer $value
 * @return String
 */
function apachesolr_search_get_value_title($search_page_id = NULL, $value = NULL) {

/**
 * Get or set the default search page id for the current page.
 */
function apachesolr_search_default_search_page($page_id = NULL) {

/**
 * Load a search page
 * @param string $page_id
 * @return array
 */
function apachesolr_search_page_load($page_id) {

/**
 * Save a search page
 * @param stdObject $search_page
 */
function apachesolr_search_page_save($search_page) {

 /**
 * Clone a search page
 * @param $page_id
 *   The page identifier it needs to clone.
 */
function apachesolr_search_page_clone($page_id) {

/**
 * Return all the saved search pages
 * @return array $search_pages
 *   Array of all search pages
 */
function apachesolr_search_load_all_search_pages() {


/**
 * Implements hook_search_page().
 * @param $results
 *   The results that came from apache solr
 */
function apachesolr_search_search_page($results) {

/**
 * Mimics apachesolr_search_search_page() but is used for custom search pages
 * We prefer to keep them seperate so we are not dependent from core search
 * when someone tries to disable the core search
 * @param $results
 *   The results that came from apache solr
 * @param $build
 *   the build array from where this function was called. Good to append output
 *   to the build array
 * @param $search_page
 *   the search page that is requesting an output
 */
function apachesolr_search_search_page_custom($results, $search_page, $build = array()) {

/**
 * Executes search depending on the conditions given.
 * See apachesolr_search.pages.inc for another use of this function
 */
function apachesolr_search_search_results($keys = NULL, $conditions = NULL, $search_page = NULL) {

/**
 * Handle browse results for empty searches.
 */
function apachesolr_search_page_browse($empty_search_behavior, $env_id) {

/**
 * Returns whether a search page exists.
 */
function apachesolr_search_page_exists($search_page_id) {