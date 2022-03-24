<?php

/**
 * bilibili 追番
 *
 * @package custom
 */

/**
 * 仅仅做了与handsome主题的兼容，感谢原作者
 */
?>
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('component/header.php'); ?>

<!-- aside -->
<?php $this->need('component/aside.php'); ?>
<!-- / aside -->
<style type="text/css">
  .BilifanItem {
    line-height: 20px;
    width: 100%;
    overflow: hidden;
    display: block;
    padding: 10px;
    height: 120px;
    background: #fff;
    color: #14191e;
  }

  .BilifanItem:hover {
    color: #14191e;
    opacity: 0.8;
    filter: saturate(150%);
    -webkit-filter: saturate(150%);
    -moz-filter: saturate(150%);
    -o-filter: saturate(150%);
    -ms-filter: saturate(150%);
  }

  .BilifanItem img {
    width: auto !important;
    height: 100%;
    float: left;
    margin: 0 5% 0 0 !important;
  }

  .BilifanItem .textBox {
    text-overflow: ellipsis;
    overflow: hidden;
    position: relative;
    z-index: 1;
    height: 100%;
  }

  .BilifanItem .jinduBG {
    height: 16px;
    width: 100%;
    background-color: gray;
    display: inline-block;
    border-radius: 4px;
    position: absolute;
    bottom: 3px;
  }

  .BilifanItem .jinduFG {
    height: 16px;
    background-color: #ff8c83;
    border-radius: 4px;
    position: absolute;
    bottom: 0px;
    z-index: 1;
  }

  .BilifanItem .jinduText {
    width: 100%;
    height: auto;
    text-align: center;
    color: #fff;
    line-height: 15px;
    font-size: 15px;
    position: absolute;
    bottom: 0px;
    z-index: 2;
  }

  @media screen and (max-width:1000px) {
    .BilifanItem {
      width: 95%;
    }
  }
</style>
<!-- <div id="content" class="app-content"> -->
<a class="off-screen-toggle hide"></a>
<main class="app-content-body <?php echo Content::returnPageAnimateClass($this); ?>">
  <div class="hbox hbox-auto-xs hbox-auto-sm">
    <!--文章-->
    <div class="col center-part gpu-speed" id="post-panel">
      <!--标题下的一排功能信息图标：作者/时间/浏览次数/评论数/分类-->
      <?php echo Content::exportPostPageHeader($this, $this->user->hasLogin(), true); ?>
      <div class="wrapper-md">
        <?php Content::BreadcrumbNavigation($this, $this->options->rootUrl); ?>
        <!--博客文章样式 begin with .blog-post-->
        <div id="postpage" class="blog-post">
          <article class="single-post panel">
            <!--文章页面的头图-->
            <?php echo Content::exportHeaderImg($this); ?>
            <!--文章内容-->
            <div class="wrapper-lg" id="post-content">
              <div class="post-content" id="post-content-block" style="display: flow-root">
                <?php Typecho_Plugin::factory('page_bilifan.php')->navBar(); ?>
              </div>
              <?php Content::postContentHtml(
                $this,
                $this->user->hasLogin()
              ); ?>
              <?php Content::pageFooter($this->options, $this) ?>
            </div>
          </article>
        </div>
        <!--评论-->
        <?php $this->need('component/comments.php') ?>
      </div>
    </div>
    <!--文章右侧边栏开始-->
    <?php $this->need('component/sidebar.php'); ?>
    <!--文章右侧边栏结束-->
  </div>
</main>
<script type="text/javascript">
  const percent = (str1, str2) => {
    if (str1 === '没有记录!') return 0;
    str1 = Number(str1);
    str2 = Number(str2);
    if (typeof str1 === 'number' && !isNaN(str1) && typeof str2 === 'number' && !isNaN(str2)) return str1 / str2 * 100;
    else return 100;
  };
  $.getJSON("/action/bili-api", {
    page: 1
  }, function(json) {
    if (json) {
      const title = json['title'];
      const image_url = json['image_url'];
      const total = json['total'];
      const progress = json['progress'];
      const evaluate = json['evaluate'];
      const season_id = json['season_id'];
      const sum = json['sum'];
      for (let j = 0; j < title.length; j++) {
        let str = "";
        str += '<a href="https://www.bilibili.com/bangumi/play/ss' + season_id[j] + '" target=\'_blank\' class=\'BilifanItem\'>';
        str += '<img src="' + image_url[j] + '" />';
        str += '<div class=\'textBox\'>' + title[j] + '<br>'
        str += evaluate[j] + '<br>';
        str += '<div class=\'jinduBG\'>';
        str += '<div class=\'jinduText\'>进度:' + progress[j] + "/" + total[j] + '</div>';
        str += '<div class=\'jinduFG\' style=\'width:' + percent(progress[j], total[j]) + '%;\'>';
        str += '</div>';
        str += '</div>';
        str += '</div>';
        str += '</a>';
        $(".wrapper-lg #post-content-block").append(str);
      }
    }
  });
  $(function() {
    let i = 2;
    let isLoading = false;
    $(window).scroll(function() {
      if (window.pageYOffset + window.innerHeight >= document.getElementsByClassName("wrapper-lg")[0].scrollHeight && !isLoading) {
        isLoading = true;
        $.getJSON("/action/bili-api", {
          page: i
        }, function(json) {
          if (json) {
            const title = json['title'];
            const image_url = json['image_url'];
            const total = json['total'];
            const progress = json['progress'];
            const evaluate = json['evaluate'];
            const season_id = json['season_id'];
            const sum = json['sum'];
            for (let j = 0; j < title.length; j++) {
              let str = "";
              str += '<a href="https://www.bilibili.com/bangumi/play/ss' + season_id[j] + '" target=\'_blank\' class=\'BilifanItem\'>';
              str += '<img src="' + image_url[j] + '" />';
              str += '<div class=\'textBox\'>' + title[j] + '<br>'
              str += evaluate[j] + '<br>';
              str += '<div class=\'jinduBG\'>';
              str += '<div class=\'jinduText\'>进度:' + progress[j] + "/" + total[j] + '</div>';
              str += '<div class=\'jinduFG\' style=\'width:' + percent(progress[j], total[j]) + '%;\'>';
              str += '</div>';
              str += '</div>';
              str += '</div>';
              str += '</a>';
              $(".wrapper-lg #post-content-block").append(str);
            }
            i++;
            isLoading = false;
          }
        });
      }
    });
  });
</script>

<!-- footer -->
<?php $this->need('component/footer.php'); ?>
<!-- / footer -->