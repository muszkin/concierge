<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 13.04.17
 * Time: 12:38
 */

namespace AppBundle\Services\Provider;


interface ConciergeProviderInterface
{

    public function exportAllData($team,$licenses);
}