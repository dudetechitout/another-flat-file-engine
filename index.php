<?php
   require('assets/inc/header.php');
   require("vendor/bbcode.php");

   $footer = '<div class="content-column w-col w-col-12"><div class="post-wrapper"><div class="post-content"><div class="body-copy w-richtext">' . file_get_contents('footer') . '</div></div></div></div>';

   $footer = "";

?>
<!DOCTYPE html>
   <head>
      <meta charset="utf-8">
      <title><?php echo $siteTitle; ?><?php if($activePost) { 
      		preg_match('/title\$(.*)/', file_get_contents('posts/' . $postFile), $gTitle); 
            $postPageTitle = " | " . $gTitle[1];
            echo $postPageTitle;
            } elseif($activePage) { echo $secondTitle; } ?></title>
      <meta content="width=device-width, initial-scale=1" name="viewport">
      <meta content="Webflow" name="generator">
      <?php
         if($activePost) {
            preg_match('/image\$(.*)/', file_get_contents('posts/' . $postFile), $gImg);
            $postPageImg = ROOT_URL . trim($gImg[1]);
            if(!empty($postPageImg)) {
      ?>
      <meta property="og:image" content="<?php echo $postPageImg; ?>" /> 
      <?php
            }
         }
      ?>
      <link href="<?php echo ROOT_URL; ?>/assets/css/style.css" rel="stylesheet" type="text/css">
      <script src="<?php echo ROOT_URL; ?>/assets/js/webfont.js"></script>
      <script type="text/javascript">WebFont.load({
         google: {
           families: ["Lato:100,100italic,300,300italic,400,400italic,700,700italic,900,900italic"]
         }
         });
      </script>
      <script src="<?php echo ROOT_URL; ?>/assets/js/modernizr-2.7.1.js" type="text/javascript"></script>
      <!--<link href="https://daks2k3a4ib2z.cloudfront.net/img/favicon.ico" rel="shortcut icon" type="image/x-icon">
      <link href="https://daks2k3a4ib2z.cloudfront.net/img/webclip.png" rel="apple-touch-icon">-->
      <style type="text/css">
         .sidebar-on-mobile {
            padding-bottom: 1.5em;
         }
      </style>
   </head>
   <body>
      <div class="navigation-bar w-nav" data-animation="default" data-collapse="medium" data-contain="1" data-duration="400">
         <div class="w-container">
            <a class="w-nav-brand" href="<?php echo ROOT_URL; ?>">
               <div class="site-name"><?php echo $siteTitle; ?></div>
            </a>
            <nav class="navigation-menu w-nav-menu" role="navigation"><a class="navigation-link w-nav-link <?php if(!($activePost || $activePage)) { echo "w--current"; } ?>" href="<?php echo ROOT_URL; ?>">Home</a><?php foreach ($pages as $page) { echo '<a class="navigation-link w-nav-link ' . (strpos($_SERVER['REQUEST_URI'], lcfirst($page)) !== false ? "w--current" : false) . '" href="' . ROOT_URL . 'pages/' . lcfirst($page) . '.html">' . $page . '</a>'; } ?></a></nav>
            <div class="menu-button w-nav-button">
               <div class="w-icon-nav-menu"></div>
            </div>
         </div>
      </div>
      <div class="content-wrapper">
         <div class="w-container">
            <div class="w-row">
               <div class="w-col w-col-3 w-hidden-small w-hidden-tiny">
                  <div class="white-wrapper">
                     <img class="circle-profile" sizes="(max-width: 767px) 100vw, (max-width: 991px) 97.296875px, 126px" src="<?php echo $profilePic; ?>">
                     <p class="site-description"><?php echo $siteDescription; ?></p>
                     <div class="grey-rule"></div>
                     <span style="<?php echo $ftPostStyle; ?>">
                        <h2 class="small-heading">Featured Posts:</h2>
                        <div class="feature-posts-list w-dyn-list">
                           <div class="w-dyn-items">
                              <?php foreach ($postsToFeature as $ftPost) { echo $ftPost; } ?>
                           </div>
                        </div>
                        <div class="grey-rule"></div>
                        </span>
                        <!--<div class="social-link-group"><a class="social-icon-link w-inline-block" href="#"><img src="https://uploads.webflow.com/56cf6e77d3b4fc4579d0a954/56cf6e77d3b4fc4579d0a99b_social-03.svg" width="25"></a><a class="social-icon-link w-inline-block" href="#"><img src="https://uploads.webflow.com/56cf6e77d3b4fc4579d0a954/56cf6e77d3b4fc4579d0a9a9_social-07.svg" width="25"></a><a class="social-icon-link w-inline-block" href="#"><img src="https://uploads.webflow.com/56cf6e77d3b4fc4579d0a954/56cf6e77d3b4fc4579d0a9bf_social-18.svg" width="25"></a><a class="social-icon-link w-inline-block" href="#"><img src="https://uploads.webflow.com/56cf6e77d3b4fc4579d0a954/56cf6e77d3b4fc4579d0a9d0_social-09.svg" width="25"></a></div>-->
                        <p class="built-with-webflow">Built custom</p>
                  </div>
               </div>
               <?php if($activePost) { ?> <div class="content-column w-col w-col-9">
                  <div class="post-wrapper">
                     <?php 

                     foreach ($postsToEcho as $key => $value) { @list($postTitle, $postSummary, $postDate, $postImage, $postFeatured, $postLink, $postLinkFile, $ftPostStyle) = $value; if($postLinkFile == $postFile) { break; } } ?>
                     <div class="blog-page-image" <?php echo $postImage; ?>></div>
                     <div class="post-content">
                        <h1><?php echo $postTitle; ?></h1>
                        <div class="details-wrapper">
                           <div class="post-info"><?php echo $postDate; ?></div>
                        </div>
                        <div class="grey-rule"></div>
                        <div class="body-copy w-richtext">
                           <?php
                              $bbcode = new BBCode;
                              $postLinkFile = 'posts/' . $postLinkFile;
                              $postPurContent = explode("|title", file_get_contents($postLinkFile))[0];
                              $postParagraphs = preg_split('/\n+/', $bbcode->toHTML($postPurContent));
                              foreach($postParagraphs as $p) {
                                 if(strlen($p) > 0) {
                                    echo "<p>$p</p>"; 
                                 }
                              }
                           ?>
                        </div>
                     </div>
                  </div>
                  <?php echo $footer; ?>
                  <div class="button-wrapper" style="display:none;"><a class="button w-button" href="/all-posts">More posts&nbsp;→</a></div>
                  <div class="sidebar-on-mobile">
                     <div class="white-wrapper">
                        <img class="circle-profile" sizes="(max-width: 767px) 100vw, (max-width: 991px) 97.296875px, 126px" src="<?php echo $profilePic; ?>">
                        <p class="site-description"><?php echo $siteDescription; ?></p>
                        <div class="grey-rule"></div>
                        <span style="<?php echo $ftPostStyle; ?>">
                        <h2 class="small-heading">Featured Posts:</h2>
                        <div class="feature-posts-list w-dyn-list">
                           <div class="w-dyn-items">
                              <?php foreach ($postsToFeature as $ftPost) { echo $ftPost; } ?>
                           </div>
                        </div>
                        <div class="grey-rule" style="display:none;"></div>
                        </span>
                        <!--<div class="social-link-group"><a class="social-icon-link w-inline-block" href="#"><img src="https://uploads.webflow.com/56cf6e77d3b4fc4579d0a954/56cf6e77d3b4fc4579d0a99b_social-03.svg" width="25"></a><a class="social-icon-link w-inline-block" href="#"><img src="https://uploads.webflow.com/56cf6e77d3b4fc4579d0a954/56cf6e77d3b4fc4579d0a9a9_social-07.svg" width="25"></a><a class="social-icon-link w-inline-block" href="#"><img src="https://uploads.webflow.com/56cf6e77d3b4fc4579d0a954/56cf6e77d3b4fc4579d0a9bf_social-18.svg" width="25"></a><a class="social-icon-link w-inline-block" href="#"><img src="https://uploads.webflow.com/56cf6e77d3b4fc4579d0a954/56cf6e77d3b4fc4579d0a9d0_social-09.svg" width="25"></a></div>-->
                        <p class="built-with-webflow">Built custom</p>
                     </div>
                  </div>
               </div>
               <?php } elseif(!$activePost && $activePage) { ?>
                 <div class="content-column w-col w-col-9">
                  <div class="post-wrapper">
                     <div class="post-content">
                        <div class="body-copy w-richtext">
                           <?php
                              $bbcode = new BBCode;
                              $postParagraphs = preg_split('/\n+/', $bbcode->toHTML(file_get_contents("pages/" . $_GET['page'])));
                              foreach($postParagraphs as $p) {
                                 if(strlen($p) > 0) {
                                    echo "<p>$p</p>"; 
                                 }
                              }
                           ?>
                        </div>
                     </div>
                  </div>
                  <?php echo $footer; ?>
               <?php } elseif(!$activePost && !$activePage) { ?>
                <div class="content-column w-col w-col-9">
                  <div class="w-dyn-list">
                     <div class="w-dyn-items">
                        
                        <?php foreach ($postsToEcho as $key => $value) { @list($postTitle, $postSummary, $postDate, $postImage, $postFeatured, $postLink, $ftPostStyle) = $value; ?>
                           <div class="w-dyn-item">
                              <div class="post-wrapper">
                                 <div class="post-content">
                                    <div class="w-row">
                                       <div class="w-col w-col-4 w-col-medium-4"><a class="blog-image w-inline-block" href="<?php echo $postLink; ?>" <?php echo $postImage; ?>></a></div>
                                       <div class="<?php echo $postDisplay; ?>">
                                          <a class="blog-title-link w-inline-block" href="<?php echo $postLink; ?>">
                                             <h2 class="blog-title"><?php echo $postTitle; ?></h2>
                                          </a>
                                          <div class="details-wrapper">
                                             <div class="post-info"><?php echo $postDate; ?></div>
                                          </div>
                                          <div class="post-summary-wrapper">
                                             <p class="post-summary"><?php echo $postSummary; ?></p>
                                             <a class="read-more-link" href="<?php echo $postLink; ?>">Read more...</a>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        <?php } ?>
                     </div>

                  </div>


                  <div class="button-wrapper" style="display:none;"><a class="button w-button" href="/all-posts">More posts&nbsp;→</a></div>
                  <div class="sidebar-on-mobile">
                     <div class="white-wrapper">
                        <img class="circle-profile" sizes="(max-width: 767px) 100vw, (max-width: 991px) 97.296875px, 126px" src="<?php echo $profilePic; ?>">
                        <p class="site-description"><?php echo $siteDescription; ?></p>
                        <div class="grey-rule"></div>
                        <span style="<?php echo $ftPostStyle; ?>">
                           <h2 class="small-heading">Featured Posts:</h2>
                           <div class="feature-posts-list w-dyn-list">
                              <div class="w-dyn-items">
                                 <?php foreach ($postsToFeature as $ftPost) { echo $ftPost; } ?>
                              </div>
                           </div>
                           <div class="grey-rule" style="display:none;"></div>
                        </span>
                        <!--<div class="social-link-group"><a class="social-icon-link w-inline-block" href="#"><img src="https://uploads.webflow.com/56cf6e77d3b4fc4579d0a954/56cf6e77d3b4fc4579d0a99b_social-03.svg" width="25"></a><a class="social-icon-link w-inline-block" href="#"><img src="https://uploads.webflow.com/56cf6e77d3b4fc4579d0a954/56cf6e77d3b4fc4579d0a9a9_social-07.svg" width="25"></a><a class="social-icon-link w-inline-block" href="#"><img src="https://uploads.webflow.com/56cf6e77d3b4fc4579d0a954/56cf6e77d3b4fc4579d0a9bf_social-18.svg" width="25"></a><a class="social-icon-link w-inline-block" href="#"><img src="https://uploads.webflow.com/56cf6e77d3b4fc4579d0a954/56cf6e77d3b4fc4579d0a9d0_social-09.svg" width="25"></a></div>-->
                        <p class="built-with-webflow">Built custom</p>
                     </div>
                  </div>
                  <?php echo $footer; ?>
                  <?php } ?>
               
               </div>
            </div>
         </div>
      </div>
      <!--[if lte IE 9]><script src="//cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
   </body>
</html>