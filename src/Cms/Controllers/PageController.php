<?php

namespace Cms\Controllers;

class PageController extends AbstractController
{
    public function indexAction()
    {
        return [
            'template' => 'Page/index',
        ];
    }
}
