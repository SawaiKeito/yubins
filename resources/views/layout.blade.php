<!DOCTYPE html> <html>
<head>
<title>住所録</title>
<!-- CSS And JavaScript -->
<link rel="shortcut icon" href="/yubins/images.png" type="image/x-icon">
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
<link rel="stylesheet" href="//cdn.rawgit.com/necolas/normalize.css/master/normalize.css">
<link rel="stylesheet" href="//cdn.rawgit.com/milligram/milligram/master/dist/milligram.min.css">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<style>
    .alert-danger {
        color: red;
    }
    .wrap {
  margin: 2em 0;
  padding: 0;
}

.wrap label {
  display: block;
  padding : 8px;
  color: #fff;
  font-weight: bold;
  background: #999;
  cursor: pointer;
}

.wrap input[type="checkbox"] {
  display: none;
}

.wrap .content {
  height: 0;
  padding: 0;
  overflow: hidden;
  margin-bottom: 10px;
  border: 1px solid #ccc;
}

.switch:checked + .content {
  height: auto;
  padding: 8px;
  background: #f7f7f7;
}
</style>

  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
<div class="container"> @yield('content')
</div> 
</body>
</html>