<?php
/**
 * Recipe Class
 */
class Recipe {
    private $id;
    private $title;
    private $ingredients;
    private $steps;
    private $image_path;
    private $created_at;
    private $updated_at;

    public function __construct($id = null, $title = '', $ingredients = '', $steps = '', $image_path = null) {
        $this->id = $id;
        $this->title = $title;
        $this->ingredients = $ingredients;
        $this->steps = $steps;
        $this->image_path = $image_path;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getTitle() { return $this->title; }
    public function getIngredients() { return $this->ingredients; }
    public function getSteps() { return $this->steps; }
    public function getImagePath() { return $this->image_path; }
    public function getCreatedAt() { return $this->created_at; }
    public function getUpdatedAt() { return $this->updated_at; }

    // Setters
    public function setTitle($title) { $this->title = $title; }
    public function setIngredients($ingredients) { $this->ingredients = $ingredients; }
    public function setSteps($steps) { $this->steps = $steps; }
    public function setImagePath($image_path) { $this->image_path = $image_path; }

    // Convert to array
    public function toArray() {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'ingredients' => $this->ingredients,
            'steps' => $this->steps,
            'image_path' => $this->image_path,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }

    // Create from array
    public static function fromArray($data) {
        $recipe = new Recipe();
        if (isset($data['id'])) $recipe->id = $data['id'];
        if (isset($data['title'])) $recipe->title = $data['title'];
        if (isset($data['ingredients'])) $recipe->ingredients = $data['ingredients'];
        if (isset($data['steps'])) $recipe->steps = $data['steps'];
        if (isset($data['image_path'])) $recipe->image_path = $data['image_path'];
        if (isset($data['created_at'])) $recipe->created_at = $data['created_at'];
        if (isset($data['updated_at'])) $recipe->updated_at = $data['updated_at'];
        return $recipe;
    }
}

