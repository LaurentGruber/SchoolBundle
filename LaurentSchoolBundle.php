<?php

namespace Laurent\SchoolBundle;

use Claroline\CoreBundle\Library\PluginBundle;
use Claroline\KernelBundle\Bundle\ConfigurationBuilder;


class LaurentSchoolBundle extends PluginBundle
{
    public function getConfiguration($environment)
    {
        $config = new ConfigurationBuilder();
        return $config->addRoutingResource(__DIR__.'/Resources/config/routing.yml', null,'school');
    }
    public function hasMigrations()
    {
        return true;
    }

    public function getRequiredFixturesDirectory($env){
        return 'DataFixtures/Required';
    }
}

?>