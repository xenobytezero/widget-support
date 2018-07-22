<?php

namespace WidgetSupport;

class Encryption {

    private $enc_key_id;
    private $enc_file_path;

    function __construct($enc_file_path, $enc_key_id) {

        this::$enc_key_id = $enc_key_id;
        this::$enc_file_path = $enc_file_path;

    }

    public static function init_encryption_key() {
        // include the enc file
        require_once(this::$enc_file_path);
    }

    public static function enc($data){
        
        // Initialise the key if required
        this::init_encryption_key();
        // Remove the base64 encoding from our key
        $encryption_key = base64_decode(GBGI_ENC_KEY);
        // Generate an initialization vector
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        // Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
        // The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
        return base64_encode($encrypted . '::' . $iv);
    }

    public static function dec($data){

        // Initialise the key if required
        Common::init_encryption_key();
        // Remove the base64 encoding from our key
        $encryption_key = base64_decode(this::$enc_key_id);
        // To decrypt, split the encrypted data from our IV - our unique separator used was "::"
        list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);

        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
    }

    
    public static function create_encryption_key() {

        //create the file
        $enc_file = fopen(this::$enc_file_path, "w") or die("Unable to create enc file");

        // write the header
        fwrite($enc_file, "<?php defined( 'ABSPATH' ) or die;");
    
        // write the key
        $key = base64_encode(openssl_random_pseudo_bytes(32));
        fwrite($enc_file, "define('" . this::$enc_key_id . "', '" . $key . "');");

        // write the footer
        fwrite($enc_file, "?>");

        // close the file
        fclose($enc_file);

    }



}









?>