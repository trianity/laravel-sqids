<?php

declare(strict_types=1);

namespace Trianity\Sqids;

use Sqids\Sqids;

class SqidsFactory
{
    protected Sqids $sqids;

    public function __construct(
        protected string $alphabet = '',
        protected int $minLength = 0,
        protected array $blocklist = []
    ) {
        $localBlockList = array_merge(config('sqids.blocklist'), $blocklist);
        $defaultLength = intval(config('sqids.minLength'));
        $defaultAlphabet = strval(config('sqids.alphabet'));
        $case = 10;
        $minLengthLimit = 250;
        if (
            ! is_int($minLength) ||
            $minLength < 3 ||
            $minLength > $minLengthLimit
        ) {
            //No or wrong input, we are using the default minLength from config
            $minLength = $defaultLength;
            $case = 0;
        }
        if (count($localBlockList) > 0) {
            $case += 1;
        }
        if (strlen($alphabet) > 0 && strlen($alphabet) < 4) {
            //Wrong input, we are using the default Alphabet from config
            $alphabet = $defaultAlphabet;
            $case += 100;
        }
        if (strlen($alphabet) > 3) {
            $case += 1000;
        }

        switch ($case) {
            case 0:
            case 10:
                $this->sqids = new Sqids(minLength: $minLength);
                break;
            case 1:
            case 11:
                $this->sqids = new Sqids(minLength: $minLength, blocklist: $localBlockList);
                break;
            case 100:
            case 1000:
                $this->sqids = new Sqids(alphabet: $alphabet, minLength: $minLength);
                break;
            case 101:
            case 111:
            case 1011:
            case 1001:
                $this->sqids = new Sqids(alphabet: $alphabet, minLength: $minLength, blocklist: $localBlockList);
                break;
            default:
                $this->sqids = new Sqids(minLength: $defaultLength);
        }
    }

    /**
     * @param  array<int, int>  $ids
     */
    public function encode(array $ids): string
    {
        return $this->sqids->encode($ids);
    }

    /**
     * @return array<int, int>
     */
    public function decode(string $code): array
    {
        return $this->sqids->decode($code);
    }
}
