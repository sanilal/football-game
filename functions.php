<?php

function customEncrypt($data, $key = 'jZHK0OFSek6daFrykfT2wKwS4VaFXeOl+dT1Lqqj8KI=') {
    $iv = substr(hash('sha256', '8VDLsosIr0ehVqMRAjyLaw=='), 0, 16); // Fixed IV for consistency
    return base64_encode(openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv));
}

function customDecrypt($encryptedData, $key = '8VDLsosIr0ehVqMRAjyLaw==') {
    $iv = substr(hash('sha256', '8VDLsosIr0ehVqMRAjyLaw=='), 0, 16); // Same IV as encryption
    return openssl_decrypt(base64_decode($encryptedData), 'AES-256-CBC', $key, 0, $iv);
}

?>
