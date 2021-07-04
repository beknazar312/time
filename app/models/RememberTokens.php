<?php

namespace Time\Models;

use Phalcon\Mvc\Model;

/**
 * RememberTokens. Stores the remember me tokens
 * Time\Models\RememberTokens
 * @package Time\Models
 */
class RememberTokens extends Model
{
    /** @var integer */
    public $id;

    /** @var integer */
    public $usersId;

    /** @var string */
    public $token;

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
