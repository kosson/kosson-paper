<?php
  $doc = JFactory::getDocument();
  defined( '_JEXEC' ) or die( 'I know you will find a way to get past this, but to what end?! This is only a place of learning. Thank you for understanding.' );

  //Adaugă frameworkul bootstrap
  JHtml::_('bootstrap.framework');

  // Incarca CSS-ul Bootstrap-ului
  JHtmlBootstrap::loadCss($includeMaincss = true);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"
      xml:lang="<?php echo $this->language; ?>"
      lang="<?php echo $this->language; ?>"
      dir="<?php echo $this->direction; ?>"
      itemscope itemtype="http://schema.org/WebPage"
      >

      <head itemscope>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <jdoc:include type="head" />
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300&subset=latin,latin-ext,cyrillic,greek-ext,greek,cyrillic-ext' rel='stylesheet' type='text/css'>
        <link rel="stylesheet"
              href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/template.css"
              type="text/css" />
        <link rel="stylesheet"
              media="(min-width: 320px)"
              href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/320-479.css"
              type="text/css" />
        <link rel="stylesheet"
              media="(min-width: 480px)"
              href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/480-767.css"
              type="text/css" />
        <link rel="stylesheet"
              media="(min-width: 768px)"
              href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/768-991.css"
              type="text/css" />
        <link rel="stylesheet"
              media="(minwidth: 992px)"
              href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/992-1999.css"
              type="text/css" />
        <?php
          // Adauga modernizr pentru IE
          $doc->addScript('templates/' . $this->template . '/js/modernizr.custom.76638.js');
        ?>
        <!-- Dependințe SyntaxHighlighter -->
        <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/shCore.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/shCoreDefault.css" type="text/css" />

        <!-- Încărcare scripturi necesare pentru SyntaxHighlighter -->
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/SyntaxHighlighter/shCore.js"></script>
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/SyntaxHighlighter/shAutoloader.js"></script>
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/SyntaxHighlighter/shBrushBash.js"></script>
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/SyntaxHighlighter/shBrushXml.js"></script>
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/SyntaxHighlighter/shBrushCss.js"></script>
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/SyntaxHighlighter/shBrushJScript.js"></script>

        <!-- Leaflet -->
        <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v1.0.0-beta.2/leaflet.css" />
        <script src="http://cdn.leafletjs.com/leaflet/v1.0.0-beta.2/leaflet.js"></script>
        <!-- Dependința omnivore https://github.com/mapbox/leaflet-omnivore -->
        <script src="http://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-omnivore/v0.2.0/leaflet-omnivore.min.js"></script>
        <!-- Dependința leaflet-ajax https://github.com/calvinmetcalf/leaflet-ajax -->
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/leaflet/ajax/leaflet.ajax.min.js"></script>

        <!--[if lt IE 9]>
          <script src="<?php echo $this->baseurl ?>/media/jui/js/html5.js"></script>
        <![endif]-->
      </head>

<!-- BODY -->
      <body itemtype="http://schema.org/mainContentOfPage">

<!-- HEADER: BANNER, SEARCH, LANG, NEWS-SMALL -->
        <!--
        Toate modulele (pozitii) din zona de header a siteului:
        * banner      (none)
        * search      (none)
        * lang        (none)
        * news-small  (htm5)
        Semantic: este headerul siteului
        -->
        <header itemtype="http://schema.org/WPHeader">
<!-- MESAJE DE SISTEM -->
          <!-- Introduc aici fragmentul care va afișa mesajele sistemului incluzând pe cele de eroare. -->
          <jdoc:include type="message" />
          <!-- Mesajele de sistem pot fi stilizate modificând: templates\system\css\system.css -->
<!-- BANNER::MODULE -->
          <!--
          Introduci modulul in care apar bannerele
          Semantic: este sectiune a headerului
          -->
          <section id="banner">
            <jdoc:include type="module" name="banner" style="none" />
          </section>

          <!--
          Introduci o zona compacta:
          LOGO | SEARCH | LANG
          Semantic: este sectiune a headerului
          -->
          <section itemscope id="top">

<!-- LOGO -->
            <img itemscope src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/logoKosson.png" alt="reprezentare logo Kosson" />
<!-- SEARCH::MODULE -->
            <!--
            Introduci modulul de cautare
            Semantic: este diviziune în interiorul secțiunii de header
            -->
            <div itemscope class="search">
              <jdoc:include type="module" name="search" style="none" />
            </div>
<!-- LANG::MODULE -->
            <!--
            Introduci modulul de selectare a limbilor
            Semantic: este diviziune în interiorul secțiunii de header
            -->
            <div itemscope class="lang">
              <jdoc:include type="module" name="lang" style="none" />
            </div>
          </section>
<!-- NEWS-SMALL::MODULE -->
          <!--
          Introduci aici toate articolele din news formatate marunt.
          Semantic: este o sectiune noua a headerului
          -->
          <section itemscope itemprop="http://schema.org/NewsArticle" class="news-small">
            <jdoc:include type="module" name="news-small" style="html5" />
          </section>
        </header>

        <!--
        Toate modulele (pozitii) din zona de orientare a siteului:
        * nav   (none)
        Semantic: este sectiune in body dedicata orientarii, fie prin meniu, fie prin alte instrumente
        -->
<!-- CATEGORIES -->
        <div itemscope class="navbar navbar-inverse">
          <div itemscope class="navbar-inner">
            <div itemscope class="container">
              <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
              </a>
              <div class="nav-collapse collapse">
                <ul class="nav">
<!-- CATEGORIES::MODULE -->
                  <li class="active"><a href="http://www.kosson.ro"><i class="icon-home icon-white"></i> Home</a></li>
                  <jdoc:include type="module" name="categories" title="categoriile conținutului" style="none" />
                </ul>
              </div><!-- /.nav-collapse -->
<!-- BREADCRUMBS::MODULE -->
              <p>
                <jdoc:include type="module" name="breadcrumbs" title="Breadcrumbs" />
              </p>
            </div><!-- /.container -->
          </div><!-- /.navbar-inner -->
        </div><!-- /.navbar -->
        <!--
        Toate modulele (pozitii) din zona de continut a siteului:
        * column         (none)
        Semantic: este main in body
        -->
        <main itemscope id="content" class="">
          <!-- O sectiune care cuprinde intregul continut -->
          <section itemscope class="articles">
<!-- COLUMN1::MODULE -->
            <!-- meniu arhivă și login pe blog nick -->
            <jdoc:include type="module" name="column1" style="none" />
<!-- COMPONENT::COMPONENT -->
            <jdoc:include type="component" />
          </section>
        </main>

        <footer itemscope itemtype="http://schema.org/WPFooter" class="">
<!-- INFOSTRUCTURES::MODULE -->
          <!-- Structuri primare de gestiune si asociere  -->
          <section itemscope class="upper-footer">
            <jdoc:include type="module" name="infostructures" style="none" />
          </section>

          <section itemscope class="main-footer">
            <jdoc:include type="module" name="footer" style="none" />
          </section>

        </footer>

        <!-- Executie SyntaxHighlighter -->
        <script type="text/javascript">SyntaxHighlighter.all()</script>

      </body>
</html>
