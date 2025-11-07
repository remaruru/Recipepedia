<?php
require_once 'config/database.php';
require_once 'classes/Recipe.php';
require_once 'classes/RecipeManager.php';
require_once 'classes/RecipeService.php';

$pageTitle = "API Client & Testing";
require_once 'includes/header.php';

$recipeManager = new RecipeManager();
$recipeService = new RecipeService();
$allRecipes = $recipeManager->getAllRecipes();
$result = '';
$resultType = '';
$resultData = null;
$method = $_GET['method'] ?? '';
$recipeId = $_GET['id'] ?? '';
$jsonId = $_GET['json_id'] ?? '';

// Handle API requests
if (!empty($method) || !empty($jsonId)) {
    try {
        switch ($method) {
            case 'xml':
                $result = $recipeService->getRecipesXML();
                $resultType = 'xml';
                break;
            case 'json':
                $result = $recipeService->getRecipesJSON();
                $resultType = 'json';
                $resultData = json_decode($result, true);
                break;
            case 'recipe':
                if (!empty($recipeId)) {
                    $result = $recipeService->getRecipeByIdXML($recipeId);
                    $resultType = 'xml';
                } else {
                    $result = 'Error: Recipe ID is required';
                    $resultType = 'error';
                }
                break;
            case 'recipe_json':
                if (!empty($recipeId)) {
                    $recipe = $recipeManager->getRecipeById($recipeId);
                    if ($recipe) {
                        $result = json_encode($recipe->toArray(), JSON_PRETTY_PRINT);
                        $resultType = 'json';
                        $resultData = $recipe->toArray();
                    } else {
                        $result = json_encode(['error' => 'Recipe not found'], JSON_PRETTY_PRINT);
                        $resultType = 'error';
                    }
                } else {
                    $result = json_encode(['error' => 'Recipe ID is required'], JSON_PRETTY_PRINT);
                    $resultType = 'error';
                }
                break;
        }
        
        // Handle direct JSON ID request
        if (!empty($jsonId) && empty($method)) {
            $recipe = $recipeManager->getRecipeById($jsonId);
            if ($recipe) {
                $result = json_encode($recipe->toArray(), JSON_PRETTY_PRINT);
                $resultType = 'json';
                $resultData = $recipe->toArray();
            } else {
                $result = json_encode(['error' => 'Recipe not found'], JSON_PRETTY_PRINT);
                $resultType = 'error';
            }
        }
    } catch (Exception $e) {
        $result = 'Error: ' . $e->getMessage();
        $resultType = 'error';
    }
}
?>

<div class="soap-client">
    <h1>🔌 API Client & Testing</h1>
    <p style="color: var(--text-light); font-size: 1.1rem; margin-bottom: 2rem;">
        Test and interact with the Recipe API. Get recipes in XML or JSON format, view details, and edit recipes directly from the API results.
    </p>
    
    <!-- Available Recipes Info -->
    <div style="background: var(--bg-light); padding: 1.5rem; border-radius: 15px; margin-bottom: 2rem; border-left: 5px solid var(--primary-color);">
        <h2 style="margin-top: 0; color: var(--text-dark); font-size: 1.25rem;">📊 Database Status</h2>
        <p style="margin: 0.5rem 0; color: var(--text-dark);">
            <strong>Total Recipes:</strong> <?php echo count($allRecipes); ?> recipes available
        </p>
        <?php if (count($allRecipes) > 0): ?>
            <p style="margin: 0.5rem 0; color: var(--text-light); font-size: 0.9rem;">
                <strong>Available IDs:</strong> 
                <?php 
                $ids = array_map(function($r) { return $r->getId(); }, $allRecipes);
                echo implode(', ', $ids);
                ?>
            </p>
        <?php endif; ?>
    </div>
    
    <!-- Get All Recipes -->
    <div style="margin: 2rem 0; background: white; padding: 2rem; border-radius: 15px; box-shadow: var(--shadow-md); border-left: 5px solid var(--primary-color);">
        <h2 style="color: var(--text-dark); margin-top: 0;">⚡ Get ALL Recipes</h2>
        <p style="color: var(--text-light); margin-bottom: 1rem;">
            <strong>Retrieve ALL recipes from the database</strong> in your preferred format. This will return every single recipe, not just one!
        </p>
        <div class="export-options">
            <a href="?method=xml" class="btn btn-primary">📄 Get ALL Recipes (XML)</a>
            <a href="?method=json" class="btn btn-primary">📋 Get ALL Recipes (JSON)</a>
        </div>
        <p style="color: var(--text-light); font-size: 0.9rem; margin-top: 1rem; padding: 0.75rem; background: var(--bg-light); border-radius: 8px;">
            <strong>⚠️ Important:</strong> These buttons return <strong>ALL recipes</strong> in the database. If you want a specific recipe, use the forms below.
        </p>
    </div>
    
    <!-- Get Recipe by ID - XML -->
    <div style="margin: 2rem 0; background: white; padding: 2rem; border-radius: 15px; box-shadow: var(--shadow-md);">
        <h2 style="color: var(--text-dark); margin-top: 0;">🔍 Get Recipe by ID (XML)</h2>
        <p style="color: var(--text-light); margin-bottom: 1rem;">Retrieve a specific recipe by its ID in XML format.</p>
        <form method="GET" style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
            <input type="hidden" name="method" value="recipe">
            <input type="number" name="id" placeholder="Enter Recipe ID" required value="<?php echo htmlspecialchars($recipeId ?: ''); ?>" 
                   style="padding: 1rem; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 1rem; min-width: 200px; flex: 1;">
            <button type="submit" class="btn btn-primary">🔍 Get Recipe (XML)</button>
        </form>
    </div>
    
    <!-- Get Recipe by ID - JSON -->
    <div style="margin: 2rem 0; background: white; padding: 2rem; border-radius: 15px; box-shadow: var(--shadow-md);">
        <h2 style="color: var(--text-dark); margin-top: 0;">🔍 Get Recipe by ID (JSON)</h2>
        <p style="color: var(--text-light); margin-bottom: 1rem;">Retrieve a specific recipe by its ID in JSON format. You can then view or edit the recipe.</p>
        <form method="GET" style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
            <input type="hidden" name="method" value="recipe_json">
            <input type="number" name="id" placeholder="Enter Recipe ID" required value="<?php echo htmlspecialchars($recipeId ?: ''); ?>" 
                   style="padding: 1rem; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 1rem; min-width: 200px; flex: 1;">
            <button type="submit" class="btn btn-primary">🔍 Get Recipe (JSON)</button>
        </form>
    </div>
    
    <!-- Direct API Endpoints -->
    <div class="api-endpoints-section">
        <h2 style="color: var(--text-dark); margin-top: 0;">🌐 Direct API Endpoints</h2>
        <p style="color: var(--text-light); margin-bottom: 1rem;">Access recipes directly via API endpoints (opens in new tab). <strong>Note:</strong> Use the form above to get recipes by any ID.</p>
        <div style="display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 1rem;">
            <a href="recipes_json.php" target="_blank" class="btn btn-secondary">📋 Get ALL Recipes (JSON API)</a>
            <a href="recipes_xml.php" target="_blank" class="btn btn-secondary">📄 Get ALL Recipes (XML API)</a>
        </div>
        <p style="color: var(--text-light); font-size: 0.9rem; margin-top: 1rem;">
            <strong>To get a specific recipe by ID:</strong> Use the "Get Recipe by ID (JSON)" form above, or visit: <code>recipes_json.php?id=YOUR_ID</code>
        </p>
    </div>
    
    <!-- Results Display -->
    <?php if ($result): ?>
        <div class="soap-result" style="margin-top: 2rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h3 style="color: var(--text-dark); margin: 0;">📋 API Response</h3>
                <div style="display: flex; gap: 0.5rem;">
                    <?php if ($resultType == 'json' && $resultData && isset($resultData['id'])): ?>
                        <a href="view_recipe.php?id=<?php echo $resultData['id']; ?>" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem;">👁️ View Recipe</a>
                        <a href="edit_recipe.php?id=<?php echo $resultData['id']; ?>" class="btn btn-success" style="padding: 0.5rem 1rem; font-size: 0.9rem;">✏️ Edit Recipe</a>
                    <?php elseif ($resultType == 'json' && is_array($resultData) && count($resultData) > 0): ?>
                        <span style="color: var(--text-light); font-size: 0.9rem;"><?php echo count($resultData); ?> recipes found</span>
                    <?php endif; ?>
                </div>
            </div>
            
            <?php if ($resultType == 'json' && $resultData && isset($resultData['id'])): ?>
                <!-- Display parsed JSON recipe nicely -->
                <div style="background: white; padding: 1.5rem; border-radius: 10px; margin-bottom: 1rem; border: 2px solid #e2e8f0;">
                    <h4 style="color: var(--primary-color); margin-top: 0;"><?php echo htmlspecialchars($resultData['title'] ?? 'Recipe'); ?></h4>
                    <p style="color: var(--text-light); margin: 0.5rem 0;"><strong>ID:</strong> <?php echo htmlspecialchars($resultData['id'] ?? 'N/A'); ?></p>
                    <p style="color: var(--text-light); margin: 0.5rem 0;"><strong>Ingredients:</strong> <?php echo htmlspecialchars(substr($resultData['ingredients'] ?? '', 0, 100)); ?>...</p>
                    <p style="color: var(--text-light); margin: 0.5rem 0;"><strong>Created:</strong> <?php echo htmlspecialchars($resultData['created_at'] ?? 'N/A'); ?></p>
                </div>
            <?php elseif ($resultType == 'json' && is_array($resultData) && count($resultData) > 0): ?>
                <!-- Display list of recipes from JSON -->
                <div style="background: white; padding: 1.5rem; border-radius: 10px; margin-bottom: 1rem; border: 2px solid var(--primary-color);">
                    <div style="background: linear-gradient(135deg, #c6f6d5 0%, #9ae6b4 100%); padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                        <h4 style="color: #22543d; margin-top: 0; font-size: 1.25rem;">✅ Success! All Recipes Retrieved</h4>
                        <p style="color: #22543d; margin: 0.5rem 0 0 0; font-size: 1rem;">
                            <strong>Total Recipes Found: <?php echo count($resultData); ?> recipes</strong>
                        </p>
                    </div>
                    <p style="color: var(--text-light); margin-bottom: 1rem; font-size: 0.9rem;">
                        Showing <strong>ALL <?php echo count($resultData); ?> recipes</strong> from the database. Click on any recipe to view or edit it.
                    </p>
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1rem; margin-top: 1rem; max-height: 600px; overflow-y: auto; padding: 0.5rem;">
                        <?php foreach ($resultData as $recipe): ?>
                            <div style="padding: 1rem; background: var(--bg-light); border-radius: 8px; border-left: 3px solid var(--primary-color); transition: transform 0.2s;">
                                <strong style="color: var(--text-dark); display: block; margin-bottom: 0.5rem; font-size: 1rem;"><?php echo htmlspecialchars($recipe['title'] ?? 'Untitled'); ?></strong>
                                <p style="margin: 0.25rem 0; font-size: 0.85rem; color: var(--text-light);"><strong>ID:</strong> <?php echo htmlspecialchars($recipe['id'] ?? 'N/A'); ?></p>
                                <p style="margin: 0.25rem 0; font-size: 0.85rem; color: var(--text-light); overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    <?php echo htmlspecialchars(substr($recipe['ingredients'] ?? '', 0, 50)); ?>...
                                </p>
                                <div style="margin-top: 0.75rem; display: flex; gap: 0.5rem;">
                                    <a href="view_recipe.php?id=<?php echo $recipe['id']; ?>" style="font-size: 0.85rem; color: var(--primary-color); text-decoration: none; font-weight: 600; padding: 0.25rem 0.5rem; background: white; border-radius: 4px;">👁️ View</a>
                                    <a href="edit_recipe.php?id=<?php echo $recipe['id']; ?>" style="font-size: 0.85rem; color: var(--success-color); text-decoration: none; font-weight: 600; padding: 0.25rem 0.5rem; background: white; border-radius: 4px;">✏️ Edit</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if (count($resultData) == 1): ?>
                        <div style="background: #feebc8; padding: 1rem; border-radius: 8px; margin-top: 1rem; border-left: 4px solid var(--warning-color);">
                            <p style="color: #744210; margin: 0; font-size: 0.9rem;">
                                <strong>⚠️ Note:</strong> Only 1 recipe found in the database. Add more recipes using the "Add Recipe" page!
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <details style="margin-top: 1rem;">
                <summary style="cursor: pointer; color: var(--primary-color); font-weight: 600; padding: 0.5rem; background: var(--bg-light); border-radius: 5px;">
                    📄 View Raw <?php echo strtoupper($resultType); ?> Response
                </summary>
                <pre style="margin-top: 1rem; max-height: 500px; overflow-y: auto;"><?php echo htmlspecialchars($result); ?></pre>
            </details>
        </div>
    <?php endif; ?>
    
    <!-- API Documentation -->
    <div style="margin-top: 3rem; background: white; padding: 2rem; border-radius: 15px; box-shadow: var(--shadow-md);">
        <h2 style="color: var(--text-dark); margin-top: 0;">📚 API Documentation</h2>
        <div style="margin-top: 1.5rem;">
            <h3 style="color: var(--text-dark); font-size: 1.1rem;">Available Endpoints:</h3>
            <ul style="color: var(--text-light); line-height: 2;">
                <li><strong>GET recipes_json.php</strong> - Returns all recipes as JSON</li>
                <li><strong>GET recipes_json.php?id={ID}</strong> - Returns a specific recipe by ID as JSON</li>
                <li><strong>GET soap_service/recipe_service.php</strong> - SOAP service endpoint</li>
            </ul>
        </div>
        <div style="margin-top: 1.5rem;">
            <h3 style="color: var(--text-dark); font-size: 1.1rem;">Response Formats:</h3>
            <ul style="color: var(--text-light); line-height: 2;">
                <li><strong>XML:</strong> Standard XML format with recipe elements</li>
                <li><strong>JSON:</strong> Array of recipe objects with id, title, ingredients, steps, image_path, created_at, updated_at</li>
            </ul>
        </div>
    </div>
    
    <div style="margin-top: 2rem;">
        <a href="index.php" class="btn btn-secondary">🏠 Back to Home</a>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>

