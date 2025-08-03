<?php

namespace Antikirra;

use InvalidArgumentException;

/**
 * @param int $userId
 * @param int $seed
 * @return string
 */
function beast($userId, $seed = 0)
{
    static $adjective = [];
    static $noun = [];

    static $adjectiveCount = 0;
    static $nounCount = 0;

    if (!is_int($userId) || $userId < 1) {
        throw new InvalidArgumentException(
            sprintf('Expected positive integer for userId, got %s', gettype($userId))
        );
    }

    if (!is_int($seed)) {
        throw new InvalidArgumentException(
            sprintf('Expected integer for seed, got %s', gettype($seed))
        );
    }

    if (empty($adjective)) {
        $adjective = require __DIR__ . '/data/adjective.php';
        $adjectiveCount = count($adjective);
    }

    if (empty($noun)) {
        $noun = require __DIR__ . '/data/noun.php';
        $nounCount = count($noun);
    }

    $hash = crc32("^{$seed}#{$userId}$");

    return $adjective[$hash % $adjectiveCount] . ' ' . $noun[($hash >> 16) % $nounCount];
}
