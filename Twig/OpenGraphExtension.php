<?php

namespace Tga\OpenGraphBundle\Twig;

use Tga\OpenGraphBundle\Renderer\OpenGraphMapRenderer;

class OpenGraphExtension extends \Twig_Extension
{
    /**
     * @var OpenGraphMapRenderer
     */
    protected $renderer;

    /**
     * @param OpenGraphMapRenderer $renderer
     */
    public function __construct(OpenGraphMapRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tga_opengraph';
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            'tga_render_opengraph' => new \Twig_Function_Method($this, 'renderOpenGraph', [ 'is_safe' => [ 'html' ] ]),
        ];
    }

    /**
     * @param object $entity
     * @return string
     */
    public function renderOpenGraph($entity)
    {
        return $this->renderer->render($entity);
    }
}