<?php
require_once 'Recipe.php';
require_once __DIR__ . '/../config/database.php';

/**
 * RecipeManager Class - Handles database operations
 */
class RecipeManager {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Get all recipes
    public function getAllRecipes($search = '') {
        $query = "SELECT * FROM recipes";
        if (!empty($search)) {
            $query .= " WHERE title LIKE :search OR ingredients LIKE :search OR steps LIKE :search";
        }
        $query .= " ORDER BY updated_at DESC";

        $stmt = $this->conn->prepare($query);
        if (!empty($search)) {
            $searchTerm = "%$search%";
            $stmt->bindParam(':search', $searchTerm);
        }
        $stmt->execute();

        $recipes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $recipe = Recipe::fromArray($row);
            $recipes[] = $recipe;
        }
        return $recipes;
    }

    // Get recipe by ID
    public function getRecipeById($id) {
        $query = "SELECT * FROM recipes WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return Recipe::fromArray($row);
        }
        return null;
    }

    // Add recipe
    public function addRecipe($recipe) {
        $query = "INSERT INTO recipes (title, ingredients, steps, image_path) 
                  VALUES (:title, :ingredients, :steps, :image_path)";
        
        $stmt = $this->conn->prepare($query);
        $title = $recipe->getTitle();
        $ingredients = $recipe->getIngredients();
        $steps = $recipe->getSteps();
        $image_path = $recipe->getImagePath();
        
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':ingredients', $ingredients);
        $stmt->bindParam(':steps', $steps);
        $stmt->bindParam(':image_path', $image_path);
        
        return $stmt->execute();
    }

    // Update recipe
    public function updateRecipe($recipe) {
        $query = "UPDATE recipes SET title = :title, ingredients = :ingredients, 
                  steps = :steps, image_path = :image_path WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $id = $recipe->getId();
        $title = $recipe->getTitle();
        $ingredients = $recipe->getIngredients();
        $steps = $recipe->getSteps();
        $image_path = $recipe->getImagePath();
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':ingredients', $ingredients);
        $stmt->bindParam(':steps', $steps);
        $stmt->bindParam(':image_path', $image_path);
        
        return $stmt->execute();
    }

    // Delete recipe
    public function deleteRecipe($id) {
        $query = "DELETE FROM recipes WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Get all recipes as array (for export)
    public function getAllRecipesAsArray() {
        $recipes = $this->getAllRecipes();
        $result = [];
        foreach ($recipes as $recipe) {
            $result[] = $recipe->toArray();
        }
        return $result;
    }
}

