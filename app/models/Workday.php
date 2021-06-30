<?php


namespace Time\Models;

use Phalcon\Mvc\Model;

/**
 * SuccessLogins. This model registers successfull logins registered users have made
 * Vokuro\Models\SuccessLogins
 * @package Vokuro\Models
 */
class Workday extends Model
{
    /** @var integer */
    public $id;

    /** @var time */
    public $time;

}