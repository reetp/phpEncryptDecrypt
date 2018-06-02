<?php

// Make key function

/*
 * Where do I store the private key?
 *
 * What I would do is use 3 keys. One is user supplied, one is application specific and the other is user specific (like a salt).
 * 
 * The application specific key can be stored anywhere (in a config file outside of the web-root, in an environmental variable, etc).
 * The user specific one would be stored in a column in the db next to the encrypted password.
 * The user supplied one would not be stored. Then, you'd do something like this:
 * $key = $userKey . $serverKey . $userSuppliedKey;
 *
 * I guess you could use a new public/private ssh key pair here
 * 
 */

 include './includes/encryptdecryptClass.php';

 $userKey = "userKey";
 $serverKey = "serverKey";
 $userSuppliedKey = "userSuppliedKey";

 $data = "Somedata";
 
 // We can't do arrays.....
 
 
 //$data = array ("someData", "somemoredata");
 
//function makeKey($userKey, $serverKey, $userSuppliedKey) {
//    $key = hash_hmac('sha512', $userKey, $serverKey);
//    $key = hash_hmac('sha512', $key, $userSuppliedKey);
//    return $key;
//}


// Encrypt    
$e = new Encryption(MCRYPT_BLOWFISH, MCRYPT_MODE_CBC);
$key = $e-> makeKey ($userKey, $serverKey, $userSuppliedKey);
$encryptedData = $e->encrypt($data, $key);



//Decrypt
$e2 = new Encryption(MCRYPT_BLOWFISH, MCRYPT_MODE_CBC);
$data = $e2->decrypt($encryptedData, $key);

print $data;

?>