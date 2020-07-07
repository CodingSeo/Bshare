<?php

namespace App\Auth;

class JWTAttemptUser
{
    /**
     * @var AuthUser
     */
    public $authUser;
    /**
     * @var string
     */
    public $token;
    /**
     * @var array
     */
    public $payload;

    public function __construct(AuthUser $authUser)
    {
        $this->authUser = $authUser;
    }

    /**
     * Get the value of authUser
     *`
     * @return  AuthUser
     */
    public function getAuthUser()
    {
        return $this->authUser;
    }

    /**
     * Set the value of authUser
     *`
     * @param AuthUser $authUser
     *
     * @return  self
     */
    public function setAuthUser(AuthUser $authUser)
    {
        $this->authUser = $authUser;

        return $this;
    }


    /**
     * Get the value of token
     *
     * @return  string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @param string $token
     *
     * @return  self
     */
    public function setToken(string $token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get the value of payload
     *
     * @return  array
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * Set the value of payload
     *
     * @param array $payload
     *
     * @return  self
     */
    public function setPayload(array $payload)
    {
        $this->payload = $payload;

        return $this;
    }
}
