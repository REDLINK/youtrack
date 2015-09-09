<?php
namespace YouTrack;
require_once("requirements.php");
require_once("testconnection.php");

/**
 * Unit test for the connection class.
 *
 * @author Jens Jahnke <jan0sch@gmx.net>
 * @author Nepomuk Fraedrich <info@nepda.eu>
 * Created at: 31.03.11 12:35
 */
class ConnectionTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateConnection()
    {
        $con = new TestConnection();
    }

    public function testIncorrectLoginThrowsException()
    {
        $con = new TestConnection();
        $refl = new \ReflectionClass('\YouTrack\TestConnection');
        $method = $refl->getMethod('handleLoginResponse');
        $method->setAccessible(true);
        $content = file_get_contents('test/testdata/incorrect-login.http');
        $response = array(
            'http_code' => 403
        );
        $this->setExpectedException('\YouTrack\IncorrectLoginException');
        $method->invoke($con, $content, $response);
    }

    public function testGetFieldType()
    {
        $con = new TestConnection();

        $this->assertEquals('ownedField', $con->getFieldType('ownedField[1]'));
        $this->assertEquals('ownedField', $con->getFieldType('ownedField'));
    }
}
