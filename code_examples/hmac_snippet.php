<?php
/**
 * Derive a key for the solr hmac using the information shared with acquia.com.
 */
function _acquia_search_derived_key() {
  $key = ACQUIA_KEY;
  $subscription = SUBSCRIPTION_INFO_ARRAY;
  $identifier = ACQUIA_IDENTIFIER;
  // We use a salt from acquia.com in key derivation since this is a shared
  // value that we could change on the AN side if needed to force any
  // or all clients to use a new derived key.  We also use a string
  // ('solr') specific to the service, since we want each service using a
  // derived key to have a separate one.
  $salt = $subscription['derived_key_salt'];
  $derivation_string = $identifier . 'solr' . $salt;
  $derived_key = _acquia_search_hmac($key, str_pad($derivation_string, 80, $derivation_string));
  return $derived_key;
}

/**
 * Calculates a HMAC-SHA1 of a data string.
 *
 * See RFC2104 (http://www.ietf.org/rfc/rfc2104.txt). Note, the result of this
 * must be identical to using hash_hmac('sha1', $string, $key);  We don't use
 * that function since PHP can be missing it if it was compiled with the
 * --disable-hash switch. However, the hash extension is enabled by default
 * as of PHP 5.1.2, so we should consider requiring it and using the built-in
 * function since it is a little faster (~1.5x).
 */
function _acquia_search_hmac($key, $string) {
  $output = str_pad($key, 64, chr(0x00)) ^ (str_repeat(chr(0x5c), 64));
  $output .= pack("H*", sha1((str_pad($key, 64, chr(0x00)) ^ (str_repeat(chr(0x36), 64))) . $string));
  return sha1($output);
}
