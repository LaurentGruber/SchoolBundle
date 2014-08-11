<?php

namespace Laurent\SchoolBundle\Listener;

use Claroline\CoreBundle\Event\DisplayToolEvent;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class Listener
 * @package Laurent\SchoolBundle\Listener
 * @DI\Service()
 */
class Listener
{
    private $container;

    /**
     * @param ContainerInterface $container
     * @DI\InjectParams({
     *      "container" = @DI\Inject("service_container"),
     * })
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    /**
     * @DI\Observe("open_administration_tool_laurent_school_admin_tool")
     */
    public function onOpen(DisplayToolEvent $event)
    {
        $event->setContent('Toto');
        $event->stopPropagation();
    }

}
