<?php
require_once 'config/database.php';
require_once 'classes/Recipe.php';
require_once 'classes/RecipeManager.php';

$pageTitle = "Add Recipe";
require_once 'includes/header.php';

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'] ?? '';
    $ingredients = $_POST['ingredients'] ?? '';
    $steps = $_POST['steps'] ?? '';
    $image_path = null;

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
                $image_path = $targetPath;
            }
        }
    }

    if (!empty($title) && !empty($ingredients) && !empty($steps)) {
        $recipe = new Recipe(null, $title, $ingredients, $steps, $image_path);
        $recipeManager = new RecipeManager();
        
        if ($recipeManager->addRecipe($recipe)) {
            $message = 'Recipe added successfully!';
            $messageType = 'success';
            // Clear form
            $_POST = [];
        } else {
            $message = 'Error adding recipe. Please try again.';
            $messageType = 'error';
        }
    } else {
        $message = 'Please fill in all required fields.';
        $messageType = 'error';
    }
}
?>

<?php if ($message): ?>
    <div class="message <?php echo $messageType; ?>">
        <?php echo htmlspecialchars($message); ?>
    </div>
<?php endif; ?>

<div class="form-container">
    <h1>Add New Recipe</h1>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Recipe Title *</label>
            <input type="text" id="title" name="title" required value="<?php echo htmlspecialchars($_POST['title'] ?? ''); ?>">
        </div>

        <div class="form-group">
            <label for="ingredients">Ingredients *</label>
            <textarea id="ingredients" name="ingredients" required><?php echo htmlspecialchars($_POST['ingredients'] ?? ''); ?></textarea>
        </div>

        <div class="form-group">
            <label for="steps">Steps *</label>
            <textarea id="steps" name="steps" required><?php echo htmlspecialchars($_POST['steps'] ?? ''); ?></textarea>
        </div>

        <div class="form-group">
            <label for="image">Recipe Image (Optional)</label>
            <input type="file" id="image" name="image" accept="image/*">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">➕ Add Recipe</button>
            <a href="index.php" class="btn btn-secondary">❌ Cancel</a>
        </div>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>

