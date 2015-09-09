<?php

namespace YouTrack;

class EnumField extends BundleElement
{

    /**
     * @param \SimpleXMLElement|null $xml
     * @param Connection|null        $youtrack
     */
    public function __construct(\SimpleXMLElement $xml = null, Connection $youtrack = null)
    {
        parent::__construct('value', $xml, $youtrack);
    }
}