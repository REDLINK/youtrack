<?php

namespace YouTrack;

class OwnedFieldBundle extends Bundle
{

    /**
     * @param \SimpleXMLElement|null $xml
     * @param Connection|null        $youtrack
     */
    public function __construct(\SimpleXMLElement $xml = null, Connection $youtrack = null)
    {
        parent::__construct('ownedField', 'ownedFieldBundle', $xml, $youtrack);
    }

    /**
     * @param \SimpleXMLElement $xml
     * @param Connection|null   $youtrack
     *
     * @return OwnedField
     */
    protected function createElement(\SimpleXMLElement $xml, Connection $youtrack = null)
    {
        return new OwnedField($xml, $youtrack);
    }
}
