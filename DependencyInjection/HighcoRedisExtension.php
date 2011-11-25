<?php

namespace Highco\Bundle\RedisBundle\DependencyInjection;

use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class HighcoRedisExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->mergeConfigs($configs, $container->getParameter('kernel.debug'));

        $loader = new XmlFileLoader($container, new FileLocator(array(__DIR__.'/../Resources/config/')));
        $loader->load('services.xml');

        if(false === empty($config['connection'])){

            $container
                ->getDefinition('highco_redis.adapter')
                ->addArgument($config['connection'])
                ->addArgument(isset($config['options']) ? $config['options'] : array())
                ;
        }
    }

    /**
     * mergeConfigs
     *
     * @param array $configs
     * @param mixed $debug
     * @access private
     * @return void
     */
    private function mergeConfigs(array $configs, $debug)
    {
        $processor = new Processor();
        $config = new Configuration($debug);

        return $processor->process($config->getConfigTreeBuilder()->buildTree(), $configs);
    }

}
