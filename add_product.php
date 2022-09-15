<?php 
require_once("inc/functions.php");

$token = "shop id";
$shop = "shop name";
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

  <?php 
  $row = 1;
  $i = 1;
  $count = 0;
  if (isset($_POST['submit'])) {	
    if(file_exists($_FILES['csv']['tmp_name'])) {
      $filename=$_FILES['csv']['tmp_name'];

      $header = array('title','body_html','vendor','product_type');

      if (($handle = fopen($filename, "r")) !== FALSE) {
        while (($row = fgetcsv($handle)) !== FALSE) {
          $count++;
          if ($count>1) {
          $i++;
          $product = array(); 

          foreach ($header as $k => $head) {
           $product[$head] = $row[$k];                         
         }
         $array = array (
          'product' => $product
          ,
        );

         $create =  shopify_call($token, $shop,"/admin/api/2021-01/products.json", $array, 'POST');

         $new_product_info = (json_decode($create['response']));

         foreach ($new_product_info as $key => $new_product) {

          /*start image update */
          $image_file = array(
            "image" => array(
              "id" => $new_product->id,
              "position"=> 1,
              "src" => $row[5]
            ),
          );

          $image_file2 = array(
            "image" => array(
              "id" => $new_product->id,
              "position"=> 2,
              "src" => $row[6]
            ),
          );

          $image_file3 = array(
            "image" => array(
              "id" => $new_product->id,
              "position"=> 3,
              "src" => $row[7]
            ),
          );

          $image_file4 = array(
            "image" => array(
              "id" => $new_product->id,
              "position"=> 4,
              "src" => $row[8]
            ),
          );

          $image_file5 = array(
            "image" => array(
              "id" => $new_product->id,
              "position"=> 5,
              "src" => $row[9]
            ),
          );


          $image_upload =  shopify_call($token, $shop,"/admin/api/2021-01/products/".$new_product->id."/images.json", $image_file, 'POST');

          $image_upload3 =  shopify_call($token, $shop,"/admin/api/2021-01/products/".$new_product->id."/images.json", $image_file2, 'POST');

         $image_upload3 =  shopify_call($token, $shop,"/admin/api/2021-01/products/".$new_product->id."/images.json", $image_file3, 'POST');

         $image_upload4 =  shopify_call($token, $shop,"/admin/api/2021-01/products/".$new_product->id."/images.json", $image_file4, 'POST');

         $image_upload5 =  shopify_call($token, $shop,"/admin/api/2021-01/products/".$new_product->id."/images.json", $image_file5, 'POST');

          /*end image update */

          /*start product price update*/

          foreach($new_product->variants as $variant){
            $array = array (
              'variant'=> array(
                'id' => $variant->id,
                'price' => $row[4]

              ),
            );

            $price_update =  shopify_call($token, $shop,"/admin/api/2021-01/variants/".$variant->id.".json", $array, 'PUT');
          }
         // $getLocation =  shopify_call($token, $shop,"/admin/api/2021-01/locations.json");

                 //  print_r($new_product_info);
          /*end product price update*/

          /*start inventory update */
            $inventory = array(
            "inventory" => array(
              "location_id" => 56979095712,
              "inventory_item_id" => 42803122176160,
              "available"=> 15
            ),
          );

          $inventory_update =  shopify_call($token, $shop,"/admin/api/2021-01/inventory_levels/set.json", $inventory, 'POST');
          print_r($inventory_update);
          /*end inventory update */
        }
      }
    }
      fclose($handle);
      echo "<div class='area'>  
      <center><img width='87' src='https://6395-42-0-7-229.ngrok.io/shopify_app/tick.png' alt='done' /><center>
      <h4><center>Product imported successfully!</center><h4>
      </div>";
    }
  }
}?>

</body>
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

h4{
  color: #004C3F;
}
</style>
