@extends('layout.layout')
<!--  Get Categories Products  -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        getReturnPolicy()
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

    async function getReturnPolicy() {
        const url = 'https://erp.monstersmokewholesale.com/api/ecommerce/staticPage?alias=return-policy';
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
    <div class="container-fluid px-5 d-flex justify-content-center align-content-center" style="min-height: 42rem; max-height:max-content; ">
        <center class="my-auto" style="text-align: left;">
            <h1 class="fw-bold" id="page-title" ></h1>

            <div class="container " id="page-content">

            </div>
        </center>
    </div>
@endsection

@section('custom-scripts')
    <script>

    </script>
@endsection
