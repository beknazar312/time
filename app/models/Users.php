<?php

/*
  +------------------------------------------------------------------------+
  | Vökuró                                                                 |
  +------------------------------------------------------------------------+
  | Copyright (c) 2016-present Phalcon Team (https://www.phalconphp.com)   |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
*/

namespace Time\Models;

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;

/**
 * All the users registered in the application
 * Vokuro\Models\Users
 * @method static Users findFirstById($id)
 * @method static Users findFirstByEmail($email)
 * @package Vokuro\Models
 */
class Users extends Model
{
    /** @var integer */
    public $id;

    /** @var string */
    public $name;

    /** @var string */
    public $email;

    /** @var string */
    public $password;

    /** @var string */
    public $active;
    
    public function validation()
    {
        $validator = new Validation();

        $validator->add('email', new Uniqueness([
            "message" => "The email is already registered"
        ]));

        return $this->validate($validator);
    }
   
}
