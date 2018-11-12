<?php


namespace App\Dto;


use JMS\Serializer\Annotation as Serializer;

class PasswordDto
{
    /**
     * @Serializer\Type("string")
     *
     * @var string
     */
    private $password;

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}