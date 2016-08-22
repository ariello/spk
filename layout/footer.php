        </div><!-- /.container -->
        <footer class="footer" style="bottom:auto">
            <div class="container">
                <p class="text-muted">Copyright@2016</p>
            </div>
        </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
        <script src="assets/js/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="assets/js/ie10-viewport-bug-workaround.js"></script>

        <script>
            $(document).ready(function() {
                    <?php
                        if (!empty($_SESSION['message'])) {
                    ?>       
                        $(window).load(function(){
                            setTimeout(function(){
                                $('.flash_box').fadeOut('slow');;
                            }, 5000);
                        });
                    <?php
                        }
                        unset($_SESSION['message']);
                        unset($_SESSION['error']);
                    ?>
                });
        </script>
    </body>
</html>