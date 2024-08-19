<?php

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

if (!function_exists('isEncrypted')) {
    /**
     * Check if a string is encrypted.
     *
     * @param string $value
     * @return bool
     */
    function isEncrypted($value)
    {
        try {
            // Attempt to decrypt; if successful, it's encrypted
            Crypt::decrypt($value);
            return true;
        } catch (DecryptException $e) {
            // If decryption fails, it's not encrypted
            return false;
        }
    }
}
