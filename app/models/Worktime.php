<?php


namespace Time\Models;

use Phalcon\Mvc\Model;

/**
 * Worktime. This model registers what time workday start
 * Time\Models\Worktime
 * @package Time\Models
 */
class Worktime extends Model
{
    /** @var integer */
    public $id;

    /** @var time */
    public $time;

}