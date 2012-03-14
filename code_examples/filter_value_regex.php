<?php
/**
 * Make sure our query matches the pattern name:value or name:"value"
 * Make sure that if we are ranges we use name:[ AND ]
 * allowed inputs :
 * a. bundle:article
 * b. date:[1970-12-31T23:59:59Z TO NOW]
 * Split the text in 4 different parts
 * 1. name, eg.: bundle or date
 * 2. The first opening bracket (or nothing), eg.: [
 * 3. The value of the field, eg. article or 1970-12-31T23:59:59Z TO NOW
 * 4. The last closing bracket, eg.: ]
 * @param string $filter
 *   The filter to validate
 * @return boolean
 */
public static function validFilterValue($filter) {
  $opening = 0; $closing = 0; $name = NULL; $value = NULL;
  if (preg_match('/(?P<name>[^:]+):(?P<value>.+)?$/', $filter, $matches)) {
    foreach ($matches as $match_id => $match) {
      switch($match_id) {
        case 'name' :
          $name = $match;
          break;
        case 'value' :
          $value = $match;
          break;
      }
    }
    // For the name we allow any character that fits between the A-Z0-9 range and
    // any alternative for this in other languages. No special characters allowed
    if (!preg_match('/^[a-zA-Z0-9_\x7f-\xff]+$/', $name)) {
      return FALSE;
    }
    // For the value we allow anything that is UTF8
    if (!drupal_validate_utf8($value)) {
      return FALSE;
    }
    // Check our bracket count. If it does not match it is also not valid
    $valid_brackets = TRUE;
    $brackets['opening']['{'] = substr_count($value, '{');
    $brackets['closing']['}'] = substr_count($value, '}');
    $valid_brackets = ($brackets['opening']['{'] != $brackets['closing']['}']) ? FALSE : TRUE;
    $brackets['opening']['['] = substr_count($value, '[');
    $brackets['closing'][']'] = substr_count($value, ']');
    $valid_brackets = ($brackets['opening']['['] != $brackets['closing'][']']) ? FALSE : TRUE;
    $brackets['opening']['('] = substr_count($value, '(');
    $brackets['closing'][')'] = substr_count($value, ')');
    $valid_brackets = ($brackets['opening']['('] != $brackets['closing'][')']) ? FALSE : TRUE;
    if (!$valid_brackets) {
      return FALSE;
    }

    // Check the date field inputs
    if (preg_match('/\[(.+) TO (.+)\]$/', $value, $datefields)) {
      // Only Allow a value in the form of
      // http://lucene.apache.org/solr/api/org/apache/solr/schema/DateField.html
      // http://lucene.apache.org/solr/api/org/apache/solr/util/DateMathParser.html
      // http://wiki.apache.org/solr/SolrQuerySyntax
      // 1976-03-06T23:59:59.999Z (valid)
      // * (valid)
      // 1995-12-31T23:59:59.999Z (valid)
      // 2007-03-06T00:00:00Z (valid)
      // NOW-1YEAR/DAY (valid)
      // NOW/DAY+1DAY (valid)
      // 1976-03-06T23:59:59.999Z (valid)
      // 1976-03-06T23:59:59.999Z+1YEAR (valid)
      // 1976-03-06T23:59:59.999Z/YEAR (valid)
      // 1976-03-06T23:59:59.999Z (valid)
      // 1976-03-06T23::59::59.999Z (invalid)
      if (!empty($datefields[1]) && !empty($datefields[2])) {
        // Do not check to full value, only the splitted ones
        unset($datefields[0]);
        // Check if both matches are valid datefields
        foreach ($datefields as $datefield) {
          if (!preg_match('/(\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:[\d\.]{2,6}Z(\S)*)|(^([A-Z\*]+)(\A-Z0-9\+\-\/)*)/', $datefield, $datefield_match)) {
            return FALSE;
          }
        }
      }
    }
  }
  return TRUE;
}