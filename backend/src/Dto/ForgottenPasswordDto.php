<?php

namespace App\Dto;

use JMS\Serializer\Annotation as Serializer;

class ForgottenPasswordDto
{
    /**
     * @var string|null
     * @Serializer\Type("string")
     */
    private $username;
    
    /**
     * @var string|null
     * @Serializer\Type("string")
     */
    private $email;

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }
}