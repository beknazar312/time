<?php

namespace Time\Models;

use Phalcon\Mvc\Model;

/**
 * PasswordChanges. Register when a user changes his/her password
 * Time\Models\PasswordChanges
 * @package Time\Models
 */
class PasswordChanges extends Model
{
    /** @var integer */
    public $id;

    /** @var integer */
    public $usersId;

    /** @var string */
    public $ipAddress;

    /** @var string */
    public $userAgent;

    /** @var integer */
    public $createdAt;

    /**
     * Before create the user assign a password
     */
    public function beforeValidationOnCreate()
    {
        // Timestamp the confirmaton
        $this->createdAt = time();
    }

    public function initialize()
    {
        $this->belongsTo('usersId', __NAMESPACE__ . '\Users', 'id', [
            'alias' => 'user'
        ]);
    }
}
