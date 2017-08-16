<?php

namespace Softonic\OAuth2\Client\Provider\Test;

use PHPUnit\Framework\TestCase;
use Softonic\OAuth2\Client\Provider\SoftonicResourceOwner;

class SoftonicResourceOwnerTest extends TestCase
{
    public function testGetIdIsNotImplemented()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('Method not implemented yet.');

        $resourceOwner = new SoftonicResourceOwner();
        $resourceOwner->getId();
    }

    public function testToArayIsNotImplemented()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('Method not implemented yet.');

        $resourceOwner = new SoftonicResourceOwner();
        $resourceOwner->toArray();
    }
}
