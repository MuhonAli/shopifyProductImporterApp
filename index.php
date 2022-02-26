<?php 
require_once("inc/functions.php");

$requests = $_GET;
$hmac = $_GET['hmac'];
$serializeArray = serialize($requests);
$requests = array_diff_key($requests, array('hmac' =>''));
ksort($requests);

$token = "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";
$shop = "muhon-learning";

/*product add array start*/
$array = array (
  'product' => 
  array (
    'title' => 'Burton Custom Freestyle 151',
    'body_html' => '<strong>Good snowboard!</strong>',
    'vendor' => 'Burton',
    'product_type' => 'Snowboard',


/*      'variants'=> array(
      'option1' => 'First',
      'price' => '10.00',
      'sku' => '123444'
    ),*/
/*      'images' => array(
        'src' => 'https://www.feedough.com/wp-content/uploads/2016/08/product-mix-03-1536x857.webp'
      )*/

    ),
);

/*product add array end*/

//$create =  shopify_call($token, $shop,"/admin/api/2021-01/products.json", $array, 'POST');

/*image update */
/*$image_file = array(
        "image" => array(
          "id" => 6547978223776,
          "position"=> 1,
          "src" => "https://cdn.shopify.com/s/files/1/0506/8108/6112/files/tying-up-boot-laces.jpg"
        ),
);

$image_upload =  shopify_call($token, $shop,"/admin/api/2021-01/products/6547978223776/images.json", $image_file, 'POST');
print_r($image_upload);
exit;*/
/*image update */

/*update price start*/
/*$array = array (
      'variant'=> array(
      'id' => 39286386819232,
      'price' => 10.00,

),
);

$price_update =  shopify_call($token, $shop,"/admin/api/2021-01/variants/39286386819232.json", $array, 'PUT');
print_r($price_update);*/

/*update price end*/
/*
$pid = (json_decode($create['response']));
$parr = $pid;
foreach ($parr as $key => $value) {
  echo $value->id;
   foreach($value->variants as $variant){
    echo $variant->id;
   };
}
exit;*/
//exit;
?>
<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>shopify Product Importer</title>
</head>

<div class="area">
  <center><a class="download-link" href="https://f74d-27-54-149-172.ngrok.io/shopify_app/sample-product.csv">Click here to Download sample csv file</a></center>
  <h2><center>shopify Product Importer</center><center></h2>
    <form action="https://f74d-27-54-149-172.ngrok.io/shopify_app/add_product.php" method="post" enctype="multipart/form-data">


      <center>  <label class="custom-file-upload">
        <input type="file" name="csv" required="">
      </label>
    </center><br>
    <center><input class="submit" type="submit" name="submit"></center>

    <center><div id="loading">
      <img id="loading-image" src="https://f74d-27-54-149-172.ngrok.io/shopify_app/loading.gif" alt="Loading..." />
    </div></center>

  </form>

</div>

</html>

<style>

  .area{
    border: 8px solid #008060;
    width: 30%;
    margin-left: 23.5%;
    padding: 9%;
    border-radius: 2%;
    margin-top: 3%;
  }

  h2{
    color: #004C3F;
  }

  .submit{
    padding: 0.65em 1.875em;
    display: inline-block;
    border-radius: 4px;
    font-family: ShopifySans, Helvetica, Arial, sans-serif;
    font-weight: 700;
    font-size: 1em;
    line-height: 1.133;
    -webkit-font-smoothing: antialiased;
    transition: 150ms ease;
    transition-property: background-color, border-color, box-shadow, color;
    text-align: center;
    -webkit-user-select: none;
    user-select: none;
    -webkit-appearance: none;
    appearance: none;
    cursor: pointer;
    box-shadow: 0 5px 15px 0 rgb(0 0 0 / 15%);
    background-color: #008060;
    color: #ffffff;
    border-width: 1px;
    border-style: solid;
    border-color: transparent;
  }

  .custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
    background: #008060;
    color: white;
  }

  .download-link{
    color: #008060;
  }

  #loading {
    width: 100%;
    height: 100%;
    top: 0px;
    left: 0px;
    position: fixed;
    display: block;
    opacity: 0.7;
    background-color: #fff;
    z-index: 99;
    text-align: center;
    display: none;
  }

  #loading-image {
   margin-left: -3%;
   margin-top: 10%;
 }

</style>

<script>
  $("form").submit(function (e) {
    $("#loading").show();
  });
</script>