<head>
	<meta charset="UTF-8">
	<title>Students DB</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  	<link rel="icon" type="image/png" href="user_img/icon.png">
  	<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
	<style type="text/css">
		* {
			outline: none;
		}
		hr {
			border-top: 2px solid rgba(0,0,0,.5) !important;
		}
		.modal-body {
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.alert-custom {
			display: none;
			position: absolute;
			right: 10px;
			bottom: 10px;
			z-index: 9999;
			width: 300px;
		}
		.loader {
			border: 10px solid #f3f3f3;
			border-top: 10px solid #3498db;
			border-radius: 50%;
			width: 80px;
			height: 80px;
			margin: 0 20px;
			animation: spin 2s linear infinite;
		}

		@keyframes spin {
		    0% { transform: rotate(0deg); }
		    100% { transform: rotate(360deg); }
		}
	</style>
</head>