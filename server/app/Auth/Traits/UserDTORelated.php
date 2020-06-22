<?php

namespace App\Auth\Traits;

use App\DTO\UserDTO;

trait UserDTORelated
{
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function FromUserDTO(UserDTO $userDTO)
    {
        $authuser = new self((array) $userDTO,
            'email',
            'password',
        );
        return $authuser;
    }

}
