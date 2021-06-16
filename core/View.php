<?php

namespace Core;

class View
{
    /**
     * @param  Page  $page
     *
     * @return false|string
     */
    public function render(Page $page)
    {
        return $this->renderLayout($page, $this->renderView($page));
    }

    /**
     * @param  Page  $page
     * @param $content
     *
     * @return false|string
     */
    private function renderLayout(Page $page, $content)
    {
        $layoutPath = $_SERVER['DOCUMENT_ROOT'] . "/app/Views/layouts/{$page->layout}.php";

        if (file_exists($layoutPath)) {
            ob_start();

            $title = $page->title;
            include $layoutPath;

            return ob_get_clean();
        }
    }

    /**
     * @param  Page  $page
     *
     * @return false|string
     */
    private function renderView(Page $page)
    {
        if ($page->view) {
            $viewPath = $_SERVER['DOCUMENT_ROOT'] . "/app/Views/{$page->view}.php";

            if (file_exists($viewPath)) {
                ob_start();

                $data = $page->data;
                extract($data);
                include $viewPath;

                return ob_get_clean();
            }
        }
    }
}