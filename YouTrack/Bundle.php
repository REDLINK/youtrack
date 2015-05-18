<?php
namespace YouTrack;

abstract class Bundle extends Object
{

    protected $values = array();

    /**
     * @var \SimpleXMLElement
     */
    private $elementTagName;

    /**
     * @var Connection
     */
    private $bundleTagName;

    /**
     * @var string
     */
    private $name;

    /**
     * @param string                 $elementTagName
     * @param string                 $bundleTagName
     * @param \SimpleXMLElement|null $xml
     * @param Connection|null        $youtrack
     */
    public function __construct($elementTagName, $bundleTagName, \SimpleXMLElement $xml = null, Connection $youtrack = null)
    {
        $this->elementTagName = $elementTagName;
        $this->bundleTagName = $bundleTagName;
        parent::__construct($xml, $youtrack);
    }

    /**
     * @param \SimpleXMLElement $xml
     */
    protected function update($xml)
    {
        $this->name = (string)$xml['name'];
        foreach ($xml->children() as $element) {
            $this->values[] = $this->createElement($element, $this->youtrack);
        }
    }

    /**
     * @return BundleElement[]
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param \SimpleXMLElement $xml
     * @param Connection|null   $youtrack
     *
     * @return mixed
     */
    abstract protected function createElement(\SimpleXMLElement $xml, Connection $youtrack = null);

    /**
     * @return string
     */
    public function toXml()
    {
        $xml = sprintf('<%s name="%s">', $this->bundleTagName, utf8_encode($this->name));
        foreach ($this->values as $v) {
            $xml .= '<value>'. $v .'</value>';
        }
        $xml .= sprintf('</%s>', $this->bundleTagName);

        return $xml;
    }
}
