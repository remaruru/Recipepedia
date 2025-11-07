<?php
/**
 * JSON API Endpoint for Recipes
 */
require_once 'config/database.php';
require_once 'classes/Recipe.php';
require_once 'classes/RecipeManager.php';
require_once 'classes/RecipeService.php';

header('Content-Type: application/json; charset=utf-8');

$recipeService = new RecipeService();

// Get all recipes as JSON
if (isset($_GET['id'])) {
    // Get single recipe
    $id = intval($_GET['id']);
    $recipeManager = new RecipeManager();
    $recipe = $recipeManager->getRecipeById($id);
    
    if ($recipe) {
        echo json_encode($recipe->toArray(), JSON_PRETTY_PRINT);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Recipe not found']);
    }
} else {
    // Get all recipes
    echo $recipeService->getRecipesJSON();
}

