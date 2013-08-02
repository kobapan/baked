<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<?php echo $this->Element('Baked/head') ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<title>不動産業者向け 無料ホームページテンプレート tp_fudosan5</title>
<meta name="copyright" content="Template Party" />
<meta name="description" content="ここにサイト説明を入れます" />
<meta name="keywords" content="キーワード１,キーワード２,キーワード３,キーワード４,キーワード５" />
<?php echo $this->Element('Baked/css') ?>
<link href="<?php echo URL ?>ThemeSkyblue/css/style.css" rel="stylesheet" type="text/css" />
<?php echo $this->Element('Baked/js') ?>
</head>

<body>
<?php echo $this->Element('Baked/html') ?>
<div id="wrap">

<div id="container">

<div id="header">
  <div id="bk-site-caption" class="bk-site-caption"><?php echo h(BK_SITE_CAPTION) ?></div>
  <div id="bk-logo">
    <a href="<?php echo URL ?>" class="bk-site-name"><?php echo h(BK_SITE_NAME) ?></a>
  </div>
  <p id="tel"><img src="<?php echo URL ?>ThemeSkyblue/images/tel.gif" width="259" height="58" alt="" /></p>
</div>
<!--/header-->

<?php
echo $this->Element('global_navigation');
?>

<div id="contents">

<div id="mainimg">
<img class="slide_file" src="<?php echo URL ?>ThemeSkyblue/images/1.jpg" title="index.html">
<img class="slide_file" src="<?php echo URL ?>ThemeSkyblue/images/2.jpg" title="index.html">
<img class="slide_file" src="<?php echo URL ?>ThemeSkyblue/images/3.jpg" title="index.html">
<input type="hidden" id="slide_loop" value="0">
<a href="index.html" id="slide_link">
<img id="slide_image" src="<?php echo URL ?>ThemeSkyblue/images/1.jpg" alt="" width="960" height="250" />
<img id="slide_image2" src="<?php echo URL ?>ThemeSkyblue/images/1.jpg" alt="" width="960" height="250" /></a></div>
<!--/mainimg-->

<div id="main">

<?php
echo $this->element('Baked/sheet', array(
  'sheet' => 'main',
));
?>

<?php
/*
<h2>無料テンプレートのご利用前に必ずお読み下さい</h2>
<p>このテンプレートは<a href="http://template-party.com/">無料ホームページテンプレート配布サイトのTemplate Party</a>が配布している『<a href="http://template-party.com/temp_biz.html#fudosan5">不動産業者向け 無料ホームページテンプレート tp_fudosan5</a>』です。<br />
必ず<a href="http://template-party.com/read.html">利用規約</a>をご一読の上でご利用下さい。不明な点があれば<a href="http://template-party.com/faq.html">ＦＡＱコーナー</a>をご一読下さい。</p>
<p><span class="color1">■<strong>HP最下部の著作表示「Web Design:Template-Party」は無断で削除しないで下さい</strong></span><br />
わざと見えなく加工する事も禁止します。お守りいただけない場合、テンプレートの利用を中止し、違反金を請求いたします。</p>
<p><span class="color1">■<strong>どうしても下部の著作を外したい場合は</strong></span><br />
<a href="http://template-party.com/member.html">ライセンス契約</a>を行う事でHP下部の著作を外す事ができます。おまけ特典として、制作時Photoshopファイルももらえます。</p>
<p><a href="http://template-party.com/"><img src="http://template-party.com/images/banner/tp_banner1.gif" alt="" width="500" height="79" /></a></p>

<h2>不動産サイト用プログラム販売中</h2>
<p>当テンプレートの物件紹介ページにも使えるCMSを販売中。物件一覧ページ以外に、各詳細ページや専用お問い合わせフォームも出力できます。<a href="http://template-party.com/file/cms_fudosan.html">詳しくはこちらをご覧下さい。</a><br />
<a href="http://template-party.com/file/cms_fudosan.html"><img src="http://template-party.com/images/file/cms_fudosan/img1.jpg" alt="" width="588" height="128" /></a></p>

<h2>更新情報・お知らせ</h2>
<div class="new mb1em">
<dl>
<dt>2012/00/00</dt>
<dd><a href="company.html#about">当テンプレートの詳しい使い方はこちらをご覧下さい。</a><img src="<?php echo URL ?>ThemeSkyblue/images/icon_new.gif" alt="NEW" width="30" height="11" /></dd>
</dl>
<dl>
<dt>2012/00/00</dt>
<dd>ホームページリニューアル<img src="<?php echo URL ?>ThemeSkyblue/images/icon_up.gif" alt="UP" width="30" height="11" /></dd>
</dl>
<dl>
<dt>2012/00/00</dt>
<dd>ホームページリニューアル</dd>
</dl>
<dl>
<dt>2012/00/00</dt>
<dd>ホームページリニューアル</dd>
</dl>
<dl>
<dt>2012/00/00</dt>
<dd>ホームページリニューアル</dd>
</dl>
<dl>
<dt>2012/00/00</dt>
<dd>ホームページリニューアル</dd>
</dl>
<dl>
<dt>2012/00/00</dt>
<dd>ホームページリニューアル</dd>
</dl>
<dl>
<dt>2012/00/00</dt>
<dd>ホームページリニューアル</dd>
</dl>
</div>
<!--/new-->

*/
?>

</div>
<!--/main-->

<div id="sub">

<?php
echo $this->Element('sub_navigation');
?>

<?php
echo $this->element('Baked/sheet', array(
  'sheet' => 'sub',
));
?>

<h3>おすすめ物件</h3>

<div class="box1">
<p class="img"><a href="item.html"><img src="<?php echo URL ?>ThemeSkyblue/images/sample1.jpg" alt="" width="60" height="60" /></a></p>
<h4><a href="item.html">ＸＸアパート　55,000円</a></h4>
<p class="text">熊本駅から徒歩3分という好立地！敷金0円サービス実施中。</p>
</div>

<div class="box1 sumi">
<p class="img"><a href="item.html"><img src="<?php echo URL ?>ThemeSkyblue/images/sample1.jpg" alt="" width="60" height="60" /></a></p>
<h4><a href="item.html">ＸＸアパート　55,000円</a></h4>
<p class="text">&lt;div class=&quot;box1 sumi&quot;&gt;<br />
とすると「ご契約済」マークが出ます。</p>
</div>

<div class="box1 osusume">
<p class="img"><a href="item.html"><img src="<?php echo URL ?>ThemeSkyblue/images/sample1.jpg" alt="" width="60" height="60" /></a></p>
<h4><a href="item.html">ＸＸアパート　55,000円</a></h4>
<p class="text">&lt;div class=&quot;box1 osusume&quot;&gt;<br />
とすると「おすすめ」マークが出ます。</p>
</div>

<div class="box1 mb1em">
<p class="img"><a href="item.html"><img src="<?php echo URL ?>ThemeSkyblue/images/sample1.jpg" alt="" width="60" height="60" /></a></p>
<h4><a href="item.html">ＸＸアパート　55,000円</a></h4>
<p class="text">熊本駅から徒歩3分という好立地！敷金0円サービス実施中。</p>
</div>

<h3>この見出しはh3で囲む</h3>
<p>ここに画像を置く場合、幅240pxまで。</p>

</div>
<!--/sub-->

<div id="footermenu">
<ul>
<li><a href="index.html">ホーム</a></li>
<li><a href="company.html">会社概要</a></li>
<li><a href="baibai.html">売買物件</a></li>
<li><a href="chintai.html">賃貸物件</a></li>
<li><a href="tenant.html">店舗物件</a></li>
<li><a href="parking.html">駐車場物件</a></li>
<li><a href="contact.html">お問い合わせ</a></li>
</ul>
<a href="#container"><img src="<?php echo URL ?>ThemeSkyblue/images/pagetop.gif" width="130" height="24" alt="PAGE TOP" id="pagetop" /></a>
</div>
<!--/footermenu-->

</div>
<!--/contents-->

</div>
<!--/container-->

<div id="footer">
Copyright&copy; 2012 <a href="index.html">不動産業者向け 無料ホームページテンプレート tp_fudosan5</a> All Rights Reserved.<br />
<span class="pr"><a href="http://template-party.com/" target="_blank">Web Design:Template-Party</a></span>
</div>
<!--/footer-->

</div><!--/wrap-->

</body>
</html>
