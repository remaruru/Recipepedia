<?php
require_once 'config/database.php';
require_once 'classes/RecipeService.php';

$recipeService = new RecipeService();

// Handle file export BEFORE including header (headers must be sent before any HTML)
if (isset($_GET['format'])) {
    $format = $_GET['format'];
    
    if ($format == 'xml') {
        header('Content-Type: application/xml; charset=utf-8');
        header('Content-Disposition: attachment; filename="recipes.xml"');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        echo $recipeService->getRecipesXML();
        exit;
    } elseif ($format == 'json') {
        header('Content-Type: application/json; charset=utf-8');
        header('Content-Disposition: attachment; filename="recipes.json"');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        echo $recipeService->getRecipesJSON();
        exit;
    }
}

// Only include header if we're not exporting
$pageTitle = "Export Recipes";
require_once 'includes/header.php';
?>

<div class="form-container">
    <h1>📤 Export Recipes</h1>
    <p style="color: var(--text-light); font-size: 1.1rem; margin-bottom: 2rem;">Download all your recipes in your preferred format. Perfect for backup or sharing!</p>
    
    <div class="export-options">
        <a href="export_recipes.php?format=xml" class="btn btn-primary">📄 Export as XML</a>
        <a href="export_recipes.php?format=json" class="btn btn-primary">📋 Export as JSON</a>
    </div>

    <p style="margin-top: 2rem;">
        <a href="index.php" class="btn btn-secondary">🏠 Back to Home</a>
    </p>
</div>

<?php require_once 'includes/footer.php'; ?>

