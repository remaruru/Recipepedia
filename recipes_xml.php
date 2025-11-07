<?php
/**
 * XML API Endpoint for Recipes
 * Direct access to get all recipes as XML
 */
require_once 'config/database.php';
require_once 'classes/RecipeService.php';

header('Content-Type: application/xml; charset=utf-8');

$recipeService = new RecipeService();

// Get all recipes as XML
if (isset($_GET['id'])) {
    // Get single recipe by ID
    $id = intval($_GET['id']);
    echo $recipeService->getRecipeByIdXML($id);
} else {
    // Get all recipes
    echo $recipeService->getRecipesXML();
}

