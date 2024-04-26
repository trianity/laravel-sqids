<?php

use Trianity\Sqids\SqidsFactory;

beforeEach(function () {
    $this->sqids = new SqidsFactory();
    $this->lengthSq = new SqidsFactory(minLength: 24);
    $this->alphaSq = new SqidsFactory(alphabet: config('sqids.alphabet'));
});

it('can encode and decode an numeric ids using dependency injection', function (int $numId) {

    $coded = $this->sqids->encode([$numId]);

    expect($coded)
        ->toBeString();

    $decoded = $this->sqids->decode($coded);

    expect($decoded)
        ->toBeArray()
        ->toContain($numId);

    expect(true)->toBeTrue();

})->with([12, 324, 5147, 83245, 912365, 1234567, 23456789]);

it('can encode and decode an numeric ids giving minlength', function (int $numId) {

    $coded = $this->lengthSq->encode([$numId]);

    expect($coded)
        ->toBeString();

    $decoded = $this->lengthSq->decode($coded);

    expect($decoded)
        ->toBeArray()
        ->toContain($numId);

    expect(true)->toBeTrue();

})->with([12, 324, 5147, 83245, 912365, 1234567, 23456789]);

it('can encode and decode an numeric ids giving string', function (int $numId) {

    $coded = $this->alphaSq->encode([$numId]);

    expect($coded)
        ->toBeString();

    $decoded = $this->alphaSq->decode($coded);

    expect($decoded)
        ->toBeArray()
        ->toContain($numId);

    expect(true)->toBeTrue();

})->with([12, 324, 5147, 83245, 912365, 1234567, 23456789]);
