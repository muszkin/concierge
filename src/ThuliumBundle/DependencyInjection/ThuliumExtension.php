<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 07.04.17
 * Time: 11:23
 */

namespace ThuliumBundle\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class ThuliumExtension extends Extension
{

    const ALIAS = 'thulium';
    /**
     * Loads a specific configuration.
     *
     * @param array $configs An array of configuration values
     * @param ContainerBuilder $container A ContainerBuilder instance
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration,$configs);

        $container->setParameter($this->getAlias().'.url',$config['url']);
        $container->setParameter($this->getAlias().'.login',$config['login']);
        $container->setParameter($this->getAlias().'.password',$config['password']);

        $loader = new YamlFileLoader($container,new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

    }

    public function getAlias()
    {
        return self::ALIAS;
    }
}