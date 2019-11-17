<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>
        <?= $this->_titlepage ?>
    </title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWYVxdF4VwIPfmB65X2kMt342GbUXApwQ&sensor=true">
    </script>
    <link rel="stylesheet" href="/components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.min.css">
    <link rel="stylesheet" href="/components/bootstrap-fileinput/css/fileinput.css">
    <link rel="stylesheet" href="/components/chart.js/dist/Chart.css">
    <link rel="stylesheet" href="/components/Font-Awesome/web-fonts-with-css/css/fontawesome-all.min.css">
    <link href="/components/bootstrap-toggle/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="/components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css" rel="stylesheet">
    <link rel="stylesheet" href="/skins/administracion/css/global.css">
    <script src="/components/jquery/dist/jquery.min.js"></script>
    <script src="/components/chart.js/dist/Chart.js"></script>
    </script>
    <script type="text/javascript">
        var map;
        var longitude = 0;
        var latitude = 0;
        var icon = '/skins/administracion/images/ubicacion.png';
        var point = false;
        var zoom = 10;

        function setValuesMap(longitud, latitud, punto, zoomm, icono) {
            longitude = longitud;
            latitude = latitud;
            if (punto) {
                point = punto;
            }
            if (zoomm) {
                zoom = zoomm;
            }
            if (icono) {
                icon = icono
            }
        }

        function initializeMap() {
            var mapOptions = {
                zoom: parseInt(zoom),
                center: new google.maps.LatLng(longitude, longitude),
            };
            // Place a draggable marker on the map
            map = new google.maps.Map(document.getElementById('map'), mapOptions);
            if (point == true) {
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(longitude, latitude),
                    map: map,
                    icon: icon
                });
            }
            map.setCenter(new google.maps.LatLng(longitude, latitude));
        }
    </script>
</head>

<body>
    <header>
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-2">
                    <img src="/skins/administracion/images/logo-blanco.png" class="logo-blanco">
                </div>
                <div class="col-10">
                    <?= $this->_data['panel_header']; ?>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid">
        <div class="row">
            <nav id="panel-botones" class="col-2">
                <?= $this->_data['panel_botones']; ?>
            </nav>
            <article id="contenido_panel" class="col-10">
                <section id="contenido_general">
                    <?= $this->_content ?>
                </section>
            </article>
        </div>
    </div>
    <footer class="panel-derechos col-md-12">&copy;2019 Todos los derechos reservados
    </footer>
    <script src="/scripts/popper.min.js"></script>
    <script src="/components/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="/components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js"></script>
    <script src="/components/bootstrap-validator/dist/validator.min.js"></script>
    <script src="/components/bootstrap-fileinput/js/fileinput.min.js"></script>
    <script src="/components/bootstrap-fileinput/js/locales/es.js"></script>
    <script src="/components/tinymce/tinymce.min.js"></script>
    <script src="/components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="/components/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
    <script src="/skins/administracion/js/main.js"></script>

</body>

</html>