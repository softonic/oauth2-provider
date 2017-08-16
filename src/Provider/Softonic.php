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
     * Get authorization url to begin OAuth flow
     *
     * @return string
     */
    public function getBaseAuthorizationUrl()
    {
        return 'https://' . static::OAUTH_HOSTNAME . '/authorize';
    }

    /**
     * Get access token url to retrieve token
     *
     * @param  array  $params
     * @return string
     */
    public function getBaseAccessTokenUrl(array $params)
    {
        return 'https://' . static::OAUTH_HOSTNAME . '/token';
    }

    /**
     * Get provider url to fetch user details
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
     * Get the default scopes used by this provider.
     *
     * This should not be a complete list of all scopes, but the minimum
     * required for the provider user interface!
     *
     * @return array
     */
    protected function getDefaultScopes()
    {
        return [];
    }

    /**
     * Check a provider response for errors.
     *
     * @param ResponseInterface $response
     * @param string            $data     Parsed response data
     *
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
     * Generate a user object from a successful user details request.
     *
     * @param object      $response
     * @param AccessToken $token
     *
     * @return SoftonicResourceOwner
     */
    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new SoftonicResourceOwner($response);
    }
}
