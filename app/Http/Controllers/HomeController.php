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
        // $category_Response = $this->getCategories();
        // $categoryTreeView = null;
        // if($category_Response){
        //     if($category_Response['status'] == 200){
        //         $categories = $category_Response['result'];
        //         $categoryTreeView = $this->getCategoryTreeView($categories);
        //     }
        // }

        // $newProductTag_id = 2;
        // $whatsNew_section = $this->getFeautureProducts_sections($newProductTag_id);

        // $ShopNowSection = $this->getShopNow_Section();

        // $mainSlides = $this->getMainSlides(85);
        // $TopFiveProductSlides = $this->getMainSlides(94);
        // $spotlightProducts = $this->getMainSlides(98);

        // $FeaturedAndDisposableTagId = 5;
        // $FeaturedAndDisposable_section = $this->getFeautureProducts_sections($FeaturedAndDisposableTagId);

        // $FeaturedProductsTagId = 3;
        // $FeaturedProducts_section = $this->getFeautureProducts_sections($FeaturedProductsTagId);

        // $BestSellersTagId = 4;
        // $BestSellers_section = $this->getFeautureProducts_sections($BestSellersTagId);

        // $TimelimitedTagId = 6;
        // $Timelimited_section = $this->getFeautureProducts_sections($TimelimitedTagId);

        return view('index'
            // , compact(
            // 'categoryTreeView',
            // 'ShopNowSection',
            // 'whatsNew_section',
            // 'mainSlides',
            // 'TopFiveProductSlides',
            // 'spotlightProducts',
            // 'FeaturedAndDisposable_section',
            // 'FeaturedProducts_section',
            // 'BestSellers_section',
            // 'Timelimited_section',
            // )
        );
    }

    public function userDashBoard()
    {
        return view('user-dashboard');
    }
    public function getMainSlides($sliderTypeId)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://erp.monstersmokewholesale.com/api/home/sliderImages?sliderTypeId='.$sliderTypeId.'&businessTypeId=1',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            '-H\'Accept:  application/json, text/plain, /\'',
            '-H\'Accept-Language:  en-US,en;q=0.9\'',
            '-H\'Cache-Control:  no-cache\'',
            '-H\'Connection:  keep-alive\'',
            '-H\'Origin:  https://www.monstersmokewholesale.com\'',
            '-H\'Pragma:  no-cache\'',
            '-H\'Referer:  https://www.monstersmokewholesale.com/\'',
            '-H\'Sec-Fetch-Dest:  empty\'',
            '-H\'Sec-Fetch-Mode:  cors\'',
            '-H\'Sec-Fetch-Site:  same-site\'',
            '-H\'User-Agent:  Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36\'',
            '-H\'sec-ch-ua:  "Google Chrome";v="123", "Not:A-Brand";v="8", "Chromium";v="123"\'',
            '-H\'sec-ch-ua-mobile:  ?0\'',
            '-H\'sec-ch-ua-platform:  "Windows"\''
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response);

        if(!$response->hasError){

            return $response->result->sliderImageList;
        }
        return "Something Went Wrong!";
    }

    public function SingleProductDetails(Request $request)
    {
        // $category_Response = $this->getCategories();
        // $categoryTreeView = null;
        // if($category_Response){
        //     if($category_Response['status'] == 200){

        //         $categories = $category_Response['result'];

        //         $categoryTreeView = $this->getCategoryTreeView($categories);
        //     }
        // }

        $newProductTag_id = 2;
        $whatsNew_section = $this->getFeautureProducts_sections($newProductTag_id);

        $SingleProductDetailSection = $this->SingleProductDetailSection($request->query('product_id'));

        return view('product-detail',compact(
            // 'categoryTreeView',
            'whatsNew_section', 'SingleProductDetailSection'));
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
                                            <img src="'.$masterProductImage.'" class="product-img img-fluid" alt="image" srcset="">
                                            <span class="product-stock-details">In Stock: '.$productsDetails['result']['masterProductDetails']['availableQuantity'].'</span>
                                        </div>
                                    </div>
                                <!-- <input type="hidden"  name="product_id" id="product_id" value="'.$productsDetails['result']['masterProductDetails']['productId'].'" /> -->
                                </div>';

            $masterProduct .= '<div class="col-md-6 col-sm-12 " style="padding-left:1.5rem;" >
                                    <div class="product-title fw-bold mb-5">
                                        <h1 id="product-title">'.ucwords(strtolower($productsDetails['result']['masterProductDetails']['productName'])).'</h1>
                                    </div>';
            $variationProducts = $productsDetails['result']['body']['content'];

            if(!empty($variationProducts)){
                $masterProduct .= $this->getProductVariationSection($variationProducts);
            }else{
                $masterProduct .= $this->getSameProductVariationSection($productsDetails['result']['masterProductDetails'], $masterProductImage);
            }

            $masterProduct .= '<div class=" d-flex justify-content-center align-items-center" ><button class="add-to-cart-btn add-item-to-cart"  ><i class="fa-solid fa-cart-shopping"></i>&nbsp;Add&nbsp;to&nbsp;Cart</button></div>';
            $masterProduct .= '</div>';

        }

        return $masterProduct;
    }

    public function getProductVariationSection($variationProducts)
    {
        $toreturn = "";

        if(!empty($variationProducts)){
            // echo  "<pre>"; print_r($variationProducts); die();
            $toreturn .= '<div class="row " style="border-top: 1px solid #D7DADD; padding: 21px 0; ">
            <div class="col-12 product-variation-container">';
            $i = 0;
            foreach($variationProducts as $variationProduct){

                $image =  $this->imgUrl($variationProduct['imageUrl']);

                $toreturn .= '<div class="product-variations mb-5">

                                <div class="var-details">

                                    <div class="var-img">
                                        <div data-image-of-'.$variationProduct['productId'].'="'.$variationProduct['imageUrl'].'" class="d-flex justify-center align-items-center flex-shrink-0 " style="width: 5.5rem; height: 5.5rem; cursor:pointer; overflow:hidden; background:#FFFFFF;">
                                            <img class="w-auto h-auto mh-100 custom-object-fit" src="'.$image.'" alt="image">
                                        </div>
                                    </div>

                                    <div class="d-flex flex-column">
                                        <div data-alias-of-'.$variationProduct['productId'].'="'.$variationProduct['urlAlias'].'" class="" style="cursor: pointer; color:#000; font-weight: 500; font-size: 1.2rem; line-height: 2rem;">
                                            '. ucwords(strtolower($variationProduct['productName'])) .'
                                        </div>
                                        <div class="d-flex gap-2 " style="color: gray; line-height: 1.9rem; font-size: 1rem; ">
                                            <div class="" style="padding-right: .5rem; border-right-width: 1px; border-color: #d7dadd  <span  class="uppercase" data-upc-of-'.$variationProduct['productId'].'="'.$variationProduct['upc'].'" data-sku-of-'.$variationProduct['productId'].'="'.$variationProduct['sku'].'" >Sku: </span>'.$variationProduct['sku'].'
                                            </div>
                                        </div>
                                        <div class="'.($this->isUserLogin() ? '' : 'protected').'">
                                            <div  class=" d-flex gap-1 align-items-center">
                                                $'.($this->isUserLogin() ? $variationProduct['standardPrice'] : 'XX.XX').' <span data-eta-of-'.$variationProduct['productId'].'="'.$variationProduct['eta'].'" data-stock-of-'.$variationProduct['productId'].'="'.$variationProduct['availableQuantity'].'" class=" d-flex gap-1 align-items-center text-grey-dark fw-bold '.($variationProduct['availableQuantity'] > 0 ? '' : 'text-danger').' " style="margin-left: .5625rem;    font-size: .8rem;    line-height: 1.5rem;" >'.($variationProduct['availableQuantity'] > 0 ? '( '.$variationProduct['availableQuantity'].' / stock)' : '(Out of Stock)').'</span>
                                            </div>
                                            <!-- <div class=" d-flex text-grey-dark "  style="font-size: .75rem; line-height: 1.5rem;" >
                                                <span class="d-flex">XX.XX</span>
                                            </div> -->

                                        </div>
                                    </div>

                                </div>

                                <div class="var-quantity d-flex flex-grow-0 gap-2 flex-column">
                                    <div class="quantity-input d-flex justify-center align-items-center gap-2">
                                    <!-- <button data-productID="'.$variationProduct['productId'].'" class="quantity-plus showSuccessMessage cssbuttons-io-button">
                                        <i class="lni lni-shopping-basket"></i>&nbsp;&nbsp;<span>Add&nbsp;Item</span>
                                    </button>  -->
                                     <button data-productID="'.$variationProduct['productId'].'" class="quantity-minus d-flex align-items-center justify-center rounded-full bg-grey-extralight" style="width: 22px; height:22px; border: none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="2" viewBox="0 0 10 2" fill="none">
                                                <path d="M0 2V0H10V2H0Z" fill="#BDC2C7"></path>
                                            </svg>
                                        </button>

                                        <input type="number" value="0"  class="quantity-input tag-btn-text" name="postQuantity['.$i.']" id="" readonly style="width: 71px; height:58px; border-radius: 21px; border-width: 1px; border-style: solid; border-color: #bdc2c7; font-style: normal; font-weight: 500;  font-size: x-large; text-align: center; padding-left: 15px;">

                                        <button data-productID="'.$variationProduct['productId'].'" class="quantity-plus d-flex align-items-center justify-center rounded-full bg-grey-extralight" style="width: 22px; height:22px; border: none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6 0H4L4 4H0V6H4L4 10H6V6H10V4H6V0Z" fill="#BDC2C7"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <input type="hidden" name="productId['.$i.']" value="'.$variationProduct['productId'].'" >
                                <input type="hidden" name="stock['.$i.']" value="'.$variationProduct['availableQuantity'].'" >
                                <input type="hidden" name="sku['.$i.']" value="'.$variationProduct['sku'].'" >
                                <input type="hidden" name="upc['.$i.']" value="'.$variationProduct['upc'].'" >
                                <input type="hidden" name="productName['.$i.']" value="'.$variationProduct['productName'].'" >
                                <input type="hidden" name="alias['.$i.']" value="'.$variationProduct['productName'].'" >
                                <input type="hidden" name="eta['.$i.']" value="'.$variationProduct['eta'].'" >
                                <input type="hidden" name="imageUrl['.$i.']" value="'.$image.'" >
                                <input type="hidden" name="standardPrice['.$i.']" value="'.($this->isUserLogin() ? $variationProduct['standardPrice'] : 'XX.XX').'" id="standardPrice-of-'.$variationProduct['productId'].'">
                                <input type="hidden" name="standardPriceWithoutDiscount['.$i.']" value="'.($this->isUserLogin() ? $variationProduct['standardPriceWithoutDiscount'] : 'XX.XX').'" id="standardPriceWithoutDiscount-of-'.$variationProduct['productId'].'">
                                <input type="hidden" name="sequenceNumber['.$i.']" value="'.$variationProduct['sequenceNumber'].'" id="sequenceNumber-of-'.$variationProduct['productId'].'">
                                <input type="hidden" name="minQuantityToSale['.$i.']" value="'.$variationProduct['minQuantityToSale'].'" id="minQuantityToSale-of-'.$variationProduct['productId'].'">
                                <input type="hidden" name="maxQuantityToSale['.$i.']" value="'.$variationProduct['maxQuantityToSale'].'" id="maxQuantityToSale-of-'.$variationProduct['productId'].'">
                                <input type="hidden" name="quantityIncrement['.$i.']" value="'.$variationProduct['quantityIncrement'].'" id="quantityIncrement-of-'.$variationProduct['productId'].'">
                                <input type="hidden" name="productName['.$i.']" value="'.$variationProduct['productName'].'" id="productName-of-'.$variationProduct['productId'].'">
                            </div>
                            <!-- Single variation End -->';
                            $i++;
            }

            $toreturn .= ' </div>
            </div>';
        }

        return $toreturn;
    }
    public function getSameProductVariationSection($variationProducts, $image)
    {
        $i = 0;
        $toreturn = "";
            $toreturn .= '<div class="row " style="border-top: 1px solid #D7DADD; padding: 21px 0; ">
            <div class="col-12 product-variation-container">';

                $image2 =  $this->imgUrl($image);
                $sku = (!empty($variationProducts['sku']) && $variationProducts['sku'] !== "null" && $variationProducts['sku'] !== null) ? $variationProducts['sku'] : '--';


                $toreturn .= '<div class="product-variations mb-5">

                                <div class="var-details">
                                    <div class="var-img">
                                        <div data-image-of-'.$variationProducts['productId'].'="'.$image.'" class="d-flex justify-center align-items-center flex-shrink-0 " style="width: 5.5rem; height: 5.5rem; cursor:pointer; overflow:hidden; background:#FFFFFF;">
                                            <img class="w-auto h-auto mh-100 custom-object-fit" src="'.$image2.'" alt="image">
                                        </div>
                                    </div>

                                    <div class="d-flex flex-column">
                                        <div data-alias-of-'.$variationProducts['productId'].'="'.$variationProducts['urlAlias'].'"  class="" style="cursor: pointer; color:#000; font-weight: 500; font-size: 1.2rem; line-height: 2rem;">
                                            '. ucwords(strtolower($variationProducts['productName'])) .'
                                        </div>
                                        <div class="d-flex gap-2 " style="color: gray; line-height: 1.9rem; font-size: 1rem; ">
                                            <div class="" style="padding-right: .5rem; border-right-width: 1px; border-color: #d7dadd;">
                                                <span  class="uppercase" data-upc-of-'.$variationProducts['productId'].'="'.$variationProducts['upc'].'" data-sku-of-'.$variationProducts['productId'].'="'.$variationProducts['sku'].'" >Sku: </span>'.$variationProducts['sku'].'
                                            </div>
                                        </div>
                                        <div class="'.($this->isUserLogin() ? '' : 'protected').'">
                                            <div  class=" d-flex gap-1 align-items-center">
                                            $'.($this->isUserLogin() ? $variationProducts['standardPrice'] : 'XX.XX').' <span data-eta-of-'.$variationProducts['productId'].'="'.$variationProducts['eta'].'" data-stock-of-'.$variationProducts['productId'].'="'.$variationProducts['availableQuantity'].'" class=" d-flex gap-1 align-items-center text-grey-dark fw-bold '.($variationProducts['availableQuantity'] > 0 ? '' : 'text-danger').' " style="margin-left: .5625rem;    font-size: .8rem;    line-height: 1.5rem;" >'.($variationProducts['availableQuantity'] > 0 ? '( '.$variationProducts['availableQuantity'].' / stock)' : '(Out of Stock)').'</span>
                                            </div>
                                            <!-- <div class=" d-flex text-grey-dark "  style="font-size: .75rem; line-height: 1.5rem;" >
                                                <span class="d-flex">XX.XX</span>
                                            </div> -->

                                        </div>
                                    </div>

                                </div>

                                <div class="var-quantity d-flex flex-grow-0 gap-2 flex-column">
                                    <div class="quantity-input d-flex justify-center align-items-center gap-2">
                                    <!--
                                    <button data-productID="'.$variationProducts['productId'].'" class="quantity-plus showSuccessMessage cssbuttons-io-button">
                                        <i class="lni lni-shopping-basket"></i>&nbsp;&nbsp;<span>Add&nbsp;Item</span>
                                    </button>  -->

                                        <button data-productID="'.$variationProducts['productId'].'" class="quantity-minus d-flex align-items-center justify-center rounded-full bg-grey-extralight" style="width: 22px; height:22px; border: none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="2" viewBox="0 0 10 2" fill="none">
                                                <path d="M0 2V0H10V2H0Z" fill="#BDC2C7"></path>
                                            </svg>
                                        </button>

                                        <input type="number" value="0"  class="quantity-input tag-btn-text" name="postQuantity['.$i.']" id="" readonly style="width: 71px; height:58px; border-radius: 21px; border-width: 1px; border-style: solid; border-color: #bdc2c7; font-style: normal; font-weight: 500;  font-size: x-large; text-align: center; padding-left: 15px;">

                                        <button data-productID="'.$variationProducts['productId'].'" class="quantity-plus d-flex align-items-center justify-center rounded-full bg-grey-extralight" style="width: 22px; height:22px; border: none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6 0H4L4 4H0V6H4L4 10H6V6H10V4H6V0Z" fill="#BDC2C7"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <input type="hidden" name="productId['.$i.']" value="'.$variationProducts['productId'].'" >
                                <input type="hidden" name="stock['.$i.']" value="'.$variationProducts['availableQuantity'].'" >
                                <input type="hidden" name="sku['.$i.']" value="'.$variationProducts['sku'].'" >
                                <input type="hidden" name="upc['.$i.']" value="'.$variationProducts['upc'].'" >
                                <input type="hidden" name="productName['.$i.']" value="'.$variationProducts['productName'].'" >
                                <input type="hidden" name="alias['.$i.']" value="'.$variationProducts['productName'].'" >
                                <input type="hidden" name="eta['.$i.']" value="'.$variationProducts['eta'].'" >
                                <input type="hidden" name="imageUrl['.$i.']" value="'.$image.'" >
                                <input type="hidden" name="standardPrice['.$i.']" value="'.($this->isUserLogin() ? $variationProducts['standardPrice'] : 'XX.XX').'" id="standardPrice-of-'.$variationProducts['productId'].'">
                                <input type="hidden" name="standardPriceWithoutDiscount['.$i.']" value="'.($this->isUserLogin() ? $variationProducts['standardPriceWithoutDiscount'] : 'XX.XX').'" id="standardPriceWithoutDiscount-of-'.$variationProducts['productId'].'">
                                <input type="hidden" name="sequenceNumber['.$i.']" value="'.$variationProducts['sequenceNumber'].'" id="sequenceNumber-of-'.$variationProducts['productId'].'">
                                <input type="hidden" name="minQuantityToSale['.$i.']" value="'.$variationProducts['minQuantityToSale'].'" id="minQuantityToSale-of-'.$variationProducts['productId'].'">
                                <input type="hidden" name="maxQuantityToSale['.$i.']" value="'.$variationProducts['maxQuantityToSale'].'" id="maxQuantityToSale-of-'.$variationProducts['productId'].'">
                                <input type="hidden" name="quantityIncrement['.$i.']" value="'.$variationProducts['quantityIncrement'].'" id="quantityIncrement-of-'.$variationProducts['productId'].'">
                                <input type="hidden" name="productName['.$i.']" value="'.$variationProducts['productName'].'" id="productName-of-'.$variationProducts['productId'].'">
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
                    // $categorylists .= '<span class="d-flex align-items-center">
                    //     <a href="'.url('/each-category-products/'.strtolower(str_replace(' ', '-', $categoryName)).'/'.strtolower(str_replace(' ', '-', str_replace('/', '-', $subCategory['name']))).'/'.$subCategory['id']).'" id="'.$subCategory['id'].'" data-parent_id="'.$categoryID.'"  >'.$subCategory['name'].'</a>
                    // </span>';
                    $subCategory_href = url('/each-category-products/'.strtolower(str_replace(' ', '-', $categoryName)).'/'.strtolower(str_replace(' ', '-', str_replace('/', '-', $subCategory['name']))).'/'.$subCategory['id']).'';
                    $categorylists .= '<a href="'.$subCategory_href.'" id="'.$subCategory['id'].'" data-parent_id="'.$categoryID.'"  >
                        <span class="d-flex align-items-center">
                        '.$subCategory['name'].'
                        </span></a>';
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
                        $productSection .= '<div class="container-fluid mb-5">
                                                <div class="p-3  product-section-wrapper" style="border-radius: 21px;">
                                                <h2 class="section-heading fw-bold fs-1 mt-2 mb-3 px-3">'.$productTag['name'].'</h2>
                                                <!-- owl-carousel start -->
                                                    <div class="owl-carousel owl-theme ">';
                                                        $productSection .= $products;
                        $productSection .= '        </div>
                                                </div>
                                                <!-- owl-carousel END -->
                                            </div>';
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
                    'message' => "SignIn Successfully!",
                ]);
            }


        }
    }
    public function signIn()
    {
        return view('singin');
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

                        // set  user data to session.
                        $customerDetails = $this->getCustomerDetail($accessToken);

                        if (!$customerDetails['hasError'] && $customerDetails['status'] == 200) {

                            if(!$customerDetails['result']['customerDto']['active']){
                                return response()->json([
                                    'status' => "info",
                                    'message' => "Your account is inactive. Please contact support for assistance.",
                                ]);
                            }

                            Session::put('user', [
                                'accessToken' => $accessToken,
                                'refresh' =>  $refresh,
                                'user_id' => $customerDetails['result']['customerDto']['id'],
                                'firstName' => $customerDetails['result']['customerDto']['firstName'],
                                'lastName' => $customerDetails['result']['customerDto']['lastName'],
                                'company' => $customerDetails['result']['customerDto']['company'],
                                'email' => $customerDetails['result']['customerDto']['email'],
                                'phone' => $customerDetails['result']['customerDto']['phone'],
                                'phone1' => $customerDetails['result']['customerDto']['phone1'],
                                'phone2' => $customerDetails['result']['customerDto']['phone2'],
                                'storePhone' => $customerDetails['result']['customerDto']['storePhone'],
                                'imageUrl' => $customerDetails['result']['customerDto']['imageUrl'],
                                'gender' => $customerDetails['result']['customerDto']['gender'],
                                'tier' => $customerDetails['result']['customerDto']['tier'],
                                'authUserLoginId' => $customerDetails['result']['customerDto']['authUserLoginId'],
                                'adminId' => $customerDetails['result']['customerDto']['adminId'],
                                'paymentTermsId' => $customerDetails['result']['customerDto']['paymentTermsId'],
                                'paymentTermsName' => $customerDetails['result']['customerDto']['paymentTermsName'],
                                'notes' => $customerDetails['result']['customerDto']['notes'],
                                'notes2' => $customerDetails['result']['customerDto']['notes2'],
                                'storeCredit' => $customerDetails['result']['customerDto']['storeCredit'],
                                'loyaltyPoints' => $customerDetails['result']['customerDto']['loyaltyPoints'],
                                'dueAmount' => $customerDetails['result']['customerDto']['dueAmount'],
                                'dueAmountStr' => $customerDetails['result']['customerDto']['dueAmountStr'],
                                'active' => $customerDetails['result']['customerDto']['active'],
                                'verified' => $customerDetails['result']['customerDto']['verified'],
                                'viewSpecificCategory' => $customerDetails['result']['customerDto']['viewSpecificCategory'],
                                'viewSpecificProduct' => $customerDetails['result']['customerDto']['viewSpecificProduct'],
                                'websiteReference' => $customerDetails['result']['customerDto']['websiteReference'],
                                'primaryBusiness' => $customerDetails['result']['customerDto']['primaryBusiness'],
                                'websiteUrl' => $customerDetails['result']['customerDto']['websiteUrl'],
                                'facebookLink' => $customerDetails['result']['customerDto']['facebookLink'],
                                'instagramLink' => $customerDetails['result']['customerDto']['instagramLink'],
                                'referBySalesRep' => $customerDetails['result']['customerDto']['referBySalesRep'],
                                'referBySalesRepName' => $customerDetails['result']['customerDto']['referBySalesRepName'],
                                'salesRepresentativeName' => $customerDetails['result']['customerDto']['salesRepresentativeName'],
                                'salesRepresentativePhone' => $customerDetails['result']['customerDto']['salesRepresentativePhone'],
                                'salesRepresentativeEmail' => $customerDetails['result']['customerDto']['salesRepresentativeEmail'],
                                'taxId' => $customerDetails['result']['customerDto']['taxId'],
                                'taxable' => $customerDetails['result']['customerDto']['taxable'],
                                'feinNumber' => $customerDetails['result']['customerDto']['feinNumber'],
                                'tobaccoLicenseExpirationDate' => $customerDetails['result']['customerDto']['tobaccoLicenseExpirationDate'],
                                'tobaccoLicenseExpirationDateString' => $customerDetails['result']['customerDto']['tobaccoLicenseExpirationDateString'],
                                'vaporTaxId' => $customerDetails['result']['customerDto']['vaporTaxId'],
                                'vaporTaxExpirationDate' => $customerDetails['result']['customerDto']['vaporTaxExpirationDate'],
                                'referByCustomerId' => $customerDetails['result']['customerDto']['referByCustomerId'],
                                'communicateViaPhone' => $customerDetails['result']['customerDto']['communicateViaPhone'],
                                'communicateViaText' => $customerDetails['result']['customerDto']['communicateViaText'],
                                'username' => $customerDetails['result']['customerDto']['username'],
                                'paymentMethodNonce' => $customerDetails['result']['customerDto']['paymentMethodNonce'],
                                'billingAddress' => $customerDetails['result']['customerDto']['billingAddress'],
                                'shippingAddress' => $customerDetails['result']['customerDto']['shippingAddress'],
                            ]);

                            // Session::put('customerStoreAddressList', [
                            //     'id' => $customerDetails['result']['customerDto']['customerStoreAddressList'][0]['id'],
                            //     'address1' => $customerDetails['result']['customerDto']['customerStoreAddressList'][0]['address1'],
                            //     'address2' => $customerDetails['result']['customerDto']['customerStoreAddressList'][0]['address2'],
                            //     'city' => $customerDetails['result']['customerDto']['customerStoreAddressList'][0]['city'],
                            //     'county' => $customerDetails['result']['customerDto']['customerStoreAddressList'][0]['county'],
                            //     'stateId' => $customerDetails['result']['customerDto']['customerStoreAddressList'][0]['stateId'],
                            //     'state' => $customerDetails['result']['customerDto']['customerStoreAddressList'][0]['state'],
                            //     'countryId' => $customerDetails['result']['customerDto']['customerStoreAddressList'][0]['countryId'],
                            //     'country' => $customerDetails['result']['customerDto']['customerStoreAddressList'][0]['country'],
                            //     'zip' => $customerDetails['result']['customerDto']['customerStoreAddressList'][0]['zip'],
                            //     'phone' => $customerDetails['result']['customerDto']['customerStoreAddressList'][0]['phone'],
                            //     'defaultBillingAddress' => $customerDetails['result']['customerDto']['customerStoreAddressList'][0]['defaultBillingAddress'],
                            //     'defaultShippingAddress' => $customerDetails['result']['customerDto']['customerStoreAddressList'][0]['defaultShippingAddress'],
                            //     'active' => $customerDetails['result']['customerDto']['customerStoreAddressList'][0]['active'],
                            // ]);
                        }

                        Session::put('ShowSingInMessage', [
                            'title' =>  "Sign In Successfully!",
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
        $headers = [
            'Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJhc3cxMDAyQGdtYWlsLmNvbSIsInVzZXJUeXBlIjoiRW1wbG95ZWUiLCJ0b2tlblR5cGUiOiJhY2Nlc3MiLCJzdG9yZUlkIjoxLCJleHAiOjE3MDk5NTE5NTAsInVzZXJJZCI6MSwiaWF0IjoxNzA5ODMxOTUwLCJyZXNldFBhc3N3b3JkUmVxdWlyZWQiOmZhbHNlfQ.rwaVPjtDxNIRUZjgkzfREcMASEIIg7tYvXJdwMbUDW0',
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://erp.monstersmokewholesale.com/api/ecommerce/product/brand?brandIdList=1&storeIds=1,2');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

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
            return asset('asset/img/place-holder.png');
        }
    }

    public function double_format($number,$tofix)
    {
        return number_format((float)$number, $tofix, '.', '');
    }

    public function getFeautureProducts_sections($tagId)
    {
        $Response = $this->getFeaturedProductsByEachTag($tagId);

        $NewProducts = "";
        if(!empty($Response) && $Response['status'] == 200){
            foreach ($Response['result']['content'] as $newProduct) {
                $productImage = $this->imgUrl($newProduct['imageUrl']);
                // $productPrice = $this->isUserLogin() ? "$ " . $this->double_format($newProduct['standardPrice'], 2) : "Login to view price";
                $productPrice = $this->isUserLogin() ? "$ " . $this->double_format($newProduct['standardPrice'], 2) : '$xx.xx';
                // $href = $this->isUserLogin() ? '/product-details?product_id='.$newProduct['productId'].'' : url('/sign-in');
                $href = $this->isUserLogin() ? '/product-details/'.urlencode(str_replace('/', '-', str_replace('--', '-', str_replace(' ', '-', str_replace('|', '', $newProduct['productName']))))).'?product_id='.$newProduct['productId'].'' : url('/sign-in');
                $NewProducts .= '<div class="item">
                                    <div class="product-card" data-href="/product-details/'.urlencode(str_replace('/', '-', str_replace('--', '-', str_replace(' ', '-', str_replace('|', '', $newProduct['productName']))))).'?product_id='.$newProduct['productId'].'" >
                                    <div class="d-flex justify-content-end align-items-center mb-3">
                                        <span class="d-block new-arrival"><i class="lni lni-star-fill"></i> New Arrival</span>
                                    </div>
                                    <div class="d-flex justify-content-center same-height-images after-overlay">
                                        <img src="' . $productImage . '" alt="image" srcset="" class="img-fluid w-75 pro-img">

                                        <div class="button-container">
                                            <a href="/product-details/'.urlencode(str_replace('/', '-', str_replace('--', '-', str_replace(' ', '-', str_replace('|', '', $newProduct['productName']))))).'?product_id='.$newProduct['productId'].'" class="see-all-options" >See&nbsp;all&nbsp;Options</a>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="/product-details/'.urlencode(str_replace('/', '-', str_replace('--', '-', str_replace(' ', '-', str_replace('|', '', $newProduct['productName']))))).'?product_id='.$newProduct['productId'].'" class="fs-6  text product-card-title fw-bold">'.$newProduct['productName'].'</a>
                                        <div class="d-flex justify-content-between mb-2"  style="align-items: center;">

                                            <a href="'.$href.'" class="fs-5  text product-card-title product-card-price fw-bold '.($this->isUserLogin() ? '' : 'protected').' " style="margin-bottom:0 !important;">'.$productPrice.'</a>
                                            <span class="d-block fw-bold product-card-stock-detail '.($newProduct['availableQuantity'] <= 0 ? 'text-danger' : 'text-secondary').'  ">'.($newProduct['availableQuantity'] <= 0 ? '(Out of Stock)' : 'In Stock:'.$newProduct['availableQuantity'] ).'  </span>
                                        </div>
                                        <a class="btn product-card-btn fw-bold" href="'.$href.'" >'
                                        . ($this->isUserLogin() ? ($newProduct['availableQuantity'] <= 0 ? 'Out of Stock' : 'Buy Now') : "Login to view price")
                                        .'</a>
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
                // $productPrice = $this->isUserLogin() ? "$ " . $this->double_format($newProduct['standardPrice'], 2) : "Login to view price";
                $productPrice = $this->isUserLogin() ? "$ " . $this->double_format($newProduct['standardPrice'], 2) : '$xx.xx';
                $href = $this->isUserLogin() ? '/product-details/'.urlencode(str_replace('/', '-', str_replace('--', '-', str_replace(' ', '-', str_replace('|', '', $newProduct['productName']))))).'?product_id='.$newProduct['productId'].'' : url('/sign-in');
                $Products .= '<div class="product-card product-card-each-category"  data-href="/product-details/'.urlencode(str_replace('/', '-', str_replace('--', '-', str_replace(' ', '-', str_replace('|', '', $newProduct['productName']))))).'?product_id='.$newProduct['productId'].'">
                                    <div class="d-flex justify-content-center align-items-center mb-3">
                                        <span class="d-block new-arrival new-arrival-each-category"><i class="lni lni-star-fill"></i> New Arrival</span>
                                    </div>
                                    <div class="d-flex justify-content-center same-height-images after-overlay">
                                        <img src="' . $productImage . '" alt="image" srcset="" class="img-fluid w-75 pro-img">

                                        <div class="button-container">
                                            <a href="/product-details/'.urlencode(str_replace('/', '-', str_replace('--', '-', str_replace(' ', '-', str_replace('|', '', $newProduct['productName']))))).'?product_id='.$newProduct['productId'].'" class="see-all-options" >See&nbsp;all&nbsp;Options</a>
                                        </div>
                                    </div>
                                    <div>
                                    <a href="/product-details/'.urlencode(str_replace('/', '-', str_replace('--', '-', str_replace(' ', '-', str_replace('|', '', $newProduct['productName']))))).'?product_id='.$newProduct['productId'].'" class="fs-6  text product-card-title fw-bold">'.$newProduct['productName'].'</a>
                                    <div class="d-flex justify-content-between mb-2" style="align-items: center;">

                                    <a href="'.$href.'" class="fs-5  text product-card-title product-card-price fw-bold '.($this->isUserLogin() ? '' : 'protected').' " style="margin-bottom:0 !important;">'.$productPrice.'</a>
                                    <span class="d-block fw-bold product-card-stock-detail '.($newProduct['availableQuantity'] <= 0 ? 'text-danger' : 'text-secondary').'  ">'.($newProduct['availableQuantity'] <= 0 ? '(Out of Stock)' : 'In Stock:'.$newProduct['availableQuantity'] ).' </span>
                                    </div>
                                    <a class="btn product-card-btn fw-bold"  href="'.$href.'" >'
                                    . ($this->isUserLogin() ? ($newProduct['availableQuantity'] <= 0 ? 'Out of Stock' : 'Buy Now') : "Login to view price")
                                    .'</a>
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

        // $category_Response = $this->getCategories();
        // $categoryTreeView = null;
        // if($category_Response){
        //     if($category_Response['status'] == 200){

        //         $categories = $category_Response['result'];
        //         $categoryTreeView = $this->getCategoryTreeView($categories);
        //     }
        // }

        $subcategory = ucwords(str_replace('-', ' ', $subcategory));
        return view('each-category-products',compact(
            // 'categoryTreeView',
            'products','category','subcategory', 'categoryId'));
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

    public function addToCart()
    {
        // $category_Response = $this->getCategories();
        // $categoryTreeView = null;
        // if($category_Response){
        //     if($category_Response['status'] == 200){

        //         $categories = $category_Response['result'];

        //         $categoryTreeView = $this->getCategoryTreeView($categories);
        //     }
        // }

        $cartItems = $this->getCartItem();
        // echo "<pre>";
        // print_r($cartItems['result']['cartLineItemDtoList'][0]['productName']);die();
      return view('add-to-cart',compact(
        // 'categoryTreeView',
        'cartItems'));
    }

    public function postMultiCartItem(Request $request)
    {

        if(!$this->isUserLogin()){
            return response()->json([
                "status"   => "error",
                "icon"   => "info",
                "message"  => "Login to continue!",

            ]);
        }

        $productArray  = array();

        $postQuantity = $request->input('postQuantity');

        foreach ($postQuantity as $index => $value) {
            if($value > 0){
                $productArray[]  = array(
                    "productId" => $request->input('productId')[$index],
                    "sku" => $request->input('sku')[$index],
                    "upc" => "".$request->input('upc')[$index]."",
                    "productName" => "".$request->input('productName')[$index]."",
                    "alias" => "",
                    "availableQuantity" => $request->input('stock')[$index],
                    "eta" => "".$request->input('eta')[$index]."",
                    "imageUrl" => "".$request->input('imageUrl')[$index]."",
                    "masterProductId" => null,
                    "masterProductName" => null,
                    "taxClassId" => null,
                    "standardPrice" => $request->input('standardPrice')[$index],
                    "standardPriceWithoutDiscount" => $request->input('standardPriceWithoutDiscount')[$index],
                    "sequenceNumber" => $request->input('sequenceNumber')[$index],
                    "minQuantityToSale" => $request->input('minQuantityToSale')[$index],
                    "maxQuantityToSale" => $request->input('maxQuantityToSale')[$index],
                    "quantityIncrement" => 0,
                    "hasChildProduct" => false,
                    "quantity" => $request->input('postQuantity')[$index]
                );
            }
        }

        if(count($productArray) > 0){

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://erp.monstersmokewholesale.com/api/cartLineItem?storeId=2',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($productArray),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json, text/plain, */*',
                '-H\'Authorization: Bearer Bearer '.Session::get('user.accessToken').'',
                'Accept-Language: en-GB,en;q=0.6',
                'Origin: https://www.monstersmokewholesale.com',
                'Referer: https://www.monstersmokewholesale.com/',
                'Sec-Fetch-Dest: empty',
                'Sec-Fetch-Mode: cors',
                'Sec-Fetch-Site: same-site',
                'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
                'sec-ch-ua: "Chromium";v="122", "Not(A:Brand";v="24", "Brave";v="122"',
                'sec-ch-ua-mobile: ?0',
                'sec-ch-ua-platform: "macOS"',
                'Authorization: Bearer '.Session::get('user.accessToken').''
              ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            $response = json_decode($response, true);

            if(!$response['hasError']){
                return response()->json([
                    "status"   => "success",
                    "icon"   => "success",
                    "message"  => "Product Added To Cart!",
                    // "cartItem" => $response["result"][0]
                ]);
            }else{
                return response()->json([
                    "status"   => "error",
                    "icon"   => "error",
                    "message"  => "Something went wrong!",
                    // "cartItem" => $response["result"][0]
                ]);
            }
        }else{
            return response()->json([
                "status"   => "error",
                "icon"   => "info",
                "message"  => "Please add some quantity!",
                // "cartItem" => $response["result"][0]
            ]);
        }
    }

    public function postCart(Request $request)
    {
        if(!$this->isUserLogin()){
            return response()->json([
                "status"   => "error",
                "icon"   => "info",
                "message"  => "Login to continue!",

            ]);
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://erp.monstersmokewholesale.com/api/cartLineItem?storeId=2',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode(array(
            array(
                "productId" => $request->input('productId'),
                "sku" => $request->input('sku'),
                "upc" => "".$request->input('upc')."",
                "productName" => "".$request->input('productName')."",
                "alias" => "".$request->input('alias')."",
                "availableQuantity" => $request->input('stock'),
                "eta" => "".$request->input('eta')."",
                "imageUrl" => "".$request->input('image')."",
                "masterProductId" => null,
                "masterProductName" => null,
                "taxClassId" => null,
                "standardPrice" => $request->input('standardPrice'),
                "standardPriceWithoutDiscount" => $request->input('standardPriceWithoutDiscount'),
                "sequenceNumber" => $request->input('sequenceNumber'),
                "minQuantityToSale" => $request->input('minQuantityToSale'),
                "maxQuantityToSale" => $request->input('maxQuantityToSale'),
                "quantityIncrement" => 0,
                "hasChildProduct" => false,
                "quantity" => $request->input('quantity')
            )
        )),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Accept: application/json, text/plain, */*',
            '-H\'Authorization: Bearer Bearer '.Session::get('user.accessToken').'',
            'Accept-Language: en-GB,en;q=0.6',
            'Origin: https://www.monstersmokewholesale.com',
            'Referer: https://www.monstersmokewholesale.com/',
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Site: same-site',
            'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
            'sec-ch-ua: "Chromium";v="122", "Not(A:Brand";v="24", "Brave";v="122"',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: "macOS"',
            'Authorization: Bearer '.Session::get('user.accessToken').''
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response, true);

        if(!$response['hasError']){
            return response()->json([
                "status"   => "success",
                "icon"   => "success",
                "message"  => "Product Added To Cart!",
                // "cartItem" => $response["result"][0]
            ]);
        }else{
            return response()->json([
                "status"   => "error",
                "icon"   => "error",
                "message"  => "Something went wrong!",
                // "cartItem" => $response["result"][0]
            ]);
        }
    }

    public function getTimeFrame()
    {
        return date("Y-m-d H:i:s", time());
    }

    public function updateCart(Request $request)
    {
        if(!$this->isUserLogin()){
            return response()->json([
                "status"   => "error",
                "icon"   => "info",
                "message"  => "Login to continue!",

            ]);
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://erp.monstersmokewholesale.com/api/cartLineItem/updateAll?storeId=2',
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => json_encode(array(
            array(
                "id" => $request->input('cartId'),
                "productId" => $request->input('productId'),
                "customerId" => Session::get('user.user_id'),
                "storeId" => 0,
                "productName" => "".$request->input('productName')."",
                "sku" => $request->input('sku'),
                "upc" => "".$request->input('upc')."",
                "quantity" => $request->input('quantity'),
                "status" => null,
                "costPrice" => $request->input('costPrice'),
                "standardPrice" => $request->input('standardPrice'),
                "cartStandardPrice" => $request->input('standardPrice'),
                "tierPrice" => $request->input('standardPrice'),
                "originalStandardPrice" => $request->input('standardPrice'),
                "adminRetailPrice" => 0,
                "availableQuantity" => $request->input('stock'),
                "deleted" => false,
                "discountValue" => 0,
                "discountType" => null,
                "discountAmount" => 0,
                "taxClassId" => null,
                "taxType" => null,
                "taxPercentage" => 0,
                "taxPerVolume" => 0,
                "outOfStock" => false,
                "minQuantityToSale" => $request->input('minQuantityToSale'),
                "maxQuantityToSale" => $request->input('maxQuantityToSale'),
                "quantityIncrement" => 0,
                "cartLineItemUpdated" => true,
                "imageUrl" => $request->input('image'),
                "updatedBy" => null,
                "insertedTimestamp" => $this->getTimeFrame() ,
                "updatedTimestamp" => $this->getTimeFrame(),
                "discount" => 0,
                "taxIncludedInSellingPrice" => null,
                "taxPerOunce" => null,
                "directTaxPercentage" => null,
                "maxCostPrice" => 0,
                "taxAmount" => 0,
                "size" => null,
                "serviceProduct" => false,
                "subtotal" =>  $request->input('standardPrice') * $request->input('quantity')
            )
        )),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            '-H\'Accept:  application/json, text/plain, */*\' \\',
            '-H\'Accept-Language:  en-GB,en;q=0.6\' \\',
            '-H\'Authorization: Bearer Bearer '.Session::get('user.accessToken').'',
            '-H\'Connection:  keep-alive\' \\',
            '-H\'Origin:  https://www.monstersmokewholesale.com\' \\',
            '-H\'Referer:  https://www.monstersmokewholesale.com/\' \\',
            '-H\'Sec-Fetch-Dest:  empty\' \\',
            '-H\'Sec-Fetch-Mode:  cors\' \\',
            '-H\'Sec-Fetch-Site:  same-site\' \\',
            '-H\'Sec-GPC:  1\' \\',
            '-H\'User-Agent:  Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36\' \\',
            '-H\'sec-ch-ua:  "Chromium";v="122", "Not(A:Brand";v="24", "Brave";v="122"\' \\',
            '-H\'sec-ch-ua-mobile:  ?0\' \\',
            '-H\'sec-ch-ua-platform:  "macOS"\' \\',
            'Authorization: Bearer '.Session::get('user.accessToken').''
          ),

        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return response()->json($response);
    }

    public function getCartItem()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://erp.monstersmokewholesale.com/api/cartLineItem/search?storeId=2');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json, text/plain, */*',
            'Accept-Language: en-GB,en;q=0.6',
            'Authorization: Bearer '.Session::get('user.accessToken').''
        ]);

        $response = curl_exec($ch);

        curl_close($ch);
        $response = json_decode($response, true);

        if(!$response['hasError'])
        {
            return $response;

        }

        return false;

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
    public function getCustomerDetail($accessToken)
    {
        $curl = curl_init();
        $url = 'https://erp.monstersmokewholesale.com/api/ecommerce/customer';
        // $accessToken = Session::get('user.accessToken');
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

    public function placeCustomerOrder(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());die;
        $creditCardDetail = 'null';
        if($request->input('PaymentMethods') == 2){
            $creditCardDetail = '{
                "firstName": "'.$request->input('firstName').'",
                "lastName": "'.$request->input('lastName').'",
                "cardNumber": "'.$request->input('cardNumber').'",
                "expirationMonth": "'.$request->input('expirationMonth').'",
                "expirationYear": "'.$request->input('expirationYear').'",
                "cvv": "'.$request->input('cvv').'",
                "address": "'.$request->input('credit-card-address').'",
                "city": "'.$request->input('credit-card-city').'",
                "stateId": '.$request->input('credit-card-state').',
                "zipcode": "'.$request->input('credit-card-zipcode').'",
                "countryId": '.$request->input('credit-card-country').'
            }';
        }
        $ch = curl_init();
        $url = 'https://erp.monstersmokewholesale.com/api/ecommerce/order?storeId=2';
        $post = '{
            "discountCouponList": [],
            "orderDto": {
                "customerBillingAddressId":  '.$request->input('Shiping-Address').',
                "customerId": '.Session::get('user.user_id').',
                "customerNotes": "",
                "customerShippingAddressId":  '.explode(',', $request->input('shipingMethod'))[0].',
                "discount": '.$request->input('cartDiscount').',
                "internalNotes": "",
                "invoiceTimestamp": null,
                "paymentTermsId": 1,
                "preferredPaymentMethodId": '.$request->input('PaymentMethods').',
                "preferredPaymentModeId": '.$request->input('PaymentMethods').',
                "preferredShippingModeId": '.explode(',', $request->input('shipingMethod'))[0].',
                "primarySalesRepresentativeId": 1,
                "shipTimestamp": null,
                "orderNotes": "'.$request->input('customer-notes').'",
                "status": "Pro Forma",
                "storeId": 1,
                "shippingAmount": '.explode(',', $request->input('shipingMethod'))[1].',
                "subTotal": '.$request->input('cartSubTotal').',
                "taxAmount": 0,
                "totalAmount": '.$request->input('totalCartPrice').',
                "totalQuantity": '.$request->input('order-totalQuantity').',
                "adjustmentValue": 0
            },
            "paymentDtoList": [
                {
                    "amount": '.$request->input('totalCartPrice').',
                    "paymentModeId": '.$request->input('PaymentMethods').',
                    "customerOrderCard": '.$creditCardDetail .'
                }
            ]
        }';
        // echo "<pre>";
        // print_r($post); die();
        $headers = [
            'Accept: application/json, text/plain',
            'Accept-Language: en-GB,en;q=0.6',
            '-H\'Authorization: Bearer Bearer '.Session::get('user.accessToken').'',
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
            'Authorization: Bearer '.Session::get('user.accessToken').''
        ];
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response);
    }

    public function checkOut()
    {
        $shipingMethods = $this->getShipingDetails();
        $PaymentMethods = $this->getPaymentMethods();
        $countries = $this->getCountries();
        $cntry = $this->getCountries();

        $customerAddresslist = $this->getCustomerAddressList();

        $cartItems = $this->getCartItem();
        $cartLineItem = $cartItems['result']['cartLineItemDtoList'];

        $totalCartQuantity = $cartItems['result']['totalCartQuantity'] ?? 0;
        $cartSubTotal = $cartItems['result']['cartSubTotal'] ?? 0;
        $cartDiscount = $cartItems['result']['cartDiscount'] ?? 0;
        $totalCartPrice = $cartItems['result']['totalCartPrice'] ?? 0;
        // print_r($cartLineItem);
        // die();
        return view('check-out',compact(
            'shipingMethods', 'PaymentMethods', 'customerAddresslist', 'countries','cntry', 'cartLineItem',
            'totalCartQuantity', 'cartSubTotal', 'cartDiscount', 'totalCartPrice'
        ));
    }

    public function getCustomerAddressList()
    {
        $customerDetails = $this->getCustomerDetail(Session::get('user.accessToken'));
        $customerAddressList = [];
        if(!$customerDetails['hasError']){
            $customerAddressList = $customerDetails['result']['customerDto']['customerStoreAddressList'];
        }
        return $customerAddressList;

    }


    public function getOrders()
    {
        $curl = curl_init();

        $url = 'https://erp.monstersmokewholesale.com/api/ecommerce/dashboard/orderTable?page=0&size=20';
        $headers = array(
            'Content-Type: application/json',
            'Accept: application/json, text/plain, */*',
            '-H\'Authorization: Bearer Bearer '.Session::get('user.accessToken').'',
            '-H\'Connection:  keep-alive\' \\',
            '-H\'Origin:  https://www.monstersmokewholesale.com\' \\',
            '-H\'Referer:  https://www.monstersmokewholesale.com/\' \\',
            '-H\'Sec-Fetch-Dest:  empty\' \\',
            '-H\'Sec-Fetch-Mode:  cors\' \\',
            '-H\'Sec-Fetch-Site:  same-site\' \\',
            '-H\'Sec-GPC:  1\' \\',
            '-H\'User-Agent:  Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36\' \\',
            '-H\'sec-ch-ua:  "Chromium";v="122", "Not(A:Brand";v="24", "Brave";v="122"\' \\',
            '-H\'sec-ch-ua-mobile:  ?0\' \\',
            '-H\'sec-ch-ua-platform:  "macOS"\'',
            'Authorization: Bearer '.Session::get('user.accessToken').''
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

        return json_decode($response);

    }


    public function addCustomerAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address1' => 'required',
            'city' => 'required',
            'country' => 'required',
            'state' => 'required',
            'postalCode' => 'required',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $curl = curl_init();

        $url  = 'https://erp.monstersmokewholesale.com/api/ecommerce/customer/'.Session::get('user.user_id').'/address';
        $post = '{
            "address1": "'.$request->input('address1').'",
            "address2": "'.$request->input('address2').'",
            "countryId": '.$request->input('country').',
            "stateId": '.$request->input('state').',
            "city": "'.$request->input('city').'",
            "zip": '.$request->input('postalCode').',
            "phone": "'.$request->input('phone').'",
            "active": true,
            "customerId": '.Session::get('user.user_id').'
            }';
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $post,
        CURLOPT_HTTPHEADER => array(
            '-H\'sec-ch-ua:  "Google Chrome";v="123", "Not:A-Brand";v="8", "Chromium";v="123"\'',
            '-H\'sec-ch-ua-mobile:  ?0\'',
            '-H\'Authorization:  Bearer '.Session::get('user.accessToken').'',
            '-H\'User-Agent:  Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36\'',
            '-H\'Content-Type:  application/json\'',
            '-H\'Accept:  application/json, text/plain\'',
            '-H\'Referer:  https://www.monstersmokewholesale.com/\'',
            '-H\'sec-ch-ua-platform:  "Windows"\'',
            'Content-Type: application/json',
            'Authorization: Bearer '.Session::get('user.accessToken').''
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response);
    }


    public function placeOrderWithCreatedCard(Request $resquest)
    {
        $curl = curl_init();
        $url = 'https://erp.monstersmokewholesale.com/api/ecommerce/order?storeId=2';
        $post = '{
            "discountCouponList": [],
            "orderDto": {
                "customerBillingAddressId": 1721,
                "customerId": null,
                "customerNotes": "",
                "customerShippingAddressId": 1721,
                "discount": 0,
                "internalNotes": "",
                "invoiceTimestamp": null,
                "paymentTermsId": 1,
                "preferredPaymentMethodId": 2,
                "preferredPaymentModeId": 2,
                "preferredShippingModeId": 1,
                "primarySalesRepresentativeId": 1,
                "shipTimestamp": null,
                "orderNotes": "",
                "status": "Pro Forma",
                "storeId": 2,
                "shippingAmount": 0,
                "subTotal": 39.99,
                "taxAmount": 0,
                "totalAmount": 39.99,
                "totalQuantity": 1,
                "adjustmentValue": 0
            },
            "paymentDtoList": [
                {
                    "amount": 39.99,
                    "paymentModeId": 2,
                    "customerOrderCard": {
                        "firstName": "asd",
                        "lastName": "asd",
                        "cardNumber": "374245455400126",
                        "expirationMonth": "11",
                        "expirationYear": "20",
                        "cvv": "123",
                        "address": "asd",
                        "city": "asd",
                        "stateId": 1,
                        "zipcode": "1234",
                        "countryId": 1
                    }
                }
            ]
        }';

        $headers = array(
            '-H\'sec-ch-ua:  "Google Chrome";v="123", "Not:A-Brand";v="8", "Chromium";v="123"\'',
            '-H\'sec-ch-ua-mobile:  ?0\'',
            '-H\'Authorization: Bearer Bearer '.Session::get('user.accessToken').'',
            '-H\'User-Agent:  Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36\'',
            '-H\'Content-Type:  application/json\'',
            '-H\'Accept:  application/json, text/plain\'',
            '-H\'Referer:  https://www.monstersmokewholesale.com/\'',
            '-H\'sec-ch-ua-platform:  "Windows"\'',
            'Content-Type: application/json',
            'Authorization: Bearer '.Session::get('user.accessToken').''
        );

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $post,
        CURLOPT_HTTPHEADER => $headers,));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);

    }

    public function deleteCartItem(Request $request)
    {

        $curl = curl_init();
        $url = 'https://erp.monstersmokewholesale.com/api/cartLineItem/clearSelected?storeId=2';
        $post = '[
            {
                "id": '.$request->input('CartID').',
                "productId": '.$request->input('productID').',
                "customerId": '.Session::get('user.user_id').',
                "storeId": '.$request->input('storeId').',
                "productName": "'.$request->input('productName').'",
                "sku": '.$request->input('sku').',
                "upc": "'.$request->input('upc').'",
                "quantity": '.$request->input('quantity').',
                "status": '.$request->input('status').',
                "costPrice": '.$request->input('costPrice').',
                "standardPrice": '.$request->input('standardPrice').',
                "cartStandardPrice": '.$request->input('cartStandardPrice').',
                "tierPrice": '.$request->input('tierPrice').',
                "originalStandardPrice": '.$request->input('originalStandardPrice').',
                "adminRetailPrice": '.$request->input('adminRetailPrice').',
                "availableQuantity": '.$request->input('availableQuantity').',
                "deleted": false,
                "discountValue": '.$request->input('discountValue').',
                "discountType": '.$request->input('discountType').',
                "discountAmount": '.$request->input('discountAmount').',
                "taxClassId": '.$request->input('taxClassId').',
                "taxType": '.$request->input('taxType').',
                "taxPercentage": '.$request->input('taxPercentage').',
                "taxPerVolume": '.$request->input('taxPerVolume').',
                "outOfStock": false,
                "minQuantityToSale": '.$request->input('minQuantityToSale').',
                "maxQuantityToSale": '.$request->input('maxQuantityToSale').',
                "quantityIncrement": '.$request->input('quantityIncrement').',
                "cartLineItemUpdated": '.$request->input('cartLineItemUpdated').',
                "imageUrl": "'.$request->input('imageUrl').'",
                "updatedBy": '.$request->input('updatedBy').',
                "insertedTimestamp": "'.$request->input('insertedTimestamp').'",
                "updatedTimestamp": "'.$request->input('updatedTimestamp').'",
                "discount": '.$request->input('discount').',
                "taxIncludedInSellingPrice": '.$request->input('taxIncludedInSellingPrice').',
                "taxPerOunce": '.$request->input('taxPerOunce').',
                "directTaxPercentage": '.$request->input('directTaxPercentage').',
                "maxCostPrice": '.$request->input('maxCostPrice').',
                "taxAmount": '.$request->input('taxAmount').',
                "size": '.$request->input('size').',
                "serviceProduct": false
            }
        ]';
        // echo "<pre>";
        // print_r($post);die;
        $headers = array(
            'Accept: application/json, text/plain, */*',
            'Accept-Language: en-US,en;q=0.9',
            'Authorization: Bearer ' . Session::get('user.accessToken'),
            'Cache-Control: no-cache',
            'Connection: keep-alive',
            'Content-Type: application/json',
            'Origin: https://www.monstersmokewholesale.com',
            'Pragma: no-cache',
            'Referer: https://www.monstersmokewholesale.com/',
            'Sec-Fetch-Dest: empty',
            'Sec-Fetch-Mode: cors',
            'Sec-Fetch-Site: same-site',
            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36',
            'sec-ch-ua: "Google Chrome";v="123", "Not:A-Brand";v="8", "Chromium";v="123"',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: "Windows"'
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_POSTFIELDS => $post,
            CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response);


    }

    public function userDashBoardDetails()
    {
        $curl = curl_init();
        $accessToken = Session::get('user.accessToken');
        $url = 'https://erp.monstersmokewholesale.com/api/ecommerce/dashboard';
        // $accessToken = Session::get('user.accessToken');
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

    public function customerOrderDetails(Request $request)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://erp.monstersmokewholesale.com/services/pdf/sales-order/invoice/16625?token=eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJqb2huLmouaHVudC4xMkBnbWFpbC5jb20iLCJ0aWVyIjo1LCJ1c2VyVHlwZSI6IkN1c3RvbWVyIiwidG9rZW5UeXBlIjoiYWNjZXNzIiwic3RvcmVJZCI6MiwiZXhwIjoxNzE0NjE0MzExLCJ1c2VySWQiOjMyOSwiaWF0IjoxNzE0NDk0MzExLCJyZXNldFBhc3N3b3JkUmVxdWlyZWQiOmZhbHNlfQ.Ogs1cQXeN_bwFLohjUQ6N_8kcM9a8v3aYRvcKff7Tpg&defaultStoreId=2&storeIdList=1%2C2&isEcommerce=true',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Accept:  text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
            'Accept-Encoding:  gzip, deflate, br, zstd',
            'Accept-Language:  en-US,en;q=0.9',
            'Connection:  keep-alive',
            'Cookie:  _ga=GA1.1.1236110284.1710193375; _ga_YZ2JKL0G4E=GS1.1.1714590640.106.1.1714591143.52.0.255860717',
            'Host:  erp.monstersmokewholesale.com',
            'Referer:  https://www.monstersmokewholesale.com/',
            'Sec-Fetch-Dest:  iframe',
            'Sec-Fetch-Mode:  navigate',
            'Sec-Fetch-Site:  same-site',
            'Sec-Fetch-User:  ?1',
            'Upgrade-Insecure-Requests:  1',
            'User-Agent:  Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
            'sec-ch-ua:  "Chromium";v="124", "Google Chrome";v="124", "Not-A.Brand";v="99"',
            'sec-ch-ua-mobile:  ?0',
            'sec-ch-ua-platform:  "Windows"',
            'Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJzaGFrQG1zb2Rpc3Ryby5jb20iLCJ0aWVyIjo1LCJlbXBsb3llZUlkIjo2LCJ1c2VyVHlwZSI6IkN1c3RvbWVyIiwidG9rZW5UeXBlIjoiYWNjZXNzIiwic3RvcmVJZCI6MiwiZXhwIjoxNzEzNjc1ODY4LCJ1c2VySWQiOjE4NjMsImlhdCI6MTcxMzU1NTg2OCwiaW5mbyI6IkNVU1RPTUVSX1NVUFBPUlRfVE9LRU4ifQ.YG3NLNU6x0Fw179nrVTh0LUNWmjefxedE-NvexGW24w'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        echo $response;
    }

    public function userProfile()
    {
        return view('user-profile');
    }

    public function userAddressList()
    {
        $customerAddresslist = $this->getCustomerAddressList();
        $countries = $this->getCountries();
        return view('user-dashboard-addresslist', compact('customerAddresslist','countries'));
    }


    public function userForgotPassword()
    {
        return view('user-forgot-password');
    }

    public function searchProduct(Request $request)
    {
        // echo $request->all();
        // die();
        $curl = curl_init();
        // echo $request->get('searchQuery'); die;
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://erp.monstersmokewholesale.com/api/ecommerce/product/searchByProductOrCategory?searchInput=".str_replace(' ', '-', $request->input('searchQuery'))."",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Accept:  application/json, text/plain, */*',
            'Accept-Encoding:  gzip, deflate, br, zstd',
            'Accept-Language:  en-US,en;q=0.9',
            'Authorization:  Bearer eyJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ0ZXN0QGdtYWlsLmNvbSIsInRpZXIiOjEsInVzZXJUeXBlIjoiQ3VzdG9tZXIiLCJ0b2tlblR5cGUiOiJhY2Nlc3MiLCJzdG9yZUlkIjoyLCJleHAiOjE3MTQ4MTEzOTMsInVzZXJJZCI6ODk2LCJpYXQiOjE3MTQ2OTEzOTMsInJlc2V0UGFzc3dvcmRSZXF1aXJlZCI6ZmFsc2V9.prZYeOTWhqIVmKaF1JP0vhb3LQ1fnPocBjmgicYWXoI',
            'Connection:  keep-alive',
            'Host:  erp.monstersmokewholesale.com',
            'Origin:  https://www.monstersmokewholesale.com',
            'Referer:  https://www.monstersmokewholesale.com/',
            'Sec-Fetch-Dest:  empty',
            'Sec-Fetch-Mode:  cors',
            'Sec-Fetch-Site:  same-site',
            'User-Agent:  Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
            'sec-ch-ua:  "Chromium";v="124", "Google Chrome";v="124", "Not-A.Brand";v="99"',
            'sec-ch-ua-mobile:  ?0',
            'sec-ch-ua-platform:  "Windows"'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response, true);
        // echo "<pre>";
        // print_r($response); die();

        if($response && !$response['hasError'] && $response['status'] == 200 &&  $response['result']['productCoreDtoList'] &&  $response['result']['categoryDtoList']){

            return response()->json([
                'status' => "success",
                'products' => $response['result']['productCoreDtoList'],
                'category' => $response['result']['categoryDtoList'][0],
                'totalCount' => $response['result']['totalCount'],
            ]);
            // return $response['result']['productCoreDtoList'];

        }

        return response()->json([
            'status' => "error",
            'message' => "something went wrong!",
        ]);
    }

}

