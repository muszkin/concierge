<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 13.04.17
 * Time: 12:44
 */

namespace AppBundle\Services\Export;


use AppBundle\Services\Provider\ConciergeProviderInterface;

class ArrayExporter implements ExporterInterface
{
    private $conciergeProvider;

    public function __construct(ConciergeProviderInterface $conciergeProvider)
    {
        $this->conciergeProvider = $conciergeProvider;
    }

    public function doExport($team, $licenses)
    {
        $return = $this->conciergeProvider->exportAllData($team,$licenses);

        return $return;
    }
}