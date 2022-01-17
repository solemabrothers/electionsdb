<?php


namespace App\Models;


class RegionalVoting
{

    /**
 *
* public $objectname;
    * public $objectvalue;
    * public $target;
 *
* /**
     * PieChart constructor.
     * @param $areaCode
     * @param $objectvalue
     */
//    public function __construct($objectname, $objectvalue)
//    {
//        $this->objectname = $objectname;
//        $this->objectvalue = $objectvalue;
//    }
    public function __construct($areaCode, $objectvalue, $target)
    {
        $this->objectname = $areaCode;
        $this->objectvalue = $objectvalue;
        $this->target = $target;
    }

    /**
     * @return mixed
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param mixed $target
     */
    public function setTarget($target)
    {
        $this->target = $target;
    }

    /**
     * @return mixed
     */
    public function getObjectname()
    {
        return $this->objectname;
    }

    /**
     * @param mixed $objectname
     */
    public function setObjectname($objectname)
    {
        $this->objectname = $objectname;
    }

    /**
     * @return mixed
     */
    public function getObjectvalue()
    {
        return $this->objectvalue;
    }

    /**
     * @param mixed $objectvalue
     */
    public function setObjectvalue($objectvalue)
    {
        $this->objectvalue = $objectvalue;
    }


}