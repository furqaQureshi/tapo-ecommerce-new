 <!-- JAVASCRIPT -->
 <script src="{{ asset('admin/assets') }}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
 <script src="{{ asset('admin/assets') }}/libs/simplebar/simplebar.min.js"></script>
 <script src="{{ asset('admin/assets') }}/libs/node-waves/waves.min.js"></script>
 <script src="{{ asset('admin/assets') }}/libs/feather-icons/feather.min.js"></script>
 <script src="{{ asset('admin/assets') }}/js/pages/plugins/lord-icon-2.1.0.js"></script>
 <script src="{{ asset('admin/assets') }}/js/plugins.js"></script>

 <!-- apexcharts -->
 <script src="{{ asset('admin/assets') }}/libs/apexcharts/apexcharts.min.js"></script>

 <!-- Vector map-->
 <script src="{{ asset('admin/assets') }}/libs/jsvectormap/jsvectormap.min.js"></script>
 <script src="{{ asset('admin/assets') }}/libs/jsvectormap/maps/world-merc.js"></script>

 <!--Swiper slider js-->
 <script src="{{ asset('admin/assets') }}/libs/swiper/swiper-bundle.min.js"></script>

 <!-- Dashboard init -->
 <script src="{{ asset('admin/assets') }}/js/pages/dashboard-ecommerce.init.js"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
     integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
     crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <!-- App js -->
 <script src="{{ asset('admin/assets') }}/js/app.js"></script>
 <script src="{{ asset('admin/assets') }}/js/jquery-3.7.1.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
 <script>
     $(document).on("click", '.show_confirm', function(event) {
         var form = $(this).closest("form");
         var name = $(this).data("name");
         event.preventDefault();
         swal({
             title: "Are you sure you want to delete this record?",
             text: "If you delete this, it will be gone forever.",
             icon: "warning",
             buttons: {
                 cancel: {
                     text: "Cancel",
                     visible: true,
                     className: "custom-cancel-btn",
                 },
                 confirm: {
                     text: "OK",
                     closeModal: true,
                     className: "custom-confirm-btn"
                 }
             },
             dangerMode: true,
         }).then((willDelete) => {
             if (willDelete) {
                 form.submit();
             }
         });
     });
 </script>
 <script>
     //  $(document).ready(function() {
     //      $('form').on('submit', function(e) {
     //          const submitButton = $(this).find('button[type="submit"]');
     //          submitButton.prop('disabled', true);
     //          submitButton.text('Please wait...');
     //      });
     //  });
 </script>
 <script>
     toastr.options = {
         "closeButton": true,
         "debug": false,
         "newestOnTop": false,
         "progressBar": true,
         "positionClass": "toast-bottom-center",
         "preventDuplicates": false,
         "onclick": null,
         "showDuration": "300",
         "hideDuration": "500",
         "timeOut": "3000",
         "extendedTimeOut": "1000",
         "showEasing": "swing",
         "hideEasing": "linear",
         "showMethod": "fadeIn",
         "hideMethod": "fadeOut"
     };
 </script>


 <script>
     @if (Session::has('success'))
         toastr.options = {
             "closeButton": true,
             "progressBar": true,
             "positionClass": "toast-bottom-center",
             "showEasing": "swing",
         }
         toastr.success("{{ session('success') }}");
     @endif

     @if (Session::has('error'))
         toastr.options = {
             "closeButton": true,
             "progressBar": true
         }
         toastr.error("{{ session('error') }}");
     @endif

     @if (Session::has('info'))
         toastr.options = {
             "closeButton": true,
             "progressBar": true
         }
         toastr.info("{{ session('info') }}");
     @endif

     @if (Session::has('warning'))
         toastr.options = {
             "closeButton": true,
             "progressBar": true
         }
         toastr.warning("{{ session('warning') }}");
     @endif
 </script>
 <script>
     function validatePrice(input) {
         // Replace any non-numeric or non-decimal characters, allow only one decimal point
         input.value = input.value.replace(/[^0-9.]/g, '') // Allow numbers and decimal point
             .replace(/\.{2,}/g, '.') // Replace multiple dots with one
             .replace(/^(\d*\.?\d{0,2}).*$/, '$1'); // Limit to 2 decimal places
     }
 </script>
 <script>
     $(document).ready(function() {

         //  $('#pointSettingsModal').on('show.bs.modal', function() {
         //      $.ajax({
         //          url: '{{ route('point-settings.fetch') }}',
         //          method: 'GET',
         //          success: function(response) {
         //              $('#points_per_rm').val(response.points_per_rm);
         //              $('#rm_per_point').val(response.rm_per_point);
         //          },
         //          error: function() {
         //              Swal.fire({
         //                  icon: 'error',
         //                  title: 'Error',
         //                  text: 'Failed to load point settings.',
         //              });
         //          }
         //      });
         //  });
         // Handle form submission with AJAX and SweetAlert2
         $('#pointSettingsForm').on('submit', function(e) {
             e.preventDefault();
             $.ajax({
                 url: '{{ route('point-settings.update') }}',
                 method: 'POST',
                 data: $(this).serialize(),
                 success: function(response) {
                     if (response.success) {
                         $('#pointSettingsModal').modal('hide');
                         toastr.success(response.message);
                     } else {
                         toastr.error(response.message);
                     }
                 },
                 error: function() {
                     toastr.error('An error occurred while updating settings.');
                 }
             });
         });
     });
 </script>
 @yield('scripts')
