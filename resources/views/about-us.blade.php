@extends('layout.layout')
<!--  Get Categories Products  -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        getAboutUs()
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

    async function getAboutUs() {
        const url = 'https://erp.monstersmokewholesale.com/api/ecommerce/staticPage?alias=about-us';
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

        <div class="row pt-1">
            <div class="col-md-12 col-sm-12">
                <div class="container">
                    <h1 class="fw-bold mb-4" id="page-title"></h1>
                </div>

                <div class="container " id="page-content">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')
    <script></script>
@endsection
