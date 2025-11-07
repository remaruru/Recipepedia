<?php
require_once 'config/database.php';
require_once 'classes/Recipe.php';
require_once 'classes/RecipeManager.php';

$pageTitle = "Edit Recipe";
require_once 'includes/header.php';

$recipeManager = new RecipeManager();
$recipe = null;
$message = '';
$messageType = '';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];
$recipe = $recipeManager->getRecipeById($id);

if (!$recipe) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'] ?? '';
    $ingredients = $_POST['ingredients'] ?? '';
    $steps = $_POST['steps'] ?? '';
    $image_path = $recipe->getImagePath();

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = 'uploads/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $fileName;
        
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (in_array($_FILES['image']['type'], $allowedTypes)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                // Delete old image if exists
                if ($image_path && file_exists($image_path)) {
                    unlink($image_path);
                }
                $image_path = $targetPath;
            }
        }
    }

    if (!empty($title) && !empty($ingredients) && !empty($steps)) {
        $recipe->setTitle($title);
        $recipe->setIngredients($ingredients);
        $recipe->setSteps($steps);
        $recipe->setImagePath($image_path);
        
        if ($recipeManager->updateRecipe($recipe)) {
            $message = 'Recipe updated successfully!';
            $messageType = 'success';
        } else {
            $message = 'Error updating recipe. Please try again.';
            $messageType = 'error';
        }
    } else {
        $message = 'Please fill in all required fields.';
        $messageType = 'error';
    }
    
    // Reload recipe to show updated data
    $recipe = $recipeManager->getRecipeById($id);
}
?>

<?php if ($message): ?>
    <div class="message <?php echo $messageType; ?>">
        <?php echo htmlspecialchars($message); ?>
    </div>
<?php endif; ?>

<div class="form-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <h1 style="margin: 0;">Edit Recipe</h1>
        <div style="background: var(--bg-light); padding: 0.75rem 1.5rem; border-radius: 50px; border: 2px solid var(--picnic-red);">
            <strong style="color: var(--text-dark); font-size: 1.1rem;">ID: <span style="color: var(--primary-color);">#<?php echo $recipe->getId(); ?></span></strong>
        </div>
    </div>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Recipe Title *</label>
            <input type="text" id="title" name="title" required value="<?php echo htmlspecialchars($recipe->getTitle()); ?>">
        </div>

        <div class="form-group">
            <label for="ingredients">Ingredients *</label>
            <textarea id="ingredients" name="ingredients" required><?php echo htmlspecialchars($recipe->getIngredients()); ?></textarea>
        </div>

        <div class="form-group">
            <label for="steps">Steps *</label>
            <textarea id="steps" name="steps" required><?php echo htmlspecialchars($recipe->getSteps()); ?></textarea>
        </div>

        <div class="form-group">
            <label for="image">Recipe Image (Optional)</label>
            <?php if ($recipe->getImagePath()): ?>
                <p>Current image: <img src="<?php echo htmlspecialchars($recipe->getImagePath()); ?>" alt="Current" style="max-width:200px; display:block; margin-top:0.5rem;"></p>
            <?php endif; ?>
            <input type="file" id="image" name="image" accept="image/*">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">💾 Update Recipe</button>
            <a href="view_recipe.php?id=<?php echo $recipe->getId(); ?>" class="btn btn-secondary">❌ Cancel</a>
        </div>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>

