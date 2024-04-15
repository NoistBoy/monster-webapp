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
    public function SingleProductDetails(Request $request)
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

        $SingleProductDetailSection = $this->SingleProductDetailSection($request->query('product_id'));

        return view('product-detail',compact('categoryTreeView', 'whatsNew_section', 'SingleProductDetailSection'));
    }

    public function SingleProductDetailSection($productId)
    {
        $productsDetails = $this->getSingleProductDetai($productId);

        $masterProduct = "";

        if($productsDetails['hasError'] == false && $productsDetails['status'] == 200 ){

            $masterProductImage = $productsDetails['result']['productImageList'][0];

            $masterProduct .= '<div class="col-md-5 col-sm-12">
                                    <div class="same-height-images">
                                        <div class="img-wrapper">
                                            <img src="'.$masterProductImage.'" class="product-img" alt="image" srcset="">
                                            <span class="product-stock-details">In Stock: '.$productsDetails['result']['masterProductDetails']['availableQuantity'].'</span>
                                        </div>
                                    </div>
                                    <input type="hidden"  name="product_id" id="product_id" value="'.$productsDetails['result']['masterProductDetails']['productId'].'" />
                                </div>';

            $masterProduct .= '<div class="col-md-6 col-sm-12">
                                    <div class="product-title fw-bold mb-5">
                                        <h1 id="product-title">'.ucwords(strtolower($productsDetails['result']['masterProductDetails']['productName'])).'</h1>
                                    </div>';
            $variationProducts = $productsDetails['result']['body']['content'];

            if(!empty($variationProducts)){
                $masterProduct .= $this->getProductVariationSection($variationProducts);
            }else{
                $masterProduct .= $this->getSameProductVariationSection($productsDetails['result']['masterProductDetails'], $masterProductImage);
            }

            $masterProduct .= '</div>';

        }

        return $masterProduct;
    }

    public function getProductVariationSection($variationProducts)
    {
        $toreturn = "";

        if(!empty($variationProducts)){

            $toreturn .= '<div class="row " style="border-top: 1px solid #D7DADD; padding: 21px 0; ">
            <div class="col-12 product-variation-container">';

            foreach($variationProducts as $variationProduct){

                $image =  $this->imgUrl($variationProduct['imageUrl']);

                $toreturn .= '<div class="product-variations mb-3">

                                <div class="var-details">

                                    <div class="var-img">
                                        <div class="d-flex justify-center align-items-center flex-shrink-0 " style="width: 5.5rem; height: 5.5rem; cursor:pointer; overflow:hidden; background:#FFFFFF;">
                                            <img class="w-auto h-auto mh-100 custom-object-fit" src="'.$image.'" alt="image">
                                        </div>
                                    </div>

                                    <div class="d-flex flex-column">
                                        <div class="" style="cursor: pointer; color:#000; font-weight: 500; font-size: 1rem; line-height: 1.125rem;">
                                            '. ucwords(strtolower($variationProduct['productName'])) .'
                                        </div>
                                        <div class="d-flex gap-2 " style="color: gray; line-height: 1.5rem; font-size: 0.8125rem; ">
                                            <div class="" style="padding-right: .5rem; border-right-width: 1px; border-color: #d7dadd;">
                                                <span class="uppercase" >Sku: </span>'.$variationProduct['sku'].'
                                            </div>
                                        </div>
                                        <div class="'.($this->isUserLogin() ? '' : 'protected').'">
                                            <div class=" d-flex gap-1 align-items-center">
                                                $'.($this->isUserLogin() ? $variationProduct['standardPrice'] : 'XX.XX').' <span data-stock-of-'.$variationProduct['productId'].'="'.$variationProduct['availableQuantity'].'" class=" d-flex gap-1 align-items-center text-grey-dark " style="margin-left: .5625rem;    font-size: .75rem;    line-height: 1.5rem;" >( '.$variationProduct['availableQuantity'].' / stock)</span>
                                            </div>
                                            <!-- <div class=" d-flex text-grey-dark "  style="font-size: .75rem; line-height: 1.5rem;" >
                                                <span class="d-flex">XX.XX</span>
                                            </div> -->
                                        </div>
                                    </div>

                                </div>

                                <div class="var-quantity d-flex flex-grow-0 gap-2 flex-column">
                                    <div class="quantity-input d-flex justify-center align-items-center gap-2">

                                        <button data-productID="'.$variationProduct['productId'].'" class="quantity-minus d-flex align-items-center justify-center rounded-full bg-grey-extralight" style="width: 22px; height:22px; border: none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="2" viewBox="0 0 10 2" fill="none">
                                                <path d="M0 2V0H10V2H0Z" fill="#BDC2C7"></path>
                                            </svg>
                                        </button>

                                        <input type="number" value="0"  class="quantity-input tag-btn-text" name="" id="" disabled style="width: 71px; height:58px; border-radius: 21px; border-width: 1px; border-style: solid; border-color: #bdc2c7; font-style: normal; font-weight: 500;  font-size: x-large; text-align: center; padding-left: 15px;">

                                        <button data-productID="'.$variationProduct['productId'].'" class="quantity-plus d-flex align-items-center justify-center rounded-full bg-grey-extralight" style="width: 22px; height:22px; border: none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6 0H4L4 4H0V6H4L4 10H6V6H10V4H6V0Z" fill="#BDC2C7"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <!-- Single variation End -->';
            }

            $toreturn .= ' </div>
            </div>';
        }

        return $toreturn;
    }
    public function getSameProductVariationSection($variationProducts, $image)
    {
        $toreturn = "";
            $toreturn .= '<div class="row " style="border-top: 1px solid #D7DADD; padding: 21px 0; ">
            <div class="col-12 product-variation-container">';

                $image =  $this->imgUrl($image);
                $sku = (!empty($variationProducts['sku']) && $variationProducts['sku'] !== "null" && $variationProducts['sku'] !== null) ? $variationProducts['sku'] : '--';


                $toreturn .= '<div class="product-variations mb-3">

                                <div class="var-details">

                                    <div class="var-img">
                                        <div class="d-flex justify-center align-items-center flex-shrink-0 " style="width: 5.5rem; height: 5.5rem; cursor:pointer; overflow:hidden; background:#FFFFFF;">
                                            <img class="w-auto h-auto mh-100 custom-object-fit" src="'.$image.'" alt="image">
                                        </div>
                                    </div>

                                    <div class="d-flex flex-column">
                                        <div class="" style="cursor: pointer; color:#000; font-weight: 500; font-size: 1rem; line-height: 1.125rem;">
                                            '. ucwords(strtolower($variationProducts['productName'])) .'
                                        </div>
                                        <div class="d-flex gap-2 " style="color: gray; line-height: 1.5rem; font-size: 0.8125rem; ">
                                            <div class="" style="padding-right: .5rem; border-right-width: 1px; border-color: #d7dadd;">
                                                <span class="uppercase" >Sku: </span>'.$sku.'
                                            </div>
                                        </div>
                                        <div class="'.($this->isUserLogin() ? '' : 'protected').'">
                                            <div class=" d-flex gap-1 align-items-center">
                                                $'.($this->isUserLogin() ? $variationProducts['standardPrice'] : 'XX.XX').' <span data-stock-of-'.$variationProducts['productId'].'="'.$variationProducts['availableQuantity'].'" class=" d-flex gap-1 align-items-center text-grey-dark " style="margin-left: .5625rem;    font-size: .75rem;    line-height: 1.5rem;" >( '.$variationProducts['availableQuantity'].' / stock)</span>
                                            </div>
                                            <!-- <div class=" d-flex text-grey-dark "  style="font-size: .75rem; line-height: 1.5rem;" >
                                                <span class="d-flex">XX.XX</span>
                                            </div> -->
                                        </div>
                                    </div>

                                </div>

                                <div class="var-quantity d-flex flex-grow-0 gap-2 flex-column">
                                    <div class="quantity-input d-flex justify-center align-items-center gap-2">

                                        <button data-productID="'.$variationProducts['productId'].'" class="quantity-minus d-flex align-items-center justify-center rounded-full bg-grey-extralight" style="width: 22px; height:22px; border: none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="2" viewBox="0 0 10 2" fill="none">
                                                <path d="M0 2V0H10V2H0Z" fill="#BDC2C7"></path>
                                            </svg>
                                        </button>

                                        <input type="number" value="0"  class="quantity-input tag-btn-text" name="" id="" disabled style="width: 71px; height:58px; border-radius: 21px; border-width: 1px; border-style: solid; border-color: #bdc2c7; font-style: normal; font-weight: 500;  font-size: x-large; text-align: center; padding-left: 15px;">

                                        <button data-productID="'.$variationProducts['productId'].'" class="quantity-plus d-flex align-items-center justify-center rounded-full bg-grey-extralight" style="width: 22px; height:22px; border: none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6 0H4L4 4H0V6H4L4 10H6V6H10V4H6V0Z" fill="#BDC2C7"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <!-- Single variation End -->';

            $toreturn .= ' </div>
            </div>';

        return $toreturn;
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

            return redirect('/sign-in');
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

    public function isUserLogin()
    {
        return Session::has('user.accessToken');
    }

    public function imgUrl($url)
    {
        if ($url && !empty($url) && $url !== "null") {
            return $url;
        } else {
            return asset('asset/img/place-holder.jpeg');
        }
    }


    public function getFeautureProducts_sections($tagId)
    {
        $Response = $this->getFeaturedProductsByEachTag($tagId);
        $NewProducts = "";
        if(!empty($Response) && $Response['status'] == 200){
            foreach ($Response['result']['content'] as $newProduct) {
                $productImage = $this->imgUrl($newProduct['imageUrl']);
                $productPrice = $this->isUserLogin() ? "$ " . $newProduct['standardPrice'] : "Login to view price";
                $href = $this->isUserLogin() ? '/product-details?product_id='.$newProduct['productId'].'' : url('/sign-in');
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
                $productImage = $this->imgUrl($newProduct['imageUrl']);
                $productPrice = $this->isUserLogin() ? "$ " . $newProduct['standardPrice'] : "Login to view price";
                $href = $this->isUserLogin() ? '/product-details?product_id='.$newProduct['productId'].'' : url('/sign-in');
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

    public function getSingleProductDetai($productId)
    {
        $headers = [
            'Accept: application/json, text/plain, /',
            'Accept-Language: en-US,en;q=0.9',
            'Cache-Control: no-cache',
            'Connection: keep-alive',
            'Origin: https://www.monstersmokewholesale.com',
            'Pragma: no-cache',
            'Referer: https://www.monstersmokewholesale.com/',
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Site: same-site',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36',
            'sec-ch-ua: "Google Chrome";v="123", "Not:A-Brand";v="8", "Chromium";v="123"',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: "Windows"',
        ];
        $url =  'https://erp.monstersmokewholesale.com/api/ecommerce/product/'.$productId.'?storeIds=2';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true);
    }

    public function postCart()
    {
        $ch = curl_init();
        $url = 'https://erp.monstersmokewholesale.com/api/cartLineItem?storeId=2';
        $headers = [
            'Accept: application/json, text/plain, */*',
            'Accept-Language: en-GB,en;q=0.6',
            'Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJhbG9rcGF0ZWw5ODI0MTA3MTUyKzFAZ21haWwuY29tIiwidGllciI6NSwidXNlclR5cGUiOiJDdXN0b21lciIsInRva2VuVHlwZSI6ImFjY2VzcyIsInN0b3JlSWQiOjIsImV4cCI6MTcxMDE0NzEwMCwidXNlcklkIjoxNzk1LCJpYXQiOjE3MTAwMjcxMDAsInJlc2V0UGFzc3dvcmRSZXF1aXJlZCI6ZmFsc2V9.zHnPTiMgn7QJDaBycB7c3IuuP5LR9T_w-hNWCRh56Lo',
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
        $post = '[
            {
                "productId": 24909,
                "sku": null,
                "upc": "734366044551",
                "productName": "Smoke Odor 7oz Gummies Spray",
                "alias": "smoke-odor-7oz-gummies-spray",
                "availableQuantity": 39,
                "eta": "Not Available",
                "imageUrl": "https://d11cxue75f9a69.cloudfront.net/product-images/smoke-odor-exterminator-spray-gummies-1-1708707379821.jpg",
                "masterProductId": null,
                "masterProductName": null,
                "taxClassId": null,
                "standardPrice": 4.75,
                "standardPriceWithoutDiscount": 4.75,
                "sequenceNumber": 47,
                "costPrice": null,
                "tags": null,
                "tagName": null,
                "tagId": null,
                "tagImageDtoList": null,
                "minQuantityToSale": 1,
                "maxQuantityToSale": 0,
                "quantityIncrement": 0,
                "hasChildProduct": false,
                "promotionType": null,
                "promotionValue": 0,
                "promotionStartdate": null,
                "promotionEnddate": null,
                "promotionNotes": null,
                "weight": null,
                "height": null,
                "length": null,
                "width": null,
                "quantity": 1
            }
        ]';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true);
    }

    public function addToCart()
    {
        $category_Response = $this->getCategories();
        $categoryTreeView = null;
        if($category_Response){
            if($category_Response['status'] == 200){

                $categories = $category_Response['result'];

                $categoryTreeView = $this->getCategoryTreeView($categories);
            }
        }

      return view('add-to-cart',compact('categoryTreeView'));
    }

    public function getRelatedProducts()
    {
        $headers = [
            'Accept: application/json, text/plain, /',
            'Accept-Language: en-US,en;q=0.9',
            'Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJjaXR5c21va2VzdmFwZUBnbWFpbC5jb20iLCJ0aWVyIjo1LCJ1c2VyVHlwZSI6IkN1c3RvbWVyIiwidG9rZW5UeXBlIjoiYWNjZXNzIiwic3RvcmVJZCI6MiwiZXhwIjoxNzEyNjczOTIyLCJ1c2VySWQiOjE3MjYsImlhdCI6MTcxMjU1MzkyMiwicmVzZXRQYXNzd29yZFJlcXVpcmVkIjpmYWxzZX0.VSsoTulzqUUR-ahaZ6a4Innf3HfY8yFECo2Zm8SLetg',
            'Cache-Control: no-cache',
            'Connection: keep-alive',
            'Origin: https://www.monstersmokewholesale.com',
            'Pragma: no-cache',
            'Referer: https://www.monstersmokewholesale.com/',
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Site: same-site',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36',
            'sec-ch-ua: "Google Chrome";v="123", "Not:A-Brand";v="8", "Chromium";v="123"',
            'sec-ch-ua-mobile: ?0',
            "sec-ch-ua-platform: \xa0\"Windows\"",
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://erp.monstersmokewholesale.com/api/ecommerce/product/24908/relatedProduct?storeIds=1,2');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        curl_close($ch);

      return  json_decode($response, true);
    }
    public function getCustomerDetail()
    {
        $curl = curl_init();
        $url = 'https://erp.monstersmokewholesale.com/api/ecommerce/customer';
        $accessToken = Session::get('user.accessToken');
        $headers = array(
            '-H\'Accept:  application/json, text/plain, /\' \\',
            '-H\'Accept-Language:  en-US,en;q=0.9\' \\',
            '-H\'Authorization:  Bearer '.$accessToken.'',
            '-H\'Cache-Control:  no-cache\' \\',
            '-H\'Connection:  keep-alive\' \\',
            '-H\'Origin:  https://www.monstersmokewholesale.com\' \\',
            '-H\'Pragma:  no-cache\' \\',
            '-H\'Referer:  https://www.monstersmokewholesale.com/\' \\',
            '-H\'Sec-Fetch-Dest:  empty\' \\',
            '-H\'Sec-Fetch-Mode:  cors\' \\',
            '-H\'Sec-Fetch-Site:  same-site\' \\',
            '-H\'User-Agent:  Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36\' \\',
            '-H\'sec-ch-ua:  "Google Chrome";v="123", "Not:A-Brand";v="8", "Chromium";v="123"\' \\',
            '-H\'sec-ch-ua-mobile:  ?0\' \\',
            '-H\'sec-ch-ua-platform:  "Windows"\'',
            'Authorization: Bearer '.$accessToken.''
        );

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return  json_decode($response, true);
    }

    public function getPaymentMethods()
    {
        $ch = curl_init();
        $headers = [
            'Accept: application/json, text/plain',
            'Accept-Language: en-US,en;q=0.9',
            'Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJjaXR5c21va2VzdmFwZUBnbWFpbC5jb20iLCJ0aWVyIjo1LCJ1c2VyVHlwZSI6IkN1c3RvbWVyIiwidG9rZW5UeXBlIjoiYWNjZXNzIiwic3RvcmVJZCI6MiwiZXhwIjoxNzEyNjczOTIyLCJ1c2VySWQiOjE3MjYsImlhdCI6MTcxMjU1MzkyMiwicmVzZXRQYXNzd29yZFJlcXVpcmVkIjpmYWxzZX0.VSsoTulzqUUR-ahaZ6a4Innf3HfY8yFECo2Zm8SLetg',
            'Cache-Control: no-cache',
            'Connection: keep-alive',
            'Origin: https://www.monstersmokewholesale.com',
            'Pragma: no-cache',
            'Referer: https://www.monstersmokewholesale.com/',
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Site: same-site',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36',
            'sec-ch-ua: "Google Chrome";v="123", "Not:A-Brand";v="8", "Chromium";v="123"',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: "Windows"',
        ];
        $url = 'https://erp.monstersmokewholesale.com/api/store/paymentMode';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        curl_close($ch);

        return  json_decode($response, true);
    }

    public function getShipingDetails()
    {
        $ch = curl_init();
        $url = 'https://erp.monstersmokewholesale.com/api/shipping/options';
        $headers = [
            'Accept: application/json, text/plain',
            'Accept-Language: en-US,en;q=0.9',
            'Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJjaXR5c21va2VzdmFwZUBnbWFpbC5jb20iLCJ0aWVyIjo1LCJ1c2VyVHlwZSI6IkN1c3RvbWVyIiwidG9rZW5UeXBlIjoiYWNjZXNzIiwic3RvcmVJZCI6MiwiZXhwIjoxNzEyNjczOTIyLCJ1c2VySWQiOjE3MjYsImlhdCI6MTcxMjU1MzkyMiwicmVzZXRQYXNzd29yZFJlcXVpcmVkIjpmYWxzZX0.VSsoTulzqUUR-ahaZ6a4Innf3HfY8yFECo2Zm8SLetg',
            'Cache-Control: no-cache',
            'Connection: keep-alive',
            'Origin: https://www.monstersmokewholesale.com',
            'Pragma: no-cache',
            'Referer: https://www.monstersmokewholesale.com/',
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Site: same-site',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36',
            'sec-ch-ua: "Google Chrome";v="123", "Not:A-Brand";v="8", "Chromium";v="123"',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: "Windows"',
        ];
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        curl_close($ch);

        return  json_decode($response, true);
    }



}
