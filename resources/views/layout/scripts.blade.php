<script src="{{ asset('asset/js/bootstrap.bundle.min.js') }}"></script>
<!-- jquery/3.7.1 --->
<script src="{{ asset('asset/js/jquery.min.js') }}"></script>
<!-- Include owl caroucel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 30,
        nav: false,
        // autoplay: true,
        autoplayTimeout: 3000,
        // stagePadding:50,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    })
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('asset/js/app.js') }}"></script>
@if (Session::has('ShowSingInMessage'))
    <script>
        Swal.fire({
            title: '{{ Session::get('ShowSingInMessage.title') }}',
            text: '{{ Session::get('ShowSingInMessage.message') }}',
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'custom-sweetAlert-btn-confirm',
                cancelButton: 'btn btn-secondary'
            }
        }).then(function() {
            <?php Session::forget('ShowSingInMessage'); ?>
        });
    </script>
@endif

</body>

</html>
