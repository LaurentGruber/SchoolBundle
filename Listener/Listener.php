<?php

namespace Laurent\SchoolBundle\Listener;

use Claroline\CoreBundle\Event\DisplayToolEvent;
use Claroline\CoreBundle\Event\DisplayWidgetEvent;
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
    public function onOpenAdminTool(DisplayToolEvent $event)
    {
        $content= 'toto';
        $event->setContent($content);
        $event->stopPropagation();
    }

    /**
     * @param DisplayWidgetEvent $event
     * @DI\Observe("widget_laurent_school_prof_menu_widget")
     */
    public function onDisplayProfMenu(DisplayWidgetEvent $event)
    {
        $twig = $this->container->get('templating');
        $content = $twig->render('LaurentSchoolBundle::profMenuWidgetLayout.html.twig');
        $event->setContent($content);
        $event->stopPropagation();
    }
    /**
     * @param DisplayWidgetEvent $event
     * @DI\Observe("widget_laurent_school_prof_menu_classes_widget")
     */
    public function onDisplayProfMenuClasses(DisplayWidgetEvent $event)
    {
        $event->setContent('Toto');
        $event->stopPropagation();
    }

}
