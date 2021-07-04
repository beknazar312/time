<?php


namespace Time\Models;

use Phalcon\Mvc\Model;

/**
 * Lates. This model registers pupils who late
 * Time\Models\Lates
 * @package Time\Models
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