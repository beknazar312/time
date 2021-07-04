<?php

namespace Time\Models;

use Phalcon\Mvc\Model;

/**
 * FailedLogins. This model registers unsuccessfull logins registered and non-registered users have made
 * Time\Models\FailedLogins
 * @package Time\Models
 */
class FailedLogins extends Model
{
    /** @var integer */
    public $id;

    /** @var integer */
    public $usersId;

    /** @var string */
    public $ipAddress;

    /** @var integer */
    public $attempted;

    public function initialize()
    {
        $this->belongsTo('usersId', __NAMESPACE__ . '\Users', 'id', [
            'alias' => 'user'
        ]);
    }
}
