@extends('layout.layout')
<!--  Get Categories Products  -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        getContactUs()
            .then(data => {
                // console.log('Return Policy Data:', data);
                $('#page-title').html(data.result.title);
                $('#page-content').html(data.result.body);
            })
            .catch(error => {
                // Handle the error
                alert('Error:', error);
            });

    });

    async function getContactUs() {
        const url = 'https://erp.monstersmokewholesale.com/api/ecommerce/staticPage?alias=contact-us';
        try {
            const response = await fetch(url, {
                method: 'GET'
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            console.log(data);
            return data;
        } catch (error) {
            alert('Error fetching the return policy:', error);
            throw error;
        }
    }
</script>
<!--  Get Categories Products End  -->
@section('custom-style')
    <style>

    </style>
@endsection
@section('content')
    <div class="container-fluid p-5" style="min-height: 42rem; max-height:max-content; ">

        <div class="row pt-5">
            <div class="col-md-6 col-sm-12">
                <h1 class="fw-bold" id="page-title"></h1>

                <div class="container " id="page-content">

                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <form action="" class=" shadow m-3 p-3" style="position: relative; border-radius: 10px;">
                                <h4 class=" " style="    position: absolute; top: -16px; ">Get in Touch</h4>
                                <div class="row  mt-4">
                                    <div class="col-md-6 col-sm-12">
                                        <input type="text" class="form-control form-control-lg mb-3" name="name" placeholder="Full Name"
                                            id="name">
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <input type="email" class="form-control form-control-lg mb-3" name="email" placeholder="Email"
                                            id="name">
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-12 col-sm-12">
                                        <input type="number" class="form-control form-control-lg mb-3" name="phone" placeholder="Phone"
                                            id="phone">
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-12 col-sm-12">
                                        <textarea class="form-control mb-3" name="message" id=""  placeholder="Message" cols="30" rows="10" style="width: 100%;"></textarea>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-12 col-sm-12">
                                        <button class="btn btn-monster w-100">Send</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')
    <script></script>
@endsection
