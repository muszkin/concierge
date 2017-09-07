<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 13.04.17
 * Time: 12:34
 */

namespace AppBundle\Services\Export;

use AppBundle\Services\Provider\ConciergeProviderInterface;

interface ExporterInterface
{
    public function __construct(ConciergeProviderInterface $conciergeProvider);

    public function doExport($team,$licenses);

}