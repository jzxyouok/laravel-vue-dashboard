<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google" value="notranslate">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Diversified Technology Monitor</title>

    <link href="/css/monitor-app.css" rel="stylesheet"/>
    <link href="/css/all.css" rel="stylesheet"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>

<body id="app-layout">

    @javascript(compact('pusherKey'))
    @javascript('userData', Auth::user())
    @javascript('isGuest', Auth::guest())

    <div id="app-monitor" class="monitor"></div>
    
    <script src="/js/monitor-app.js"></script>
    <script src="/js/all.js"></script>

</body>
</html>
