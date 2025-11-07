<?php
/**
 * SOAP Web Service for Recipe Sharing
 */
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../classes/Recipe.php';
require_once __DIR__ . '/../classes/RecipeManager.php';
require_once __DIR__ . '/../classes/RecipeService.php';

// Enable SOAP extension check
if (!extension_loaded('soap')) {
    die('SOAP extension is not enabled. Please enable it in php.ini');
}

// Create WSDL on the fly or use a static one
$wsdl = null; // We'll use non-WSDL mode for simplicity

try {
    $server = new SoapServer($wsdl, [
        'uri' => 'http://localhost/Recipedia/soap_service/recipe_service.php',
        'location' => 'http://localhost/Recipedia/soap_service/recipe_service.php'
    ]);

    // Set the class that will handle SOAP requests
    $recipeService = new RecipeService();
    
    // Register SOAP functions
    $server->setClass('RecipeService');
    
    // Handle SOAP request
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $server->handle();
    } else {
        // For GET requests, return XML recipes directly
        header('Content-Type: application/xml; charset=utf-8');
        echo $recipeService->getRecipesXML();
        exit;
    }
} catch (Exception $e) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        header('Content-Type: text/xml; charset=utf-8');
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<soap:Fault><faultcode>Server</faultcode><faultstring>' . htmlspecialchars($e->getMessage()) . '</faultstring></soap:Fault>';
    } else {
        echo "SOAP Service Error: " . $e->getMessage();
    }
}

