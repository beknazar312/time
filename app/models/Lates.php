<?php


namespace Time\Models;

use Phalcon\Mvc\Model;

/**
 * SuccessLogins. This model registers successfull logins registered users have made
 * Vokuro\Models\SuccessLogins
 * @package Vokuro\Models
 */
class Lates extends Model
{
    /** @var integer */
    public $id;

    /** @var integer */
    public $usersId;

    /** @var timestamps */
    public $createdAt;


    public function initialize()
    {
        $this->belongsTo('usersId', __NAMESPACE__ . '\Users', 'id', [
            'alias' => 'user'
        ]);
    }
}