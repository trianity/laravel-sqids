<?php

test('demo', function () {
    expect(true)->toBeTrue();
});

test('confirm environment is set to testing', function () {
    expect(config('app.env'))->toBe('testing');
});
