<?php

use Trianity\Sqids\Facades\Sqids;

it('can encode and decode an numeric id using facade', function (int $numId) {

    $coded = Sqids::encode([$numId]);

    expect($coded)
        ->toBeString();

    $decoded = Sqids::decode($coded);

    expect($decoded)
        ->toBeArray()
        ->toContain($numId);

    expect(true)->toBeTrue();

})->with([12, 324, 5147, 83245, 912365, 1234567, 23456789]);
