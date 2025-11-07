<?php
require_once 'config/database.php';
require_once 'classes/Recipe.php';
require_once 'classes/RecipeManager.php';

$pageTitle = "View Recipe";
require_once 'includes/header.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$recipeManager = new RecipeManager();
$recipe = $recipeManager->getRecipeById($_GET['id']);

if (!$recipe) {
    header('Location: index.php');
    exit;
}

$pageTitle = htmlspecialchars($recipe->getTitle());
?>

<div class="recipe-view">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; flex-wrap: wrap; gap: 1rem;">
        <h1 style="margin: 0;"><?php echo htmlspecialchars($recipe->getTitle()); ?></h1>
        <div style="background: var(--bg-light); padding: 0.75rem 1.5rem; border-radius: 50px; border: 2px solid var(--picnic-red);">
            <strong style="color: var(--text-dark); font-size: 1.1rem;">ID: <span style="color: var(--primary-color);">#<?php echo $recipe->getId(); ?></span></strong>
        </div>
    </div>
    
    <?php if ($recipe->getImagePath()): ?>
        <div class="recipe-view-image-container">
            <img src="<?php echo htmlspecialchars($recipe->getImagePath()); ?>" alt="<?php echo htmlspecialchars($recipe->getTitle()); ?>">
        </div>
    <?php endif; ?>

    <div class="section">
        <h2>📋 Ingredients</h2>
        <pre><?php echo htmlspecialchars($recipe->getIngredients()); ?></pre>
    </div>

    <div class="section">
        <h2>👨‍🍳 Steps</h2>
        <pre><?php echo htmlspecialchars($recipe->getSteps()); ?></pre>
    </div>

    <div class="actions" style="margin-top: 2rem; padding-top: 2rem; border-top: 2px solid #e2e8f0;">
        <a href="edit_recipe.php?id=<?php echo $recipe->getId(); ?>" class="btn btn-primary">✏️ Edit Recipe</a>
        <a href="index.php" class="btn btn-secondary">🏠 Back to Home</a>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>

