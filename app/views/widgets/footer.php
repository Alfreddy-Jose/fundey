
        <!-- Footer Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="rounded-top footer p-4">
                <div class="row">
                    <div class="col-12 col-sm-6 text-center text-sm-start">
                        &copy; <span class="footer__letras">UPTYAB JAIMES/VARGAS</span>
                    </div>
                    <div class="col-12 col-sm-6 text-center text-sm-end">
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Diseñado por <span class="footer__letras">JAIMES/VARGAS</span>
                        <br>Distribuido por: <span class="footer__letras">UPTYAB</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
    </div>
    <!-- Content End -->

    <!-- JavaScript Libraries -->
    <script src="/FUNDEY/app/views/plugins/datatables/datatables.min.js"></script>
    <script src="/FUNDEY/app/views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/FUNDEY/app/views/js/formulario.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
<?php
if ($_SERVER['PHP_SELF'] == '/FUNDEY/app/views/competencia/competencia.php' || $_SERVER['PHP_SELF'] == '/FUNDEY/app/views/atleta/atleta.php') {?>

    <script>
    let json = '<?php echo json_encode($array); ?>';
<?php } ?>
    </script>
    <!-- Template Javascript -->
    <script src="/FUNDEY/app/views/js/main.js"></script>
    <script src="/FUNDEY/app/views/js/peticiones.js"></script>
</body>

</html>