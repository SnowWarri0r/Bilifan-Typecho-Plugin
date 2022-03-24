# Bilifan-Typecho-Plugin(For handsome)  

原作者来自：https://github.com/fengmo66/Mo66CnBilifan  

基于原作者版本，优化了性能，增加了分页系统（追番两百多部顶不住一口气加载。。。  

但是只适配了Handsome主题，所以就另外发版了  

## 使用说明  

1. 右上角绿色的按钮点开，点击下载Zip压缩包，然后把里面的东西解压出来，改名为 Bilifan 放入 `/usr/plugins` 文件夹，并把 其中的 `page_bilifan.php` 放入 `/usr/themes/handsome` 文件夹，将原本的页面覆盖掉即可。
2. 来到后台启用插件，并填入自己b站账户的uid和cookie。
  - 这里的uid可以来到自己的主页，主页后面一串数字即你的uid
  - cookie则需要打开控制台(F12)，然后点开网络(Network)选项卡，然后访问 https://www.bilibili.com ，找到其中的 `www.bilibili.com` 这一项，查看请求信息中的Cookie项，把这里面的全部复制粘贴即可。  

## 鸣谢  

在这里特别感谢原作者 `fengmo66` 在接口和序列化方面做出的贡献，我也只是在前人的基础上进行了优化改良，也算不上完美，还希望能有大佬对其进行更多优化和美化。
