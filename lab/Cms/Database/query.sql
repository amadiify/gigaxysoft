-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 15, 2020 at 04:11 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `abrdi-app`
--

-- --------------------------------------------------------

--
-- Table structure for table `Zema_assets`
--

CREATE TABLE `Zema_assets` (
  `assetid` bigint(20) NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'css',
  `visible` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '1',
  `siteid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Zema_assets`
--

INSERT INTO `Zema_assets` (`assetid`, `path`, `tag`, `visible`, `position`, `siteid`) VALUES
(1, 'moorexa.css', 'css', 1, 1, 'ABRDI'),
(2, 'moorexa.min.js', 'js', 1, 1, 'ABRDI'),
(3, 'theme/vendor.bundle.css?ver=141', 'css', 1, 1, 'ABRDI'),
(4, 'theme/style.css?ver=141', 'css', 1, 1, 'ABRDI'),
(5, 'theme/theme.css?ver=141', 'css', 1, 1, 'ABRDI'),
(6, 'theme/jquery.bundle.js?ver=141', 'js', 1, 1, 'ABRDI'),
(7, 'theme/scripts.js?ver=141', 'js', 1, 1, 'ABRDI');

-- --------------------------------------------------------

--
-- Table structure for table `Zema_config`
--

CREATE TABLE `Zema_config` (
  `configid` bigint(20) NOT NULL,
  `sitename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_view` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `developer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siteid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Zema_config`
--

INSERT INTO `Zema_config` (`configid`, `sitename`, `default_controller`, `default_view`, `favicon`, `keywords`, `description`, `developer`, `siteid`) VALUES
(1, 'Welcome to ABRDI', 'App', 'home', 'CMS/favicon.png', '', '', 'ABRDI Team', 'ABRDI');

-- --------------------------------------------------------

--
-- Table structure for table `Zema_containers`
--

CREATE TABLE `Zema_containers` (
  `containerid` bigint(20) NOT NULL,
  `container_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `container_body` text COLLATE utf8mb4_unicode_ci,
  `siteid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Zema_containers`
--

INSERT INTO `Zema_containers` (`containerid`, `container_name`, `container_body`, `siteid`) VALUES
(1, 'header-with-slide', '<!-- Header -->\r\n<header class=\"is-transparent is-sticky is-shrink\" id=\"header\">\r\n	<div class=\"header-main\">\r\n		<div class=\"header-container container\">\r\n			<div class=\"header-wrap\">\r\n				<!-- Logo  -->\r\n				<div class=\"header-logo logo\">\r\n					<a href=\"./\" class=\"logo-link\">\r\n						<img class=\"logo-dark\" src=\"@image(&#039;app-logo&#039;);\" alt=\"logo\">\r\n						<img class=\"logo-light\" src=\"@image(&#039;app-logo&#039;);\" alt=\"logo\">\r\n					</a>\r\n				</div>\r\n				\r\n				<!-- Menu Toogle -->\r\n				<div class=\"header-nav-toggle\">\r\n					<a href=\"#\" class=\"search search-mobile search-trigger\"><i class=\"icon ti-search \"></i></a>\r\n					<a href=\"#\" class=\"navbar-toggle\" data-menu-toggle=\"header-menu\">\r\n						<div class=\"toggle-line\">\r\n							<span></span>\r\n						</div>\r\n					</a>\r\n				</div>\r\n				<!-- Menu Toogle -->\r\n				\r\n				@container(&#039;public-nav&#039;);\r\n\r\n				<!-- header-search -->\r\n				<div class=\"header-search\">\r\n					<form role=\"search\" method=\"POST\" class=\"search-form\" action=\"#\">\r\n						<div class=\"search-group\">\r\n							<input type=\"text\" class=\"input-search\" placeholder=\"Search ...\">\r\n							<button class=\"search-submit\" type=\"submit\"><i class=\"icon ti-search\"></i></button>\r\n						</div>\r\n					</form>\r\n				</div>\r\n				<!-- . header-search -->\r\n			</div>\r\n		</div>\r\n	</div>\r\n	<!-- banner / slider -->\r\n	@container(&#039;home-slide&#039;);\r\n	<!-- .slider / banner -->  \r\n</header>\r\n<!-- end header -->\r\n', 'ABRDI'),
(2, 'header-no-slide', '\r\n<!-- Header -->\r\n<header class=\"is-transparent is-sticky is-shrink\" id=\"header\">\r\n	<div class=\"header-main\">\r\n		<div class=\"header-container container\">\r\n			<div class=\"header-wrap\">\r\n				<!-- Logo  -->\r\n				<div class=\"header-logo logo\">\r\n					<a href=\"./\" class=\"logo-link\">\r\n						<img class=\"logo-dark\" src=\"images/logo.png\" srcset=\"images/logo2x.png 2x\" alt=\"logo\">\r\n						<img class=\"logo-light\" src=\"images/logo-white.png\" srcset=\"images/logo-white2x.png 2x\" alt=\"logo\">\r\n					</a>\r\n				</div>\r\n				\r\n				<!-- Menu Toogle -->\r\n				<div class=\"header-nav-toggle\">\r\n					<a href=\"#\" class=\"search search-mobile search-trigger\"><i class=\"icon ti-search \"></i></a>\r\n					<a href=\"#\" class=\"navbar-toggle\" data-menu-toggle=\"header-menu\">\r\n						<div class=\"toggle-line\">\r\n							<span></span>\r\n						</div>\r\n					</a>\r\n				</div>\r\n				<!-- Menu Toogle -->\r\n				\r\n				@container(\'public-nav\');\r\n\r\n				<!-- header-search -->\r\n				<div class=\"header-search\">\r\n					<form role=\"search\" method=\"POST\" class=\"search-form\" action=\"#\">\r\n						<div class=\"search-group\">\r\n							<input type=\"text\" class=\"input-search\" placeholder=\"Search ...\">\r\n							<button class=\"search-submit\" type=\"submit\"><i class=\"icon ti-search\"></i></button>\r\n						</div>\r\n					</form>\r\n				</div>\r\n				<!-- . header-search -->\r\n			</div>\r\n		</div>\r\n	</div> \r\n</header>\r\n<!-- end header -->\r\n', 'ABRDI'),
(3, 'home-slide', '<div class=\"banner banner-s4 has-slider\">\r\n    <div class=\"has-carousel\" data-effect=\"true\" data-items=\"1\" data-loop=\"true\" data-dots=\"false\" data-auto=\"true\" data-navs=\"true\">\r\n        {$slides = db(\'slides\')->get(\'slide_group = ?\', \'homescreen\');}\r\n\r\n        @fetch ($slides, \'slide\')\r\n            <div class=\"banner-block tc-light d-flex\">\r\n                <div class=\"container\">\r\n                    <div class=\"row\">\r\n                        <div class=\"col-md-10 col-xl-8\">\r\n                            <div class=\"banner-content\">\r\n                                {$slideContent = db(\'slidesAnimation\')->get(\'slideid=?\', $slide->slideid);}\r\n\r\n                                @fetch ($slideContent, \'content\')\r\n                                    @php\r\n                                        $data = $content->contentWrapper;\r\n                                        // replace {content} with $content->content\r\n                                        $data = str_replace(\'{content}\', $content->content, $data);\r\n                                        // replace {slide_btn} with $slide->slide_btn\r\n                                        $data = str_replace(\'{slide_btn}\', url($slide->slide_btn), $data);\r\n                                    @endphp\r\n                                    {$data}\r\n                                @endfetch\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                <!-- bg -->\r\n                <div class=\"bg-image change-bg\">\r\n                    <img src=\"{image($slide->slide_image)}\" alt=\"{$slide->slide_title}\">\r\n                </div>\r\n                <!-- end bg -->\r\n            </div>\r\n        @endfetch\r\n    </div>\r\n    <div class=\"tes-arrow\">\r\n        <a class=\"slick-prev slick-arrow\"><i class=\"icon ti ti-angle-left\"></i></a>\r\n        <a class=\"slick-next slick-arrow\"><i class=\"icon ti ti-angle-right\"></i></a>\r\n    </div>\r\n</div>', 'ABRDI'),
(4, 'public-nav', '<!-- Menu -->\r\n<div class=\"header-navbar\">\r\n	<nav class=\"header-menu\" id=\"header-menu\">\r\n		<ul class=\"menu\">\r\n			{$parentNavigation = Query::getParentNavigation();}\r\n\r\n			@fetch ($parentNavigation, \'parent\')\r\n				\r\n				{$isActive = CMS::pageIsActive($parent);}\r\n\r\n				@if (Query::doesAssertTrueForNavWithChildren($parent->navigationid) == Query::YES)				\r\n					<li class=\"menu-item has-sub\">\r\n						<a class=\"menu-link nav-link {$isActive} menu-toggle\" href=\"@goto($parent->page_link);\">{ucwords($parent->page_name)}</a>\r\n						<ul class=\"menu-sub menu-drop\">\r\n							\r\n							{$getSubNavigation = Query::getParentNavChildren($parent->navigationid);}\r\n\r\n							@fetch ($getSubNavigation, \'sub\')\r\n								<li class=\"menu-item\"><a class=\"menu-link nav-link\" href=\"@goto($sub->page_link);\">{ucwords($sub->page_name)}</a></li>\r\n							@endfetch\r\n						</ul>\r\n					</li>\r\n				@else\r\n					<li class=\"menu-item\"><a class=\"menu-link {$isActive} nav-link\" href=\"@goto($parent->page_link);\">{ucwords($parent->page_name)}</a></li>\r\n				@endif\r\n			@endfetch\r\n		</ul>\r\n	</nav>\r\n</div><!-- .header-navbar --> ', 'ABRDI'),
(5, 'breadcum', '<!-- banner -->\r\n		<div class=\"banner banner-inner banner-s2 banner-s2-inner tc-light\">\r\n			<div class=\"banner-block\">\r\n				<div class=\"container\">\r\n					<div class=\"row align-items-center\">\r\n						<div class=\"col-md-7 col-sm-9\">\r\n							<div class=\"banner-content\">\r\n								<div class=\"line-animate\">\r\n									<span class=\"line line-top\"></span>\r\n									<span class=\"line line-right\"></span>\r\n									<span class=\"line line-bottom\"></span>\r\n									<span class=\"line line-left\"></span>\r\n								</div>\r\n								<p class=\"sub-heading\">@breacum-title;</p>\r\n								<h1 class=\"banner-heading\">@breadcum-desc;</h1>\r\n							</div>\r\n						</div>\r\n					</div>\r\n				</div>\r\n				<div class=\"bg-image\"> {$view = uri()->view;}\r\n\r\n					<img src=\"@image($view.&#039;-banner&#039;);\" alt=\"banner\">\r\n				</div>\r\n			</div>\r\n		</div>\r\n		<!-- .banner --> ', 'ABRDI'),
(6, 'header-with-breadcum', '<!-- Header -->\r\n<header class=\"is-transparent is-sticky is-shrink\" id=\"header\">\r\n	<div class=\"header-main\">\r\n		<div class=\"header-container container\">\r\n			<div class=\"header-wrap\">\r\n				<!-- Logo  -->\r\n				<div class=\"header-logo logo\">\r\n					<a href=\"./\" class=\"logo-link\">\r\n						<img class=\"logo-dark\" src=\"@image(\'app-logo\');\" alt=\"logo\">\r\n						<img class=\"logo-light\" src=\"@image(\'app-logo\');\" alt=\"logo\">\r\n					</a>\r\n				</div>\r\n				\r\n				<!-- Menu Toogle -->\r\n				<div class=\"header-nav-toggle\">\r\n					<a href=\"#\" class=\"search search-mobile search-trigger\"><i class=\"icon ti-search \"></i></a>\r\n					<a href=\"#\" class=\"navbar-toggle\" data-menu-toggle=\"header-menu\">\r\n						<div class=\"toggle-line\">\r\n							<span></span>\r\n						</div>\r\n					</a>\r\n				</div>\r\n				<!-- Menu Toogle -->\r\n				\r\n				@container(\'public-nav\');\r\n\r\n				<!-- header-search -->\r\n				<div class=\"header-search\">\r\n					<form role=\"search\" method=\"POST\" class=\"search-form\" action=\"#\">\r\n						<div class=\"search-group\">\r\n							<input type=\"text\" class=\"input-search\" placeholder=\"Search ...\">\r\n							<button class=\"search-submit\" type=\"submit\"><i class=\"icon ti-search\"></i></button>\r\n						</div>\r\n					</form>\r\n				</div>\r\n				<!-- . header-search -->\r\n			</div>\r\n		</div>\r\n	</div> \r\n    @container(\'breadcum\');\r\n</header>\r\n<!-- end header -->', 'ABRDI'),
(7, 'what we believe', '	\r\n		\r\n			\r\n				\r\n					\r\n						\r\n					\r\n				<h1> hello </h1>\r\n				\r\n					\r\n						We Believe\r\n						 @container(&#039;what we believe heading&#039;); \r\n						@container(&#039;what we believe body&#039;)\r\n						Contact Us\r\n					\r\n				\r\n			\r\n		\r\n	\r\n	', 'ABRDI'),
(8, 'what we believe heading', 'Growth across Africa that will improve the welfare of the people', 'ABRDI'),
(9, 'what we believe body', '<p>Our philosophy is rooted in the principles of financial portfolio management and drives business results through smarter marketing investments.</p>\r\n						<p>Are you ready to start your next  project? We know that when the time comes, you need a partner that not only understands and cares about your needs, but has the in-house capabilities to efficiently complete your project.</p>', 'ABRDI'),
(10, 'contact-wrapper', '<!-- section -->\r\n		<div class=\"section section-x\">\r\n			<div class=\"container\">\r\n				<div class=\"row gutter-vr-30px\">\r\n					<div class=\"col-lg-4\">\r\n						<div class=\"text-block\">\r\n							<div class=\"section-head\">\r\n								<h5 class=\"heading-xs dash fw-4\">Feel the form</h5>\r\n								<h2>@container(&#039;contact-subheading&#039;);</h2>\r\n							</div>\r\n						</div>\r\n					</div><!-- .col -->\r\n					<div class=\"col-lg-8\">\r\n						@container(&#039;contact-form&#039;);\r\n					</div><!-- .col -->\r\n				</div><!-- .row -->\r\n			</div><!-- .container -->\r\n		</div>\r\n		<!-- .section -->', 'ABRDI'),
(11, 'contact-details', '<div class=\"text-box is-shadow contact-box\">\r\n								<div class=\"contact-content contact-content-s3\">\r\n									<h4>Phone:</h4>\r\n									<p>1800 456 7890</p>\r\n								</div>\r\n								<div class=\"contact-content contact-content-s3\">\r\n									<h4>Email:</h4>\r\n									<p>info@genox.com</p>\r\n								</div>\r\n								<div class=\"contact-content contact-content-s3\">\r\n									<h4>Address:</h4>\r\n									<address>52A, Tailstoi Town 5238 La city, IA 85796</address>\r\n								</div>\r\n							</div>', 'ABRDI'),
(12, 'contact-form', '@alert;\r\n<form class=\"genox-form\" action=\"\" method=\"POST\">\r\n@csrf;\r\n							<div class=\"form-results\"></div>\r\n							<div class=\"row\">\r\n								<div class=\"form-field col-md-6\">\r\n									<input name=\"cf_name\" type=\"text\" placeholder=\"Your Name\" class=\"input bg-secondary required\">\r\n								</div>\r\n								<div class=\"form-field col-md-6\">\r\n									<input name=\"cf_email\" type=\"email\" placeholder=\"Your Email\" class=\"input bg-secondary required\">\r\n								</div>\r\n							</div>\r\n							<div class=\"row\">\r\n								<div class=\"form-field col-md-6\">\r\n									<input name=\"cf_address\" type=\"text\" placeholder=\"Your Address\" class=\"input bg-secondary\">\r\n								</div>\r\n								<div class=\"form-field col-md-6\">\r\n									<input name=\"cf_country\" type=\"text\" placeholder=\"Your Country\" class=\"input bg-secondary\">\r\n								</div>\r\n							</div>\r\n							\r\n							<div class=\"row\">\r\n								<div class=\"form-field col-md-12\">\r\n									<textarea name=\"cf_msg\" placeholder=\"Your message here\" class=\"input input-msg bg-secondary required\" aria-required=\"true\"></textarea>\r\n									<input type=\"text\" class=\"d-none\" name=\"form-anti-honeypot\" value=\"\">\r\n									<button type=\"submit\" class=\"btn btn-md\">Send Message</button>\r\n								</div>\r\n							</div>\r\n						</form><!-- end form -->', 'ABRDI'),
(13, 'contact-subheading', 'Let’s make something awesome togheter', 'ABRDI'),
(14, 'footer', '<!-- footer -->\r\n	<footer class=\"section footer footer-alt\">\r\n		<div class=\"container\">\r\n			<div class=\"row gutter-vr-30px\">\r\n				<div class=\"col-lg-4 col-sm-6\">\r\n					<div class=\"wgs\">\r\n						<div class=\"wgs-content\">\r\n							<div class=\"wgs-logo\">\r\n								<a href=\"./\">\r\n									<img src=\"@image(&#039;app-logo&#039;);\" srcset=\"@image(&#039;app-logo&#039;);\" alt=\"logo\">\r\n								</a>\r\n							</div>\r\n							<p>@container(&#039;footer-text&#039;);</p>	\r\n						</div>\r\n					</div><!-- .wgs -->\r\n				</div><!-- .col -->\r\n				<div class=\"col-lg-2 offset-lg-1 col-sm-6\">\r\n					<div class=\"wgs\">\r\n						<div class=\"wgs-content\">\r\n							<h3 class=\"wgs-title\">Company</h3>\r\n							<ul class=\"wgs-menu\">\r\n								<li><a href=\"@goto(&#039;about&#039;);\">About us</a></li>\r\n								<li><a href=\"@goto(&#039;about&#039;);\">Why ABRDI?</a></li>\r\n								<li><a href=\"@goto(&#039;about&#039;);\">Meet the team</a></li>\r\n							</ul>\r\n						</div>\r\n					</div><!-- .wgs -->\r\n				</div><!-- .col -->\r\n				<div class=\"col-lg-2 col-sm-6\">\r\n					<div class=\"wgs\">\r\n						<div class=\"wgs-content\">\r\n							<h3 class=\"wgs-title\">Services</h3>\r\n							<ul class=\"wgs-menu\">\r\n								<li><a href=\"texas-service-single.html\">Digital Media</a></li>\r\n								<li><a href=\"texas-service-single.html\">Strategy</a></li>\r\n								<li><a href=\"texas-service-single.html\">Development</a></li>\r\n							</ul>\r\n						</div>\r\n					</div><!-- .wgs -->\r\n				</div><!-- .col -->\r\n				<div class=\"col-lg-3 col-sm-6\">\r\n					<div class=\"wgs\">\r\n						<div class=\"wgs-content\">\r\n							<h3 class=\"wgs-title\">Get our staff</h3>\r\n							<form class=\"genox-form\" action=\"\" method=\"POST\">\r\n@csrf;\r\n@method(&#039;subcribe&#039;);\r\n								<div class=\"form-results\"></div>\r\n								<div class=\"field-group btn-inline\">\r\n									<input name=\"s_email\" type=\"email\" class=\"input\" placeholder=\"Your  Email\">\r\n									<input type=\"text\" class=\"d-none\" name=\"form-anti-honeypot\" value=\"\">\r\n									<button type=\"submit\"  class=\"far fa-paper-plane button\"></button>\r\n								</div>\r\n							</form>\r\n						</div>\r\n					</div><!-- .wgs -->\r\n				</div><!-- .col -->\r\n			</div><!-- .row -->\r\n		</div><!-- .container -->\r\n	</footer>\r\n	<!-- .footer -->\r\n\r\n	<!-- copyright -->\r\n	<div class=\"copyright\">\r\n		<div class=\"container bdr-copyright\">\r\n			<div class=\"row align-items-center justify-content-between\">\r\n				<div class=\"col-md-6\">\r\n					<div class=\"copyright-content\">\r\n						<p>© {date(&#039;Y&#039;)}. All rights reserved. Powered by <a href=\"http://moorexa.com\" target=\"_blank\">Moorexa</a></p>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-md-6 text-md-right\">\r\n					<div class=\"copyright-content\">\r\n						<ul class=\"social social-style-icon\">\r\n							<li><a href=\"\" class=\"fab fa-facebook-f\"></a></li>\r\n							<li><a href=\"\" class=\"fab fa-twitter\"></a></li>\r\n							<li><a href=\"\" class=\"fab fa-dribbble\"></a></li>\r\n							<li><a href=\"\" class=\"fab fa-behance\"></a></li>\r\n						</ul>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n	<!-- .copyright -->\r\n		\r\n	<!-- preloader -->\r\n	<div class=\"preloader preloader-light preloader-texas no-split\"><span class=\"spinner spinner-alt\"><img class=\"spinner-brand\" src=\"@image(&#039;app-logo&#039;);\" alt=\"\"></span></div>\r\n', 'ABRDI'),
(15, 'header-with-banner', '<!-- Header -->\r\n<header class=\"is-transparent is-sticky is-shrink\" id=\"header\">\r\n	<div class=\"header-main\">\r\n		<div class=\"header-container container\">\r\n			<div class=\"header-wrap\">\r\n				<!-- Logo  -->\r\n				<div class=\"header-logo logo\">\r\n					<a href=\"./\" class=\"logo-link\">\r\n						<img class=\"logo-dark\" src=\"@image(\'app-logo\');\" alt=\"logo\">\r\n						<img class=\"logo-light\" src=\"@image(\'app-logo\');\" alt=\"logo\">\r\n					</a>\r\n				</div>\r\n				\r\n				<!-- Menu Toogle -->\r\n				<div class=\"header-nav-toggle\">\r\n					<a href=\"#\" class=\"search search-mobile search-trigger\"><i class=\"icon ti-search \"></i></a>\r\n					<a href=\"#\" class=\"navbar-toggle\" data-menu-toggle=\"header-menu\">\r\n						<div class=\"toggle-line\">\r\n							<span></span>\r\n						</div>\r\n					</a>\r\n				</div>\r\n				<!-- Menu Toogle -->\r\n				\r\n				@container(\'public-nav\');\r\n\r\n				<!-- header-search -->\r\n				<div class=\"header-search\">\r\n					<form role=\"search\" method=\"POST\" class=\"search-form\" action=\"#\">\r\n						<div class=\"search-group\">\r\n							<input type=\"text\" class=\"input-search\" placeholder=\"Search ...\">\r\n							<button class=\"search-submit\" type=\"submit\"><i class=\"icon ti-search\"></i></button>\r\n						</div>\r\n					</form>\r\n				</div>\r\n				<!-- . header-search -->\r\n			</div>\r\n		</div>\r\n	</div>\r\n	<!-- banner  -->\r\n	@container(\'home-banner\');\r\n	<!-- banner -->  \r\n</header>\r\n<!-- end header -->', 'ABRDI'),
(16, 'home-banner', '<div class=\"banner banner-s2\">\r\n			<div class=\"banner-block\">\r\n				<div class=\"container\">\r\n					<div class=\"row align-items-center\">\r\n						<div class=\"col-sm-2 order-last order-sm-first\">\r\n							<ul class=\"social social-alt\">\r\n								<li><a href=\"\" class=\"fab fa-facebook-f\"></a></li>\r\n								<li><a href=\"\" class=\"fab fa-twitter\"></a></li>\r\n								<li><a href=\"\" class=\"fab fa-dribbble\"></a></li>\r\n								<li><a href=\"\" class=\"fab fa-pinterest\"></a></li>\r\n							</ul>\r\n						</div>\r\n						<div class=\"col-10 col-sm-9\">\r\n							<div class=\"banner-content\">\r\n								<div class=\"line-animate\">\r\n									<span class=\"line line-top\"></span>\r\n									<span class=\"line line-right\"></span>\r\n									<span class=\"line line-bottom\"></span>\r\n									<span class=\"line line-left\"></span>\r\n								</div>\r\n								<p class=\"sub-heading\">@container(\'home-sub-heading\');</p>\r\n								<h1 class=\"banner-heading size-sm\">@container(\'home-heading\');</h1>\r\n                                @container(\'home-button\');\r\n							</div>\r\n						</div>\r\n					</div>\r\n				</div>\r\n				<div class=\"bg-image\">\r\n					<img src=\"@image(\'home-banner\');\" alt=\"banner\">\r\n				</div>\r\n			</div>\r\n		</div>\r\n		<!-- .banner -->', 'ABRDI'),
(17, 'footer-text', 'African Better Roads Development Initiative is an NGO that promotes the development of Inter and Intra Regional Connectivity within the African continent.', 'ABRDI'),
(18, 'home-sub-heading', 'WHAT WE DO', 'ABRDI'),
(19, 'home-heading', 'Promote Economic Growth across Africa', 'ABRDI'),
(20, 'home-button', '<div class=\"banner-btn\">\r\n									<h6>Explore Events</h6>\r\n									<a href=\"texas-work.html\" class=\"btn-scroll\"><em class=\"ti-angle-right\"></em></a>\r\n								</div>', 'ABRDI'),
(22, 'who-we-are', '<!-- section -->\r\n	<div class=\"section section-x tc-grey\">\r\n		<div class=\"container\">\r\n			<div class=\"row gutter-vr-30px justify-content-between align-items-start align-items-md-start\">\r\n				<div class=\"col-lg-6 order-lg-last\">\r\n					<div class=\"box-image\">\r\n						<img src=\"@image(&#039;who-we-are&#039;);\" alt=\"\">\r\n					</div>\r\n				</div><!-- .col -->\r\n				<div class=\"col-lg-6\">\r\n					<div class=\"text-block block-pad-b-100\">\r\n						<h5 class=\"heading-xs dash\">Who are we</h5>\r\n						<h2>@container(&#039;who-we-are-title&#039;);</h2>\r\n						@container(&#039;who-we-are-body&#039;);\r\n						<a href=\"@goto(&#039;about&#039;);\" class=\"btn\">More About Us</a>\r\n					</div><!-- .text-block  -->\r\n				</div><!-- .col -->\r\n			</div><!-- .row -->\r\n			<div class=\"row gutter-vr-30px\">\r\n				<div class=\"col-md-6\">\r\n					<div class=\"text-block bg-primary tc-light d-flex\">\r\n						<div class=\"row align-items-center m-0\">\r\n							<div class=\"col-12 p-0 col-xl-6 order-xl-last\">\r\n								<div class=\"box-image\">\r\n									<img src=\"@image(&#039;better-roads&#039;);\" alt=\"\">\r\n								</div>\r\n							</div>\r\n							<div class=\"col-12 col-xl-6 p-lg-0\">\r\n								<div class=\"text-box team-pad\">\r\n									<h4>Our Vision</h4>\r\n									<p>@container(&#039;vision-text&#039;);</p>\r\n								</div>\r\n							</div>\r\n						</div>\r\n					</div>\r\n				</div><!-- .col -->\r\n				<div class=\"col-md-6\">\r\n					<div class=\"text-block bg-secondary\">\r\n						<div class=\"row align-items-center m-0\">\r\n							<div class=\"col-12 p-0 col-xl-6 order-xl-last\">\r\n								<div class=\"box-image\">\r\n									<img src=\"@image(&#039;mission-image&#039;);\" alt=\"\">\r\n								</div>\r\n							</div>\r\n							<div class=\"col-12 col-xl-6 p-lg-0\">\r\n								<div class=\"text-box team-pad\">\r\n									<h4>Our Mission</h4>\r\n									<p class=\"tc-grey\">@container(&#039;mission-text&#039;);</p>\r\n								</div>\r\n							</div>\r\n						</div>\r\n					</div>\r\n				</div><!-- .col -->\r\n			</div><!-- .row -->\r\n		</div>\r\n	</div>\r\n	<!-- .section -->', 'ABRDI'),
(23, 'who-we-are-title', 'We’re an African NGO promoting better roads and economic growth across Africa', 'ABRDI'),
(24, 'who-we-are-body', '<p class=\"lead\">@container(&#039;footer-text&#039;);</p>\r\n<p>Better road infrastructure is one basic and critical factor that shapes the face of development in every economy. Road networks provide access to employment, social, health and education services, which are vital to any development agenda.</p>', 'ABRDI'),
(25, 'vision-text', 'To ensure healthy, safe and better roads for road users in Africa and promote economic growth across Africa.', 'ABRDI'),
(26, 'mission-text', 'To promote the development of Inter and Intra Regional Connectivity within the African continent.', 'ABRDI'),
(27, 'what-we-do', '<!-- section -->\r\n	<div class=\"section section-x tc-light section-feature-alt\">\r\n		<div class=\"container\">\r\n			<div class=\"row justify-content-center\">\r\n				<div class=\"col-lg-6 text-center\">\r\n					<div class=\"section-head section-md\">\r\n						<h5 class=\"heading-xs dash dash-both\">What we do</h5>\r\n						<h2>@container(&#039;what-we-do-title&#039;);</h2>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n		<div class=\"container-fluid\">\r\n			<div class=\"row\">\r\n				<div class=\"col-lg-3 col-sm-6 bdr-rt bdr_dark_v1 text-center\">\r\n					<div class=\"feature feature-alt\">\r\n						<div class=\"feature-icon\">\r\n							<em class=\"icon ti-car\"></em>\r\n						</div>\r\n						<div class=\"feature-content\">\r\n							<h3>Investments</h3>\r\n							<p>@container(&#039;investment&#039;);</p>\r\n							\r\n						</div>\r\n					</div>\r\n				</div><!-- .col -->\r\n				<div class=\"col-lg-3 col-sm-6 bdr-rt bdr_dark_v1 text-center\">\r\n					<div class=\"feature feature-alt\">\r\n						<div class=\"feature-icon\">\r\n							<em class=\"icon ti-stats-up\"></em>\r\n						</div>\r\n						<div class=\"feature-content\">\r\n							<h3>Growth</h3>\r\n							<p>@container(&#039;growth&#039;);</p>\r\n						</div>\r\n					</div>\r\n				</div><!-- .col -->\r\n				<div class=\"col-lg-3 col-sm-6 bdr-rt bdr_dark_v1 text-center\">\r\n					<div class=\"feature feature-alt\">\r\n						<div class=\"feature-icon\">\r\n							<em class=\"icon ti-layers-alt\"></em>\r\n						</div>\r\n						<div class=\"feature-content\">\r\n							<h3>Development</h3>\r\n							<p>@container(&#039;development&#039;);</p>\r\n							\r\n						</div>\r\n					</div>\r\n				</div><!-- .col -->\r\n				<div class=\"col-lg-3 col-sm-6 bdr-rt bdr_dark_v1 text-center\">\r\n					<div class=\"feature feature-alt\">\r\n						<div class=\"feature-icon\">\r\n							<em class=\"icon ti-shield\"></em>\r\n						</div>\r\n						<div class=\"feature-content\">\r\n							<h3>Protection</h3>\r\n							<p>@container(&#039;protection&#039;);</p>\r\n							\r\n						</div>\r\n					</div>\r\n				</div><!-- .col -->\r\n			</div><!-- .row -->\r\n		</div>\r\n		<!-- bg -->\r\n		<div class=\"bg-image overlay-dark bg-fixed\">\r\n			<img src=\"@image(&#039;what-we-do-image&#039;);\" alt=\"\">\r\n		</div>\r\n		<!-- .bg -->\r\n	</div>\r\n	<!-- .section -->', 'ABRDI'),
(28, 'what-we-do-title', 'We Promote Economic Growth across Africa that will improve the welfare of the people', 'ABRDI'),
(29, 'investment', 'Inadequate road links are a major contributor to poverty in Africa. We Promote Green Investment, Green Finance and Green Infrastructure in Africa', 'ABRDI'),
(30, 'growth', 'We promote Sustained economic growth, providing regional interconnectivity, increasing welfare in target areas and boosting trade connections.', 'ABRDI'),
(31, 'development', 'Roads are the basic building blocks of development. We promote government participation in Road Development for Africa. ', 'ABRDI'),
(32, 'protection', 'We promote a Sustainable public campaign on proper road safety values and practices.', 'ABRDI'),
(33, 'meet-the-team', '<!-- team -->\r\n	<div class=\"section section-x team tc-grey\">\r\n		<div class=\"container\">\r\n			<div class=\"row justify-content-center\">\r\n				<div class=\"col-lg-6 text-center\">\r\n					<div class=\"section-head section-md\">\r\n						<h5 class=\"heading-xs dash dash-both\">Meet the team</h5>\r\n						<h2>People behind ABRDI.</h2>\r\n					</div>\r\n				</div>\r\n			</div><!-- .row -->\r\n			<div class=\"row justify-content-center gutter-vr-30px\">\r\n				<div class=\"col-lg-3 col-sm-5\">\r\n					<div class=\"team-single text-center\">\r\n						<div class=\"team-image\">\r\n							<img src=\"@image(&#039;mr-david&#039;);\" alt=\"\">\r\n						</div>\r\n						<div class=\"team-content\">\r\n							<h5 class=\"team-name\">David Olatunji</h5>\r\n							<p>CEO, ABRDI</p>\r\n						</div>\r\n					</div>\r\n				</div><!-- .col -->\r\n				<div class=\"col-lg-3 col-sm-5\">\r\n					<div class=\"team-single text-center\">\r\n						<div class=\"team-image\">\r\n							<img src=\"images/team-b.jpg\" alt=\"\">\r\n						</div>\r\n						<div class=\"team-content\">\r\n							<h5 class=\"team-name\">Marina Bedi</h5>\r\n							<p>Developer, Genox</p>\r\n						</div>\r\n					</div>\r\n				</div><!-- .col -->\r\n				<div class=\"col-lg-3 col-sm-5\">\r\n					<div class=\"team-single text-center\">\r\n						<div class=\"team-image\">\r\n							<img src=\"images/team-c.jpg\" alt=\"\">\r\n						</div>\r\n						<div class=\"team-content\">\r\n							<h5 class=\"team-name\">Ajax Holder</h5>\r\n							<p>Head of Research, Genox</p>\r\n						</div>\r\n					</div>\r\n				</div><!-- .col -->\r\n				<div class=\"col-lg-3 col-sm-5\">\r\n					<div class=\"team-single text-center\">\r\n						<div class=\"team-image\">\r\n							<img src=\"images/team-p.jpg\" alt=\"\">\r\n						</div>\r\n						<div class=\"team-content\">\r\n							<h5 class=\"team-name\">Maria Diana</h5>\r\n							<p>Product Developer, Genox</p>\r\n						</div>\r\n					</div>\r\n				</div><!-- .col -->\r\n			</div><!-- .row -->\r\n		</div><!-- .container -->\r\n	</div>\r\n	<!-- .team -->', 'ABRDI'),
(34, 'callout-section', '<!-- section / cta-->\r\n	<div class=\"section section-cta tc-light\">\r\n		<div class=\"container\">\r\n			<div class=\"row gutter-vr-30px align-items-center justify-content-between\">\r\n				<div class=\"col-lg-8 text-center text-lg-left\">\r\n					<div class=\"cta-text-s2\">\r\n						<h2><span>Ready to make  great ? </span> <strong>Let’s work together</strong></h2>\r\n					</div>\r\n				</div>\r\n				<div class=\"col-lg-4 text-lg-right text-center\">\r\n					<div class=\"cta-btn\">\r\n						<a href=\"texas-contact.html\" class=\"btn btn-lg\">work with us</a>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n		<div class=\"bg-image bg-fixed\">\r\n			<img src=\"@image(&#039;call-out-bg&#039;);\" alt=\"\">\r\n		</div>\r\n	</div>\r\n	<!-- .section-cta -->', 'ABRDI'),
(35, 'about-page-intro', 'Promoting Sustainable economy', 'ABRDI'),
(36, 'who-we-are-about', '<!-- section --><div class=\"section section-x tc-grey-alt\"><div class=\"container\"><div class=\"row justify-content-between gutter-vr-30px\"><div class=\"col-lg-6\"><div class=\"image-block\"><img src=\"@image(&#039;who-we-are-about&#039;);\" alt=\"\" class=\"fr-fic fr-dii\"></div></div><!-- .col --><div class=\"col-lg-6\"><div class=\"text-block mtm-8 text-box-ml-2x\"><h5 class=\"heading-xs dash\">Who We Are</h5><h2>@container(&#39;who-we-are-title&#39;);</h2>@container(&#39;who-we-are-body&#39;);</div><!-- .text-block  --></div><!-- .col --></div><!-- .row --></div><!-- .container --></div><!-- .section -->', 'ABRDI'),
(37, 'our-values', '<!-- section -->\r\n	<div class=\"section section-x bg-secondary is-bg-half tc-grey\">\r\n\r\n		<!-- bg -->\r\n		<div class=\"bg-image bg-half style-right\">\r\n			<img src=\"@image(&#039;our-values&#039;);\" alt=\"\">\r\n		</div>\r\n		<!-- end bg -->\r\n		\r\n		<div class=\"container\">\r\n			<div class=\"row\">\r\n				<div class=\"col-md-6\">\r\n					<div class=\"row gutter-vr-30px\">\r\n						<div class=\"col-md-10\">\r\n							<div class=\"section-head section-head-col m-0\">\r\n								<h5 class=\"heading-xs dash\">OUR VALUES</h5>\r\n								<h2>What we care about makes us who we are.</h2>\r\n							</div>\r\n						</div>\r\n						<div class=\"col-lg-6\">\r\n							<div class=\"text-box res-pr-1rem\">\r\n								<h4 class=\"fw-6\">Investment</h4>\r\n								<p>@container(&#039;investment&#039;);</p>\r\n							</div>\r\n						</div>\r\n						<div class=\"col-lg-6\">\r\n							<div class=\"text-box res-pr-1rem\">\r\n								<h4 class=\"fw-6\">Growth</h4>\r\n								<p>@container(&#039;growth&#039;);</p>\r\n							</div>\r\n						</div>\r\n						<div class=\"col-lg-6\">\r\n							<div class=\"text-box res-pr-1rem\">\r\n								<h4 class=\"fw-6\">Development</h4>\r\n								<p>@container(&#039;development&#039;);</p>\r\n							</div>\r\n						</div>\r\n						<div class=\"col-lg-6\">\r\n							<div class=\"text-box res-pr-1rem\">\r\n								<h4 class=\"fw-6\">Protection</h4>\r\n								<p>@container(&#039;protection&#039;);</p>\r\n							</div>\r\n						</div>\r\n					</div>\r\n				</div>\r\n			</div>\r\n		</div>\r\n	</div>\r\n	<!-- .section -->\r\n\r\n@container(&#039;objectives-container&#039;);', 'ABRDI'),
(38, 'objectives', '<ol>\r\n<li>To Promote government participation in Road Development</li>\r\n<li>To Promote the development of Inter and Intra Regional Connectivity within the African continent</li>\r\n<li>To Promote Investments within the African continent to empower the people</li>\r\n<li>To Promote Economic Growth across Africa that will improve the welfare of the people</li>\r\n<li>To Promote and Support the achievement of Sustainable Infrastructural Development Objectives in Africa</li>\r\n<li>To Promote Green Investment, Green Finance and Green Infrastructure in Africa</li>\r\n<li>To Promote Environmental Protection, Prevention and Mitigation of Polution</li>\r\n<li>To Promote avenues and mediums that will encourage Slash Trade Cost.</li>\r\n</ol>', 'ABRDI'),
(39, 'objectives-container', '<!-- section -->\r\n	<div class=\"section section-x tc-grey-alt\">\r\n		<div class=\"container\">\r\n			<div class=\"row justify-content-between gutter-vr-30px\">\r\n				<div class=\"col-lg-6\">\r\n					<div class=\"image-block\">\r\n						<img src=\"@image(&#039;our-objective-bg&#039;);\" alt=\"\">\r\n					</div>\r\n				</div><!-- .col -->\r\n				<div class=\"col-lg-6\">\r\n					<div class=\"text-block mtm-8 text-box-ml-2x\">\r\n						<h5 class=\"heading-xs dash\">Our Objectives</h5>\r\n						<h2>The African Better Roads Development initiative aims, </h2>\r\n						@container(&#039;objectives&#039;);\r\n					</div><!-- .text-block  -->\r\n				</div><!-- .col -->\r\n			</div><!-- .row -->\r\n		</div><!-- .container -->\r\n	</div>\r\n	<!-- .section -->', 'ABRDI'),
(40, 'focus-page-intro', 'Promoting growth across africa', 'ABRDI'),
(41, 'contact-page-intro', 'Have a question? Let&#039;s Talk', 'ABRDI'),
(42, 'contact-address', '<!-- section  -->\r\n		<div class=\"section tc-light section-x\">\r\n			<div class=\"container\">\r\n				<div class=\"row gutter-vr-30px\">\r\n                    <div class=\"col-lg-3 col-md-4\"></div>\r\n                    <div class=\"col-lg-2 offset-lg-1 col-md-4\"></div>\r\n					<div class=\"col-lg-4 offset-lg-1 col-md-4\">\r\n						<div class=\"contact-text\">\r\n							<div class=\"text-box\">\r\n								<h3>Nigeria</h3>\r\n								<p class=\"lead\">@container(&#039;nigeria-address&#039;);</p>\r\n							</div>\r\n							<ul class=\"contact-list\">\r\n								@container(&#039;contact-list&#039;);\r\n							</ul>\r\n						</div>\r\n					</div><!-- .col -->\r\n				</div><!-- .row -->\r\n			</div><!-- .container -->\r\n			<!-- bg -->\r\n			<div class=\"bg-image bg-fixed\">\r\n				<img src=\"@image(&#039;contact-us-address-bg&#039;);\" alt=\"\">\r\n			</div>\r\n			<!-- .bg -->\r\n		</div>\r\n		<!-- .section -->', 'ABRDI'),
(43, 'nigeria-address', 'Ground Floor Suite 2, Peace Park \'A\' Plaza, Plot 480/483, Ajose Adeogun Street, Off Obafemi Awolowo, Utako, Abuja', 'ABRDI'),
(44, 'contact-list', '<li>\r\n									<em class=\"contact-icon ti-mobile\"></em>\r\n									<div class=\"conatct-content\">\r\n										<a href=\"tel:+2349075523333\">+2349075523333</a>\r\n									</div>\r\n								</li>\r\n								<li>\r\n									<em class=\"contact-icon ti-email\"></em>\r\n									<div class=\"conatct-content\">\r\n										<a href=\"mailto:info@abrdi.org\">info.at.abrdi.org</a>\r\n									</div>\r\n								</li>', 'ABRDI');

-- --------------------------------------------------------

--
-- Table structure for table `Zema_directives`
--

CREATE TABLE `Zema_directives` (
  `directiveid` bigint(20) NOT NULL,
  `directive` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `directive_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `directive_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siteid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Zema_directives`
--

INSERT INTO `Zema_directives` (`directiveid`, `directive`, `directive_class`, `directive_method`, `siteid`) VALUES
(1, 'image', 'CmsGlobal\\Cms', 'loadImages', 'ABRDI'),
(2, 'breacum-title', 'CmsGlobal\\Cms', 'loadBreadcumTitle', 'ABRDI'),
(3, 'goto', 'CmsGlobal\\Cms', 'gotoDirective', 'ABRDI'),
(4, 'breadcum-desc', 'CmsGlobal\\Cms', 'loadBreadcumDescription', 'ABRDI');

-- --------------------------------------------------------

--
-- Table structure for table `Zema_images`
--

CREATE TABLE `Zema_images` (
  `imageid` bigint(20) NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siteid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Zema_images`
--

INSERT INTO `Zema_images` (`imageid`, `image_path`, `alt`, `title`, `image_name`, `siteid`) VALUES
(1, 'CMS/ABRDI-Logo.png', NULL, NULL, 'app-logo', 'ABRDI'),
(2, './lab/Cms/MVC/App/Uploads/who-we-are.jpg', NULL, NULL, 'we-believe', 'ABRDI'),
(3, './lab/Cms/MVC/App/Uploads/22faf6fa7553ba9fdab732b8bb4ecd6fwhat-we-do-image.png', NULL, NULL, 'home-banner', 'ABRDI'),
(4, './lab/Cms/MVC/App/Uploads/who-we-are.jpg', NULL, NULL, 'who-we-are', 'ABRDI'),
(5, './lab/Cms/MVC/App/Uploads/vision-image.jpg', NULL, NULL, 'better-roads', 'ABRDI'),
(6, './lab/Cms/MVC/App/Uploads/mission-image2.jpg', NULL, NULL, 'mission-image', 'ABRDI'),
(7, './lab/Cms/MVC/App/Uploads/5ec92c35876abee54da0050faaabfaa1what-we-do2.png', NULL, NULL, 'what-we-do-image', 'ABRDI'),
(8, './lab/Cms/MVC/App/Uploads/mr-david.jpg', NULL, NULL, 'mr-david', 'ABRDI'),
(9, './lab/Cms/MVC/App/Uploads/our-values.jpg', NULL, NULL, 'our-values', 'ABRDI'),
(10, './lab/Cms/MVC/App/Uploads/81cd322525582819c9895fd0b4374f33about-us-bg.png', NULL, NULL, 'about-banner', 'ABRDI'),
(11, './lab/Cms/MVC/App/Uploads/what-we-do-image.png', NULL, NULL, 'focus-banner', 'ABRDI'),
(12, './lab/Cms/MVC/App/Uploads/contact-us-banner.png', NULL, NULL, 'contact-banner', 'ABRDI'),
(13, './lab/Cms/MVC/App/Uploads/0bde6944f86ee99c17ac6f35d63125f9contact-us-address.png', NULL, NULL, 'contact-us-address-bg', 'ABRDI'),
(14, './lab/Cms/MVC/App/Uploads/who-we-are-bg.jpg', NULL, NULL, 'who-we-are-about', 'ABRDI'),
(15, './lab/Cms/MVC/App/Uploads/our-objectives.jpg', NULL, NULL, 'our-objective-bg', 'ABRDI'),
(16, './lab/Cms/MVC/App/Uploads/6d8a0f13826253adff2fad55a77505b5bad-road-need-fix.png', NULL, NULL, 'call-out-bg', 'ABRDI'),
(17, 'CMS/mmexport1543478758695.jpg', NULL, NULL, 'we-believe', 'ABRDI'),
(18, 'CMS/better-roads.png', NULL, NULL, 'home-banner', 'ABRDI');

-- --------------------------------------------------------

--
-- Table structure for table `Zema_navigation`
--

CREATE TABLE `Zema_navigation` (
  `navigationid` bigint(20) NOT NULL,
  `page_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `navigationtypeid` int(11) DEFAULT NULL,
  `visible` tinyint(4) DEFAULT '1',
  `position` int(11) DEFAULT '1',
  `parentid` bigint(20) DEFAULT '0',
  `keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `page_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `breadcum_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siteid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Zema_navigation`
--

INSERT INTO `Zema_navigation` (`navigationid`, `page_name`, `page_link`, `navigationtypeid`, `visible`, `position`, `parentid`, `keyword`, `description`, `page_title`, `breadcum_title`, `siteid`) VALUES
(1, 'Home', 'app/home', 1, 1, 1, 0, NULL, NULL, NULL, 'Welcome', 'ABRDI'),
(2, 'About', 'app/about', 1, 1, 1, 0, 'about abrdi, About ABRDI', NULL, 'About ABRDI', 'About us', 'ABRDI'),
(3, 'Focus', 'app/focus', 1, 1, 1, 0, 'ABRDI focus, abrdi focus, our focus', NULL, 'ABRDI Focus', 'Our Focus', 'ABRDI'),
(4, 'Gallery', 'app/gallery', 1, 1, 1, 0, 'ABRDI Gallery, Gallery', NULL, 'ABRDI Gallery', 'Our Gallery', 'ABRDI'),
(5, 'Project', 'app/project', 1, 1, 1, 0, 'ABRDI Projects, ABRDI project', NULL, 'ABRDI Projects', 'Our Projects', 'ABRDI'),
(6, 'Contact', 'app/contact', 1, 1, 1, 0, 'Contact ABRDI, contact abrdi', NULL, 'Contact ABRDI', 'Contact us', 'ABRDI');

-- --------------------------------------------------------

--
-- Table structure for table `Zema_navigationtypes`
--

CREATE TABLE `Zema_navigationtypes` (
  `navigationtypeid` bigint(20) NOT NULL,
  `navigationtype` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siteid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Zema_navigationtypes`
--

INSERT INTO `Zema_navigationtypes` (`navigationtypeid`, `navigationtype`, `siteid`) VALUES
(1, 'public', NULL),
(2, 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Zema_permission`
--

CREATE TABLE `Zema_permission` (
  `permissionid` bigint(20) NOT NULL,
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission_group` text COLLATE utf8mb4_unicode_ci,
  `siteid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Zema_permission`
--

INSERT INTO `Zema_permission` (`permissionid`, `permission`, `permission_group`, `siteid`) VALUES
(1, 'Basic Moderator', 'view', NULL),
(2, 'Moderator', 'view,edit,update,upload', NULL),
(3, 'Administrator', 'view,edit,update,delete,upload', NULL),
(4, 'Super Adminstrator', 'view,edit,update,delete,upload,create,destroy', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Zema_slides`
--

CREATE TABLE `Zema_slides` (
  `slideid` bigint(20) NOT NULL,
  `slide_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slide_group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'homescreen',
  `slide_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slide_btn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siteid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Zema_slides`
--

INSERT INTO `Zema_slides` (`slideid`, `slide_title`, `slide_group`, `slide_image`, `slide_btn`, `siteid`) VALUES
(1, 'smart city', 'homescreen', 'Slides/slide1.jpg', 'app/home', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Zema_slidesAnimation`
--

CREATE TABLE `Zema_slidesAnimation` (
  `slidesAnimationid` bigint(20) NOT NULL,
  `slideid` bigint(20) DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contentWrapper` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siteid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Zema_slidesAnimation`
--

INSERT INTO `Zema_slidesAnimation` (`slidesAnimationid`, `slideid`, `content`, `contentWrapper`, `siteid`) VALUES
(1, 1, 'Crafting Digital Experience to help brands grow', '<h1 class=\\\"banner-heading animate t-u\\\" data-animate=\\\"fade-in-up\\\" data-delay=\\\"0.5\\\" data-duration=\\\"0.5\\\">{content}</h1>', NULL),
(2, 1, 'The digital agency with a human approach', '<p class=\\\"lead lead-lg animate\\\" data-animate=\\\"fade-in-up\\\" data-delay=\\\"0.12\\\" data-duration=\\\"0.5\\\">{content}</p>', NULL),
(3, 1, 'Check Out Our Work', '<div class=\\\"banner-btn animate\\\" data-animate=\\\"fade-in-up\\\" data-delay=\\\"0.20\\\" data-duration=\\\"0.9\\\">\n                        <a href=\\\"{slide_btn}\\\" class=\\\"menu-link btn\\\">{content}</a>\n                    </div>', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Zema_users`
--

CREATE TABLE `Zema_users` (
  `userid` bigint(20) NOT NULL,
  `permissionid` bigint(20) DEFAULT '1',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createdby` bigint(20) DEFAULT '0',
  `dateadded` datetime DEFAULT CURRENT_TIMESTAMP,
  `loggedinToken` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siteid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Zema_users`
--

INSERT INTO `Zema_users` (`userid`, `permissionid`, `username`, `password`, `fullname`, `createdby`, `dateadded`, `loggedinToken`, `siteid`) VALUES
(1, 4, 'admin', '$2y$10$BnjoihmHtIj1uXUuPyqATOrc2288.j5oiamNKN/E2JIf2tHndjabq', 'Amadi ifeanyi', 0, NULL, 'd42990abb07e76e83c82859921f9724f', 'ABRDI'),
(2, 1, 'tester', '$2y$10$xA3ieHw0E7YjrlkiFJRAiOtDbC1ENASgwbtX.cWI226bfET1K44Le', 'Moderator user', 1, '2020-01-12 19:04:28', 'e0bd00293123e435cb82d81a9614d399', 'ABRDI');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Zema_assets`
--
ALTER TABLE `Zema_assets`
  ADD PRIMARY KEY (`assetid`);

--
-- Indexes for table `Zema_config`
--
ALTER TABLE `Zema_config`
  ADD PRIMARY KEY (`configid`);

--
-- Indexes for table `Zema_containers`
--
ALTER TABLE `Zema_containers`
  ADD PRIMARY KEY (`containerid`);

--
-- Indexes for table `Zema_directives`
--
ALTER TABLE `Zema_directives`
  ADD PRIMARY KEY (`directiveid`);

--
-- Indexes for table `Zema_images`
--
ALTER TABLE `Zema_images`
  ADD PRIMARY KEY (`imageid`);

--
-- Indexes for table `Zema_navigation`
--
ALTER TABLE `Zema_navigation`
  ADD PRIMARY KEY (`navigationid`);

--
-- Indexes for table `Zema_navigationtypes`
--
ALTER TABLE `Zema_navigationtypes`
  ADD PRIMARY KEY (`navigationtypeid`);

--
-- Indexes for table `Zema_permission`
--
ALTER TABLE `Zema_permission`
  ADD PRIMARY KEY (`permissionid`);

--
-- Indexes for table `Zema_slides`
--
ALTER TABLE `Zema_slides`
  ADD PRIMARY KEY (`slideid`);

--
-- Indexes for table `Zema_slidesAnimation`
--
ALTER TABLE `Zema_slidesAnimation`
  ADD PRIMARY KEY (`slidesAnimationid`);

--
-- Indexes for table `Zema_users`
--
ALTER TABLE `Zema_users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Zema_assets`
--
ALTER TABLE `Zema_assets`
  MODIFY `assetid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Zema_config`
--
ALTER TABLE `Zema_config`
  MODIFY `configid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Zema_containers`
--
ALTER TABLE `Zema_containers`
  MODIFY `containerid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `Zema_directives`
--
ALTER TABLE `Zema_directives`
  MODIFY `directiveid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Zema_images`
--
ALTER TABLE `Zema_images`
  MODIFY `imageid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `Zema_navigation`
--
ALTER TABLE `Zema_navigation`
  MODIFY `navigationid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Zema_navigationtypes`
--
ALTER TABLE `Zema_navigationtypes`
  MODIFY `navigationtypeid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Zema_permission`
--
ALTER TABLE `Zema_permission`
  MODIFY `permissionid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Zema_slides`
--
ALTER TABLE `Zema_slides`
  MODIFY `slideid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Zema_slidesAnimation`
--
ALTER TABLE `Zema_slidesAnimation`
  MODIFY `slidesAnimationid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Zema_users`
--
ALTER TABLE `Zema_users`
  MODIFY `userid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
