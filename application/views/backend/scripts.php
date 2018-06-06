
<script src="<?php echo base_url();?>style/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url();?>style/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>style/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<script src="<?php echo base_url();?>style/js/jquery.slimscroll.js"></script>
<script src="<?php echo base_url();?>style/js/waves.js"></script>
<script src="<?php echo base_url();?>style/bower_components/raphael/raphael-min.js"></script>
<script src="<?php echo base_url();?>style/bower_components/morrisjs/morris.js"></script>
<script src="<?php echo base_url();?>style/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url();?>style/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
<script src="<?php echo base_url();?>style/js/custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>style/bower_components/gallery/js/animated-masonry-gallery.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>style/bower_components/gallery/js/jquery.isotope.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>style/bower_components/fancybox/ekko-lightbox.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>style/js/jPlayer/jquery.jplayer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>style/js/jPlayer/add-on/jplayer.playlist.min.js"></script>
<script src="<?php echo base_url();?>style/js/dashboard1.js"></script>
<script src="<?php echo base_url();?>style/bower_components/switchery/dist/switchery.min.js"></script>
<script src="<?php echo base_url();?>style/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
<script src="<?php echo base_url();?>style/bower_components/owl.carousel/owl.carousel.min.js"></script>
<script src="<?php echo base_url();?>style/bower_components/owl.carousel/owl.custom.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script src="<?php echo base_url();?>style/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>style/bower_components/bootstrap-rtl-master/dist/js/bootstrap-rtl.min.js">
<script src="<?php echo base_url();?>style/js/jasny-bootstrap.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>style/bower_components/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>style/bower_components/html5-editor/wysihtml5-0.3.0.js"></script>
<script src="<?php echo base_url();?>style/bower_components/html5-editor/bootstrap-wysihtml5.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/js/dropzone/dropzone.css">
<script src="<?php echo base_url();?>style/bower_components/toast-master/js/jquery.toast.js"></script>
<script src="<?php echo base_url();?>style/js/toastr.js"></script>
<script src="<?php echo base_url();?>assets/js/dropzone/dropzone.js"></script>
<script type="text/javascript">
        jQuery('.mydatepicker').datepicker();
</script>

<script type="text/javascript">
        $(document).ready(function ($) {
            $(document).delegate('*[data-toggle="lightbox"]:not([data-gallery="navigateTo"])', 'click', function (event) {
                event.preventDefault();
                return $(this).ekkoLightbox({
                    onShown: function () {
                        if (window.console) {
                            return console.log('Checking our the events huh?');
                        }
                    }
                    , onNavigate: function (direction, itemIndex) {
                        if (window.console) {
                            return console.log('Navigating ' + direction + '. Current item: ' + itemIndex);
                        }
                    }
                });
            });
            $('#open-image').click(function (e) {
                e.preventDefault();
                $(this).ekkoLightbox();
            });
            $('#open-youtube').click(function (e) {
                e.preventDefault();
                $(this).ekkoLightbox();
            });
            $(document).delegate('*[data-gallery="navigateTo"]', 'click', function (event) {
                event.preventDefault();
                var lb;
                return $(this).ekkoLightbox({
                    onShown: function () {
                        lb = this;
                        $(lb.modal_content).on('click', '.modal-footer a', function (e) {
                            e.preventDefault();
                            lb.navigateTo(2);
                        });
                    }
                });
            });
        });
</script>