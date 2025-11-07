<?php
require_once 'config/database.php';
require_once 'classes/RecipeService.php';

$pageTitle = "Import Recipes";
require_once 'includes/header.php';

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $file = $_FILES['file'];
        $fileContent = file_get_contents($file['tmp_name']);
        $fileType = $file['type'];
        
        $recipeService = new RecipeService();
        
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        if ($fileExtension == 'xml' || strpos($fileType, 'xml') !== false) {
            // XML import
            $result = $recipeService->importRecipesFromXML($fileContent);
        } elseif ($fileExtension == 'json' || strpos($fileType, 'json') !== false) {
            // JSON import
            $result = $recipeService->importRecipesFromJSON($fileContent);
        } else {
            $result = ['success' => false, 'message' => 'Unsupported file format. Please upload XML or JSON file.'];
        }
        
        $message = $result['message'];
        $messageType = $result['success'] ? 'success' : 'error';
    } else {
        $message = 'Please select a file to import.';
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
    <h1>📥 Import Recipes</h1>
    <p style="color: var(--text-light); font-size: 1.1rem; margin-bottom: 2rem;">Upload an XML or JSON file to add multiple recipes at once. Great for restoring backups or sharing recipes!</p>
    
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="file">Select File (XML or JSON) *</label>
            <input type="file" id="file" name="file" accept=".xml,.json" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">📥 Import Recipes</button>
            <a href="index.php" class="btn btn-secondary">❌ Cancel</a>
        </div>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>

