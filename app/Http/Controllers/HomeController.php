<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $category_Response = $this->getCategories();
        $categoryTreeView = null;
        if($category_Response){
            if($category_Response['status'] == 200){

                $categories = $category_Response['result'];

                $categoryTreeView = $this->getCategoryTreeView($categories);
            }
        }
        $newProductTag_id = 2;
        $whatsNew_section = $this->getFeautureProducts_sections($newProductTag_id);

        $ShopNowSection = $this->getShopNow_Section();

        // $FeaturedAndDisposableTagId = 5;
        // $FeaturedAndDisposable_section = $this->getFeautureProducts_sections($FeaturedAndDisposableTagId);

        // $FeaturedProductsTagId = 3;
        // $FeaturedProducts_section = $this->getFeautureProducts_sections($FeaturedProductsTagId);

        // $BestSellersTagId = 4;
        // $BestSellers_section = $this->getFeautureProducts_sections($BestSellersTagId);

        // $TimelimitedTagId = 6;
        // $Timelimited_section = $this->getFeautureProducts_sections($TimelimitedTagId);

        return view('index', compact(
            'categoryTreeView',
            'ShopNowSection',
            'whatsNew_section',
            // 'FeaturedAndDisposable_section',
            // 'FeaturedProducts_section',
            // 'BestSellers_section',
            // 'Timelimited_section',
        ));
    }

    public function getCategoryTreeView($categories)
    {
        $categoryLabels = '';
        $categorylists = '';

        foreach ($categories as $category) {
            $categoryName = str_replace(' ', '', $category['name']);
            $categoryID =  $category['id'];

            $categoryLabels .= '<li class="mb-2 label d-flex justify-content-between align-items-center" id="'. $categoryID .'">
                                    <span class="">'.$categoryName.'</span><i class="lni lni-chevron-right"></i>
                                </li>';
            $categorylists .= '<div class="list-values" id="'. $categoryID .'-list">
                                    <span class="d-flex align-items-center back-to-category"><i class="lni lni-chevron-left"></i>&nbsp;&nbsp;&nbsp;<a href="#"> Back to Home</a></span>';

            if(!empty($category['subCategories'])){
                foreach ($category['subCategories'] as $subCategory) {
                    $categorylists .= '<span class="d-flex align-items-center"><a href="'.url('/each-category-products/'.strtolower(str_replace(' ', '-', $categoryName)).'/'.strtolower(str_replace(' ', '-', str_replace('/', '-', $subCategory['name']))).'/'.$subCategory['id']).'" id="'.$subCategory['id'].'" data-parent_id="'.$categoryID.'"  >'.$subCategory['name'].'</a></span>';
                }
            }

            $categorylists .= '</div>';
        }

        $categoryLabels = '<ul id="category-list" >' . $categoryLabels . '</ul>';

        $categoryTreeView = $categoryLabels . $categorylists;
        return $categoryTreeView;
    }

    public function getShopNow_Section()
    {
        $productSection = "";
        if (($response = $this->getFeaturedProductsTags()) && !$response['hasError'] && $response['status'] == 200) {
            foreach ($response['result'] as $productTag) {

                if(!empty($productTag['id'])){
                    $products = $this->getFeautureProducts_sections($productTag['id']) ;
                    if(!empty($products)) {
                        $productSection .= '<div class="container mb-5">
                        <h2 class=" fw-bold fs-1 my-4">'.$productTag['name'].'</h2>
                        <!-- owl-carousel start --><div class="owl-carousel owl-theme ">';
                        $productSection .= $products;
                        $productSection .= '</div><!-- owl-carousel END --></div>';
                    }
                }

            }
        }

        return  $productSection;
    }
    public function getCountries()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://erp.monstersmokewholesale.com/api/country/all');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if($response){
            $response = json_decode($response, true);

            if($response['status'] == 200){
                return $response['result'];
            }else{
                return "Some Thing  went Wrong!";
            }
        }

    }
    public function getStates(Request $request)
    {
        $countryID = $request->input('countryId');

        $url = 'https://erp.monstersmokewholesale.com/api/country/' . $countryID . '/allState';

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        ]);
        $response = curl_exec($ch);
        curl_close($ch);

        $option = "<option value=''> ---- Please Select ----</option>";

        if ($response) {
            $response = json_decode($response, true);

            if ($response['status'] == 200) {
                foreach ($response['result'] as $cities) {
                    $option .= "<option value='{$cities['id']}'>{$cities['name']}</option>";
                }
                return $option;
            } else {
                return "Something went wrong!";
            }
        }
    }


    public function getCategories()
    {
        $ch = curl_init();
        $url = 'https://erp.monstersmokewholesale.com/api/menu?businessTypeId=1';
        $headers = [
            'Accept: application/json, text/plain, */*',
            'Accept-Language: en-GB,en;q=0.6',
            'Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJqb2huLmouaHVudC4xMkBnbWFpbC5jb20iLCJ0aWVyIjo1LCJ1c2VyVHlwZSI6IkN1c3RvbWVyIiwidG9rZW5UeXBlIjoiYWNjZXNzIiwic3RvcmVJZCI6MiwiZXhwIjoxNzEwMTQ2MzE2LCJ1c2VySWQiOjMyOSwiaWF0IjoxNzEwMDI2MzE2LCJyZXNldFBhc3N3b3JkUmVxdWlyZWQiOmZhbHNlfQ.FgnMJU4JGOquL5vLvPQ_WNEnxw_My2iGq1-sJNhu1lU',
            'Connection: keep-alive',
            'Origin: https://www.monstersmokewholesale.com',
            'Referer: https://www.monstersmokewholesale.com/',
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Site: same-site',
            'Sec-GPC: 1',
            'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
            'sec-ch-ua: "Chromium";v="122", "Not(A:Brand";v="24", "Brave";v="122"',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: "macOS"',
        ];
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function authenticateUser()
    {

        $ch = curl_init();
        $headers = [
            'Accept: application/json, text/plain, */*',
            'Accept-Language: en-GB,en;q=0.6',
            'Connection: keep-alive',
            'Content-Type: application/json',
            'Origin: https://www.monstersmokewholesale.com',
            'Referer: https://www.monstersmokewholesale.com/',
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Site: same-site',
            'Sec-GPC: 1',
            'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
            'sec-ch-ua: "Chromium";v="122", "Not(A:Brand";v="24", "Brave";v="122"',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: "macOS"',
        ];
        $postData = '{"username":"john.j.hunt.12@gmail.com","type":"customer","password":"ZoolaPA23!!"}';
        curl_setopt($ch, CURLOPT_URL, 'https://erp.monstersmokewholesale.com/api/authenticate');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        $response = curl_exec($ch);

        curl_close($ch);

        if($response){
            $userData = json_decode($response, true);

            $hasError = $userData['hasError'];
            $status = $userData['status'];

            if($hasError == 1){
                return response()->json([
                    'status' => "error",
                    'message' => $userData['error'],
                ]);
            }

            $accessToken = $userData['result']['access'] ?? null;
            $refresh     = $userData['result']['refresh'] ?? null;

            Session::put('user', [
                'accessToken' => $accessToken,
                'refresh' =>  $refresh
            ]);

            if($status == 200){
                return response()->json([
                    'status' => "success",
                    'user_accessToken' => $accessToken,
                    'user_refresh' => $refresh,
                    'message' => "SingIn Successfully!",
                ]);
            }


        }
    }
    public function singIn()
    {
        return view('singIn');
    }

    public function singUp()
    {
        $countries = $this->getCountries();
        return view('singUp',compact('countries'));
    }
    public function singUpCustomer(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'business_name' => 'required',
                'company' => 'required',
                'business_address' => 'required',
                'city' => 'required',
                'country_id' => 'required|numeric',
                'state_id' => 'required|numeric',
                'zipcode' => 'required',
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|email',
                'phone' => 'sometimes|nullable|min:11|max:11',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            // echo "<pre>";
            // print_r($request->all());die;
            $business_name = $request->input('business_name');
            $company = $request->input('company');
            $tax_id = $request->input('tax_id');
            $business_address = $request->input('business_address');
            $country_id = $request->input('country_id');
            $city = $request->input('city');
            $state_id = $request->input('state_id');
            $zipcode = $request->input('zipcode');
            $firstname = $request->input('firstname');
            $lastname = $request->input('lastname');
            $email = $request->input('email');
            $phone = $request->input('phone');

            $headers = [
                'Accept: application/json, text/plain',
                'Accept-Language: en-GB,en;q=0.6',
                'Connection: keep-alive',
                'Content-Type: multipart/form-data; boundary=----WebKitFormBoundaryNwyCxUb1pUNASnqS',
                'Origin: https://www.monstersmokewholesale.com',
                'Referer: https://www.monstersmokewholesale.com/',
                'Sec-Fetch-Dest: empty',
                'Sec-Fetch-Mode: cors',
                'Sec-Fetch-Site: same-site',
                'Sec-GPC: 1',
                'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
                'sec-ch-ua: "Chromium";v="122", "Not(A:Brand";v="24", "Brave";v="122"',
                'sec-ch-ua-mobile: ?0',
                'sec-ch-ua-platform: "macOS"',
            ];
            $postData = [
                'customerObj' => '{
                    "customerStoreAddressList": [
                    {
                        "address1": "'. $business_address .'",
                        "city": "'. $city .'",
                        "countryId":  ' . $country_id . ',
                        "stateId": '. $state_id .',
                        "zip": "'. $zipcode .'"
                    }
                    ],
                    "firstName": "'. $firstname .'",
                    "lastName": "'.$lastname.'",
                    "email": "'. $email .'",
                    "phone": "'. $phone .'",
                    "company": "'. $company .'",
                    "dbaName": "Salesgent",
                    "primaryBusinessName": "'. $business_name .'",
                    "taxId": "'. $tax_id .'"
                }',
            ];

            $url = 'https://erp.monstersmokewholesale.com/api/ecommerce/customer/withDocuments';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

            $response = curl_exec($ch);

        curl_close($ch);
            if($response){
                $response = json_decode($response, true);

                if($response['hasError'] == false){

                    return response()->json([
                        'status' => "success",
                        'message' => "Your application was submitted. Please check your email.",
                    ]);

                }else{
                    return response()->json([
                        'status' => "error",
                        'message' => "Some Thing  went Wrong! Please  try again letter.",
                    ]);
                }
            }

        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            return response()->json([
                'status' => "error",
                'message' => $errorMessage
            ], 500);
        }

    }
    public  function AuthenticationApi($username, $userPassword)
    {
        $headers = [
            'Accept: application/json, text/plain, */*',
            'Accept-Language: en-GB,en;q=0.6',
            'Connection: keep-alive',
            'Content-Type: application/json',
            'Origin: https://www.monstersmokewholesale.com',
            'Referer: https://www.monstersmokewholesale.com/',
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Site: same-site',
            'Sec-GPC: 1',
            'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
            'sec-ch-ua: "Chromium";v="122", "Not(A:Brand";v="24", "Brave";v="122"',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: "macOS"',
        ];
        $userData = '{"username":"'. $username .'","type":"customer","password":"'. $userPassword .'"}';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://erp.monstersmokewholesale.com/api/authenticate');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $userData);

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true);
    }
    public function singInCustomer(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $username = $request->input('username');
            $userPassword = $request->input('password');

            $response = $this->AuthenticationApi($username, $userPassword);

            if($response){

                if($response['hasError'] == 1){

                    return response()->json([
                        'status' => "error",
                        'message' => $response['error'],
                    ]);

                }

                if(!$response['hasError']){

                    $accessToken = $response['result']['access'] ?? null;
                    $refresh     = $response['result']['refresh'] ?? null;


                    if($accessToken !== null){
                        Session::put('user', [
                            'accessToken' => $accessToken,
                            'refresh' =>  $refresh
                        ]);

                        Session::put('ShowSingInMessage', [
                            'title' =>  "Sing In Successfully!",
                            'message' => "You are Logged in Now",
                        ]);

                        return response()->json([
                            'status' => "success",
                            'redirect' => "/",
                            'access' => $response['result']['access'],
                        ]);

                    }else{

                        return response()->json([
                            'status' => "error",
                            'message' => "Something went  wrong.",
                            'redirect' => false,
                        ]);
                    }
                }
            }

        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            return response()->json([
                'status' => "error",
                'message' => $errorMessage
            ], 500);
        }
    }

    public function LogOut()
    {
        if(Session::has('user.accessToken')){
            Session::forget('user');

            return redirect('/sing-in');
        }else{
            return redirect()->back();
        }
    }

    public function getFeaturedProductsTags()
    {
        $headers = [
            'Accept: application/json, text/plain, */*',
            'Accept-Language: en-GB,en;q=0.6',
            'Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJhbG9rcGF0ZWw5ODI0MTA3MTUyKzFAZ21haWwuY29tIiwidGllciI6NSwidXNlclR5cGUiOiJDdXN0b21lciIsInRva2VuVHlwZSI6ImFjY2VzcyIsInN0b3JlSWQiOjIsImV4cCI6MTcxMDE0NzEwMCwidXNlcklkIjoxNzk1LCJpYXQiOjE3MTAwMjcxMDAsInJlc2V0UGFzc3dvcmRSZXF1aXJlZCI6ZmFsc2V9.zHnPTiMgn7QJDaBycB7c3IuuP5LR9T_w-hNWCRh56Lo',
            'Connection: keep-alive',
            'Origin: https://www.monstersmokewholesale.com',
            'Referer: https://www.monstersmokewholesale.com/',
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Site: same-site',
            'Sec-GPC: 1',
            'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
            'sec-ch-ua: "Chromium";v="122", "Not(A:Brand";v="24", "Brave";v="122"',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: "macOS"',
        ];
        $url = 'https://erp.monstersmokewholesale.com/api/home/productTagList';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true);
    }

    public function getFeaturedProductsByEachTag($tagId)
    {
        $url = 'https://erp.monstersmokewholesale.com/api/home/product/tagId/'.$tagId.'?page=0&size=10&businessTypeId=1&storeId=2';
        $headers = array(
            'Accept: application/json, text/plain, */*',
            'Accept-Language: en-GB,en;q=0.6',
            'Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJhbG9rcGF0ZWw5ODI0MTA3MTUyKzFAZ21haWwuY29tIiwidGllciI6NSwidXNlclR5cGUiOiJDdXN0b21lciIsInRva2VuVHlwZSI6ImFjY2VzcyIsInN0b3JlSWQiOjIsImV4cCI6MTcxMDE0NzEwMCwidXNlcklkIjoxNzk1LCJpYXQiOjE3MTAwMjcxMDAsInJlc2V0UGFzc3dvcmRSZXF1aXJlZCI6ZmFsc2V9.zHnPTiMgn7QJDaBycB7c3IuuP5LR9T_w-hNWCRh56Lo',
            'Connection: keep-alive',
            'Origin: https://www.monstersmokewholesale.com',
            'Referer: https://www.monstersmokewholesale.com/',
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Site: same-site',
            'Sec-GPC: 1'
        );

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        curl_close($ch);

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true);
    }

    public function getallbrands()
    {
        $post = [
            'Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJhc3cxMDAyQGdtYWlsLmNvbSIsInVzZXJUeXBlIjoiRW1wbG95ZWUiLCJ0b2tlblR5cGUiOiJhY2Nlc3MiLCJzdG9yZUlkIjoxLCJleHAiOjE3MDk5NTE5NTAsInVzZXJJZCI6MSwiaWF0IjoxNzA5ODMxOTUwLCJyZXNldFBhc3N3b3JkUmVxdWlyZWQiOmZhbHNlfQ.rwaVPjtDxNIRUZjgkzfREcMASEIIg7tYvXJdwMbUDW0',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://erp.monstersmokewholesale.com/api/ecommerce/product/brand?brandIdList=1');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $post);

        $response = curl_exec($ch);

        curl_close($ch);

        echo  $response;
        die();
    }

    public function getFeautureProducts_sections($tagId)
    {
        $Response = $this->getFeaturedProductsByEachTag($tagId);
        $NewProducts = "";
        if(!empty($Response) && $Response['status'] == 200){
            foreach ($Response['result']['content'] as $newProduct) {
                $productImage = empty($newProduct['imageUrl']) ? asset('asset/img/place-holder.jpeg') : $newProduct['imageUrl'];
                $productPrice = Session::has('user.accessToken') ? "$ " . $newProduct['standardPrice'] : "Login to view price";
                $href = Session::has('user.accessToken') ? '' : url('/sign-in');
                $NewProducts .= '<div class="item">
                                    <div class="product-card">
                                    <div class="d-flex justify-content-center align-items-center mb-3">
                                        <span class="d-block new-arrival"><i class="lni lni-star-fill"></i> New Arrival</span>
                                    </div>
                                    <div class="d-flex justify-content-center same-height-images ">
                                        <img src="' . $productImage . '" alt="image" srcset="" class="img-fluid w-100">
                                    </div>
                                    <div>
                                        <span class="d-block fw-bold product-card-stock-detail monster-primary ">In Stock: '.$newProduct['availableQuantity'].'</span>
                                        <p class="fs-6  text product-card-title fw-bold">'.$newProduct['productName'].'</p>
                                        <a class="btn product-card-btn fw-bold" href="'.$href.'">
                                            '.$productPrice.'
                                        </a>
                                    </div>
                                    </div>
                                </div>';

            }
        }

        return $NewProducts;
    }
    public function getEachCategoryProducts_sections($Response)
    {
        $Products = "";
        if(!empty($Response) && $Response['status'] == 200){
            foreach ($Response['result']['content'] as $newProduct) {
                $productImage = empty($newProduct['imageUrl']) ? asset('asset/img/place-holder.jpeg') : $newProduct['imageUrl'];
                $productPrice = Session::has('user.accessToken') ? "$ " . $newProduct['standardPrice'] : "Login to view price";
                $href = Session::has('user.accessToken') ? '' : url('/sign-in');
                $Products .= '<div class="product-card">
                                    <div class="d-flex justify-content-center align-items-center mb-3">
                                        <span class="d-block new-arrival"><i class="lni lni-star-fill"></i> New Arrival</span>
                                    </div>
                                    <div class="d-flex justify-content-center same-height-images ">
                                        <img src="' . $productImage . '" alt="image" srcset="" class="img-fluid w-100">
                                    </div>
                                    <div>
                                        <span class="d-block fw-bold product-card-stock-detail monster-primary ">In Stock: '.$newProduct['availableQuantity'].'</span>
                                        <p class="fs-6  text product-card-title fw-bold">'.$newProduct['productName'].'</p>
                                        <a class="btn product-card-btn fw-bold" href="'.$href.'">
                                            '.$productPrice.'
                                        </a>
                                    </div>
                                </div>';
            }
        }

        return $Products;
    }

    public function getProducts($categoryIdList = 25)
    {
        $ch = curl_init();
        $url = 'https://erp.monstersmokewholesale.com/api/ecommerce/product/category?categoryIdList='.$categoryIdList.'&page=0&size=20&sort=date&sortDirection=DESC&storeIds=2';
        $headers = [
            'Accept: application/json, text/plain, */*',
            'Accept-Language: en-GB,en;q=0.6',
            'Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJqb2huLmouaHVudC4xMkBnbWFpbC5jb20iLCJ0aWVyIjo1LCJ1c2VyVHlwZSI6IkN1c3RvbWVyIiwidG9rZW5UeXBlIjoiYWNjZXNzIiwic3RvcmVJZCI6MiwiZXhwIjoxNzEwMTQ2MzE2LCJ1c2VySWQiOjMyOSwiaWF0IjoxNzEwMDI2MzE2LCJyZXNldFBhc3N3b3JkUmVxdWlyZWQiOmZhbHNlfQ.FgnMJU4JGOquL5vLvPQ_WNEnxw_My2iGq1-sJNhu1lU',
            'Connection: keep-alive',
            'Origin: https://www.monstersmokewholesale.com',
            'Referer: https://www.monstersmokewholesale.com/',
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Site: same-site',
            'Sec-GPC: 1',
            'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
            'sec-ch-ua: "Chromium";v="122", "Not(A:Brand";v="24", "Brave";v="122"',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: "macOS"',
        ];
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function getEachCategoryProducts($category, $subcategory, $categoryId)
    {
        $products = $this->getProducts($categoryId);
        $products = $this->getEachCategoryProducts_sections($products);

        $category_Response = $this->getCategories();
        $categoryTreeView = null;
        if($category_Response){
            if($category_Response['status'] == 200){

                $categories = $category_Response['result'];
                $categoryTreeView = $this->getCategoryTreeView($categories);
            }
        }
        $subcategory = ucwords(str_replace('-', ' ', $subcategory));
        return view('each-category-products',compact('categoryTreeView','products','category','subcategory', 'categoryId'));
    }

}
