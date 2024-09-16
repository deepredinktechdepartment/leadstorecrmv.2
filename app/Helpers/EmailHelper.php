<?php

namespace App\Helpers;

class EmailHelper
{
    /**
     * Check if the domain of the given email address is valid.
     *
     * @param string $email
     * @return bool
     */



    public static function isDomainValid($email)
{
    $domain = substr(strrchr($email, "@"), 1);


    // Check for MX records
    $mxRecords = dns_get_record($domain, DNS_MX);
    dd($mxRecords);
    if (!empty($mxRecords)) {
        return true;
    }

    // Check for A records
    $aRecords = dns_get_record($domain, DNS_A);
    if (!empty($aRecords)) {
        return true;
    }


    return false;
}
}
