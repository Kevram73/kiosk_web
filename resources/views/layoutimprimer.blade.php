<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">




		<!-- Vendor CSS -->
		<link rel="stylesheet" href="public/octopus/assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="public/octopus/assets/vendor/font-awesome/css/font-awesome.css" />


        @yield('css')
	</head>
	<body>

		<section class="body">

      <!-- end: header -->
			@yield('contenu')

		</section>


		<!-- Vendor -->
		<script src="public/octopus/assets/vendor/jquery/jquery.js"></script>
		<script src="public/octopus/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="public/octopus/assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="public/octopus/assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
        <script src="/public/vendor/numeral/numeral.min.js"></script>
        <script>
        // switch between locales
        numeral.locale('fr');
        </script>

        @yield('js')
        <script src="public/js/facture.js"></script>
		<!-- Examples -->



    </body>
</html>
