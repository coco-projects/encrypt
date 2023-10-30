<?php

    declare(strict_types = 1);

    namespace Coco\encrypt;

class Encrypt
{
    /**
     * @param string $plainText Plain String
     * @param string $key       Working key provided by CCAvenue
     *
     * @return string Decrypted String
     */
    public static function encrypt(string $plainText, string $key): string
    {
        $key           = static::hextobin(md5($key));
        $initVector    = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $openMode      = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
        $encryptedText = bin2hex($openMode);

        return $encryptedText;
    }

    /**
     * @param string $encryptedText Encrypted String
     * @param string $key           Working key provided by CCAvenue
     *
     * @return string|bool Successful decryption returns the original string, while failed decryption returns false.
     */
    public static function decrypt(string $encryptedText, string $key): string|bool
    {
        $key           = static::hextobin(md5($key));
        $initVector    = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
        $encryptedText = static::hextobin($encryptedText);
        $decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);

        return $decryptedText;
    }

    /**
     * @param string $hexString
     *
     * @return string
     */
    protected static function hextobin(string $hexString): string
    {
        $length    = strlen($hexString);
        $binString = "";
        $count     = 0;
        while ($count < $length) {
            $subString = substr($hexString, $count, 2);
            @$packedString = pack("H*", $subString);

            if ($count == 0) {
                $binString = $packedString;
            } else {
                $binString .= $packedString;
            }

            $count += 2;
        }

        return $binString;
    }
}
