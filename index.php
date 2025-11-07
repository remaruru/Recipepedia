<?php
require_once 'config/database.php';
require_once 'classes/Recipe.php';
require_once 'classes/RecipeManager.php';

$pageTitle = "Home";
require_once 'includes/header.php';

$recipeManager = new RecipeManager();
$search = isset($_GET['search']) ? $_GET['search'] : '';
$recipes = $recipeManager->getAllRecipes($search);
?>

<div class="search-container">
    <form method="GET" action="index.php">
        <input type="text" name="search" placeholder="🔍 Search recipes by name, ingredients, or steps..." value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit" class="btn btn-primary">🔍 Search</button>
        <?php if ($search): ?>
            <a href="index.php" class="btn btn-secondary">❌ Clear</a>
        <?php endif; ?>
    </form>
</div>

<?php if (empty($recipes)): ?>
    <div class="empty-state">
        <div class="empty-state-icon">🍳</div>
        <h2>No Recipes Found</h2>
        <p><?php echo $search ? 'Try a different search term.' : 'Get started by adding your first recipe!'; ?></p>
        <a href="add_recipe.php" class="btn btn-primary">➕ Add Your First Recipe</a>
    </div>
<?php else: ?>
    <div class="recipe-grid">
        <?php foreach ($recipes as $recipe): ?>
            <div class="recipe-card">
                <div class="recipe-card-image-container">
                    <?php if ($recipe->getImagePath()): ?>
                        <img src="<?php echo htmlspecialchars($recipe->getImagePath()); ?>" alt="<?php echo htmlspecialchars($recipe->getTitle()); ?>">
                    <?php else: ?>
                        <div class="recipe-card-image-placeholder">🍽️</div>
                    <?php endif; ?>
                </div>
                <div class="recipe-card-content">
                <h2><?php echo htmlspecialchars($recipe->getTitle()); ?></h2>
                <p><strong>📋 Ingredients:</strong> <?php echo htmlspecialchars(substr($recipe->getIngredients(), 0, 100)); ?>...</p>
                <div class="actions">
                    <a href="view_recipe.php?id=<?php echo $recipe->getId(); ?>" class="btn btn-primary">👁️ View</a>
                    <a href="edit_recipe.php?id=<?php echo $recipe->getId(); ?>" class="btn btn-secondary">✏️ Edit</a>
                </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>

