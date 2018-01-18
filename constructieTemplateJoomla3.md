# Creează structura primară

Mai întâi de toate ai nevoie de un subdirector în directorul **templates**.

## subdirector în /templates

Creezi:

Creează fișierul **index.php**, adaugi **favicon.ico** și fișierul **templateDetails.xml**. Apoi creezi directorul css și în el fișierul ***template.css**. Creează directorul images în directorul template-ului tău.

## Crearea unei schițe de templateDetails.xml

Acest fișier este necesar pentru evidențierea tuturor resurselor ce care beneficiază template-ul. Acest fișier este absolut necesar pentru instalarea template-ul. Fără el instalarea nu se face. Dacă există resurse care nu sunt menționate la secțiunea `<files>`, instalarea template-ului după construcție, va da eroare.

Câteva informații orientative se pot găsi și [pe pagina dedicată acestui fișier](http://docs.joomla.org/Creating_a_basic_templateDetails.xml_file).

```html
<?xml version="1.0" encoding="utf-8"?>
<extension version="2.5" type="template">
  <name>kosson-100</name>
  <creationDate>2018-18-01</creationDate>
  <author>Nicolaie Constantinescu</author>
  <authorEmail>kosson@gmail.com</authorEmail>
  <authorUrl>http://www.kosson.ro</authorUrl>
  <copyright>Nicolaie Constantinescu</copyright>
  <license>CC-BY</license>
  <version>1.0</version>
  <description>Template bazat pe kosson-paper, dar complet refăcut.</description>
  <files>
    <filename>index.php</filename>
    <filename>templateDetails.xml</filename>
    <folder>images</folder>
    <folder>css</folder>
  </files>
  <positions>
    <position>news-small</position>
    <position>search</position>
    <position>lang</position>
    <position>zone</position>
    <position>categories</position>
    <position>column1</position>
    <position>breadcrumb</position>
    <position>infostructures</position>
    <position>footer</position>
  </positions>
</extension>
```

Pentru a avea un [reper general de construire a template-urilor](http://docs.joomla.org/Creating_a_basic_Joomla!_template) se poate verifica periodica pagina dedicată.

# Elaborarea index.php

Fișierul testează inițial dacă este inițializează o aplicație Joomla! Dacă nu, scriptul php se va opri din rulare cu mesaj.

```php
<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
```

În cazul template-ului kosson-100 mai trebuie adăugat înainte de restricția `or die` următorul apel:

```php
$doc = JFactory::getDocument();
```

Pasul următor este menționarea folosirii HTML-ului 5.

```php
<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<!DOCTYPE html>
```

Deschide html-ul cu atributele necesare

```html
<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"
      xml:lang="<?php echo $this->language; ?>"
      lang="<?php echo $this->language; ?>"
      dir="<?php echo $this->direction; ?>"
      >
</html>
```

## HEAD

Cheamă fișierele dependințe ale template-ului, adica css-urile

```html
<head>
  <link rel="stylesheet"
        href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/template.css"
        type="text/css" />
</head>
```

Pentru adăugarea de imagini din **/images** se va folosi:

```html
<img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/myimage.png" alt="Custom image" class="customImage" />
```

Începând cu headerul Joomla! injectează codul generat de aplicație prin intermediul declarațiilor jdoc - **< jdoc:include />**. Tipurile specificate de conținut ce vor fi injectate de Joomla! prin `jdoc` pot fi:

_head_ modules _component_ message

### ATENȚIE!

**< jdoc:include type="head" />** apare o singură dată în întregul template.

### ATENȚIE

**< jdoc:include type="message" />** se va introduce în template dacă ai nevoie să afișezi mesajele de sistem și cele de eroare.

Pentru mai multe detalii privind jdoc, ar trebui accesată [pagina dedicată jdoc de la Joomla!](http://docs.joomla.org/Jdoc_statements)

```html
<head>
  <jdoc:include type="head" />
  <link rel="stylesheet"
        href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/template.css"
        type="text/css" />
</head>
```

## BODY

Cea mai simplă structură este:

```html
<body>
<jdoc:include type="modules" name="top" />
<jdoc:include type="component" />
<jdoc:include type="modules" name="bottom" />
</body>
```

### ATENȚIE!

**< jdoc:include type="component" />** apare o singură dată în întregul template. Mai este un element care apare o singură dată într-un document: `<jdoc:include type="message" />`.

## Introducerea modulelor

Pentru a introduce modulele, va trebui inserat în scriptul php o secvență:

```php
<jdoc:include type="module" name="categories" title="Main Menu" />
```

Să analizăm atributele:

- `type` indică faptul că avem un modul pe care-l inserăm
- la `name`, numele modulului trebuie să fie identic cu cel al numelui modului pentru a se face legătura (de ex.: mod_meniulprincipal), iar
- `title` este pur și simplu titlul afișat al codului, dacă se optează din setări să fie afișat în pagină

După ce ai creat un modul, acesta trebuie publicat (a se citi: activat) pentru ca acesta să injecteze conținutul.
Tot conținutul HTML al paginii web este generat de module și `component`.
Modulelor care generează conținut în pagină li se poate preciza cum vor afișa acel conținut prin menționarea atributului style la declarația `jdoc`. Trebuie să-ți aduci aminte mereu de faptul că ceea ce ai trecut în `name`, trebuie trecut și în fișierul XML: templateDetails.xml în secțiunea `positions`:

```xml
<positions>
  <position>news-small</position>
  <position>search</position>
  <position>lang</position>
  <position>zone</position>
  <position>categories</position>
  <position>column1</position>
  <position>breadcrumbs</position>
  <position>infostructures</position>
  <position>footer</position>
</positions>
```

Stiluri de modelare a codului care va genera identitatea vizuală:

#### none

```html
<ul class="menu">
  <li><!-- various menu items --></li>
</ul>
```

#### xhtml

```html
<div class="moduletable_menu">
  <h3>Main Menu</h3>
  <ul class="menu">
    <li><!-- various menu items --></li>
  </ul>
</div>
```

#### html5

```html
<div class="well _menu">
  <h3 class="page-header">Main Menu</h3>
  <ul class="nav menu">
    <li><!-- various menu items --></li>
  </ul>
</div>
```

## Construcția lui kosson-100

În head este necesară introducerea directivei meta viewport

```html
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
```

Adu fonturile siteului

```html
<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300⊂=latin,latin-ext,cyrillic,greek-ext,greek,cyrillic-ext' rel='stylesheet' type='text/css'>
```

Incarca fontul din CSS pentru tot siteul

```css
* {
  font-family: 'Ubuntu', 'Ubuntu Light', sans-serif, 'Verdana'
}
```

Tot în `head` în caz că sunt probleme cu IE mai vechi există o soluție

```html
<!--[if lt IE 9]>
  <script src="<?php echo $this->baseurl ?>/media/jui/js/html5.js"></script>
<![endif]-->
```

În php incarca apelul care aduce CSS-ul specific Bootstrap-ului

```php
// Incarca CSS-ul Bootstrap-ului
JHtmlBootstrap::loadCss($includeMaincss = true);
```

## Lista modulelor în Kosson

### Modulul `Continut`

Title: Continut
Position: categories
Language: Romanian

Folosește poziția `categories` introdusă prin `<jdoc:include type="module" name="categories" title="categoriile conținutului" style="none" />` din `index.php`.
În zona `Menu Assignement`, bifezi dintre elementele de meniu, care la momentul selecției și încărcării conținutului aferent, va încărca și meniul principal.

În structura site-ului Kosson sunt prevăute două tipuri de meniuri. Primul este cel legat de menționarea celor mai importante secțiuni de conținut, care reflectă și categoriile definite intern. Mai există un tip de meniu numit `zone`, care are trimiteri către zone de mare întindere ca și volum de conținut cum ar fi Depozit.

# Structura standard HTML generata de `jdoc:include type="component"`

## Este structura generată pentru prima pagină prin opțiunile din setările:

### Content->Article Manager->Options->Blog / Featured Layouts

Aceste setări se aplică pentru prezentarea tip `blog` sau `featured layouts` asta dacă nu sunt modificare de anumite elemente de meniu.

**Schema aplicată:**

Setare             | Nr.
:----------------- | :---
Leading Articles   | 1
Intro Articles     | 4
Columns            | 1
Links              | 4
Multi Column Order | Down

- `div` **.blog-featured** `itemtype="http://schema.org/Blog" itemscope=""`

  - `div` **.items-leading .clearfix**

    - `div` **.leading-0 .clearfix** `itemtype="http://schema.org/BlogPosting" itemscope="" itemprop="blogPost"`

      - `h2` **.item-title** `itemprop="name"`
      - `dl` **.article-info .muted**

    - `div` **.items-row .cols-1 .row-0 .row-fluid**

      - `div` **.item .column-1 .span12** `itemtype="http://schema.org/BlogPosting" itemscope="" itemprop="blogPost"`

        - `h2` **.item-title** `itemprop="name"`
        - `dl` **.article-info .muted**

    - `div` **.items-row .cols-1 .row-1 .row-fluid**

      - `div` **.item .column-1 .span12** `itemtype="http://schema.org/BlogPosting" itemscope="" itemprop="blogPost"`

        - `h2` **.item-title** `itemprop="name"`
        - `dl` **.article-info .muted**

    - `div` **.items-row .cols-1 .row-2 .row-fluid**

      - `div` **.item .column-1 .span12** `itemtype="http://schema.org/BlogPosting" itemscope="" itemprop="blogPost"`

        - `h2` **.item-title** `itemprop="name"`
        - `dl` **.article-info .muted**

    - `div` **.items-row .cols-1 .row-3 .row-fluid**

      - `div` **.item .column-1 .span12** `itemtype="http://schema.org/BlogPosting" itemscope="" itemprop="blogPost"`

        - `h2` **.item-title** `itemprop="name"`
        - `dl` **.article-info .muted**

    - `div` **.items-row .cols-1 .row-4 .row-fluid**

      - `div` **.item .column-1 .span12** `itemtype="http://schema.org/BlogPosting" itemscope="" itemprop="blogPost"`

        - `h2` **.item-title** `itemprop="name"`
        - `dl` **.article-info .muted**

    - `div` **.items-more**

      - `ol` **.nav .nav-tabs .nav-stacked**

    - `div` **.pagination**

## Explicarea conținutului generat ca și clase CSS generate:

Vor exista tot atâtea `div.learning-0 ... n` câte Leading Articles sunt specificate în schema aplicată default sau cea specifica pe element de meniu.

Dacă la coloane este specificată una singură, atunci articolele apar unul sub altul, fiecare dintre ele primind clasă `.cols-1` și `.row-0`. Îi este atașată clasa specifică Bootstrap `.row-fluid`.

Exemplu de multicoloane și cum este distribuit conținutul:

**Menus** -> **continut** -> **Acasă** -> **Layout**

Setare             | Nr.
:----------------- | :---
Leading Articles   | 1
Intro Articles     | 9
Columns            | 3
Links              | 5
Multi Column Order | Down

**Atenție!** Orice câmp lăsat liber va folosi numărul specificat la setările generale din:

**Content->Article Manager->Options->Blog / Featured Layouts**

Ceea ce s-a urmărit prin aceste setări este să ai un articol mare în prezentare și alte 9 care să prezinte continuitatea de publicare. În concluzie 10 articole „featured" pe prima pagină.

* `div` **.blog-featured** `itemtype="http://schema.org/Blog"` `itemscope=""`
  * `div` **.items-leading .clearfix**
    * `div` **.leading-0 .clearfix** `itemtype="http://schema.org/BlogPosting"` `itemscope=""` `itemprop="blogPost"`
      * `h2` **.item-title** `itemprop="name"`
      * `dl` **.article-info .muted**
        * `dt` **.article-info-term**
        * `dd` **.createdby**
    * `div` **.items-row .cols-3 .row-0 .row-fluid**
      * `div` **.item .column-1 .span4** `itemtype="http://schema.org/BlogPosting" itemscope="" itemprop="blogPost"`
      * `div` **.item .column-2 .span4** `itemtype="http://schema.org/BlogPosting" itemscope="" itemprop="blogPost"`
      * `div` **.item .column-3 .span4** `itemtype="http://schema.org/BlogPosting" itemscope="" itemprop="blogPost"`
    * `div` **.items-row .cols-3 .row-1 .row-fluid**
      - `div` **.item .column-1 .span4** `itemtype="http://schema.org/BlogPosting" itemscope="" itemprop="blogPost"`
      - `div` **.item .column-2 .span4** `itemtype="http://schema.org/BlogPosting" itemscope="" itemprop="blogPost"`
      - `div` **.item .column-3 .span4** `itemtype="http://schema.org/BlogPosting" itemscope="" itemprop="blogPost"`
    * `div` **.items-row .cols-3 .row-2 .row-fluid**
      - `div` **.item .column-1 .span4** `itemtype="http://schema.org/BlogPosting" itemscope="" itemprop="blogPost"`
      - `div` **.item .column-2 .span4** `itemtype="http://schema.org/BlogPosting" itemscope="" itemprop="blogPost"`
      - `div` **.item .column-3 .span4** `itemtype="http://schema.org/BlogPosting" itemscope="" itemprop="blogPost"
    * `div` **.pagination**
      * `p` **.counter .pull-right**
      * `ul`
        * `li` **.pagination-start**
          * `span` **.pagenav** ***Start***
        - `li` **.pagination-prev**
          - `span` **.pagenav** **_Prec_**
        - `li`
          - `span` **.pagenav** "1"
        - `li`
          - `a` **.pagenav** href="/WEB/kosson/index.php?limitstart=11\⟨=ro" "2"
        - `li`
          - `a` **.pagenav** href="/WEB/kosson/index.php?limitstart=22\⟨=ro" "3"

        - `li`

          - `a` **.pagenav** href="/WEB/kosson/index.php?limitstart=33\⟨=ro" "4"

        - `li`

          - `a` **.pagenav** href="/WEB/kosson/index.php?limitstart=44\⟨=ro" "5"

        - `li`

          - `a` **.pagenav** href="/WEB/kosson/index.php?limitstart=55\⟨=ro" "6"

        - `li`

          - `a` **.pagenav** href="/WEB/kosson/index.php?limitstart=66\⟨=ro" "7"

        - `li`

          - `a` **.pagenav** href="/WEB/kosson/index.php?limitstart=77\⟨=ro" "8"

        - `li`

          - `a` **.pagenav** href="/WEB/kosson/index.php?limitstart=88\⟨=ro" "9"

        - `li`

          - `a` **.pagenav** href="/WEB/kosson/index.php?limitstart=99\⟨=ro" "10"

        - `li` **.pagination-next**

          - `a` **.hasTooltip .pagenav** href="/WEB/kosson/index.php?limitstart=11\⟨=ro" title="" data-original-title="Următor" **_Următor_**

        - `li` **.pagination-end**

          - `a` **.hasTooltip .pagenav** href="/WEB/kosson/index.php?limitstart=528\⟨=ro" **_Sfârșit_**

Articolele primesc individual o clasă specifică Bootstrap. În acest caz `span4`

## Folosirea overflow pentru a face scroll pe conținut în interiorul articolului fără barele de scroll.

Pentru o bună fluiență și organizare vizuală s-a dorit ca articolele din `blog-featured` să urmărească o schemă care să expună divuri ce pot fi organizate ca blocuri de text care să apară ca niște unități distincte pe prima pagină. În acest sens s-a urmărit următorarea schemă pentru elementul de meniu primar pentru o fațetă de limbă (**Menus** -> **continut** -> **Acasă** -> **Layout**):

Setare             | Nr.
:----------------- | :---
Leading Articles   | 1
Intro Articles     | 10
Columns            | 3
Links              | 0
Multi Column Order | Down

## Schema generată la accesarea unui articol

- `section` **.articles .container-fluid**

  - `div` **.item-page** `itemtype="http://schema.org/Article" itemscope=""`
  - `div` **.page-header**

    - `h1` **_Arhivistică_**

  - `div` **.page-header** _`h2 itemprop="name"`_`a itemprop="url"` (link către același articol)
  - `div` **.article-info .muted** _`dl` **.article-info**_`div itemprop="articleBody"`
  - `ul` **.pager .pagenav**
  - `div` **#jc**

## Schema generată la accesarea unui articol care are taguri

_`section` **.articles .container-fluid**_`div` **.item-page** `itemtype="http://schema.org/Article" itemscope=""` _`div` **.page-header**_`h1` **_Arhivistică_** _`div` _*.page-header__

```
* `h2 itemprop="name"`
* `a itemprop="url"` ( link către același articol )
```

- `div` **.article-info .muted**

  - `dl` **.article-info**

- `ul` **.tags .inline** `li` **.tag2 .tag-list0** `itemprop="keywords"` `a` **.label .label-info** `href="/radacina-site/selecteaza-toate-articolele-cu-acelasi-tag"` `li` **.tag3 .tag-list1** `` `itemprop="keywords"`` `a` **.label .label-info** `href="/radacina-site/selecteaza-toate-articolele-cu-acelasi-tag"` *`div itemprop="articleBody"`

  - `ul` **.pager .pagenav**

- `div` **#jc**

## Schema generată la accesarea unei secțiuni de site

- `section` **.articles .container-fluid** ::before

  - `div` **.blog** `itemtype="http://schema.org/Blog" itemscope=""`

    - `h2`

      - `span` **.subheading-category** (numele secțiunii de site)

    - `div` **.category-desc .clearfix** ::before

      - (textul descriptiv atașat secțiunii de site) ::after

    - `div` **.items-leading .clearfix** ::before

      - `div` **leading-0** `itemtype="http://schema.org/BlogPosting" itemscope="" itemprop="blogPost"`

        - `div` **.page-header**

          - `h2 itemprop="name"`

            - `a itemprop="url" href="/WEB/kosson/index.php?option=com_content&view=article&id=892:ghidul-activitatilor-de-indrumare-metodica&catid=92&Itemid=146\⟨=ro"` (titlul articolului) ... ::after

      `<!-- end items-leading -->`

    - `div` **.items-row .cols-1 .row-0 .row-fluid .clearfix**
    - `div` **.items-row .cols-1 .row-1 .row-fluid .clearfix**
    - `div` **.items-row .cols-1 .row-2 .row-fluid .clearfix**
    - `div` **.items-row .cols-1 .row-3 .row-fluid .clearfix**
    - `div` **.items-more**
    - `div` **.cat-children**

      - `div` **.first**

        - `h3`**.page-header .item-title**

          - `a`
          - `span` **.badge .badge-info .tip .hasTooltip**

    - `div` **.pagination**

  - `aside`**.moduletable .loginmod** ::after

# Modulele de Newsflash

Acestea se vor duplica pentru a constitui module noi și vor fi numite după tipicul: Newsflash - NumeleLimbii. Vor fi atribuite poziției de template **news-small**

Modulul de newsflash trebuie să apară doar pe prima pagină a fiecărei limbi.

# Articole după cuvânt cheie

Structura generată pentru Components->Tags->Options->Tagged Items->Default Tagged Items->Default

* section.articles
  * div.tag-category
    * h2
    * div.category-desc
    * form#adminForm
      * ul.category .list-striped
        * li.cat-list-row0 .clearfix
          * h3
            * a
          * span.tag-body
        * li.cat-list-row1 .clearfix

Structura generată pentru Components->Tags->Options->Tagged Items->Default Tagged Items->Compact Layout

* section.articles
  * div.tag-category
    * div.category-desc
    * form#adminForm
      * fieldset.filters .btn-toolbar
      * table.category .table .table-striped .table-bordered .table-hover
        * thead
          * tr
            * th#categorylist_header_title .hasPopover
            * th#categorylist_header_date .hasPopover
        * tbody
          * tr.cat-list-row0
            * td.list-title
              * a
            * td.list-date small
