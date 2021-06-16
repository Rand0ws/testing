<?php

namespace Core;

class Dispatcher
{
    /**
     * @param  Track  $track
     *
     * @return Page
     */
    public function getPage(Track $track)
    {
        $className = ucfirst($track->controller) . 'Controller';
        $fullName  = "\\app\\Controllers\\$className";

        try {
            $controller = new $fullName;

            if (method_exists($controller, $track->action)) {
                $result = $controller->{$track->action}($track->params);

                if ($result) {
                    return $result;
                } else {
                    return new Page('default');
                }
            } else {
                echo "Метод <b>{$track->action}</b> не найден в классе $fullName.";
                die;
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            die;
        }
    }
}