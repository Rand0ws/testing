<?php

namespace Core;

class Router
{
    /**
     * @param  array  $routes
     * @param  string  $uri
     *
     * @return Track
     */
    public function getTrack(array $routes, string $uri): Track
    {
        foreach ($routes as $route) {
            $pattern = $this->createPattern($route->path);

            /*
             * Проверяем адрес URI на соответсвие регулярному выражению
             * Если URI подойдёт под регулярку, то в $params будут параметры
             */
            if (preg_match($pattern, $uri, $params)) {
                /*
                 * Очищаем параметры от элементов с числовыми ключами
                 */
                $params = $this->clearParams($params);

                return new Track($route->controller, $route->action, $params);
            }
        }

        return new Track('error', 'notFound');
    }

    /**
     * Метод преобразует путь из роута в регуляку,
     * подставляя вместо параметров роута именованные карманы
     *
     * К примеру, из адреса '/test/:var1/:var2/' метод
     * сделает регулярку '#^/test/(?<var1>[^/]+)/(?<var2>[^/]+)/?$#'
     *
     * @param  string  $path
     *
     * @return string
     */
    private function createPattern(string $path): string
    {
        return '#^' . preg_replace('#/:([^/]+)#', '/(?<$1>[^/]+)', $path) . '/?$#';
    }

    /**
     * @param  array  $params
     *
     * @return array
     */
    private function clearParams(array $params): array
    {
        $result = [];

        foreach ($params as $key => $param) {
            if (!is_int($key)) {
                $result[$key] = $param;
            }
        }

        return $result;
    }
}