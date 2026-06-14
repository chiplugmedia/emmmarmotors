  <!-- Footer Start -->

  <footer class="footer-glass py-3">

                    <div class="container-fluid">

                        <div class="row align-items-center">

                            <div class="col">

                                <div class="text-sm-start text-center">

                                    <p class="mb-0 text-muted">© <script>document.write(new Date().getFullYear())</script> <?php echo $sitename ?>. Developed with <i class="mdi mdi-heart text-danger"></i> by <a href="https://chiplugs.vercel.app" target="_blank" class="text-reset">Chiplugmedia</a>.</p>

                                </div>

                            </div><!--end col-->

                        </div><!--end row-->

                    </div><!--end container-->

                </footer><!--end footer-->

                <!-- End -->

            </main>

            <!--End page-content" -->

        </div>
<script src="/mysite/sweet/sweet.js"></script>
        <!-- page-wrapper -->

        <!-- Start Modal -->
        <div class="modal fade" id="announcement" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom p-3">
                        <h5 class="modal-title" id="exampleModalLabel">Add Notifications</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body p-3 pt-4">
                        <div class="row">
                            

                            <div class="col-md-8 mt-4 mt-sm-0">
                                <div class="ms-md-4">
                                    <form method="POST">
                                        <div class="row">
                                            
                                              
    
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label"> Title </label>
                                                    <input name="title" type="text" class="form-control" id="tag" value="">
                                                </div>
                                            </div><!--end col-->
    
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Notifications <span class="text-danger">*</span></label>
                                                    <textarea name="message" id="comments" rows="4" class="form-control" placeholder="Notifications description :"></textarea>
                                                </div>
                                            </div><!--end col-->
    
                                            <div class="col-lg-12 text-end">
                                                <button type="submit" class="btn btn-primary" name="postMsg">Add Notifications</button>
                                            </div><!--end col-->
                                        </div>
                                    </form>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div>
                </div>
            </div>
        </div>
        <!-- End modal -->

  

                    </div><!--end col-->

                </div>

            </div>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>


<script>
           document.addEventListener('DOMContentLoaded', function () {
    let table = new DataTable('#myTable');
});
        </script>



        

        <!-- javascript -->

        <script src="assets/js/bootstrap.bundle.min.js"></script>

        <!-- simplebar -->

        <script src="assets/js/simplebar.min.js"></script>

        <!-- Icons -->

        <script src="assets/js/feather.min.js"></script>

        <!-- Chart -->

        <script src="assets/js/apexcharts.min.js"></script>

        <!-- Main Js -->

        <script src="assets/js/plugins.init.js"></script>

        <script src="assets/js/app.js"></script>

      
    </body>



</html>