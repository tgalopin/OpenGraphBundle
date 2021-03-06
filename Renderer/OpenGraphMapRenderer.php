<?php

namespace Tga\OpenGraphBundle\Renderer;

use Tga\OpenGraphBundle\Document\OpenGraphDocument;
use Tga\OpenGraphBundle\Renderer\Exception\EntityNotSupported;
use Tga\OpenGraphBundle\Registry\Registry;

class OpenGraphMapRenderer
{
    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @param Registry $registry
     */
    public function __construct(Registry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @param object $entity
     * @return string
     * @throws EntityNotSupported
     */
    public function render($entity)
    {
        $this->registry->freeze();

        foreach ($this->registry->getMaps() as $map) {
            if ($map->supports($entity)) {
                $docuemnt = $this->createDocument();

                $map->map($docuemnt, $entity);

                return $docuemnt->render();
            }
        }

        throw new EntityNotSupported($entity, $this->registry);
    }

    /**
     * @return \Tga\OpenGraphBundle\Registry\Registry
     */
    public function getRegistry()
    {
        return $this->registry;
    }

    /**
     * @return OpenGraphDocument
     */
    protected function createDocument()
    {
        return new OpenGraphDocument();
    }
}