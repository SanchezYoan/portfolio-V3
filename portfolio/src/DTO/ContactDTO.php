<?php

namespace App\DTO;
use Symfony\Component\Validator\Constraints as Assert;

class ContactDTO
{
    public function __construct(

         #[Assert\NotBlank(message: 'Le nom ne peut pas être vide.')]
        #[Assert\Length(min: 3, max: 50, minMessage: 'Le nom doit comporter au moins {{ limit }} caractères.', maxMessage: 'Le nom ne peut pas dépasser {{ limit }} caractères.')]
        public string $name = '',

        #[Assert\NotBlank(message: 'L\'email ne peut pas être vide.')]
        #[Assert\Email(message: 'L\'email n\'est pas valide.')]
        public string $email = '',
        #[Assert\NotBlank(message: 'Le message ne peut pas être vide.')]
        #[Assert\Length(min: 10, max: 1000, minMessage: 'Le message doit comporter au moins {{ limit }} caractères.', maxMessage: 'Le message ne peut pas dépasser {{ limit }} caractères.')]
        public string $message = '',
    ) {
    }
}