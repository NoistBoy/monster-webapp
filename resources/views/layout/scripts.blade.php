<script src="{{ asset('asset/js/bootstrap.bundle.min.js') }}"></script>
<!-- jquery/3.7.1 --->
<script src="{{ asset('asset/js/jquery.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- Include owl caroucel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // autoplay: true,
    // autoplayTimeout: 3000,
    // stagePadding:50,
    // $('.owl-carousel').owlCarousel({
    //     loop: true,
    //     margin: 30,
    //     nav: true,
    //     responsive: {
    //         0: {
    //             items: 2
    //         },
    //         600: {
    //             items: 4
    //         },
    //         1000: {
    //             items: 5
    //         }
    //     }
    // })

       setTimeout(function() {

        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            responsive:{
                0:{
                    items:2
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        })

        }, 700);

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('asset/js/app.js') }}"></script>
<script>
        $(document).ready(function () {
            // $(".owl-nav").removeClass("disabled");
            // $(".owl-dots").addClass("disabled");


            // $(".owl-next, .owl-prev").click(function () {

            //     $(".owl-nav").removeClass("disabled");
            //     $(".owl-dots").addClass("disabled");

            // });


        });
</script>
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
