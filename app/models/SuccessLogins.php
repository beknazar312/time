<?php

namespace Time\Models;

use Phalcon\Mvc\Model;

/**
 * SuccessLogins. This model registers successfull logins registered users have made
 * Time\Models\SuccessLogins
 * @package Time\Models
 */
class SuccessLogins extends Model
{
    /** @var integer */
    public $id;

    /** @var integer */
    public $usersId;

    /** @var string */
    public $ipAddress;

    /** @var string */
    public $userAgent;

    public function initialize()
    {
        $this->belongsTo('usersId', __NAMESPACE__ . '\Users', 'id', [
            'alias' => 'user'
        ]);
    }
}
