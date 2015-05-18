<?php
namespace YouTrack;

abstract class BundleElement extends Object
{

    /**
     * @var \SimpleXMLElement
     */
    private $elementTagName;

    /** @var string */
    private $name;

    /** @var string */
    private $description;

    /** @var int */
    private $colorIndex;

    /**
     * @param string                 $elementTagName
     * @param \SimpleXMLElement|null $xml
     * @param Connection|null        $youtrack
     */
    public function __construct($elementTagName, \SimpleXMLElement $xml = null, Connection $youtrack = null)
    {
        parent::__construct($xml, $youtrack);
        $this->elementTagName = $elementTagName;
    }

    /**
     * @param \SimpleXMLElement $xml
     */
    protected function update($xml)
    {
        $this->name = (string)$xml;
        $this->description = (string)$xml['description'];
        $this->colorIndex = (int)$xml['colorIndex'];

        $this->updateSpecificAttributes($xml);
    }

    /**
     * @param \SimpleXMLElement $xml
     */
    protected function updateSpecificAttributes(\SimpleXMLElement $xml)
    {
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getColorIndex()
    {
        return $this->colorIndex;
    }

    public function __toString()
    {
        return (string)$this->name;
    }
}
