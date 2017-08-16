<?php

namespace Softonic\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\ResponseInterface;

class Softonic extends AbstractProvider
{
    const OAUTH_HOSTNAME = 'oauth-v2.softonic.com';

    /**
     * Returns the base URL for authorizing a client.
     *
     * Eg. https://oauth.service.com/authorize
     *
     * @return string
     */
    public function getBaseAuthorizationUrl()
    {
        return 'https://' . static::OAUTH_HOSTNAME . '/authorize';
    }

    /**
     * Returns the base URL for requesting an access token.
     *
     * Eg. https://oauth.service.com/token
     *
     * @param array $params
     *
     * @return string
     */
    public function getBaseAccessTokenUrl(array $params)
    {
        return 'https://' . static::OAUTH_HOSTNAME . '/token';
    }

    /**
     * Returns the URL for requesting the resource owner's details.
     *
     * @param AccessToken $token
     *
     * @return string
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        throw new \BadMethodCallException('Method not implemented.');
    }

    /**
     * Returns the default scopes used by this provider.
     *
     * This should only be the scopes that are required to request the details
     * of the resource owner, rather than all the available scopes.
     *
     * @return array
     */
    protected function getDefaultScopes()
    {
        return [];
    }

    /**
     * Checks a provider response for errors.
     *
     * @param ResponseInterface $response
     * @param array|string      $data     Parsed response data
     *
     * @throws IdentityProviderException If parsed response data contains an error.
     */
    protected function checkResponse(ResponseInterface $response, $data)
    {
        $message = $this->getErrorMessage($data);

        if (!empty($message)) {
            throw new IdentityProviderException(
                $message,
                $response->getStatusCode(),
                $response
            );
        }
    }

    /**
     * Returns error message if any, otherwise null.
     *
     * @param array $parsedResponse
     *
     * @return string|null
     */
    private function getErrorMessage(array $parsedResponse)
    {
        if ($this->responseHasError($parsedResponse)) {
            return !empty($parsedResponse['exception']) ?
                 $parsedResponse['exception']
                 : $parsedResponse['error_description'];
        }

        return null;
    }

    /**
     * Returns true if response has any error.
     *
     * @param array $parsedResponse
     *
     * @return bool
     */
    private function responseHasError(array $parsedResponse)
    {
        return !empty($parsedResponse['exception']) ||
            !empty($parsedResponse['error_description']);
    }

    /**
     * Generates a resource owner object from a successful resource owner
     * details request.
     *
     * @param array       $response
     * @param AccessToken $token
     *
     * @return ResourceOwnerInterface
     */
    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new SoftonicResourceOwner($response);
    }
}
