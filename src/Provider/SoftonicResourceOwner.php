<?php

namespace Softonic\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class SoftonicResourceOwner implements ResourceOwnerInterface
{
    /**
     * Returns the identifier of the authorized resource owner.
     *
     * @return mixed
     */
    public function getId()
    {
        throw new \BadMethodCallException('Method not implemented yet.');
    }

    /**
     * Return all of the owner details available as an array.
     *
     * @return array
     */
    public function toArray()
    {
        throw new \BadMethodCallException('Method not implemented yet.');
    }
}
