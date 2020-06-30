<?php

namespace App\Providers;

// namespace Laravel\Socialite\Two;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class HiworksProvider extends AbstractProvider implements ProviderInterface
{
    // /**
    //  * The scopes being requested.
    //  *
    //  * @var array
    //  */
    // protected $scopes = ['user:email'];
    /**
     * Get the GET parameters for the code request.
     *
     * @param  string|null  $state
     * @return array
     */
    protected function getCodeFields($state = null)
    {
        $fields = [
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUrl,
            'response_type' => 'code',
            'access_type' => 'offline'
        ];
        if ($this->usesState()) {
            $fields['state'] = $state;
        }
        return array_merge($fields, $this->parameters);
    }

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://api.hiworks.com/open/auth/authform', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return 'https://api.hiworks.com/open/auth/accesstoken';
    }

    /**
     * {@inheritdoc}
     */
    public function getAccessTokenResponse($code)
    {
        $postKey =  'form_params';

        $response = $this->getHttpClient()->post($this->getTokenUrl(), [
            'headers' => ['Accept' => 'application/json'],
            $postKey => $this->getTokenFields($code),
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * Get the POST fields for the token request.
     *
     * @param  string  $code
     * @return array
     */
    protected function getTokenFields($code)
    {
        return [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type' => 'refresh_token',
            'auth_code' => $code,
            'access_type' => 'offline',
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $userUrl = 'https://api.hiworks.com/user/v2/me';

        $response = $this->getHttpClient()->get([
            'header' => [
                'Authorization' => 'Bearer' . $token,
                'Content-Type' => 'application/json'
            ],
        ]);
        return json_decode($response->getBody(), true);
    }

    ////////////////////////////////////////map을 원할하게 할것인가?
    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        return (new User)->setRaw($user)->map([
            'id' => $user['user_id'],
            'name' => $user['name'],
            'user_num' => $user['no'],
        ]);
    }
}
