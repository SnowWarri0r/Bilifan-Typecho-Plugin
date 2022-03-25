<?php
/*
 * @Author: SnowWarri0r
 * @LastModifiedBy: SnowWarri0r
 * @GithubUser: SnowWarri0r
 * @Date: 2022-03-25 11:58:40
 * @Company: ncuhome
 * @LastEditTime: 2022-03-25 12:00:59
 * @FilePath: \Bilifan\Plugin.php
 * @Description: 
 */
/**
 * b站追番插件(适配handsome主题)
 *
 * @package Bilifan
 * @author SnowWarri0r
 * @version 1.0.1
 * @link https://www.onesnowwarrior.cn
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

class Bilifan_Plugin implements Typecho_Plugin_Interface
{
  /**
   * 激活插件方法,如果激活失败,直接抛出异常
   *
   * @access public
   * @return void
   * @throws Typecho_Plugin_Exception
   */
  public static function activate()
  {
    Typecho_Plugin::factory('page_bilifan.php')->navBar = array('Bilifan_Plugin', 'render');
    Helper::addAction('bili-api', 'Bilifan_Action');
  }

  /**
   * 禁用插件方法,如果禁用失败,直接抛出异常
   *
   * @static
   * @access public
   * @return void
   * @throws Typecho_Plugin_Exception
   */
  public static function deactivate()
  {
    Helper::removeAction('bili-api');
  }

  /**
   * 获取插件配置面板
   *
   * @access public
   * @param Typecho_Widget_Helper_Form $form 配置面板
   * @return void
   */
  public static function config(Typecho_Widget_Helper_Form $form)
  {
    /** 分类名称 */
    $name = new Typecho_Widget_Helper_Form_Element_Text('Bilifan_uid', NULL, 'uid', _t('请输入b站uid'));
    $form->addInput($name);
    $name = new Typecho_Widget_Helper_Form_Element_Text('Bilifan_cookie', NULL, 'cookie', _t('请输入b站cookie'));
    $form->addInput($name);
    $size = new Typecho_Widget_Helper_Form_Element_Text('Bilifan_size', NULL, '20', _t('分页大小'));
    $form->addInput($size);
  }

  /**
   * 个人用户的配置面板
   *
   * @access public
   * @param Typecho_Widget_Helper_Form $form
   * @return void
   */
  public static function personalConfig(Typecho_Widget_Helper_Form $form)
  {
  }
  
  /**
   * 插件实现方法
   *
   * @access public
   * @return void
   */
  public static function render()
  {
    echo '<meta name="referrer" content="never">';
    echo '<link rel="stylesheet" type="text/css" href="' . Helper::options()->pluginUrl . '/Bilifan/css/style.css" />';
  }
}
