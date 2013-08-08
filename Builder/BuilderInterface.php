<?php
/**
 * Author: Paul Seleznev
 * Date: 4/08/2013
 */
namespace Art\BreadcrumbsBundle\Builder;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;

interface BuilderInterface
{
    public function build();
}