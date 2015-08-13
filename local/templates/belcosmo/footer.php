

<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
            </section>
        </div> <!-- end class="row"-->
</div> <!-- end class="wrapper"-->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 twitter">
                <h3>Лента твиттера</h3>
<!--                <time datetime="2012-10-23"><a href="#">23 oct</a></time>-->
                <p>
                    Натуральная Белоруская бытовая химия и косметика оптом.
                </p>
            </div>
            <div class="col-md-3 sitemap">
                <h3>Карта сайта</h3>
                <div class="row">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "bottom",
                        array(
                            "ROOT_MENU_TYPE" => "bottom",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => array(
                            ),
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "bottom",
                            "USE_EXT" => "N",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N"
                        ),
                        false
                    );?>
                </div>
            </div>
            <div class="col-md-2 social">
                <h3>Социальные сети</h3>
                <a href="http://twitter.com/" class="social-icon twitter"></a>
                <a href="http://facebook.com/" class="social-icon facebook"></a>
                <a href="http://plus.google.com/" class="social-icon google-plus"></a>
                <a href="http://vimeo.com/" class="social-icon-small vimeo"></a>
                <a href="http://youtube.com/" class="social-icon-small youtube"></a>
                <a href="http://flickr.com/" class="social-icon-small flickr"></a>
                <a href="http://instagram.com/" class="social-icon-small instagram"></a>
                <a href="/rss/" class="social-icon-small rss"></a>
            </div>
            <div class="col-md-3 footer-logo">
                <div class="col-md-12 footer-logo">
                    <a href="/">Натуральная Белоруская бытовая химия и косметика оптом.</a>
                    <p>
                        Copyright © 2015
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>