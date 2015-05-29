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

    public function testGetResponseHeaders()
    {
        $con = new TestConnection();
        $refl = new \ReflectionClass('\YouTrack\TestConnection');
        $method = $refl->getMethod('getResponseHeaders');
        $method->setAccessible(true);

        $http_response_header = <<<ABC
HTTP/1.1 201 Created
Date: Fri, 29 May 2015 07:36:05 GMT
Server: Jetty(8.y.z-SNAPSHOT)
Strict-Transport-Security: max-age=15552000
Vary: Accept-Encoding,User-Agent
Location: https://issues.myserver.de/rest/issue/ST-26
Content-Type: application/xml; charset=UTF-8
Access-Control-Expose-Headers: Location
Cache-Control: no-cache, no-store, no-transform, must-revalidate
Content-Length: 0
X-UA-Compatible: IE=edge


ABC;

        $headers = $method->invoke($con, $http_response_header);

        $this->assertCount(10, $headers);
        $this->assertEquals('https://issues.myserver.de/rest/issue/ST-26', $headers['Location']);
    }
}
