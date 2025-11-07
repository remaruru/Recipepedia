<?php
/**
 * Script to add 20+ sample recipes to the database
 * Run this file once: http://localhost/Recipedia/add_sample_recipes.php
 */

require_once 'config/database.php';
require_once 'classes/Recipe.php';
require_once 'classes/RecipeManager.php';

$recipeManager = new RecipeManager();

// Sample recipes data
$recipes = [
    [
        'title' => 'Classic Margherita Pizza',
        'ingredients' => '1 pizza dough, 1 cup tomato sauce, 2 cups mozzarella cheese, fresh basil leaves, 2 tbsp olive oil, salt to taste',
        'steps' => "1. Preheat oven to 475°F (245°C)\n2. Roll out pizza dough on a floured surface\n3. Spread tomato sauce evenly over the dough\n4. Add mozzarella cheese\n5. Bake for 10-12 minutes until crust is golden\n6. Top with fresh basil and drizzle with olive oil\n7. Serve hot"
    ],
    [
        'title' => 'Chicken Tikka Masala',
        'ingredients' => '500g chicken breast, 1 cup yogurt, 2 tbsp garam masala, 1 onion, 2 tomatoes, 1 cup cream, 3 cloves garlic, 1 inch ginger, 2 tbsp oil',
        'steps' => "1. Marinate chicken in yogurt and spices for 2 hours\n2. Heat oil in a pan and cook chicken until golden\n3. Sauté onions, garlic, and ginger\n4. Add tomatoes and cook until soft\n5. Blend to make a smooth sauce\n6. Add cream and cooked chicken\n7. Simmer for 15 minutes\n8. Serve with rice or naan"
    ],
    [
        'title' => 'Chocolate Chip Cookies',
        'ingredients' => '2 cups all-purpose flour, 1 cup butter, 3/4 cup brown sugar, 3/4 cup white sugar, 2 eggs, 2 tsp vanilla, 1 tsp baking soda, 2 cups chocolate chips',
        'steps' => "1. Preheat oven to 375°F (190°C)\n2. Cream butter and both sugars\n3. Beat in eggs and vanilla\n4. Mix in flour and baking soda\n5. Fold in chocolate chips\n6. Drop rounded tablespoons onto baking sheet\n7. Bake for 9-11 minutes\n8. Cool on wire rack"
    ],
    [
        'title' => 'Beef Tacos',
        'ingredients' => '500g ground beef, 8 taco shells, 1 packet taco seasoning, 1 onion, 2 tomatoes, 1 cup shredded lettuce, 1 cup cheddar cheese, sour cream, salsa',
        'steps' => "1. Brown ground beef in a skillet\n2. Add taco seasoning and water, simmer\n3. Dice tomatoes and onions\n4. Heat taco shells in oven\n5. Fill shells with beef\n6. Top with vegetables and cheese\n7. Add sour cream and salsa\n8. Serve immediately"
    ],
    [
        'title' => 'Caesar Salad',
        'ingredients' => '1 head romaine lettuce, 1/2 cup Caesar dressing, 1/4 cup Parmesan cheese, 1 cup croutons, 2 anchovy fillets, black pepper',
        'steps' => "1. Wash and chop romaine lettuce\n2. Toss lettuce with Caesar dressing\n3. Add croutons and Parmesan cheese\n4. Top with anchovy fillets\n5. Season with black pepper\n6. Serve as a side or main dish"
    ],
    [
        'title' => 'Beef Stroganoff',
        'ingredients' => '500g beef sirloin, 1 onion, 2 cups mushrooms, 1 cup sour cream, 2 tbsp flour, 2 cups beef broth, 1 tbsp Worcestershire sauce, egg noodles',
        'steps' => "1. Cut beef into thin strips\n2. Season and brown beef in a pan\n3. Sauté onions and mushrooms\n4. Add flour and stir\n5. Pour in beef broth and Worcestershire sauce\n6. Simmer until sauce thickens\n7. Stir in sour cream\n8. Serve over cooked egg noodles"
    ],
    [
        'title' => 'Sushi Rolls',
        'ingredients' => '2 cups sushi rice, 4 nori sheets, 200g salmon, 1 cucumber, 1 avocado, wasabi, soy sauce, rice vinegar, sugar, salt',
        'steps' => "1. Cook sushi rice and season with vinegar, sugar, and salt\n2. Let rice cool to room temperature\n3. Cut salmon, cucumber, and avocado into strips\n4. Place nori on bamboo mat\n5. Spread rice on nori, leaving edges\n6. Add fillings in the center\n7. Roll tightly using the mat\n8. Slice into pieces and serve with wasabi and soy sauce"
    ],
    [
        'title' => 'Chicken Noodle Soup',
        'ingredients' => '500g chicken breast, 8 cups chicken broth, 2 cups egg noodles, 2 carrots, 2 celery stalks, 1 onion, 3 cloves garlic, fresh parsley, salt, pepper',
        'steps' => "1. Dice vegetables and set aside\n2. Cook chicken in broth until tender\n3. Remove chicken and shred\n4. Add vegetables to broth and simmer\n5. Add egg noodles and cook until tender\n6. Return shredded chicken to pot\n7. Season with salt and pepper\n8. Garnish with fresh parsley"
    ],
    [
        'title' => 'Chocolate Brownies',
        'ingredients' => '1 cup butter, 2 cups sugar, 4 eggs, 1 tsp vanilla, 1 cup flour, 3/4 cup cocoa powder, 1/2 tsp baking powder, 1/2 tsp salt, 1 cup chocolate chips',
        'steps' => "1. Preheat oven to 350°F (175°C)\n2. Melt butter and mix with sugar\n3. Beat in eggs and vanilla\n4. Combine dry ingredients\n5. Mix wet and dry ingredients\n6. Fold in chocolate chips\n7. Pour into greased pan\n8. Bake for 25-30 minutes\n9. Cool before cutting"
    ],
    [
        'title' => 'Pasta Carbonara',
        'ingredients' => '400g spaghetti, 200g bacon, 4 eggs, 1 cup Parmesan cheese, 2 cloves garlic, black pepper, salt',
        'steps' => "1. Cook spaghetti according to package\n2. Fry bacon until crispy\n3. Whisk eggs with Parmesan and pepper\n4. Drain pasta, reserving some water\n5. Toss hot pasta with bacon\n6. Quickly add egg mixture off heat\n7. Toss until creamy\n8. Add pasta water if needed\n9. Serve immediately"
    ],
    [
        'title' => 'BBQ Pulled Pork',
        'ingredients' => '2kg pork shoulder, 1 cup BBQ sauce, 1 onion, 4 cloves garlic, 1 tbsp brown sugar, 1 tsp paprika, salt, pepper, buns',
        'steps' => "1. Season pork with salt, pepper, and paprika\n2. Sear pork on all sides\n3. Place in slow cooker with onions and garlic\n4. Cook on low for 8 hours\n5. Shred pork with forks\n6. Mix with BBQ sauce and brown sugar\n7. Serve on buns with coleslaw"
    ],
    [
        'title' => 'Greek Salad',
        'ingredients' => '2 tomatoes, 1 cucumber, 1 red onion, 1/2 cup Kalamata olives, 200g feta cheese, 2 tbsp olive oil, 1 tbsp lemon juice, oregano, salt',
        'steps' => "1. Dice tomatoes and cucumber\n2. Thinly slice red onion\n3. Combine vegetables in a bowl\n4. Add olives and crumbled feta\n5. Drizzle with olive oil and lemon juice\n6. Season with oregano and salt\n7. Toss gently and serve"
    ],
    [
        'title' => 'Beef Burger',
        'ingredients' => '500g ground beef, 4 burger buns, 1 onion, 2 tomatoes, lettuce, 4 slices cheese, pickles, ketchup, mustard, salt, pepper',
        'steps' => "1. Season ground beef with salt and pepper\n2. Form into 4 patties\n3. Grill or pan-fry patties\n4. Toast burger buns\n5. Build burger with patty, cheese, vegetables\n6. Add condiments\n7. Serve with fries"
    ],
    [
        'title' => 'Chicken Curry',
        'ingredients' => '500g chicken, 2 onions, 2 tomatoes, 1 cup coconut milk, 2 tbsp curry powder, 1 tbsp turmeric, 3 cloves garlic, 1 inch ginger, 2 tbsp oil',
        'steps' => "1. Heat oil and sauté onions\n2. Add garlic and ginger, cook until fragrant\n3. Add curry powder and turmeric\n4. Add chicken and cook until browned\n5. Add tomatoes and cook until soft\n6. Pour in coconut milk\n7. Simmer for 20 minutes\n8. Season with salt\n9. Serve with rice"
    ],
    [
        'title' => 'French Toast',
        'ingredients' => '8 slices bread, 4 eggs, 1 cup milk, 2 tbsp sugar, 1 tsp vanilla, 1/2 tsp cinnamon, butter, maple syrup',
        'steps' => "1. Whisk eggs, milk, sugar, vanilla, and cinnamon\n2. Dip bread slices in mixture\n3. Cook in buttered pan until golden\n4. Flip and cook other side\n5. Serve with maple syrup\n6. Add fresh berries if desired"
    ],
    [
        'title' => 'Beef Stir Fry',
        'ingredients' => '400g beef strips, 2 bell peppers, 1 onion, 2 carrots, 2 cups broccoli, 3 cloves garlic, 1/4 cup soy sauce, 2 tbsp cornstarch, 2 tbsp oil',
        'steps' => "1. Marinate beef in soy sauce and cornstarch\n2. Heat oil in wok or large pan\n3. Stir-fry beef until cooked, remove\n4. Add vegetables and stir-fry\n5. Add garlic\n6. Return beef to pan\n7. Add remaining soy sauce\n8. Serve over rice"
    ],
    [
        'title' => 'Fish and Chips',
        'ingredients' => '4 white fish fillets, 2 cups flour, 1 cup beer, 1 tsp baking powder, 4 large potatoes, vegetable oil, salt, malt vinegar',
        'steps' => "1. Cut potatoes into chips\n2. Soak chips in cold water\n3. Mix flour, beer, and baking powder for batter\n4. Heat oil to 375°F (190°C)\n5. Fry chips until golden, drain\n6. Dip fish in batter\n7. Fry fish until golden and crispy\n8. Serve with chips and malt vinegar"
    ],
    [
        'title' => 'Chicken Alfredo Pasta',
        'ingredients' => '400g fettuccine, 500g chicken breast, 2 cups heavy cream, 1 cup Parmesan cheese, 4 cloves garlic, 2 tbsp butter, salt, pepper, parsley',
        'steps' => "1. Cook pasta according to package\n2. Season and cook chicken, slice\n3. Melt butter and sauté garlic\n4. Add cream and simmer\n5. Stir in Parmesan until melted\n6. Add chicken to sauce\n7. Toss with cooked pasta\n8. Garnish with parsley"
    ],
    [
        'title' => 'Vegetable Lasagna',
        'ingredients' => '9 lasagna noodles, 2 cups marinara sauce, 2 cups ricotta cheese, 2 cups mozzarella, 1 cup Parmesan, 2 zucchini, 2 carrots, 1 onion, spinach, 2 cloves garlic',
        'steps' => "1. Cook lasagna noodles\n2. Sauté vegetables with garlic\n3. Mix ricotta with Parmesan\n4. Layer sauce, noodles, ricotta, vegetables, mozzarella\n5. Repeat layers\n6. Top with remaining cheese\n7. Bake at 375°F (190°C) for 45 minutes\n8. Let rest 10 minutes before serving"
    ],
    [
        'title' => 'Pad Thai',
        'ingredients' => '200g rice noodles, 200g shrimp, 2 eggs, 1 cup bean sprouts, 2 green onions, 1/4 cup peanuts, 3 tbsp fish sauce, 2 tbsp tamarind paste, 2 tbsp sugar, lime',
        'steps' => "1. Soak rice noodles in warm water\n2. Heat oil and scramble eggs\n3. Add shrimp and cook\n4. Add noodles and stir-fry\n5. Add fish sauce, tamarind, and sugar\n6. Add bean sprouts and green onions\n7. Toss everything together\n8. Serve with peanuts and lime wedges"
    ],
    [
        'title' => 'Chicken Wings',
        'ingredients' => '1kg chicken wings, 1/2 cup hot sauce, 1/4 cup butter, 2 tbsp vinegar, 1 tsp garlic powder, blue cheese dressing, celery sticks',
        'steps' => "1. Preheat oven to 400°F (200°C)\n2. Season wings and bake for 45 minutes\n3. Melt butter and mix with hot sauce and vinegar\n4. Toss wings in sauce\n5. Return to oven for 10 minutes\n6. Serve with blue cheese dressing and celery"
    ],
    [
        'title' => 'Chocolate Mousse',
        'ingredients' => '200g dark chocolate, 4 eggs, 1/4 cup sugar, 1 cup heavy cream, 1 tsp vanilla extract',
        'steps' => "1. Melt chocolate and let cool\n2. Separate eggs\n3. Whip egg whites until stiff\n4. Whip cream until soft peaks\n5. Beat egg yolks with sugar\n6. Fold chocolate into yolks\n7. Gently fold in whipped cream\n8. Fold in egg whites\n9. Chill for 4 hours\n10. Serve with berries"
    ],
    [
        'title' => 'Beef Chili',
        'ingredients' => '500g ground beef, 2 cans kidney beans, 1 can tomatoes, 1 onion, 2 bell peppers, 3 cloves garlic, 2 tbsp chili powder, 1 tsp cumin, salt, pepper',
        'steps' => "1. Brown ground beef\n2. Add onions and peppers, cook until soft\n3. Add garlic and spices\n4. Add tomatoes and beans\n5. Simmer for 30 minutes\n6. Season with salt and pepper\n7. Serve with cheese and sour cream"
    ],
    [
        'title' => 'Salmon Teriyaki',
        'ingredients' => '4 salmon fillets, 1/2 cup soy sauce, 1/4 cup mirin, 2 tbsp sugar, 1 tbsp ginger, 2 cloves garlic, 2 green onions, sesame seeds, rice',
        'steps' => "1. Mix soy sauce, mirin, sugar, ginger, and garlic for teriyaki sauce\n2. Marinate salmon for 30 minutes\n3. Heat pan and cook salmon skin-side down\n4. Flip and cook other side\n5. Brush with teriyaki sauce\n6. Cook until glazed\n7. Serve over rice with green onions and sesame seeds"
    ]
];

// Check if recipes already exist
$existingRecipes = $recipeManager->getAllRecipes();
$existingCount = count($existingRecipes);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Sample Recipes - Recipepedia</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1><a href="index.php">🍳 Recipepedia</a></h1>
            <nav>
                <a href="index.php">🏠 Home</a>
            </nav>
        </div>
    </header>
    <main class="container">
        <div class="form-container">
            <h1>📝 Add Sample Recipes</h1>
            
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_recipes'])) {
                $added = 0;
                $skipped = 0;
                
                foreach ($recipes as $recipeData) {
                    $recipe = new Recipe(null, $recipeData['title'], $recipeData['ingredients'], $recipeData['steps'], null);
                    
                    // Check if recipe already exists
                    $existing = $recipeManager->getAllRecipes($recipeData['title']);
                    $exists = false;
                    foreach ($existing as $existingRecipe) {
                        if (strtolower($existingRecipe->getTitle()) == strtolower($recipeData['title'])) {
                            $exists = true;
                            break;
                        }
                    }
                    
                    if (!$exists) {
                        if ($recipeManager->addRecipe($recipe)) {
                            $added++;
                        }
                    } else {
                        $skipped++;
                    }
                }
                
                echo '<div class="message success">';
                echo "✅ Successfully added <strong>$added</strong> recipes!<br>";
                if ($skipped > 0) {
                    echo "⏭️ Skipped <strong>$skipped</strong> recipes (already exist).";
                }
                echo '</div>';
                echo '<p style="margin-top: 2rem;"><a href="index.php" class="btn btn-primary">🏠 Go to Home</a></p>';
            } else {
            ?>
                <p style="color: var(--text-light); font-size: 1.1rem; margin-bottom: 2rem;">
                    This will add <strong>24 sample recipes</strong> to your database. 
                    <?php if ($existingCount > 0): ?>
                        You currently have <strong><?php echo $existingCount; ?></strong> recipe(s) in your database.
                    <?php endif; ?>
                </p>
                
                <p style="color: var(--text-light); margin-bottom: 2rem;">
                    Recipes will be added: Margherita Pizza, Chicken Tikka Masala, Chocolate Chip Cookies, Beef Tacos, 
                    Caesar Salad, Beef Stroganoff, Sushi Rolls, Chicken Noodle Soup, Chocolate Brownies, Pasta Carbonara, 
                    BBQ Pulled Pork, Greek Salad, Beef Burger, Chicken Curry, French Toast, Beef Stir Fry, Fish and Chips, 
                    Chicken Alfredo Pasta, Vegetable Lasagna, Pad Thai, Chicken Wings, Chocolate Mousse, Beef Chili, and Salmon Teriyaki.
                </p>
                
                <form method="POST">
                    <div class="form-group">
                        <button type="submit" name="add_recipes" class="btn btn-success">➕ Add All 24 Sample Recipes</button>
                        <a href="index.php" class="btn btn-secondary">❌ Cancel</a>
                    </div>
                </form>
            <?php } ?>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 Recipepedia - Your Recipe Sharing Platform</p>
        </div>
    </footer>
</body>
</html>

