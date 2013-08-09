<?php
/**
 * Author: Paul Seleznev
 * Date: 8/08/2013
 */
namespace Art\BreadcrumbsBundle\Tests\Builder;

use Art\BreadcrumbsBundle\Builder\YMLBuilder;

class YMLBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Art\BreadcrumbsBundle\Exception\InvalidSchemaException
     */
    public function testWithInvalidSchema()
    {
        $router = $this->getMock('Symfony\Component\Routing\RouterInterface');
        $ymlBuilder = new YMLBuilder($router, 'schmea.xml');
        $ymlBuilder->build();
    }

    /**
     * @expectedException        \Exception
     * @expectedExceptionMessage This builder(Art\BreadcrumbsBundle\Builder\YMLBuilder) should be used only in request scope
     */
    public function testWithoutRequestObject()
    {
        $router = $this->getMock('Symfony\Component\Routing\RouterInterface');
        $ymlBuilder = new YMLBuilder($router, 'Tests/schema.yml');
        $ymlBuilder->build();
    }

    public function testReturningBreadcrumbs()
    {
        $compiledRoute = $this->getMockBuilder('Symfony\Component\Routing\CompiledRoute')
            ->disableOriginalConstructor()
            ->getMock();
        $compiledRoute->expects($this->any())
            ->method('getVariables')
            ->will($this->returnValue(array()));
        $route = $this->getMockBuilder('Symfony\Component\Routing\Route')
            ->disableOriginalConstructor()
            ->getMock();
        $route->expects($this->any())
            ->method('compile')
            ->will($this->returnValue($compiledRoute));
        $routeCollection = $this->getMock('Symfony\Component\Routing\RouteCollection');
        $routeCollection->expects($this->any())
            ->method('get')
            ->will($this->returnValue($route));

        $router = $this->getMock('Symfony\Component\Routing\RouterInterface');
        $router->expects($this->any())
            ->method('getRouteCollection')
            ->will($this->returnValue($routeCollection));

        $request = $this->getMock('Symfony\Component\HttpFoundation\Request');
        $request->expects($this->any())
            ->method('get')
            ->will($this->returnValue('children_children_1'));
        $ymlBuilder = new YMLBuilder($router, 'Tests/schema.yml');
        $ymlBuilder->setRequest($request);
        $breadcrumbs = $ymlBuilder->build();

        $this->assertCount(3, $breadcrumbs);
        $this->assertEquals('home', $breadcrumbs[0]['label']);
        $this->assertEquals('children_1', $breadcrumbs[1]['label']);
        $this->assertEquals('children_children_1', $breadcrumbs[2]['label']);
    }
}