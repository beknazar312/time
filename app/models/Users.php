<?php

namespace Time\Models;

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;

/**
 * All the users registered in the application
 * Time\Models\Users
 * @method static Users findFirstById($id)
 * @method static Users findFirstByEmail($email)
 * @package Time\Models
 */
class Users extends Model
{
    /** @var integer */
    public $id;

    /** @var string */
    public $name;

    /** @var string */
    public $login;

    /** @var string */
    public $email;

    /** @var string */
    public $password;

    /** @var string */
    public $profilesId;

    /** @var string */
    public $active;

    

    /**
     * Validate that emails are unique across users
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add('email', new Uniqueness([
            "message" => "The email is already registered"
        ]));

        return $this->validate($validator);
    }

    public function initialize()
    {
        $this->belongsTo('profilesId', __NAMESPACE__ . '\Profiles', 'id', [
            'alias' => 'profile',
            'reusable' => true
        ]);

        $this->hasMany('id', __NAMESPACE__ . '\SuccessLogins', 'usersId', [
            'alias' => 'successLogins',
            'foreignKey' => [
                'message' => 'User cannot be deleted because he/she has activity in the system'
            ]
        ]);

        $this->hasMany('id', __NAMESPACE__ . '\PasswordChanges', 'usersId', [
            'alias' => 'passwordChanges',
            'foreignKey' => [
                'message' => 'User cannot be deleted because he/she has activity in the system'
            ]
        ]);

        $this->hasMany('id', __NAMESPACE__ . '\ResetPasswords', 'usersId', [
            'alias' => 'resetPasswords',
            'foreignKey' => [
                'message' => 'User cannot be deleted because he/she has activity in the system'
            ]
        ]);

        $this->hasMany('id', __NAMESPACE__ . '\Timer', 'usersId', [
            'alias' => 'timer',
            'foreignKey' => [
                'message' => 'User cannot be deleted because he/she has activity in the system'
            ]
        ]);
    }
}
