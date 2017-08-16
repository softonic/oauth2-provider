<?php

namespace Softonic\OAuth2\Client\Provider\Test;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Softonic\OAuth2\Client\Provider\Softonic;

class SoftonicTest extends TestCase
{
    private $provider;

    public function setUp()
    {
        $this->provider = new Softonic();
    }

    public function testGetBaseAuthorizationUrl()
    {
        $expectedUrl = 'https://oauth-v2.softonic.com/authorize';
        $this->assertSame($expectedUrl, $this->provider->getBaseAuthorizationUrl());
    }

    public function testGetBaseAccessTokenUrl()
    {
        $expectedUrl = 'https://oauth-v2.softonic.com/token';
        $this->assertSame($expectedUrl, $this->provider->getBaseAccessTokenUrl([]));
    }

    public function testGetResourceOwnerDetailsUrl()
    {
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('Method not implemented.');

        $accessToken = new AccessToken(['access_token' => 'foobar']);
        $this->provider->getResourceOwnerDetailsUrl($accessToken);
    }

    public function testGetDefaultScopes()
    {
        $this->provider = new class() extends Softonic {
            public function getDefaultScopes()
            {
                return parent::getDefaultScopes();
            }
        };

        $this->assertSame([], $this->provider->getDefaultScopes());
    }

    public function testCheckResponseWhenTheResponseIsValidShouldNotThrowAnException()
    {
        $this->provider = new class() extends Softonic {
            public function checkResponse(ResponseInterface $response, $data)
            {
                parent::checkResponse($response, $data);
            }
        };

        $response = $this->createMock(ResponseInterface::class);
        $this->assertNull($this->provider->checkResponse($response, []));
    }

    public function testCheckResponseWhenTheResponseContainsErrorsShouldThrowAIdentityProviderException()
    {
        $parsedResponse = [
            'error' => 'invalid_client',
            'error_description' => 'The client credentials are invalid',
        ];
        $this->provider = new class() extends Softonic {
            public function checkResponse(ResponseInterface $response, $data)
            {
                parent::checkResponse($response, $data);
            }
        };

        $this->expectException(IdentityProviderException::class);
        $this->expectExceptionMessage('The client credentials are invalid');
        $this->expectExceptionCode(500);

        $response = $this->createMock(ResponseInterface::class);
        $response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(500);
        $this->assertNull($this->provider->checkResponse($response, $parsedResponse));
    }

    public function testCheckResponseWhenTheResponseScopeMissingShouldThrowAIdentityProviderException()
    {
        $parsedResponse = [
            'status' => false,
            'message' => 'We are sorry, but something went terribly wrong.',
            'exception' => 'Missing request scopes',
        ];
        $this->provider = new class() extends Softonic {
            public function checkResponse(ResponseInterface $response, $data)
            {
                parent::checkResponse($response, $data);
            }
        };

        $this->expectException(IdentityProviderException::class);
        $this->expectExceptionMessage('Missing request scopes');
        $this->expectExceptionCode(500);

        $response = $this->createMock(ResponseInterface::class);
        $response->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(500);
        $this->assertNull($this->provider->checkResponse($response, $parsedResponse));
    }

    public function testCreateResourceOwner()
    {
        $this->provider = new class() extends Softonic {
            public function createResourceOwner(array $response, AccessToken $token)
            {
                return parent::createResourceOwner($response, $token);
            }
        };
        $response = [];
        $accessToken = new AccessToken(['access_token' => 'foobar']);
        $this->assertInstanceOf(
            \League\OAuth2\Client\Provider\ResourceOwnerInterface::class,
            $this->provider->createResourceOwner($response, $accessToken)
        );
    }
}
