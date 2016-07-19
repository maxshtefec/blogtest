<?php

namespace Blogger\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BloggerUserBundle extends Bundle
{
	public function getParent()
    {
        return 'FOSUserBundle';
    }
}
