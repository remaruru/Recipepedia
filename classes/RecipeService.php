<?php
require_once 'Recipe.php';
require_once 'RecipeManager.php';

/**
 * RecipeService Class - Handles SOAP and JSON services
 */
class RecipeService {
    private $recipeManager;

    public function __construct() {
        $this->recipeManager = new RecipeManager();
    }

    // Get all recipes as XML
    public function getRecipesXML() {
        $recipes = $this->recipeManager->getAllRecipes();
        
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><recipes></recipes>');
        
        foreach ($recipes as $recipe) {
            $recipeElement = $xml->addChild('recipe');
            $recipeElement->addChild('id', $recipe->getId());
            $recipeElement->addChild('title', htmlspecialchars($recipe->getTitle()));
            $recipeElement->addChild('ingredients', htmlspecialchars($recipe->getIngredients()));
            $recipeElement->addChild('steps', htmlspecialchars($recipe->getSteps()));
            $recipeElement->addChild('image_path', htmlspecialchars($recipe->getImagePath() ?? ''));
            $recipeElement->addChild('created_at', $recipe->getCreatedAt());
            $recipeElement->addChild('updated_at', $recipe->getUpdatedAt());
        }
        
        return $xml->asXML();
    }

    // Get all recipes as JSON
    public function getRecipesJSON() {
        $recipes = $this->recipeManager->getAllRecipesAsArray();
        return json_encode($recipes, JSON_PRETTY_PRINT);
    }

    // Get recipe by ID as XML
    public function getRecipeByIdXML($id) {
        $recipe = $this->recipeManager->getRecipeById($id);
        
        if (!$recipe) {
            return '<?xml version="1.0" encoding="UTF-8"?><error>Recipe not found</error>';
        }
        
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><recipe></recipe>');
        $xml->addChild('id', $recipe->getId());
        $xml->addChild('title', htmlspecialchars($recipe->getTitle()));
        $xml->addChild('ingredients', htmlspecialchars($recipe->getIngredients()));
        $xml->addChild('steps', htmlspecialchars($recipe->getSteps()));
        $xml->addChild('image_path', htmlspecialchars($recipe->getImagePath() ?? ''));
        $xml->addChild('created_at', $recipe->getCreatedAt());
        $xml->addChild('updated_at', $recipe->getUpdatedAt());
        
        return $xml->asXML();
    }

    // Import recipes from XML
    public function importRecipesFromXML($xmlString) {
        try {
            $xml = simplexml_load_string($xmlString);
            if ($xml === false) {
                return ['success' => false, 'message' => 'Invalid XML format'];
            }

            $imported = 0;
            foreach ($xml->recipe as $recipeData) {
                $recipe = new Recipe();
                $recipe->setTitle((string)$recipeData->title);
                $recipe->setIngredients((string)$recipeData->ingredients);
                $recipe->setSteps((string)$recipeData->steps);
                $recipe->setImagePath((string)$recipeData->image_path);
                
                if ($this->recipeManager->addRecipe($recipe)) {
                    $imported++;
                }
            }
            
            return ['success' => true, 'message' => "Imported $imported recipes"];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    // Import recipes from JSON
    public function importRecipesFromJSON($jsonString) {
        try {
            $data = json_decode($jsonString, true);
            if ($data === null) {
                return ['success' => false, 'message' => 'Invalid JSON format'];
            }

            $imported = 0;
            foreach ($data as $recipeData) {
                $recipe = Recipe::fromArray($recipeData);
                if ($this->recipeManager->addRecipe($recipe)) {
                    $imported++;
                }
            }
            
            return ['success' => true, 'message' => "Imported $imported recipes"];
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}

