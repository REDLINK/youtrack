<?php

namespace YouTrack;

class OwnedField extends BundleElement
{

    /** @var string */
    private $owner;

    /**
     * @param \SimpleXMLElement|null $xml
     * @param Connection|null        $youtrack
     */
    public function __construct(\SimpleXMLElement $xml = null, Connection $youtrack = null)
    {
        parent::__construct('ownedField', $xml, $youtrack);
    }

    /**
     * @param \SimpleXMLElement $xml
     */
    protected function updateSpecificAttributes(\SimpleXMLElement $xml)
    {
        $this->owner = (string)$xml['owner'];
    }

    /**
     * @return string
     */
    public function getOwner()
    {
        return $this->owner;
    }
}