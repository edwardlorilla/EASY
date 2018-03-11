<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-W2DZ232');</script>
        <!-- End Google Tag Manager -->
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="description"
              content="Collection is intended to catalogue biodiversity and facilitate genomic research."/>
        <meta name="keywords" content="Genomics, Plant sciences"/>
        <meta property="og:type" content="article"/>
        <meta property="og:site_name" content="Nature News &amp; Comment"/>
        <meta property="og:title" content="plant repository"/>
        <meta property="og:description"
              content="Collection is intended to catalogue biodiversity and facilitate genomic research."/>
        <meta property="article:tag" content="Plant sciences"/>
        <meta property="article:section" content="News"/>
        <meta name="access" content="Yes"/>

        <meta name="WT.cg_n" content="Nature News"/>
        <meta name="WT.cg_s" content="News"/>
        <meta name="WT.z_cg_type" content="Nature News"/>
        <link rel="manifest" href="/manifest.json">
        <script  src="https://cdn.rawgit.com/GoogleChrome/pwacompat/v1.0.3/pwacompat.min.js"></script>
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-title" content="HAGO">

        <link rel="apple-touch-icon" sizes="180x180" href="/icons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="36x36" href="/icons/android-chrome-36x36.png">
        <link rel="icon" type="image/png" sizes="48x48" href="/icons/android-chrome-48x48.png">
        <link rel="icon" type="image/png" sizes="72x72" href="/icons/android-chrome-72x72.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/icons/android-chrome-96x96.png">
        <link rel="icon" type="image/png" sizes="144x144" href="/icons/android-chrome-144x144.png">
        <link rel="icon" type="image/png" sizes="192x192" href="/icons/android-chrome-192x192.png">
        <link rel="icon" type="image/png" sizes="256x256" href="/icons/android-chrome-256x256.png">
        <link rel="icon" type="image/png" sizes="384x384" href="/icons/android-chrome-384x384.png">
        <link rel="icon" type="image/png" sizes="512x512" href="/icons/android-chrome-512x512.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/icons/favicon-16x16.png">

        <meta name="msapplication-TileImage" content="/icons/android-chrome-144x144.png">
        <meta name="msapplication-TileColor" content="#fff">
        <link rel="mask-icon" href="/logo/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="apple-mobile-web-app-title" content="HAGO">
        <meta name="application-name" content="HAGO">
        <meta name="theme-color" content="#2196f3">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <script type="application/ld+json">



        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone.js"></script>
        <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=IntersectionObserver"></script>
        <script src='https://www.gstatic.com/firebasejs/4.8.0/firebase.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.10.0/js/md5.js'></script>
        {!!script_ts("/js/promise.js")  !!}
        {!!script_ts("/js/fetch.js")  !!}
        {!!script_ts("/js/idb.js")  !!}
        {!!script_ts("/js/utility.js")  !!}
        <script type="text/javascript">
            window.Laravel = {csrfToken: '{{ csrf_token() }}'}

            /*new Promise(function(resolve, reject) {
             Notification.requestPermission(function(result) {
             if (result !== 'granted') return reject(Error("Denied notification permission"));
             resolve();
             })
             }).then(function() {
             return navigator.serviceWorker.ready;
             }).then(function(reg) {
             return reg.sync.register('syncTest');
             }).then(function() {
             console.log('Sync registered');
             }).catch(function(err) {
             console.log('It broke');
             console.log(err.message);
             });*/
        </script>

        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <link rel="stylesheet" href="{{ mix('/css/bundle.css') }}"/>
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}"/>
        {{--{!! style_ts(mix('/css/bundle.css')) !!}
        {!! style_ts(mix('/css/app.css')) !!}--}}
        {!! style_ts('https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.2.0/leaflet.css') !!}
        <link rel="stylesheet" href="https://adoroszlai.github.io/leaflet-distance-markers/leaflet-distance-marker.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.1.0/MarkerCluster.css">
        <link rel="stylesheet" href="http://turban.github.io/Leaflet.Photo/Leaflet.Photo.css">
        <link rel="stylesheet" href="http://turban.github.io/Leaflet.Photo/examples/css/map.css">
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.1.0/MarkerCluster.Default.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.2.0/leaflet.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.1.0/leaflet.markercluster.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3ki29AJHS78LOsuUmYxBGm_IlXSnL1ow"></script>
        <script src="https://cdn.jsdelivr.net/npm/leaflet-geometryutil@0.8.1/src/leaflet.geometryutil.min.js"></script>
        <script src="https://adoroszlai.github.io/leaflet-distance-markers/leaflet-distance-marker.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.0.1/color-thief.min.js"></script>
        <script src="http://turban.github.io/Leaflet.Photo/examples/lib/reqwest.min.js"></script>
        <script src="http://turban.github.io/Leaflet.Photo/Leaflet.Photo.js"></script>
        <link rel="stylesheet" href="https://www.domoritz.de/leaflet-locatecontrol/dist/L.Control.Locate.min.css">
        <script src="https://www.domoritz.de/leaflet-locatecontrol/src/L.Control.Locate.js"></script>

        <title>HAGO</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <link href='https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v0.0.4/leaflet.fullscreen.css'
              rel='stylesheet'>

        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-flat.css">

        <script type="text/javascript">


            window.currentUser = null;
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>;
            window.allRepositories = null;


        </script>
        <style>
            body {
                padding: 0;
                margin: 0;
            }
            html, body, #map #map-desktop #app{
                height: 100%;
                width: 100%;
            }
            .logo-area {
                background: #006699;

                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
            }
            .icon-container {
                position: absolute;
                top: 50%;
                left: 50%;
                height: 0;
                width: 0;
            }
            .icon {
                position: absolute;
                top: -128px;
                left: -128px;
                width: 256px;
                height: 256px;
                border-radius: 60px;
                -webkit-box-shadow: inset #1b8bc1 0 1px 1px, rgba(0,0,0,0.2) 1px 1px 2px;
                -moz-box-shadow: inset #1b8bc1 0 1px 1px, rgba(0,0,0,0.2) 1px 1px 2px;
                -ms-box-shadow: inset #1b8bc1 0 1px 1px, rgba(0,0,0,0.2) 1px 1px 2px;
                -o-box-shadow: inset #1b8bc1 0 1px 1px, rgba(0,0,0,0.2) 1px 1px 2px;
                box-shadow: inset #1b8bc1 0 1px 1px, rgba(0,0,0,0.2) 1px 1px 2px;

                background: rgb(62,186,233); /* Old browsers */
                background: -moz-radial-gradient(center, ellipse cover,  rgba(62,186,233,1) 0%, rgba(66,191,236,1) 100%); /* FF3.6+ */
                background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,rgba(62,186,233,1)), color-stop(100%,rgba(66,191,236,1))); /* Chrome,Safari4+ */
                background: -webkit-radial-gradient(center, ellipse cover,  rgba(62,186,233,1) 0%,rgba(66,191,236,1) 100%); /* Chrome10+,Safari5.1+ */
                background: -o-radial-gradient(center, ellipse cover,  rgba(62,186,233,1) 0%,rgba(66,191,236,1) 100%); /* Opera 12+ */
                background: -ms-radial-gradient(center, ellipse cover,  rgba(62,186,233,1) 0%,rgba(66,191,236,1) 100%); /* IE10+ */
                background: radial-gradient(ellipse at center,  rgba(62,186,233,1) 0%,rgba(66,191,236,1) 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3ebae9', endColorstr='#42bfec',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */

            }
            .inner-circle {
                position: absolute;
                top: 61px;
                left: 61px;
                width: 134px;
                height: 134px;

                -webkit-border-radius: 50% / 50%;
                -moz-border-radius: 50% / 50%;
                -ms-border-radius: 50% / 50%;
                -o-border-radius: 50% / 50%;
                border-radius: 50% / 50%;

                background: rgb(62,186,233); /* Old browsers */
                background: -moz-radial-gradient(center, ellipse cover,  rgba(62,186,233,1) 0%, rgba(66,191,236,1) 100%); /* FF3.6+ */
                background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,rgba(62,186,233,1)), color-stop(100%,rgba(66,191,236,1))); /* Chrome,Safari4+ */
                background: -webkit-radial-gradient(center, ellipse cover,  rgba(62,186,233,1) 0%,rgba(66,191,236,1) 100%); /* Chrome10+,Safari5.1+ */
                background: -o-radial-gradient(center, ellipse cover,  rgba(62,186,233,1) 0%,rgba(66,191,236,1) 100%); /* Opera 12+ */
                background: -ms-radial-gradient(center, ellipse cover,  rgba(62,186,233,1) 0%,rgba(66,191,236,1) 100%); /* IE10+ */
                background: radial-gradient(ellipse at center,  rgba(62,186,233,1) 0%,rgba(66,191,236,1) 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3ebae9', endColorstr='#42bfec',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */

                -webkit-box-shadow: inset rgba(0,0,0,0.1) 0 1px 1px;
                -moz-box-shadow: inset rgba(0,0,0,0.1) 0 1px 1px;
                -ms-box-shadow: inset rgba(0,0,0,0.1) 0 1px 1px;
                -o-box-shadow: inset rgba(0,0,0,0.1) 0 1px 1px;
                box-shadow: inset rgba(0,0,0,0.1) 0 1px 1px;
            }
            .inner-rim {
                position: absolute;
                top: 55px;
                left: 55px;
                width: 146px;
                height: 146px;

                -webkit-border-radius: 50% / 50%;
                -moz-border-radius: 50% / 50%;
                -ms-border-radius: 50% / 50%;
                -o-border-radius: 50% / 50%;
                border-radius: 50% / 50%;

                background: rgb(233,233,233); /* Old browsers */
                background: -moz-linear-gradient(45deg,  rgba(233,233,233,1) 0%, rgba(241,241,241,1) 50%, rgba(233,233,233,1) 100%); /* FF3.6+ */
                background: -webkit-gradient(linear, left bottom, right top, color-stop(0%,rgba(233,233,233,1)), color-stop(50%,rgba(241,241,241,1)), color-stop(100%,rgba(233,233,233,1))); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(45deg,  rgba(233,233,233,1) 0%,rgba(241,241,241,1) 50%,rgba(233,233,233,1) 100%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(45deg,  rgba(233,233,233,1) 0%,rgba(241,241,241,1) 50%,rgba(233,233,233,1) 100%); /* Opera 11.10+ */
                background: -ms-linear-gradient(45deg,  rgba(233,233,233,1) 0%,rgba(241,241,241,1) 50%,rgba(233,233,233,1) 100%); /* IE10+ */
                background: linear-gradient(45deg,  rgba(233,233,233,1) 0%,rgba(241,241,241,1) 50%,rgba(233,233,233,1) 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e9e9e9', endColorstr='#e9e9e9',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */

            }
            .outer-rim {
                position: absolute;
                top: 48px;
                left: 48px;
                width: 160px;
                height: 160px;

                -webkit-border-radius: 50% / 50%;
                -moz-border-radius: 50% / 50%;
                -ms-border-radius: 50% / 50%;
                -o-border-radius: 50% / 50%;
                border-radius: 50% / 50%;

                background: rgb(233,233,233); /* Old browsers */
                background: -moz-linear-gradient(45deg,  #f9f7f7 0%, #f9fafb 50%, #f9f7f7 100%); /* FF3.6+ */
                background: -webkit-gradient(linear, left bottom, right top, color-stop(0%,#f9f7f7), color-stop(50%,#f9fafb), color-stop(100%,#f9f7f7)); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(45deg,  #f9f7f7 0%,#f9fafb 50%,#f9f7f7 100%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(45deg,  #f9f7f7 0%,#f9fafb 50%,#f9f7f7 100%); /* Opera 11.10+ */
                background: -ms-linear-gradient(45deg,  #f9f7f7 0%,#f9fafb 50%,#f9f7f7 100%); /* IE10+ */
                background: linear-gradient(45deg,  #f9f7f7 0%,#f9fafb 50%,#f9f7f7 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e9e9e9', endColorstr='#e9e9e9',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */

                -webkit-box-shadow: rgba(0,0,0,0.1) 0 0 1px 1px;
                -moz-box-shadow: rgba(0,0,0,0.1) 0 0 1px 1px;
                -ms-box-shadow: rgba(0,0,0,0.1) 0 0 1px 1px;
                -o-box-shadow: rgba(0,0,0,0.1) 0 0 1px 1px;
                box-shadow: rgba(0,0,0,0.1) 0 0 1px 1px;

            }

            .triangle {
                position: absolute;
                width: 0;
                height: 0;
            }

            .big-point.top.one {
                top: 21px;
                left: 106px;
                border-top: transparent 28px solid;
                border-left: transparent 10px solid;
                border-right: #fbfbfb 12px solid;
                border-bottom: transparent 6px solid;
            }
            .big-point.top.two {
                top: 21px;
                left: 128px;
                border-top: transparent 28px solid;
                border-left: #eeeeee 12px solid;
                border-right: transparent 10px solid;
                border-bottom: transparent 6px solid;
            }
            .shadow-point.top.one {
                top: 20px;
                left: 106px;
                border-top: transparent 28px solid;
                border-left: transparent 10px solid;
                border-right: rgba(0,0,0,0.1) 12px solid;
                border-bottom: transparent 6px solid;
            }
            .shadow-point.top.two {
                top: 20px;
                left: 128px;
                border-top: transparent 28px solid;
                border-left: rgba(0,0,0,0.1) 12px solid;
                border-right: transparent 10px solid;
                border-bottom: transparent 6px solid;
            }

            .big-point.bottom.one {
                bottom: 21px;
                left: 106px;
                border-bottom: transparent 28px solid;
                border-left: transparent 10px solid;
                border-right: #fbfbfb 12px solid;
                border-top: transparent 6px solid;
            }
            .big-point.bottom.two {
                bottom: 21px;
                left: 128px;
                border-bottom: transparent 28px solid;
                border-left: #eeeeee 12px solid;
                border-right: transparent 10px solid;
                border-top: transparent 6px solid;
            }
            .shadow-point.bottom.one {
                bottom: 20px;
                left: 106px;
                border-bottom: transparent 28px solid;
                border-left: transparent 10px solid;
                border-right: rgba(0,0,0,0.1) 12px solid;
                border-top: transparent 6px solid;
            }
            .shadow-point.bottom.two {
                bottom: 20px;
                left: 128px;
                border-bottom: transparent 28px solid;
                border-left: rgba(0,0,0,0.1) 12px solid;
                border-right: transparent 10px solid;
                border-top: transparent 6px solid;
            }

            .big-point.left.one {
                left: 21px;
                top: 106px;
                border-left: transparent 28px solid;
                border-top: transparent 10px solid;
                border-bottom: #fbfbfb 12px solid;
                border-right: transparent 6px solid;
            }
            .big-point.left.two {
                left: 21px;
                top: 128px;
                border-left: transparent 28px solid;
                border-top: #eeeeee 12px solid;
                border-bottom: transparent 10px solid;
                border-right: transparent 6px solid;
            }
            .shadow-point.left.one {
                left: 20px;
                top: 106px;
                border-left: transparent 28px solid;
                border-top: transparent 10px solid;
                border-bottom: rgba(0,0,0,0.1) 12px solid;
                border-right: transparent 6px solid;
            }
            .shadow-point.left.two {
                left: 20px;
                top: 128px;
                border-left: transparent 28px solid;
                border-top: rgba(0,0,0,0.1) 12px solid;
                border-bottom: transparent 10px solid;
                border-right: transparent 6px solid;
            }

            .big-point.right.one {
                right: 21px;
                top: 106px;
                border-right: transparent 28px solid;
                border-top: transparent 10px solid;
                border-bottom: #fbfbfb 12px solid;
                border-left: transparent 6px solid;
            }
            .big-point.right.two {
                right: 21px;
                top: 128px;
                border-right: transparent 28px solid;
                border-top: #eeeeee 12px solid;
                border-bottom: transparent 10px solid;
                border-left: transparent 6px solid;
            }
            .shadow-point.right.one {
                right: 20px;
                top: 106px;
                border-right: transparent 28px solid;
                border-top: transparent 10px solid;
                border-bottom: rgba(0,0,0,0.1) 12px solid;
                border-left: transparent 6px solid;
            }
            .shadow-point.right.two {
                right: 20px;
                top: 128px;
                border-right: transparent 28px solid;
                border-top: rgba(0,0,0,0.1) 12px solid;
                border-bottom: transparent 10px solid;
                border-left: transparent 6px solid;
            }

            .small-point.top-left {
                -webkit-transform: rotate(45deg);
                -moz-transform: rotate(45deg);
                -ms-transform: rotate(45deg);
                -o-transform: rotate(45deg);
                transform: rotate(45deg);
            }
            .small-point.top-left.one {
                left: 62px;
                top: 55px;
                border-left: transparent 16px solid;
                border-top: transparent 8px solid;
                border-bottom: #fbfbfb 8px solid;
                border-right: transparent 6px solid;
            }
            .small-point.top-left.two {
                left: 51px;
                top: 66px;
                border-left: transparent 16px solid;
                border-top: #eeeeee 8px solid;
                border-bottom: transparent 8px solid;
                border-right: transparent 6px solid;
            }

            .small-point.top-right {
                -webkit-transform: rotate(-45deg);
                -moz-transform: rotate(-45deg);
                -ms-transform: rotate(-45deg);
                -o-transform: rotate(-45deg);
                transform: rotate(-45deg);
            }
            .small-point.top-right.one {
                right: 62px;
                top: 55px;
                border-right: transparent 16px solid;
                border-top: transparent 8px solid;
                border-bottom: #fbfbfb 8px solid;
                border-left: transparent 6px solid;
            }
            .small-point.top-right.two {
                right: 51px;
                top: 66px;
                border-right: transparent 16px solid;
                border-top: #eeeeee 8px solid;
                border-bottom: transparent 8px solid;
                border-left: transparent 6px solid;
            }

            .small-point.bottom-left {
                -webkit-transform: rotate(135deg);
                -moz-transform: rotate(135deg);
                -ms-transform: rotate(135deg);
                -o-transform: rotate(135deg);
                transform: rotate(135deg);
            }
            .small-point.bottom-left.one {
                left: 62px;
                bottom: 55px;
                border-right: transparent 16px solid;
                border-top: transparent 8px solid;
                border-bottom: #eeeeee 8px solid;
                border-left: transparent 6px solid;
            }
            .small-point.bottom-left.two {
                left: 51px;
                bottom: 66px;
                border-right: transparent 16px solid;
                border-top: #fbfbfb 8px solid;
                border-bottom: transparent 8px solid;
                border-left: transparent 6px solid;
            }

            .small-point.bottom-right {
                -webkit-transform: rotate(-135deg);
                -moz-transform: rotate(-135deg);
                -ms-transform: rotate(-135deg);
                -o-transform: rotate(-135deg);
                transform: rotate(-135deg);
            }
            .small-point.bottom-right.one {
                right: 62px;
                bottom: 55px;
                border-left: transparent 16px solid;
                border-top: transparent 8px solid;
                border-bottom: #fbfbfb 8px solid;
                border-right: transparent 6px solid;
            }
            .small-point.bottom-right.two {
                right: 51px;
                bottom: 66px;
                border-left: transparent 16px solid;
                border-top: #eeeeee 8px solid;
                border-bottom: transparent 8px solid;
                border-right: transparent 6px solid;
            }


            @-webkit-keyframes wheel-spin {
                0% {
                    -webkit-transform: rotate(45deg);
                }
                50% {
                    -webkit-transform: rotate(-135deg);
                }
                100% {
                    -webkit-transform: rotate(-315deg);
                }
            }
            @keyframes wheel-spin {
                0% {
                    transform: rotate(45deg);
                }
                50% {
                    transform: rotate(-135deg);
                }
                100% {
                    transform: rotate(-315deg);
                }
            }

            .spinner {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;

                animation: wheel-spin 1s 2 linear;
                -webkit-animation: wheel-spin 1s 2 linear;

                -webkit-transform: rotate(45deg);
                -moz-transform: rotate(45deg);
                -ms-transform: rotate(45deg);
                -o-transform: rotate(45deg);
                transform: rotate(45deg);
            }

            .arrow.one {
                top: 20px;
                left: 99px;
                border-top: transparent 109px solid;
                border-left: transparent 10px solid;
                border-right: #e46868 19px solid;
                border-bottom: transparent 0px solid;
            }
            .arrow.two {
                top: 20px;
                left: 128px;
                border-top: transparent 109px solid;
                border-left: #ce5d5d 19px solid;
                border-right: transparent 10px solid;
                border-bottom: transparent 0px solid;
            }

            .arrow.three {
                bottom: 20px;
                left: 99px;
                border-top: transparent 0px solid;
                border-left: transparent 10px solid;
                border-right: #f1f1f1 19px solid;
                border-bottom: transparent 109px solid;
            }
            .arrow.four {
                bottom: 20px;
                left: 128px;
                border-top: transparent 0px solid;
                border-left: #d9d9d9 19px solid;
                border-right: transparent 10px solid;
                border-bottom: transparent 109px solid;
            }

            .middle-circle {
                position: absolute;
                top: 118px;
                left: 118px;
                width: 20px;
                height: 20px;

                -webkit-border-radius: 50% / 50%;
                -moz-border-radius: 50% / 50%;
                -ms-border-radius: 50% / 50%;
                -o-border-radius: 50% / 50%;
                border-radius: 50% / 50%;

                background: #FFFFFF;

                -webkit-box-shadow: rgba(0,0,0,0.3) 2px 2px 3px;
                -moz-box-shadow: rgba(0,0,0,0.3) 2px 2px 3px;
                -ms-box-shadow: rgba(0,0,0,0.3) 2px 2px 3px;
                -o-box-shadow: rgba(0,0,0,0.3) 2px 2px 3px;
                box-shadow: rgba(0,0,0,0.3) 2px 2px 3px;
            }


            .first-shadow {
                position: absolute;
                top: 95px;
                left: 130px;
                width: 159px;
                height: 230px;
                background: -moz-linear-gradient(top, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0) 100%);
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0.1)), color-stop(100%,rgba(0,0,0,0)));
                background: -webkit-linear-gradient(top, rgba(0,0,0,0.1) 0%,rgba(0,0,0,0) 100%);
                background: -o-linear-gradient(top, rgba(0,0,0,0.1) 0%,rgba(0,0,0,0) 100%);
                background: -ms-linear-gradient(top, rgba(0,0,0,0.1) 0%,rgba(0,0,0,0) 100%);
                background: 0.linear-gradient(to bottom, rgba(0,0,0,1) 0%,rgba(0,0,0,0) 100%);
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1a000000', endColorstr='#00000000',GradientType=0 );
                -webkit-transform: rotate(-45deg);
                -moz-transform: rotate(-45deg);
                -ms-transform: rotate(-45deg);
                -o-transform: rotate(-45deg);
                transform: rotate(-45deg);

            }

            @-webkit-keyframes shadow-pulse {
                0% {
                    opacity: 0;
                }
                66% {
                    opacity: 0;
                }
                100% {
                    opacity: 1;
                }
            }
            @keyframes shadow-pulse {
                0% {
                    opacity: 0;
                }
                66% {
                    opacity: 0;
                }
                100% {
                    opacity: 1;
                }
            }

            .second-shadow {
                position: absolute;
                top: 95px;
                left: 104px;
                width: 210px;
                height: 230px;
                background: -moz-linear-gradient(top, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0) 100%);
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0.1)), color-stop(100%,rgba(0,0,0,0)));
                background: -webkit-linear-gradient(top, rgba(0,0,0,0.1) 0%,rgba(0,0,0,0) 100%);
                background: -o-linear-gradient(top, rgba(0,0,0,0.1) 0%,rgba(0,0,0,0) 100%);
                background: -ms-linear-gradient(top, rgba(0,0,0,0.1) 0%,rgba(0,0,0,0) 100%);
                background: 0.linear-gradient(to bottom, rgba(0,0,0,1) 0%,rgba(0,0,0,0) 100%);
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1a000000', endColorstr='#00000000',GradientType=0 );
                -webkit-transform: rotate(-45deg);
                -moz-transform: rotate(-45deg);
                -ms-transform: rotate(-45deg);
                -o-transform: rotate(-45deg);
                transform: rotate(-45deg);



                animation: shadow-pulse 3s 1 linear;
                -webkit-animation: shadow-pulse 3s 1 linear;

            }


            .inspired {
                position: absolute;
                left: 0;
                right: 0;
                bottom: 0;
                line-height: 30px;
                font-family: sans-serif;
                text-align: center;
                color: #FFF;
            }
            .inspired a {
                color: #FFF;
            }
            .page--full_bg__background {
                background: url('http://adserver.bworldonline.com/webpics/articles/image/20150813fc197.jpg') no-repeat;
                background-size: cover;
                no-repeat center;
                -webkit-filter: blur(5px); /* Safari 6.0 - 9.0 */
                filter: blur(5px);
            }
            .image-icon img {
                height: 36px !important;
                width: 36px !important;
                border-radius: 50%;
                border: solid;
                border-color: green;
            }
        </style>

        <style>
            .ath-viewport * {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }

            .ath-viewport {
                position: relative;
                z-index: 2147483641;
                pointer-events: none;

                -webkit-tap-highlight-color: rgba(0,0,0,0);
                -webkit-touch-callout: none;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                -webkit-text-size-adjust: none;
                -moz-text-size-adjust: none;
                -ms-text-size-adjust: none;
                -o-text-size-adjust: none;
                text-size-adjust: none;
            }

            .ath-modal {
                pointer-events: auto !important;
                background: rgba(0,0,0,0.6);
            }

            .ath-mandatory {
                background: #000;
            }

            .ath-container {
                pointer-events: auto !important;
                position: absolute;
                z-index: 2147483641;
                padding: 0.7em 0.6em;
                width: 18em;

                background: #eee;
                background-size: 100% auto;

                box-shadow: 0 0.2em 0 #d1d1d1;

                font-family: sans-serif;
                font-size: 15px;
                line-height: 1.5em;
                text-align: center;
            }

            .ath-container small {
                font-size: 0.8em;
                line-height: 1.3em;
                display: block;
                margin-top: 0.5em;
            }

            .ath-ios.ath-phone {
                bottom: 1.8em;
                left: 50%;
                margin-left: -9em;
            }

            .ath-ios6.ath-tablet {
                left: 5em;
                top: 1.8em;
            }

            .ath-ios7.ath-tablet {
                left: 0.7em;
                top: 1.8em;
            }

            .ath-ios8.ath-tablet {
                right: 0.4em;
                top: 1.8em;
            }

            .ath-android {
                bottom: 1.8em;
                left: 50%;
                margin-left: -9em;
            }

            /* close icon */
            .ath-container:before {
                content: '';
                position: relative;
                display: block;
                float: right;
                margin: -0.7em -0.6em 0 0.5em;
                background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIQAAACECAMAAABmmnOVAAAAA3NCSVQICAjb4U/gAAAACXBIWXMAAAeHAAAHhwFd+hRDAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAHVQTFRFAAAAOTk5MzMzOzs7Nzc3QUFBQEBAPz8/Pj4+QUFBQEBAPz8/Pj4+QUFBQEBAPz8/QUFBPj4+Pz8/Pz8/Pj4+Pz8/Pz8/Pz8/Pj4+Pz8/Pj4+Pz8/Pz8/Pz8/Pz8/Pz8/Pj4+Pz8/Pz8/Pz8/Pz8/QEBAPz8/n3QmjwAAACZ0Uk5TAAkKDQ4zODk6OzxBQkNERUusrbG0tba7vL3Excbu8fL19fb3+PgucqJgAAACqklEQVR42sXc23LCIBAGYKy2pgft0WpP2vTA+z9i0+goCZAs7O7P3oWZTL5ZYAh7sca0MXmYG3jM7yfu4/TV1jdow01tX6cdg4UrGoN1FNM3a+GK1nBSzPYGrOJgsPZt1hrerYUrjoa9wjHgFI7B2veZWVk3tpCdWm07H30y8+4AIhedPFj7cW7wioABrggawIqIAaroGbYXzlGCUvQNnc0IUgwaQIoRA0QxagAoCAZ1BcmgrCAaVBVkg6IiwaCmSDIoKRINKopkg4IiwyCuyDIIKzINoopsg6CCYRBTsAxCCqZBRLGo2RcrtkLAwFaIGJgKIQNLIWZgKAQN2QpRg1dKoCmEDVkKcUOGQsGQrFAxJCqUDEkKNUOCQtFAVqgaiAplg69YFDAQFADDqAJiGFGADI1iF1XADAOKvqHSLApHFFBDRAE2BBVwQ0BRwOApfn8LGDxFEcOQAmeIK5CGmAJrCCvQBq8A8r9Zrw08qp6irvAGs/zpIr4XBQxf3nQsyhvwipABrQgbsIqYAamIG3CKnqH+LKDoGXbVwD84zDB4E4AZ4IqgAayIGKCKqMGYS5RiwOArlgUMnuJrWcAAUYwaAAqCQV1BMigriAZVBdmgqEgwqCmSDEqKRIOKItmgoMgwiCv6hkvaa6KKTIOoItsgqGAYxBQsg5CCaRBRsA0CCgEDWyFiYCqEDCyFmIGhEDRkK0QNmQphQ5ZC3JChUDAkK1QMiQolQ5JCzZCguNUzkBV3P4oGokLZQFKoGwgKgGFUATGMKECGQQXMYMxVTAE0RBVQQ0QBNgQVcENI8QwoBo8cUiszWYPz4OVi3bQ9cBQoQ0exblsvTDZwg6PYHNo/tE0XmvVwa4BxWBentgtnL+A8HHPxcnYaaBRoQ6twDY3iEW5oFI8Hwx/QxSE448b+MwAAAABJRU5ErkJggg==);
                background-color: rgba(255,255,255,0.8);
                background-size: 50%;
                background-repeat: no-repeat;
                background-position: 50%;
                width: 2.7em;
                height: 2.7em;
                text-align: center;
                overflow: hidden;
                color: #a33;
                z-index: 2147483642;
            }

            .ath-container.ath-icon:before {
                position: absolute;
                top: 0;
                right: 0;
                margin: 0;
                float: none;
            }

            .ath-mandatory .ath-container:before {
                display: none;
            }

            .ath-container.ath-android:before {
                float: left;
                margin: -0.7em 0.5em 0 -0.6em;
            }

            .ath-container.ath-android.ath-icon:before {
                position: absolute;
                right: auto;
                left: 0;
                margin: 0;
                float: none;
            }


            /* applied only if the application icon is shown */
            .ath-container.ath-icon {

            }

            .ath-action-icon {
                display: inline-block;
                vertical-align: middle;
                background-position: 50%;
                background-repeat: no-repeat;
                text-indent: -9999em;
                overflow: hidden;
            }

            .ath-ios7 .ath-action-icon,
            .ath-ios8 .ath-action-icon {
                width: 1.6em;
                height: 1.6em;
                background-image:url(data:image/png;base64,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);
                margin-top: -0.3em;
                background-size: auto 100%;
            }

            .ath-ios6 .ath-action-icon {
                width: 1.8em;
                height: 1.8em;
                background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJAAAAB0CAQAAADAmnOnAAAAAnNCSVQICFXsRgQAAAAJcEhZcwAAWwEAAFsBAXkZiFwAAAAZdEVYdFNvZnR3YXJlAHd3dy5pbmtzY2FwZS5vcmeb7jwaAAAGaklEQVR42u3cfUxVZRwH8O8FRERRfNfKt4zM2UzNMszZFPMPW5KWzizJ0JJWitOU3mYs54ZuNRk6zblSaebUnKllSpopaRorJiqmtjRNK4sNEBR5+fbH45ELwrnn5Tnn3gPP7/cv9/7O/eyc5zyvAF6PrlgAFTrRHcQmtFIQekDEYXRRFA3GzP4gCOI39FcaDcQ7g24BEUUYrTz0gIhKvKZE9IAIIhNhSkUPiNiGaOWiB0Tko4eS0QMi/sQQZaMHRJRivNLRAyKqkKZ89IAIYg1aKCDq5l60U0D6WYDeCkg/r2KEAtLPG5iqgPSzBukKKFB+ikgFpJ+56KyA9PMcHjBXYYwjGRmyQMR/GGWmAqVnNV4N4TuIICowPXhA1ZgR0o+Y6Yk1uTyVeD7E26Da3GpsYk0iTwQ3kSS5nbLboAj0wnBMwGwsRhaysRO5yEMe8iJP2bjig+joIlALbhE86xguCWUgXkYmduMMbjrQVhLEWfRzCagldwmelfTZhOmM8ViGXJQ7hFI3iwK906SUieLXgifTFs9DeA/HUOMKjP87LdlhoFb8RvB8ZJHHhxHIxEWXYfzzY0Q4BtSG3wueDyzhxCAFvwSRJuA7zeYXx/CQ4LEy/3sPlqMkBHBEHkN36UBt+YPgWWgapzfWoiJkcERewECpQB2YR5I1nG/6PbUcN0IMR2QJxhkEWsi0gPkjSVYzxRROS6SjLCRxGplYa+QPq2goqjnTFM8wFIQwjpZZCJcDVMmppu6dTNf7OFbzEDoFAKrcx5yA+ZIJnh444hEckcfRUxcoXe5wMwH/eIqHIK7gUbeAklHlOR4xCElyA2iWR3mIGixyHijDoziMqRw8xflH7H2v8vTjKfIyhzoLNNurPM+xVHRksp0EesabbU84M1hDklVMo885oMdcmhGUnO25W9w7xUx0sh8Ui/Ne5InjCcFTwL4BetI2gbZ5kedZreXZwjYBx2K2gKZ7DydMa3mqRcvjJFAcrnmNJ5ZfiXunlBMNzgfZAPrSazx9eVzwnOB9hmcULQM96TWeCSwRPFv9Wx6ngMKQ3zRaHqeAXvQSTzttNfgaJ5leOLQE5EOhd3j6MF/wnGSchZVVS0Bj5f6ELhzKiZzLdC7nOm7nAebzPIvqZKHF7x7DfwXPNsZYWpu3BLTD/iptPFO4mnt5muWGVg0uW6ozj5UBWh4ngPpYHZxG8nGmcTPPsJpmwzxQK34mPlrGKTY2UFkAWmJ+y8wopnM/y/QEilnAQ9zJbGZxMedzBif559EF5mr24s/ie3/nIFtb8CwAnTV+md04hzm83hBIFQu5mUv5Op/mQMbK3YKXyGJR5Vt2NPqzZAH1N3aJrTmNu1lRn6WUOVzGJA5hlHN7FFNFy0N+yAjbu1xNA70duFOWwPXaeFmLIu7gmxxm5oKtAUVxvahYzhfMVZAFdES/GU7m6bo0Z7mMw2n7jLsxoB78SVQ9T9OHfeUARfluNv5QzeNFf5pCvssBbm4DHsm/ReXvaOGkhhyg+MbeU3N4pZamhGs53O190m/wprZ/0tKDLAdo7p3f4GMSL9Ti/MpZbO32RvIofiKqX2eS1QpSgMI+r//5+7mvFucgE+nQf9TQA7qbR0X9PzjUegUpQG1O1F04eau2j3OAw4JzFGGE9nDvYQc7FaQARRf7rwwc1nDOcbLtbeUWgVK0vtYK2jw5LwMo2nf7c8navVPORWY7fbKAorlRXMMNJtuvIAMoTusKLhXzc2QO74UrcSfQXdodfEnOwy0D6GGxY3qPNj+XBNeiPlCCNs+TY3y05ThQ7EiwK4+JCztjdJTsBFCaNtpaJe9AlgSgsVN6aQOJzWwLBAcokqu1lucVmRUkAC2eeElsKE+F66EBdWOuyXkeF4EYT7LCzZanPtBoXtXmeTrJriAD6AmW8SkgWEC3W541bCm/ggygRxiPIMWSB1cInAqTRyJcnw8KUrD7rXmewY5VaAJA++W3PE0JKMPUPE8MEpoXkLnBcBL+wqpmBWQiemIXCCqghiIcadoxvvYbFFD9GIDDtb9s3EkF5B9RyKj7jy0UkH+MvnNBXAFp0QEbGjoCqoC0mNPwL1NACshYhKUqIN2YvFEB6ca0LxSQAlJACkgBKSAFpICsADXdVEAKSAEpIAWkgBSQAlJACkgBKaDgA41hc8vUXHM3UPOLVQpIAbkH9D87oz0rvnJrOgAAAABJRU5ErkJggg==);
                margin-bottom: 0.4em;
                background-size: 100% auto;
            }

            .ath-android .ath-action-icon {
                width: 1.4em;
                height: 1.4em;
                background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyNpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDE0IDc5LjE1MTQ4MSwgMjAxMy8wMy8xMy0xMjowOToxNSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChNYWNpbnRvc2gpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkE2ODRFM0VGNDc0NTExRTRCNEUxODAyMzVCNkM5RTU5IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkE2ODRFM0YwNDc0NTExRTRCNEUxODAyMzVCNkM5RTU5Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6QTY4NEUzRUQ0NzQ1MTFFNEI0RTE4MDIzNUI2QzlFNTkiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6QTY4NEUzRUU0NzQ1MTFFNEI0RTE4MDIzNUI2QzlFNTkiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7bs1dGAAABKElEQVR42uyXywnCQBRFxyCxCFsQ/CzUGtQGdOfGuBJbcWcqsAGtwY2Iii1YgbhQF/EOvEAQ/ARnkhHug7NwvJC5hDBzClEUqV8nCILkTx+MQR9UZO0IFmAObnEwDMOfn11UZqcMlqD2tN4WhqAHTqYe6BncvP9i88nR/61AycUCwYfNx1MFIxcLDCxlMyvQSJGtu1ggzdxdLLBNkT26WGBhKZtZAX0q7b/IHSTrXIEr6ILdm4wu2JGskx+xPmFbYAo24CJsZK1p8hS2cZVQcteZCdanYOIyl+d46s+HBfIeIx/xk9B8f3AYEBobb0B7wQSswVlYy5rv5BugkdHIaGQ0MhoZjYxGRiOjkdEHWIBGRiOjkdHIaGQ0MhoZjYxGRiPL1sgeAgwApeJtJOoNgAYAAAAASUVORK5CYII=);
                background-size: 100% auto;
            }

            .ath-container p {
                margin: 0;
                padding: 0;
                position: relative;
                z-index: 2147483642;
                text-shadow: 0 0.1em 0 #fff;
                font-size: 1.1em;
            }

            .ath-ios.ath-phone:after {
                content: '';
                background: #eee;
                position: absolute;
                width: 2em;
                height: 2em;
                bottom: -0.9em;
                left: 50%;
                margin-left: -1em;
                -webkit-transform: scaleX(0.9) rotate(45deg);
                transform: scaleX(0.9) rotate(45deg);
                box-shadow: 0.2em 0.2em 0 #d1d1d1;
            }

            .ath-ios.ath-tablet:after {
                content: '';
                background: #eee;
                position: absolute;
                width: 2em;
                height: 2em;
                top: -0.9em;
                left: 50%;
                margin-left: -1em;
                -webkit-transform: scaleX(0.9) rotate(45deg);
                transform: scaleX(0.9) rotate(45deg);
                z-index: 2147483641;
            }

            .ath-application-icon {
                position: relative;
                padding: 0;
                border: 0;
                margin: 0 auto 0.2em auto;
                height: 6em;
                width: 6em;
                z-index: 2147483642;
            }

            .ath-container.ath-ios .ath-application-icon {
                border-radius: 1em;
                box-shadow: 0 0.2em 0.4em rgba(0,0,0,0.3),
                inset 0 0.07em 0 rgba(255,255,255,0.5);
                margin: 0 auto 0.4em auto;
            }

            @media only screen and (orientation: landscape) {
                .ath-container.ath-phone {
                    width: 24em;
                }

                .ath-android.ath-phone {
                    margin-left: -12em;
                }

                .ath-ios.ath-phone {
                    margin-left: -12em;
                }

                .ath-ios6:after {
                    left: 39%;
                }

                .ath-ios8.ath-phone {
                    left: auto;
                    bottom: auto;
                    right: 0.4em;
                    top: 1.8em;
                }

                .ath-ios8.ath-phone:after {
                    bottom: auto;
                    top: -0.9em;
                    left: 68%;
                    z-index: 2147483641;
                    box-shadow: none;
                }
            }
        </style>
        <script>
            /* Add to Homescreen v3.1.1 ~ (c) 2014 Matteo Spinelli ~ @license: http://cubiq.org/license */
            (function (window, document) {
                /*
                 _   _ _____     _____
                 ___ _| |_| |_   _|___|  |  |___ _____ ___ ___ ___ ___ ___ ___ ___
                 | .'| . | . | | | | . |     | . |     | -_|_ -|  _|  _| -_| -_|   |
                 |__,|___|___| |_| |___|__|__|___|_|_|_|___|___|___|_| |___|___|_|_|
                 by Matteo Spinelli ~ http://cubiq.org
                 */

// Check for addEventListener browser support (prevent errors in IE<9)
                var _eventListener = 'addEventListener' in window;

// Check if document is loaded, needed by autostart
                var _DOMReady = false;
                if ( document.readyState === 'complete' ) {
                    _DOMReady = true;
                } else if ( _eventListener ) {
                    window.addEventListener('load', loaded, false);
                }

                function loaded () {
                    window.removeEventListener('load', loaded, false);
                    _DOMReady = true;
                }

// regex used to detect if app has been added to the homescreen
                var _reSmartURL = /\/ath(\/)?$/;
                var _reQueryString = /([\?&]ath=[^&]*$|&ath=[^&]*(&))/;

// singleton
                var _instance;
                function ath (options) {
                    _instance = _instance || new ath.Class(options);

                    return _instance;
                }

// message in all supported languages
                ath.intl = {
                    de_de: {
                        ios: 'Um diese Web-App zum Home-Bildschirm hinzuzufügen, tippen Sie auf %icon und dann <strong>Zum Home-Bildschirm</strong>.',
                        android: 'To add this web app to the home screen open the browser option menu and tap on <strong>Add to homescreen</strong>. <small>The menu can be accessed by pressing the menu hardware button if your device has one, or by tapping the top right menu icon <span class="ath-action-icon">icon</span>.</small>',
                    },

                    en_us: {
                        ios: 'To add this web app to the home screen: tap %icon and then <strong>Add to Home Screen</strong>.',
                        android: 'To add this web app to the home screen open the browser option menu and tap on <strong>Add to homescreen</strong>. <small>The menu can be accessed by pressing the menu hardware button if your device has one, or by tapping the top right menu icon <span class="ath-action-icon">icon</span>.</small>',
                    },

                    es_es: {
                        ios: 'Para añadir esta aplicación web a la pantalla de inicio: pulsa %icon y selecciona <strong>Añadir a pantalla de inicio</strong>.',
                        android: 'To add this web app to the home screen open the browser option menu and tap on <strong>Add to homescreen</strong>. <small>The menu can be accessed by pressing the menu hardware button if your device has one, or by tapping the top right menu icon <span class="ath-action-icon">icon</span>.</small>',
                    },

                    fr_fr: {
                        ios: 'Pour ajouter cette application web sur l\'écran d\'accueil : Appuyez %icon et sélectionnez <strong>Ajouter sur l\'écran d\'accueil</strong>.',
                        android: 'To add this web app to the home screen open the browser option menu and tap on <strong>Add to homescreen</strong>. <small>The menu can be accessed by pressing the menu hardware button if your device has one, or by tapping the top right menu icon <span class="ath-action-icon">icon</span>.</small>',
                    },

                    he_il: {
                        ios: '<span dir="rtl">להוספת האפליקציה למסך הבית: ללחוץ על %icon ואז <strong>הוסף למסך הבית</strong>.</span>',
                        android: 'To add this web app to the home screen open the browser option menu and tap on <strong>Add to homescreen</strong>. <small>The menu can be accessed by pressing the menu hardware button if your device has one, or by tapping the top right menu icon <span class="ath-action-icon">icon</span>.</small>',
                    },

                    it_it: {
                        ios: 'Per aggiungere questa web app alla schermata iniziale: premi %icon e poi <strong>Aggiungi a Home</strong>.',
                        android: 'Per aggiungere questa web app alla schermata iniziale, apri il menu opzioni del browser e premi su <strong>Aggiungi alla homescreen</strong>. <small>Puoi accedere al menu premendo il pulsante hardware delle opzioni se la tua device ne ha uno, oppure premendo l\'icona <span class="ath-action-icon">icon</span> in alto a destra.</small>',
                    },

                    nb_no: {
                        ios: 'For å installere denne appen på hjem-skjermen: trykk på %icon og deretter <strong>Legg til på Hjem-skjerm</strong>.',
                        android: 'To add this web app to the home screen open the browser option menu and tap on <strong>Add to homescreen</strong>. <small>The menu can be accessed by pressing the menu hardware button if your device has one, or by tapping the top right menu icon <span class="ath-action-icon">icon</span>.</small>',
                    },

                    pt_br: {
                        ios: 'Para adicionar este app à tela de início: clique %icon e então <strong>Tela de início</strong>.',
                        android: 'To add this web app to the home screen open the browser option menu and tap on <strong>Add to homescreen</strong>. <small>The menu can be accessed by pressing the menu hardware button if your device has one, or by tapping the top right menu icon <span class="ath-action-icon">icon</span>.</small>',
                    },

                    pt_pt: {
                        ios: 'Para adicionar esta app ao ecrã principal: clique %icon e depois <strong>Ecrã principal</strong>.',
                        android: 'To add this web app to the home screen open the browser option menu and tap on <strong>Add to homescreen</strong>. <small>The menu can be accessed by pressing the menu hardware button if your device has one, or by tapping the top right menu icon <span class="ath-action-icon">icon</span>.</small>',
                    },

                    nl_nl: {
                        ios: 'Om deze webapp op je telefoon te installeren, klik op %icon en dan <strong>Zet in beginscherm</strong>.',
                        android: 'To add this web app to the home screen open the browser option menu and tap on <strong>Add to homescreen</strong>. <small>The menu can be accessed by pressing the menu hardware button if your device has one, or by tapping the top right menu icon <span class="ath-action-icon">icon</span>.</small>',
                    },

                    sv_se: {
                        ios: 'För att lägga till denna webbapplikation på hemskärmen: tryck på %icon och därefter <strong>Lägg till på hemskärmen</strong>.',
                        android: 'To add this web app to the home screen open the browser option menu and tap on <strong>Add to homescreen</strong>. <small>The menu can be accessed by pressing the menu hardware button if your device has one, or by tapping the top right menu icon <span class="ath-action-icon">icon</span>.</small>',
                    },

                    zh_cn: {
                        ios: '如要把应用程式加至主屏幕,请点击%icon, 然后<strong>加至主屏幕</strong>',
                        android: 'To add this web app to the home screen open the browser option menu and tap on <strong>Add to homescreen</strong>. <small>The menu can be accessed by pressing the menu hardware button if your device has one, or by tapping the top right menu icon <span class="ath-action-icon">icon</span>.</small>',
                    },

                    zh_tw: {
                        ios: '如要把應用程式加至主屏幕, 請點擊%icon, 然後<strong>加至主屏幕</strong>.',
                        android: 'To add this web app to the home screen open the browser option menu and tap on <strong>Add to homescreen</strong>. <small>The menu can be accessed by pressing the menu hardware button if your device has one, or by tapping the top right menu icon <span class="ath-action-icon">icon</span>.</small>',
                    }
                };

// Add 2 characters language support (Android mostly)
                for ( var lang in ath.intl ) {
                    ath.intl[lang.substr(0, 2)] = ath.intl[lang];
                }

// default options
                ath.defaults = {
                    appID: 'org.cubiq.addtohome',		// local storage name (no need to change)
                    fontSize: 15,				// base font size, used to properly resize the popup based on viewport scale factor
                    debug: false,				// override browser checks
                    modal: false,				// prevent further actions until the message is closed
                    mandatory: false,			// you can't proceed if you don't add the app to the homescreen
                    autostart: true,			// show the message automatically
                    skipFirstVisit: false,		// show only to returning visitors (ie: skip the first time you visit)
                    startDelay: 1,				// display the message after that many seconds from page load
                    lifespan: 15,				// life of the message in seconds
                    displayPace: 1440,			// minutes before the message is shown again (0: display every time, default 24 hours)
                    maxDisplayCount: 0,			// absolute maximum number of times the message will be shown to the user (0: no limit)
                    icon: true,					// add touch icon to the message
                    message: '',				// the message can be customized
                    validLocation: [],			// list of pages where the message will be shown (array of regexes)
                    onInit: null,				// executed on instance creation
                    onShow: null,				// executed when the message is shown
                    onRemove: null,				// executed when the message is removed
                    onAdd: null,				// when the application is launched the first time from the homescreen (guesstimate)
                    onPrivate: null,			// executed if user is in private mode
                    privateModeOverride: false,	// show the message even in private mode (very rude)
                    detectHomescreen: false		// try to detect if the site has been added to the homescreen (false | true | 'hash' | 'queryString' | 'smartURL')
                };

// browser info and capability
                var _ua = window.navigator.userAgent;

                var _nav = window.navigator;
                _extend(ath, {
                    hasToken: document.location.hash == '#ath' || _reSmartURL.test(document.location.href) || _reQueryString.test(document.location.search),
                    isRetina: window.devicePixelRatio && window.devicePixelRatio > 1,
                    isIDevice: (/iphone|ipod|ipad/i).test(_ua),
                    isMobileChrome: _ua.indexOf('Android') > -1 && (/Chrome\/[.0-9]*/).test(_ua),
                    isMobileIE: _ua.indexOf('Windows Phone') > -1,
                    language: _nav.language && _nav.language.toLowerCase().replace('-', '_') || ''
                });

// falls back to en_us if language is unsupported
                ath.language = ath.language && ath.language in ath.intl ? ath.language : 'en_us';

                ath.isMobileSafari = ath.isIDevice && _ua.indexOf('Safari') > -1 && _ua.indexOf('CriOS') < 0;
                ath.OS = ath.isIDevice ? 'ios' : ath.isMobileChrome ? 'android' : ath.isMobileIE ? 'windows' : 'unsupported';

                ath.OSVersion = _ua.match(/(OS|Android) (\d+[_\.]\d+)/);
                ath.OSVersion = ath.OSVersion && ath.OSVersion[2] ? +ath.OSVersion[2].replace('_', '.') : 0;

                ath.isStandalone = window.navigator.standalone || ( ath.isMobileChrome && ( screen.height - document.documentElement.clientHeight < 40 ) );	// TODO: check the lame polyfill
                ath.isTablet = (ath.isMobileSafari && _ua.indexOf('iPad') > -1) || (ath.isMobileChrome && _ua.indexOf('Mobile') < 0);

                ath.isCompatible = (ath.isMobileSafari && ath.OSVersion >= 6) || ath.isMobileChrome;	// TODO: add winphone

                var _defaultSession = {
                    lastDisplayTime: 0,			// last time we displayed the message
                    returningVisitor: false,	// is this the first time you visit
                    displayCount: 0,			// number of times the message has been shown
                    optedout: false,			// has the user opted out
                    added: false				// has been actually added to the homescreen
                };

                ath.removeSession = function (appID) {
                    try {
                        localStorage.removeItem(appID || ath.defaults.appID);
                    } catch (e) {
                        // we are most likely in private mode
                    }
                };

                ath.Class = function (options) {
                    // merge default options with user config
                    this.options = _extend({}, ath.defaults);
                    _extend(this.options, options);

                    // IE<9 so exit (I hate you, really)
                    if ( !_eventListener ) {
                        return;
                    }

                    // normalize some options
                    this.options.mandatory = this.options.mandatory && ( 'standalone' in window.navigator || this.options.debug );
                    this.options.modal = this.options.modal || this.options.mandatory;
                    if ( this.options.mandatory ) {
                        this.options.startDelay = -0.5;		// make the popup hasty
                    }
                    this.options.detectHomescreen = this.options.detectHomescreen === true ? 'hash' : this.options.detectHomescreen;

                    // setup the debug environment
                    if ( this.options.debug ) {
                        ath.isCompatible = true;
                        ath.OS = typeof this.options.debug == 'string' ? this.options.debug : ath.OS == 'unsupported' ? 'android' : ath.OS;
                        ath.OSVersion = ath.OS == 'ios' ? '8' : '4';
                    }

                    // the element the message will be appended to
                    this.container = document.documentElement;

                    // load session
                    this.session = localStorage.getItem(this.options.appID);
                    this.session = this.session ? JSON.parse(this.session) : undefined;

                    // user most likely came from a direct link containing our token, we don't need it and we remove it
                    if ( ath.hasToken && ( !ath.isCompatible || !this.session ) ) {
                        ath.hasToken = false;
                        _removeToken();
                    }

                    // the device is not supported
                    if ( !ath.isCompatible ) {
                        return;
                    }

                    this.session = this.session || _defaultSession;

                    // check if we can use the local storage
                    try {
                        localStorage.setItem(this.options.appID, JSON.stringify(this.session));
                        ath.hasLocalStorage = true;
                    } catch (e) {
                        // we are most likely in private mode
                        ath.hasLocalStorage = false;

                        if ( this.options.onPrivate ) {
                            this.options.onPrivate.call(this);
                        }
                    }

                    // check if this is a valid location
                    var isValidLocation = !this.options.validLocation.length;
                    for ( var i = this.options.validLocation.length; i--; ) {
                        if ( this.options.validLocation[i].test(document.location.href) ) {
                            isValidLocation = true;
                            break;
                        }
                    }

                    // check compatibility with old versions of add to homescreen. Opt-out if an old session is found
                    if ( localStorage.getItem('addToHome') ) {
                        this.optOut();
                    }

                    // critical errors:
                    // user opted out, already added to the homescreen, not a valid location
                    if ( this.session.optedout || this.session.added || !isValidLocation ) {
                        return;
                    }

                    // check if the app is in stand alone mode
                    if ( ath.isStandalone ) {
                        // execute the onAdd event if we haven't already
                        if ( !this.session.added ) {
                            this.session.added = true;
                            this.updateSession();

                            if ( this.options.onAdd && ath.hasLocalStorage ) {	// double check on localstorage to avoid multiple calls to the custom event
                                this.options.onAdd.call(this);
                            }
                        }

                        return;
                    }

                    // (try to) check if the page has been added to the homescreen
                    if ( this.options.detectHomescreen ) {
                        // the URL has the token, we are likely coming from the homescreen
                        if ( ath.hasToken ) {
                            _removeToken();		// we don't actually need the token anymore, we remove it to prevent redistribution

                            // this is called the first time the user opens the app from the homescreen
                            if ( !this.session.added ) {
                                this.session.added = true;
                                this.updateSession();

                                if ( this.options.onAdd && ath.hasLocalStorage ) {	// double check on localstorage to avoid multiple calls to the custom event
                                    this.options.onAdd.call(this);
                                }
                            }

                            return;
                        }

                        // URL doesn't have the token, so add it
                        if ( this.options.detectHomescreen == 'hash' ) {
                            history.replaceState('', window.document.title, document.location.href + '#ath');
                        } else if ( this.options.detectHomescreen == 'smartURL' ) {
                            history.replaceState('', window.document.title, document.location.href.replace(/(\/)?$/, '/ath$1'));
                        } else {
                            history.replaceState('', window.document.title, document.location.href + (document.location.search ? '&' : '?' ) + 'ath=');
                        }
                    }

                    // check if this is a returning visitor
                    if ( !this.session.returningVisitor ) {
                        this.session.returningVisitor = true;
                        this.updateSession();

                        // we do not show the message if this is your first visit
                        if ( this.options.skipFirstVisit ) {
                            return;
                        }
                    }

                    // we do no show the message in private mode
                    if ( !this.options.privateModeOverride && !ath.hasLocalStorage ) {
                        return;
                    }

                    // all checks passed, ready to display
                    this.ready = true;

                    if ( this.options.onInit ) {
                        this.options.onInit.call(this);
                    }

                    if ( this.options.autostart ) {
                        this.show();
                    }
                };

                ath.Class.prototype = {
                    // event type to method conversion
                    events: {
                        load: '_delayedShow',
                        error: '_delayedShow',
                        orientationchange: 'resize',
                        resize: 'resize',
                        scroll: 'resize',
                        click: 'remove',
                        touchmove: '_preventDefault',
                        transitionend: '_removeElements',
                        webkitTransitionEnd: '_removeElements',
                        MSTransitionEnd: '_removeElements'
                    },

                    handleEvent: function (e) {
                        var type = this.events[e.type];
                        if ( type ) {
                            this[type](e);
                        }
                    },

                    show: function (force) {
                        // in autostart mode wait for the document to be ready
                        if ( this.options.autostart && !_DOMReady ) {
                            setTimeout(this.show.bind(this), 50);
                            return;
                        }

                        // message already on screen
                        if ( this.shown ) {
                            return;
                        }

                        var now = Date.now();
                        var lastDisplayTime = this.session.lastDisplayTime;

                        if ( force !== true ) {
                            // this is needed if autostart is disabled and you programmatically call the show() method
                            if ( !this.ready ) {
                                return;
                            }

                            // we obey the display pace (prevent the message to popup too often)
                            if ( now - lastDisplayTime < this.options.displayPace * 60000 ) {
                                return;
                            }

                            // obey the maximum number of display count
                            if ( this.options.maxDisplayCount && this.session.displayCount >= this.options.maxDisplayCount ) {
                                return;
                            }
                        }

                        this.shown = true;

                        // increment the display count
                        this.session.lastDisplayTime = now;
                        this.session.displayCount++;
                        this.updateSession();

                        // try to get the highest resolution application icon
                        if ( !this.applicationIcon ) {
                            if ( ath.OS == 'ios' ) {
                                this.applicationIcon = document.querySelector('head link[rel^=apple-touch-icon][sizes="152x152"],head link[rel^=apple-touch-icon][sizes="144x144"],head link[rel^=apple-touch-icon][sizes="120x120"],head link[rel^=apple-touch-icon][sizes="114x114"],head link[rel^=apple-touch-icon]');
                            } else {
                                this.applicationIcon = document.querySelector('head link[rel^="shortcut icon"][sizes="196x196"],head link[rel^=apple-touch-icon]');
                            }
                        }

                        var message = '';

                        if ( this.options.message in ath.intl ) {		// you can force the locale
                            message = ath.intl[this.options.message][ath.OS];
                        } else if ( this.options.message !== '' ) {		// or use a custom message
                            message = this.options.message;
                        } else {										// otherwise we use our message
                            message = ath.intl[ath.language][ath.OS];
                        }

                        // add the action icon
                        message = '<p>' + message.replace('%icon', '<span class="ath-action-icon">icon</span>') + '</p>';

                        // create the message container
                        this.viewport = document.createElement('div');
                        this.viewport.className = 'ath-viewport';
                        if ( this.options.modal ) {
                            this.viewport.className += ' ath-modal';
                        }
                        if ( this.options.mandatory ) {
                            this.viewport.className += ' ath-mandatory';
                        }
                        this.viewport.style.position = 'absolute';

                        // create the actual message element
                        this.element = document.createElement('div');
                        this.element.className = 'ath-container ath-' + ath.OS + ' ath-' + ath.OS + (ath.OSVersion + '').substr(0,1) + ' ath-' + (ath.isTablet ? 'tablet' : 'phone');
                        this.element.style.cssText = '-webkit-transition-property:-webkit-transform,opacity;-webkit-transition-duration:0s;-webkit-transition-timing-function:ease-out;transition-property:transform,opacity;transition-duration:0s;transition-timing-function:ease-out;';
                        this.element.style.webkitTransform = 'translate3d(0,-' + window.innerHeight + 'px,0)';
                        this.element.style.transform = 'translate3d(0,-' + window.innerHeight + 'px,0)';

                        // add the application icon
                        if ( this.options.icon && this.applicationIcon ) {
                            this.element.className += ' ath-icon';
                            this.img = document.createElement('img');
                            this.img.className = 'ath-application-icon';
                            this.img.addEventListener('load', this, false);
                            this.img.addEventListener('error', this, false);

                            this.img.src = this.applicationIcon.href;
                            this.element.appendChild(this.img);
                        }

                        this.element.innerHTML += message;

                        // we are not ready to show, place the message out of sight
                        this.viewport.style.left = '-99999em';

                        // attach all elements to the DOM
                        this.viewport.appendChild(this.element);
                        this.container.appendChild(this.viewport);

                        // if we don't have to wait for an image to load, show the message right away
                        if ( !this.img ) {
                            this._delayedShow();
                        }
                    },

                    _delayedShow: function (e) {
                        setTimeout(this._show.bind(this), this.options.startDelay * 1000 + 500);
                    },

                    _show: function () {
                        var that = this;

                        // update the viewport size and orientation
                        this.updateViewport();

                        // reposition/resize the message on orientation change
                        window.addEventListener('resize', this, false);
                        window.addEventListener('scroll', this, false);
                        window.addEventListener('orientationchange', this, false);

                        if ( this.options.modal ) {
                            // lock any other interaction
                            document.addEventListener('touchmove', this, true);
                        }

                        // Enable closing after 1 second
                        if ( !this.options.mandatory ) {
                            setTimeout(function () {
                                that.element.addEventListener('click', that, true);
                            }, 1000);
                        }

                        // kick the animation
                        setTimeout(function () {
                            that.element.style.webkitTransitionDuration = '1.2s';
                            that.element.style.transitionDuration = '1.2s';
                            that.element.style.webkitTransform = 'translate3d(0,0,0)';
                            that.element.style.transform = 'translate3d(0,0,0)';
                        }, 0);

                        // set the destroy timer
                        if ( this.options.lifespan ) {
                            this.removeTimer = setTimeout(this.remove.bind(this), this.options.lifespan * 1000);
                        }

                        // fire the custom onShow event
                        if ( this.options.onShow ) {
                            this.options.onShow.call(this);
                        }
                    },

                    remove: function () {
                        clearTimeout(this.removeTimer);

                        // clear up the event listeners
                        if ( this.img ) {
                            this.img.removeEventListener('load', this, false);
                            this.img.removeEventListener('error', this, false);
                        }

                        window.removeEventListener('resize', this, false);
                        window.removeEventListener('scroll', this, false);
                        window.removeEventListener('orientationchange', this, false);
                        document.removeEventListener('touchmove', this, true);
                        this.element.removeEventListener('click', this, true);

                        // remove the message element on transition end
                        this.element.addEventListener('transitionend', this, false);
                        this.element.addEventListener('webkitTransitionEnd', this, false);
                        this.element.addEventListener('MSTransitionEnd', this, false);

                        // start the fade out animation
                        this.element.style.webkitTransitionDuration = '0.3s';
                        this.element.style.opacity = '0';
                    },

                    _removeElements: function () {
                        this.element.removeEventListener('transitionend', this, false);
                        this.element.removeEventListener('webkitTransitionEnd', this, false);
                        this.element.removeEventListener('MSTransitionEnd', this, false);

                        // remove the message from the DOM
                        this.container.removeChild(this.viewport);

                        this.shown = false;

                        // fire the custom onRemove event
                        if ( this.options.onRemove ) {
                            this.options.onRemove.call(this);
                        }
                    },

                    updateViewport: function () {
                        if ( !this.shown ) {
                            return;
                        }

                        this.viewport.style.width = window.innerWidth + 'px';
                        this.viewport.style.height = window.innerHeight + 'px';
                        this.viewport.style.left = window.scrollX + 'px';
                        this.viewport.style.top = window.scrollY + 'px';

                        var clientWidth = document.documentElement.clientWidth;

                        this.orientation = clientWidth > document.documentElement.clientHeight ? 'landscape' : 'portrait';

                        var screenWidth = ath.OS == 'ios' ? this.orientation == 'portrait' ? screen.width : screen.height : screen.width;
                        this.scale = screen.width > clientWidth ? 1 : screenWidth / window.innerWidth;

                        this.element.style.fontSize = this.options.fontSize / this.scale + 'px';
                    },

                    resize: function () {
                        clearTimeout(this.resizeTimer);
                        this.resizeTimer = setTimeout(this.updateViewport.bind(this), 100);
                    },

                    updateSession: function () {
                        if ( ath.hasLocalStorage === false ) {
                            return;
                        }

                        localStorage.setItem(this.options.appID, JSON.stringify(this.session));
                    },

                    clearSession: function () {
                        this.session = _defaultSession;
                        this.updateSession();
                    },

                    optOut: function () {
                        this.session.optedout = true;
                        this.updateSession();
                    },

                    optIn: function () {
                        this.session.optedout = false;
                        this.updateSession();
                    },

                    clearDisplayCount: function () {
                        this.session.displayCount = 0;
                        this.updateSession();
                    },

                    _preventDefault: function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                    }
                };

// utility
                function _extend (target, obj) {
                    for ( var i in obj ) {
                        target[i] = obj[i];
                    }

                    return target;
                }

                function _removeToken () {
                    if ( document.location.hash == '#ath' ) {
                        history.replaceState('', window.document.title, document.location.href.split('#')[0]);
                    }

                    if ( _reSmartURL.test(document.location.href) ) {
                        history.replaceState('', window.document.title, document.location.href.replace(_reSmartURL, '$1'));
                    }

                    if ( _reQueryString.test(document.location.search) ) {
                        history.replaceState('', window.document.title, document.location.href.replace(_reQueryString, '$2'));
                    }
                }

// expose to the world
                window.addToHomescreen = ath;

            })(window, document);
        </script>
        <script>
            addToHomescreen();
        </script>

    </head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W2DZ232"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div id="app">
</div>
</body>
{{--{!! script_ts(mix('/js/bundle.js')) !!}
{!! script_ts(mix('/js/app.js')) !!}--}}

<script type="text/javascript" src="http://labs.easyblog.it/maps/leaflet-compass/src/leaflet-compass.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.js"></script>
<script type="text/javascript" src="{{mix('/js/bundle.js')}}"></script>
<script type="text/javascript" src="{{mix('/js/app.js')}}"></script>


<script>
    // Thanks: https://github.com/component/textarea-caret-position
    (function(){
        var originalInitTile = L.GridLayer.prototype._initTile
        L.GridLayer.include({
            _initTile: function (tile) {
                originalInitTile.call(this, tile);

                var tileSize = this.getTileSize();

                tile.style.width = tileSize.x + 1 + 'px';
                tile.style.height = tileSize.y + 1 + 'px';
            }
        });
    })()
</script>
<script nomodule>
    document.getElementById("app").innerHTML = "Your browser doesn't support JavaScript modules :(";
</script>

</html>