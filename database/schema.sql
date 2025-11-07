-- Recipepedia Database Schema
CREATE DATABASE IF NOT EXISTS recipepedia;
USE recipepedia;

-- Recipes table
CREATE TABLE IF NOT EXISTS recipes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    ingredients TEXT NOT NULL,
    steps TEXT NOT NULL,
    image_path VARCHAR(500) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Sample data (optional)
INSERT INTO recipes (title, ingredients, steps, image_path) VALUES
('Pancakes', '2 cups flour, 2 eggs, 1 cup milk, 2 tbsp sugar, 1 tsp baking powder', '1. Mix dry ingredients\n2. Add wet ingredients\n3. Cook on griddle until golden', NULL),
('Chocolate Cake', '2 cups flour, 1 cup sugar, 3 eggs, 1/2 cup cocoa, 1 cup milk', '1. Preheat oven to 350°F\n2. Mix all ingredients\n3. Bake for 30 minutes', NULL);

