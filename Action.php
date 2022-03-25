<?php
/**
 * author SnowWarri0r
 * link https://www.onesnowwarrior.cn
 */
if (!defined('__TYPECHO_ROOT_DIR__')) {
  exit;
}
require_once('classFunctions.php'); //引入文件

class Bilifan_Action extends Typecho_Widget implements Widget_Interface_Do
{
  public function action()
  {
    $this->on($this->request->isGet())->api();
  }
  
  private function api()
  {
    $page = $this->request->get('page');
    $uid = Typecho_Widget::widget('Widget_Options')->plugin('Bilifan')->Bilifan_uid;
    $cookie = Typecho_Widget::widget('Widget_Options')->plugin('Bilifan')->Bilifan_cookie;
    $size = Typecho_Widget::widget('Widget_Options')->plugin('Bilifan')->Bilifan_size;
    $bili = new BilibiliAnimeInfo($uid, $cookie);
    $sum = $bili->sum / $size;
    $sum += $bili->sum % $size === 0 ? 0 : 1;
    if ($page === "" || $page <= 0) $page = 1;
    http_response_code(200);
    if ($page > $sum) {
      die();
    }
    $json_str = array(
      'title' => array_slice($bili->title, ($page - 1) * $size, $size),
      'image_url' => array_slice($bili->image_url, ($page - 1) * $size, $size),
      'total' => array_slice($bili->total, ($page - 1) * $size, $size),
      'progress' => array_slice($bili->progress, ($page - 1) * $size, $size),
      'evaluate' => array_slice($bili->evaluate, ($page - 1) * $size, $size),
      'season_id' => array_slice($bili->season_id, ($page - 1) * $size, $size),
      'sum' => $bili->sum,
    ); //用来传输给前端的json
    $json_str['progress'] = mb_convert_encoding($json_str['progress'], "utf-8");
    $json_str = json_encode($json_str, JSON_UNESCAPED_UNICODE);
    header("Content-Type: application/json");
    echo $json_str;
  }
}
