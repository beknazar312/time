<?php


namespace Time\Models;

use Phalcon\Mvc\Model;

/**
 * Holidays. This model registers days when we dont work
 * Time\Models\Holidays
 * @package Time\Models
 */
class Holidays extends Model
{
    /** @var integer */
    public $id;

    /** @var date */
    public $date;

    /** @var string */
    public $repeate;

    /** @var date */
    public $createdAt;

}