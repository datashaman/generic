<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title></title>

<link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="/styles/dataTables.bootstrap.css" />
<link rel="stylesheet" href="/styles/site.css" />

@yield('styles')
</head>
<body>

<!-- Wrap all page content here -->
<div id="wrap">
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Project name</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    @include('_menu', [ 'menu' => $menuMain ])
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        @yield('content')
    </div>
</div>

<div id="footer">
    <div class="container">
        <p class="text-muted credit">Example courtesy <a href="http://martinbean.co.uk">Martin Bean</a> and <a href="http://ryanfait.com/sticky-footer/">Ryan Fait</a>.</p>
    </div>
</div>

<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/bower_components/elasticsearch/elasticsearch.jquery.min.js"></script>
<script src="/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="/scripts/dataTables.bootstrap.min.js"></script>

@yield('scripts')
</body>
</html>
