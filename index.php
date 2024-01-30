<?php

require("./sitemap.php");

// Роутер
class uSitemap
{
   public $title = '';
   public $params = null;
   public $classname = '';
   public $data = null;

   public $request_uri = '';
   public $url_info = [];

   public $found = false;

   function __construct()
   {
      $this->mapClassName();
   }

   function mapClassName()
   {
      $this->classname = '';
      $this->title = '';
      $this->params = null;

      global $sitemap;
      $map = &$sitemap;

      $this->request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
      $this->url_info = parse_url($this->request_uri);

      $uri = urldecode($this->url_info['path']);
      $data = false;

      foreach ($map as $term => $dd) {
         $match = [];
         $i = preg_match('@^' . $term . '$@Uu', $uri, $match);

         if ($i > 0) {
            // Get class name and main title part
            $m = explode(',', $dd);
            $data = [
               'classname' => isset($m[0]) ? strtolower(trim($m[0])) : '',
               'title' => isset($m[1]) ? trim($m[1]) : '',
               'params' => $match,
            ];

            break;
         }
      }

      if ($data === false) {
         // 404
         if (isset($map['_404'])) {
            $dd = $map['_404'];
            $m = explode(',', $dd);

            $this->classname = strtolower(trim($m[0]));
            $this->title = trim($m[1]);
            $this->params = array();
         }

         $this->found = false;
      } else {
         // Путь существует!
         $this->classname = $data['classname'];
         $this->title = $data['title'];
         $this->params = $data['params'];

         $this->found = true;
      }

      return $this->classname;
   }
}

$router = new uSitemap();
$routed_file = $router->classname; // Получаем имя файла для подключения через require()

require("db/index.php");

require("helpers.php");

global $current_user;
$current_user = get_logged_user();

$is_admin = $current_user && $db->is_admin($current_user["id"]);

$notifications = [];
$scripts = [];

require('controllers/' . $routed_file);

require('template/template.php');

// P.S. Внутри подключённого файла Вы можете использовать параметры запроса,
// которые хранятся в свойстве $router->params
