<?php

// Set variables for our request
$shop = $_GET['shop'];
$api_key = "8896823f6e0b76761d2ec5a482c15bed";
$scopes = "read_orders,write_products";
$redirect_uri = "https://f74d-27-54-149-172.ngrok.io/shopify_app/generate_token.php";

// Build install/approval URL to redirect to
$install_url = "https://" . $shop . ".myshopify.com/admin/oauth/authorize?client_id=" . $api_key . "&scope=" . $scopes . "&redirect_uri=" . urlencode($redirect_uri);

// Redirect
header("Location: " . $install_url);
die();