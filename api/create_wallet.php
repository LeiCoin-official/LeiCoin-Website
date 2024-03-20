<?php

header('Content-Type: application/json; charset=utf-8');

// Generate a new Ed25519 key pair
function generateEd25519KeyPair() {
    if (!function_exists('sodium_crypto_sign_keypair')) {
        throw new Exception('Sodium extension not available.');
    }

    $keyPair = sodium_crypto_sign_keypair();
    $publicKey = sodium_crypto_sign_publickey($keyPair);
    $secretKey = sodium_crypto_sign_secretkey($keyPair);

    return array(
        'publicKey' => $publicKey,
        'secretKey' => substr($secretKey, 0, 64)
    );
}

try {
    $keyPair = generateEd25519KeyPair();
    $publicKeyHex = bin2hex($keyPair['publicKey']);
    $secretKeyHex = bin2hex($keyPair['secretKey']);

    // Generate address from the public key
    $address = "lc0x" . substr(hash("sha256", $publicKeyHex), 0, 38);

    echo json_encode(array(
        "address" => $address,
        "public_key" => $publicKeyHex,
        "private_key" => $secretKeyHex,
    ));
} catch (Exception $e) {
    echo json_encode(array(
        "error" => $e->getMessage()
    ));
}

?>
