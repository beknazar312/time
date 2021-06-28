<?php
namespace Time\Validation;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Identical;


class LoginValidation extends Validation
{
    public function initialize()
    {
        $this->add(
            'email',
            new PresenceOf(
                [
                    'message' => 'The e-mail is required',
                ]
            )
        );

        $this->add(
            'email',
            new Email(
                [
                    'message' => 'The e-mail is not valid',
                ]
            )
        );

        $this->add(
            'password',
            new PresenceOf(
                [
                    'message' => 'The password is required',
                ]
            )
        );

        $this->add(
            'csrf',
            new Identical(
                [
                    'value' => $this->security->getSessionToken(),
                    'message' => 'CSRF validation failed'
                ]
            )
        );

    }
}