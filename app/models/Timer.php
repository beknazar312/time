<?php


namespace Time\Models;

use Phalcon\Mvc\Model;

/**
 * SuccessLogins. This model registers successfull logins registered users have made
 * Vokuro\Models\SuccessLogins
 * @package Vokuro\Models
 */
class Timer extends Model
{
    /** @var integer */
    public $id;

    /** @var integer */
    public $usersId;

    /** @var datetime */
    public $start;

    /** @var datetime */
    public $stop;

    public function initialize()
    {
        $this->belongsTo('usersId', __NAMESPACE__ . '\Users', 'id', [
            'alias' => 'user'
        ]);
    }
}