<?php
namespace Samdjstevens\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\ResponseInterface;

class Spotify extends AbstractProvider
{
    /**
     * @inheritdoc
     * @return string
     */
    public function getBaseAuthorizationUrl()
    {
        return 'https://accounts.spotify.com/authorize';
    }

    /**
     * @inheritdoc
     * @param array $params
     * @return string
     */
    public function getBaseAccessTokenUrl(array $params)
    {
        return 'https://accounts.spotify.com/api/token';
    }

    /**
     * @inheritdoc
     * @param \League\OAuth2\Client\Token\AccessToken $token
     * @return string
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return 'https://api.spotify.com/v1/me?access_token=' . $token->getToken();
    }

    /**
     * @inheritdoc
     * @return array
     */
    protected function getDefaultScopes()
    {
        return join(' ', [
            'playlist-read-private',
            'playlist-read-collaborative',
            'user-follow-read',
            'user-library-read',
            'user-read-email',
            'user-top-read'
        ]);
    }

    /**
     * @inheritdoc
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param array|string $data
     * @throws \League\OAuth2\Client\Provider\Exception\IdentityProviderException
     */
    protected function checkResponse(ResponseInterface $response, $data)
    {
        if (! empty($data['error'])) {
            $message = $data['error'] . ': ' . $data['error_description'];
            throw new IdentityProviderException($message, 0, $data);
        }
    }

    /**
     * @inheritdoc
     * @param array $response
     * @param \League\OAuth2\Client\Token\AccessToken $token
     * @return \League\OAuth2\Client\Provider\ResourceOwnerInterface
     */
    protected function createResourceOwner(array $response, AccessToken $token)
    {
        $user = new SpotifyUser();
        $user->setId($response['id']);
        $user->setEmail($response['email']);
        $user->setDisplayName($response['display_name']);

        return $user;
    }
}
