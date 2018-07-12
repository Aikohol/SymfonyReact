<?php
namespace AppBundle\Security;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class CorsListener extends KernelEvent
{
	public function onKernelResponse(FilterResponseEvent $event)
	{
		$responseHeaders = $event->getResponse()->headers;

		$responseHeaders->set('Access-Control-Allow-Headers', 'origin, content-type, accept, credentials');
		$responseHeaders->set('Access-Control-Allow-Origin', '*');
		$responseHeaders->set('Access-Control-Allow-Credentials', 'true');
		$responseHeaders->set('Access-Control-Allow-ContentType', 'true');
		$responseHeaders->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
	}
}
