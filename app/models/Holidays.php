<?php


namespace Time\Models;

use Phalcon\Mvc\Model;

/**
 * SuccessLogins. This model registers successfull logins registered users have made
 * Vokuro\Models\SuccessLogins
 * @package Vokuro\Models
 */
class Holidays extends Model
{
    /** @var integer */
    public $id;

    /** @var date */
    public $date;

    /** @var string */
    public $repeatDate;

    /** @var date */
    public $createdAt;

}