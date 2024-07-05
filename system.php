<?php

use DI\ContainerBuilder;

final class System {
    /**
    * * @var \DI\Container
    */
    protected $container;

    /**
     * @var system
     */
    protected static $instance;

    protected function __construct() {
        $this->buildContainer();
    }

    public function getInstance() : system
    {
        if( null == static::$instance ){
            static::$instance = new static();
        }

        return static::$instance;
    }


    public function getContainer() :  \DI\Container
    {
        return $this->container;
    }

    /**
     * @return \DI\Container
     */
    protected function buildContainer() {
        $builder = new ContainerBuilder();
        $builder->addDefinitions( [
            'RecentPosts' => function ( ContainerBuilder $c ) {
                return PostsFactory::create( 'post', 3 );
            },
            'Products'   => function ( ContainerBuilder $c ) {
                return PostsFactory::create( 'product', 50 );
            }
        ] );

        $this->container = $builder->build();

    }

}
