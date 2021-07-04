<?php


namespace Time\Models;

use Phalcon\Mvc\Model;

/**
 * Timers. This model registers times when user click start and stop
 * Time\Models\Timerss
 * @package Time\Models
 */
class Timers extends Model
{
    /** @var integer */
    public $id;

    /** @var integer */
    public $usersId;

    /** @var time */
    public $start;

    /** @var time */
    public $stop;

    /** @var timestamp */
    public $createdAt;

    public function initialize()
    {
        $this->belongsTo('usersId', __NAMESPACE__ . '\Users', 'id', [
            'alias' => 'user'
        ]);
    }
}