<?php

namespace Softonic\OAuth2\Client\Provider;

use PHPUnit\Framework\TestCase;

class SoftonicResourceOwnerTest extends TestCase
{
    public function testGetIdIsNotImplemented()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('Method not implemented yet.');

        $resourceOwner = new SoftonicResourceOwner();
        $resourceOwner->getId();
    }

    public function testToArrayIsNotImplemented()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('Method not implemented yet.');

        $resourceOwner = new SoftonicResourceOwner();
        $resourceOwner->toArray();
    }
}
