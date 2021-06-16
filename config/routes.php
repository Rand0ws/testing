<?php

use \Core\Route;

return [
    new Route('/', 'Auth', 'index'),
    new Route('/profile', 'Profile', 'index'),
];