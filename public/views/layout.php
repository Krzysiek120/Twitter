<html>
    <head>
        <title><?php echo isset($_SESSION['userId']) ? $_SESSION['userId'] : 'you are not logged'; ?></title>
        <link rel="stylesheet" type="text/css" href="views/css/main.css" />
    </head>
    <body>
        <?php echo $content; ?>

        <div id="footer" ><hr />To stały element szablonu, ładowany z konfiguracji: <?php echo $this->getConfig()['email']; ?></div>
    </body>
</html>