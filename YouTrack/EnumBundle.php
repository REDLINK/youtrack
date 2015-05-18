<?php
namespace YouTrack;

class EnumBundle extends Bundle
{

    /**
     * @param \SimpleXMLElement|null $xml
     * @param Connection|null        $youtrack
     */
    public function __construct(\SimpleXMLElement $xml = null, Connection $youtrack = null)
    {
        parent::__construct('value', 'enumeration', $xml, $youtrack);
    }

    /**
     * @param \SimpleXMLElement $xml
     * @param Connection|null   $youtrack
     *
     * @return OwnedField
     */
    protected function createElement(\SimpleXMLElement $xml, Connection $youtrack = null)
    {
        return new EnumField($xml, $youtrack);
    }
}
