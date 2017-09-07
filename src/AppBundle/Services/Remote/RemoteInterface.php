<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 01.06.17
 * Time: 14:17
 */

namespace AppBundle\Services\Remote;


use DashboardBundle\Entity\Concierge;

interface RemoteInterface
{
    public function addNoteToClient(Concierge $concierge,$agent);

    public function init($config);

}