# Recipepedia - Complete Functionality Documentation

## Table of Contents
1. [Project Overview](#project-overview)
2. [System Architecture](#system-architecture)
3. [Database Structure](#database-structure)
4. [Core Classes & OOP Implementation](#core-classes--oop-implementation)
5. [User Interface Pages](#user-interface-pages)
6. [API Endpoints & Web Services](#api-endpoints--web-services)
7. [File Processing](#file-processing)
8. [Security Features](#security-features)
9. [User Flows & Use Cases](#user-flows--use-cases)
10. [Technical Implementation Details](#technical-implementation-details)
11. [Features Breakdown](#features-breakdown)

---

## Project Overview

**Recipepedia** is a Wikipedia-style Recipe Storage and Sharing Service that allows users to view, add, edit, and share recipes without requiring user authentication. The application is built using PHP, MySQL, and features a modern red and white picnic-themed user interface.

### Key Characteristics
- **No Authentication Required**: Anyone can view, add, and edit recipes (Wikipedia-style)
- **Local Development**: Designed to run on XAMPP (Apache + MySQL + PHP)
- **Multiple Data Formats**: Supports XML and JSON for import/export
- **Web Services**: Includes SOAP web service and RESTful JSON/XML APIs
- **File Uploads**: Supports image uploads for recipes
- **Responsive Design**: Works on desktop and mobile devices

---

## System Architecture

### Technology Stack
- **Backend**: PHP 7.4+
- **Database**: MySQL (via PDO)
- **Frontend**: HTML5, CSS3, JavaScript (Vanilla)
- **Web Server**: Apache (XAMPP)
- **Web Services**: SOAP, REST (JSON/XML)

### Project Structure
```
Recipedia/
├── assets/
│   └── css/
│       └── style.css          # Main stylesheet (picnic theme)
├── classes/                   # OOP Classes
│   ├── Recipe.php            # Recipe entity class
│   ├── RecipeManager.php     # Database operations (CRUD)
│   └── RecipeService.php     # XML/JSON conversion services
├── config/
│   └── database.php          # Database connection configuration
├── database/
│   ├── schema.sql            # Database schema with sample data
│   └── sample_recipes.sql    # Additional sample recipes (24+)
├── includes/
│   ├── header.php            # Header with navigation & emoji animations
│   └── footer.php            # Footer
├── soap_service/
│   └── recipe_service.php    # SOAP web service endpoint
├── uploads/                  # User-uploaded recipe images
│   └── .htaccess             # Security configuration
├── add_recipe.php            # Add new recipe page
├── add_sample_recipes.php    # Script to add sample recipes
├── edit_recipe.php           # Edit recipe page
├── export_recipes.php        # Export recipes to XML/JSON
├── import_recipes.php        # Import recipes from XML/JSON
├── index.php                 # Home page with recipe list
├── recipes_json.php          # JSON API endpoint
├── recipes_xml.php           # XML API endpoint
├── soap_client.php           # SOAP client test interface
├── view_recipe.php           # View recipe details page
├── sample_recipes.xml        # Sample XML export file
├── sample_recipes.json       # Sample JSON export file
└── README.md                 # Project documentation
```

---

## Database Structure

### Database: `recipepedia`

### Table: `recipes`

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| `id` | INT | PRIMARY KEY, AUTO_INCREMENT | Unique recipe identifier |
| `title` | VARCHAR(255) | NOT NULL | Recipe title/name |
| `ingredients` | TEXT | NOT NULL | Recipe ingredients list |
| `steps` | TEXT | NOT NULL | Cooking instructions/steps |
| `image_path` | VARCHAR(500) | NULL | Path to uploaded image file |
| `created_at` | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP | Recipe creation timestamp |
| `updated_at` | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP ON UPDATE | Last update timestamp |

### Database Relationships
- No foreign keys (single table design)
- Self-contained recipe storage

### Sample Data
- Database includes 2 default sample recipes (Pancakes, Chocolate Cake)
- Additional 24+ sample recipes available via `add_sample_recipes.php`

---

## Core Classes & OOP Implementation

### 1. Recipe Class (`classes/Recipe.php`)

**Purpose**: Represents a recipe entity with all its properties and methods.

**Properties**:
- `$id` - Recipe unique identifier
- `$title` - Recipe title
- `$ingredients` - Recipe ingredients
- `$steps` - Cooking steps
- `$image_path` - Path to recipe image
- `$created_at` - Creation timestamp
- `$updated_at` - Last update timestamp

**Methods**:
- `__construct($id, $title, $ingredients, $steps, $image_path)` - Constructor
- `getId()` - Get recipe ID
- `getTitle()` - Get recipe title
- `getIngredients()` - Get ingredients
- `getSteps()` - Get cooking steps
- `getImagePath()` - Get image path
- `getCreatedAt()` - Get creation timestamp
- `getUpdatedAt()` - Get update timestamp
- `setTitle($title)` - Set recipe title
- `setIngredients($ingredients)` - Set ingredients
- `setSteps($steps)` - Set cooking steps
- `setImagePath($image_path)` - Set image path
- `toArray()` - Convert recipe to associative array
- `fromArray($data)` - Create recipe from associative array (static method)

**OOP Concepts Used**:
- Encapsulation (private properties, public getters/setters)
- Constructor for object initialization
- Static method for factory pattern
- Data transformation methods

---

### 2. RecipeManager Class (`classes/RecipeManager.php`)

**Purpose**: Handles all database operations (CRUD) for recipes.

**Properties**:
- `$conn` - PDO database connection object

**Methods**:
- `__construct()` - Initialize database connection
- `getAllRecipes($search = '')` - Get all recipes with optional search filter
- `getRecipeById($id)` - Get single recipe by ID
- `addRecipe($recipe)` - Insert new recipe into database
- `updateRecipe($recipe)` - Update existing recipe
- `deleteRecipe($id)` - Delete recipe by ID
- `getAllRecipesAsArray()` - Get all recipes as array (for export)

**Database Operations**:
- Uses PDO prepared statements for security
- Implements search functionality (searches title, ingredients, steps)
- Handles NULL values for optional fields
- Returns Recipe objects or arrays

**Security Features**:
- Prepared statements prevent SQL injection
- Parameter binding with `bindParam()`
- Input sanitization handled by PDO

---

### 3. RecipeService Class (`classes/RecipeService.php`)

**Purpose**: Handles XML/JSON conversion, import/export, and SOAP service methods.

**Properties**:
- `$recipeManager` - RecipeManager instance

**Methods**:
- `__construct()` - Initialize RecipeManager
- `getRecipesXML()` - Convert all recipes to XML format
- `getRecipesJSON()` - Convert all recipes to JSON format
- `getRecipeByIdXML($id)` - Get single recipe as XML
- `importRecipesFromXML($xmlString)` - Import recipes from XML string
- `importRecipesFromJSON($jsonString)` - Import recipes from JSON string

**XML Handling**:
- Uses `SimpleXMLElement` for XML generation
- Escapes HTML special characters
- Creates structured XML with recipe elements

**JSON Handling**:
- Uses `json_encode()` with `JSON_PRETTY_PRINT`
- Handles array conversion
- Returns formatted JSON

**Import Functionality**:
- Validates XML/JSON format
- Processes multiple recipes at once
- Returns success/error messages
- Handles exceptions gracefully

---

### 4. Database Class (`config/database.php`)

**Purpose**: Manages database connection using PDO.

**Properties**:
- `$host` - Database host (localhost)
- `$dbname` - Database name (recipepedia)
- `$username` - Database username (root)
- `$password` - Database password (empty by default)

**Methods**:
- `__construct()` - Establish PDO connection
- `getConnection()` - Return PDO connection object

**Configuration**:
- Default: localhost, root user, no password
- Configurable for different environments
- Error handling for connection failures

---

## User Interface Pages

### 1. Home Page (`index.php`)

**URL**: `http://localhost/Recipedia/` or `http://localhost/Recipedia/index.php`

**Functionality**:
- **Display All Recipes**: Shows all recipes in a grid layout
- **Search Functionality**: Real-time search by title, ingredients, or steps
- **Recipe Cards**: Each recipe displayed in a card with:
  - Recipe image (or placeholder emoji 🍽️)
  - Recipe title
  - Preview of ingredients (first 100 characters)
  - View button (👁️)
  - Edit button (✏️)
- **Empty State**: Shows message when no recipes found
- **Clear Search**: Button to clear search and show all recipes

**User Interactions**:
1. User types in search bar → Filters recipes in real-time
2. User clicks "View" → Redirects to `view_recipe.php?id={ID}`
3. User clicks "Edit" → Redirects to `edit_recipe.php?id={ID}`
4. User clicks "Clear" → Removes search filter

**Technical Details**:
- Uses `RecipeManager->getAllRecipes($search)` for data retrieval
- GET parameter `?search=` for search functionality
- Responsive grid layout (CSS Grid)
- Card-based design with hover effects

---

### 2. Add Recipe Page (`add_recipe.php`)

**URL**: `http://localhost/Recipedia/add_recipe.php`

**Functionality**:
- **Form Fields**:
  - Recipe Title (required, text input)
  - Ingredients (required, textarea)
  - Steps (required, textarea)
  - Recipe Image (optional, file upload)
- **Image Upload**:
  - Accepts JPEG, JPG, PNG, GIF
  - Validates file type
  - Stores in `uploads/` directory
  - Filename: `{timestamp}_{original_filename}`
- **Form Validation**:
  - Client-side: HTML5 `required` attribute
  - Server-side: Checks for empty required fields
- **Success/Error Messages**: Displays feedback after submission
- **Cancel Button**: Returns to home page

**User Flow**:
1. User fills in recipe details
2. User optionally uploads an image
3. User clicks "Add Recipe" button
4. System validates input
5. System creates recipe in database
6. System displays success message
7. Form is cleared for next recipe

**Technical Details**:
- POST method with `enctype="multipart/form-data"` for file uploads
- Creates `uploads/` directory if it doesn't exist
- Uses `RecipeManager->addRecipe()` to insert recipe
- Handles file upload errors gracefully

---

### 3. Edit Recipe Page (`edit_recipe.php`)

**URL**: `http://localhost/Recipedia/edit_recipe.php?id={ID}`

**Functionality**:
- **Recipe ID Display**: Shows recipe ID in a badge (non-editable)
- **Pre-filled Form**: Loads existing recipe data
- **Form Fields** (same as Add Recipe):
  - Recipe Title (required)
  - Ingredients (required)
  - Steps (required)
  - Recipe Image (optional)
- **Current Image Display**: Shows existing image if available
- **Image Update**: Allows replacing existing image
- **Image Deletion**: Automatically deletes old image when new one is uploaded
- **Update Button**: Saves changes to database
- **Cancel Button**: Returns to view recipe page

**User Flow**:
1. User clicks "Edit" on a recipe card
2. System loads recipe data by ID
3. Form is pre-filled with existing data
4. User modifies recipe details
5. User optionally uploads new image
6. User clicks "Update Recipe"
7. System validates and updates database
8. System displays success message
9. Recipe is reloaded with updated data

**Technical Details**:
- GET parameter `?id={ID}` to identify recipe
- Uses `RecipeManager->getRecipeById($id)` to load recipe
- Uses `RecipeManager->updateRecipe($recipe)` to save changes
- Deletes old image file when new image is uploaded
- Validates recipe exists before editing

---

### 4. View Recipe Page (`view_recipe.php`)

**URL**: `http://localhost/Recipedia/view_recipe.php?id={ID}`

**Functionality**:
- **Recipe Header**: 
  - Recipe title
  - Recipe ID badge (displayed prominently)
- **Recipe Image**: Large display of recipe image (if available)
- **Ingredients Section**: Full ingredients list with 📋 emoji
- **Steps Section**: Full cooking steps with 👨‍🍳 emoji
- **Action Buttons**:
  - Edit Recipe button (✏️)
  - Back to Home button (🏠)

**User Flow**:
1. User clicks "View" on a recipe card
2. System loads recipe by ID
3. Recipe details are displayed
4. User can click "Edit Recipe" to modify
5. User can click "Back to Home" to return

**Technical Details**:
- GET parameter `?id={ID}` to identify recipe
- Uses `RecipeManager->getRecipeById($id)` to load recipe
- Displays recipe ID in a styled badge
- Shows full recipe information
- HTML escaping for security

---

### 5. Export Recipes Page (`export_recipes.php`)

**URL**: `http://localhost/Recipedia/export_recipes.php`

**Functionality**:
- **Export Options**:
  - Export as XML button (📄)
  - Export as JSON button (📋)
- **File Download**: Downloads file automatically when button is clicked
- **File Format**:
  - XML: `recipes.xml`
  - JSON: `recipes.json`

**User Flow**:
1. User clicks "Export" in navigation
2. User chooses XML or JSON format
3. System generates file with all recipes
4. File is downloaded to user's computer
5. User can use file for backup or sharing

**Technical Details**:
- Export logic runs BEFORE header includes (to send proper headers)
- Sets `Content-Type` header (application/xml or application/json)
- Sets `Content-Disposition` header (attachment; filename="recipes.{format}")
- Uses `RecipeService->getRecipesXML()` or `getRecipesJSON()`
- Exits after sending file (no HTML output)

---

### 6. Import Recipes Page (`import_recipes.php`)

**URL**: `http://localhost/Recipedia/import_recipes.php`

**Functionality**:
- **File Upload Form**:
  - File input (accepts .xml and .json files)
  - Upload button (📥)
- **File Validation**:
  - Checks file extension (.xml or .json)
  - Checks MIME type
  - Validates file format
- **Import Processing**:
  - Parses XML or JSON file
  - Creates Recipe objects
  - Inserts recipes into database
  - Shows success/error message
- **Results Display**: Shows number of recipes imported

**User Flow**:
1. User clicks "Import" in navigation
2. User selects XML or JSON file
3. User clicks "Import Recipes"
4. System validates file format
5. System parses and imports recipes
6. System displays success message with count
7. User can view imported recipes on home page

**Technical Details**:
- POST method with `enctype="multipart/form-data"`
- Uses `file_get_contents()` to read uploaded file
- Detects file format using `pathinfo()` and MIME type
- Uses `RecipeService->importRecipesFromXML()` or `importRecipesFromJSON()`
- Handles errors gracefully with user-friendly messages

---

### 7. SOAP Client Page (`soap_client.php`)

**URL**: `http://localhost/Recipedia/soap_client.php`

**Functionality**:
- **Database Status**: Shows total number of recipes and available IDs
- **Get All Recipes**:
  - Get ALL Recipes (XML) button
  - Get ALL Recipes (JSON) button
- **Get Recipe by ID**:
  - Get Recipe by ID (XML) form with ID input
  - Get Recipe by ID (JSON) form with ID input
- **Direct API Endpoints**:
  - Links to `recipes_json.php` and `recipes_xml.php`
- **Results Display**:
  - Formatted display of recipe(s)
  - View and Edit buttons for JSON results
  - Raw XML/JSON response in collapsible section
- **API Documentation**: Lists available endpoints and response formats

**User Flow**:
1. User clicks "API" in navigation
2. User sees database status (total recipes, available IDs)
3. User clicks "Get ALL Recipes" button
4. System displays all recipes in selected format
5. User can click "Get Recipe by ID" and enter an ID
6. System displays single recipe
7. User can click "View" or "Edit" buttons (for JSON results)
8. User can view raw response in collapsible section

**Technical Details**:
- GET parameters: `?method={xml|json|recipe|recipe_json}&id={ID}`
- Uses `RecipeService` methods for data retrieval
- Parses JSON responses for formatted display
- Displays recipe cards for multiple results
- Shows single recipe card for ID-based queries
- Links to view/edit pages for easy navigation

---

### 8. Header (`includes/header.php`)

**Functionality**:
- **Navigation Bar**:
  - Home link (🏠)
  - Add Recipe link (➕)
  - Export link (📤)
  - Import link (📥)
  - API link (🔌)
- **Logo/Title**: "🍕 Recipepedia" (clickable, links to home)
- **Animated Background**:
  - Left column: Red background with floating food emojis (scrolling down)
  - Right column: Red background with floating food emojis (scrolling up)
  - Center: White background for content
- **Styling**: Includes main CSS file

**Technical Details**:
- Inline CSS for emoji animations
- Two columns of emojis for seamless looping
- CSS animations: `@keyframes scrollDownLeft` and `@keyframes scrollUpRight`
- Responsive design with flexbox
- Black borders on header (5px solid)

---

### 9. Footer (`includes/footer.php`)

**Functionality**:
- **Copyright Text**: "© 2025 Recipepedia. All rights reserved."
- **Styling**: Consistent with header design

---

## API Endpoints & Web Services

### 1. JSON API Endpoint (`recipes_json.php`)

**URL**: `http://localhost/Recipedia/recipes_json.php`

**Methods**:
- **GET** (no parameters): Returns all recipes as JSON array
- **GET** (`?id={ID}`): Returns single recipe as JSON object

**Response Format (All Recipes)**:
```json
[
  {
    "id": 1,
    "title": "Pancakes",
    "ingredients": "2 cups flour, 2 eggs...",
    "steps": "1. Mix dry ingredients...",
    "image_path": "uploads/1234567890_pancakes.jpg",
    "created_at": "2025-01-01 12:00:00",
    "updated_at": "2025-01-01 12:00:00"
  },
  ...
]
```

**Response Format (Single Recipe)**:
```json
{
  "id": 1,
  "title": "Pancakes",
  "ingredients": "2 cups flour, 2 eggs...",
  "steps": "1. Mix dry ingredients...",
  "image_path": "uploads/1234567890_pancakes.jpg",
  "created_at": "2025-01-01 12:00:00",
  "updated_at": "2025-01-01 12:00:00"
}
```

**Error Response**:
```json
{
  "error": "Recipe not found"
}
```

**HTTP Headers**:
- `Content-Type: application/json; charset=utf-8`
- `404 Not Found` (if recipe not found)

**Technical Details**:
- Uses `RecipeService->getRecipesJSON()` for all recipes
- Uses `RecipeManager->getRecipeById($id)` for single recipe
- Returns `JSON_PRETTY_PRINT` formatted JSON
- Handles 404 errors for non-existent recipes

---

### 2. XML API Endpoint (`recipes_xml.php`)

**URL**: `http://localhost/Recipedia/recipes_xml.php`

**Methods**:
- **GET** (no parameters): Returns all recipes as XML
- **GET** (`?id={ID}`): Returns single recipe as XML

**Response Format (All Recipes)**:
```xml
<?xml version="1.0" encoding="UTF-8"?>
<recipes>
  <recipe>
    <id>1</id>
    <title>Pancakes</title>
    <ingredients>2 cups flour, 2 eggs...</ingredients>
    <steps>1. Mix dry ingredients...</steps>
    <image_path>uploads/1234567890_pancakes.jpg</image_path>
    <created_at>2025-01-01 12:00:00</created_at>
    <updated_at>2025-01-01 12:00:00</updated_at>
  </recipe>
  ...
</recipes>
```

**Response Format (Single Recipe)**:
```xml
<?xml version="1.0" encoding="UTF-8"?>
<recipe>
  <id>1</id>
  <title>Pancakes</title>
  <ingredients>2 cups flour, 2 eggs...</ingredients>
  <steps>1. Mix dry ingredients...</steps>
  <image_path>uploads/1234567890_pancakes.jpg</image_path>
  <created_at>2025-01-01 12:00:00</created_at>
  <updated_at>2025-01-01 12:00:00</updated_at>
</recipe>
```

**Error Response**:
```xml
<?xml version="1.0" encoding="UTF-8"?>
<error>Recipe not found</error>
```

**HTTP Headers**:
- `Content-Type: application/xml; charset=utf-8`

**Technical Details**:
- Uses `RecipeService->getRecipesXML()` for all recipes
- Uses `RecipeService->getRecipeByIdXML($id)` for single recipe
- Uses `SimpleXMLElement` for XML generation
- Escapes HTML special characters

---

### 3. SOAP Web Service (`soap_service/recipe_service.php`)

**URL**: `http://localhost/Recipedia/soap_service/recipe_service.php`

**Methods**:
- **POST**: Handles SOAP requests
- **GET**: Returns XML of all recipes (direct access)

**SOAP Methods** (available via POST):
1. **getRecipesXML()** - Returns all recipes as XML string
2. **getRecipesJSON()** - Returns all recipes as JSON string
3. **getRecipeByIdXML($id)** - Returns single recipe as XML string

**SOAP Configuration**:
- Non-WSDL mode (simpler setup)
- URI: `http://localhost/Recipedia/soap_service/recipe_service.php`
- Uses `SoapServer` class
- Handles SOAP faults

**GET Request Handling**:
- Returns XML of all recipes directly
- Useful for testing and direct access
- Same format as XML API endpoint

**Error Handling**:
- Returns SOAP fault on error
- Checks for SOAP extension availability
- Handles exceptions gracefully

**Technical Details**:
- Requires SOAP extension in PHP
- Uses `RecipeService` class for method implementations
- Handles both SOAP POST and direct GET requests
- Returns proper HTTP headers

---

## File Processing

### 1. Image Upload

**Supported Formats**:
- JPEG (.jpg, .jpeg)
- PNG (.png)
- GIF (.gif)

**Upload Process**:
1. User selects image file in form
2. System validates file type (MIME type check)
3. System generates unique filename: `{timestamp}_{original_filename}`
4. System moves file to `uploads/` directory
5. System stores file path in database

**File Storage**:
- Directory: `uploads/`
- Auto-created if it doesn't exist
- Permissions: 0777 (full access)
- Security: `.htaccess` prevents direct PHP execution

**Image Display**:
- Recipe cards: Thumbnail display
- View recipe: Large image display
- Edit recipe: Preview of current image
- Placeholder: 🍽️ emoji if no image

**Image Update**:
- When editing recipe with new image:
  1. System uploads new image
  2. System deletes old image file (if exists)
  3. System updates database with new path

**Security Features**:
- File type validation (MIME type)
- File extension check
- Stored outside web root (optional)
- `.htaccess` protection

---

### 2. XML File Processing

**Export Process**:
1. System retrieves all recipes from database
2. System creates `SimpleXMLElement` root element
3. System loops through recipes and creates XML elements
4. System escapes HTML special characters
5. System outputs XML with proper headers

**Import Process**:
1. User uploads XML file
2. System reads file content
3. System validates XML format using `simplexml_load_string()`
4. System loops through `<recipe>` elements
5. System creates Recipe objects
6. System inserts recipes into database
7. System returns success/error message

**XML Structure**:
```xml
<?xml version="1.0" encoding="UTF-8"?>
<recipes>
  <recipe>
    <id>1</id>
    <title>Recipe Title</title>
    <ingredients>Ingredients list</ingredients>
    <steps>Cooking steps</steps>
    <image_path>Path to image</image_path>
    <created_at>Timestamp</created_at>
    <updated_at>Timestamp</updated_at>
  </recipe>
</recipes>
```

**Error Handling**:
- Invalid XML format: Returns error message
- Missing elements: Handles gracefully
- Database errors: Returns error message

---

### 3. JSON File Processing

**Export Process**:
1. System retrieves all recipes from database
2. System converts recipes to arrays
3. System encodes arrays to JSON using `json_encode()`
4. System outputs JSON with `JSON_PRETTY_PRINT` formatting
5. System sets proper headers

**Import Process**:
1. User uploads JSON file
2. System reads file content
3. System validates JSON format using `json_decode()`
4. System loops through recipe arrays
5. System creates Recipe objects using `Recipe::fromArray()`
6. System inserts recipes into database
7. System returns success/error message

**JSON Structure**:
```json
[
  {
    "id": 1,
    "title": "Recipe Title",
    "ingredients": "Ingredients list",
    "steps": "Cooking steps",
    "image_path": "Path to image",
    "created_at": "Timestamp",
    "updated_at": "Timestamp"
  }
]
```

**Error Handling**:
- Invalid JSON format: Returns error message
- Missing fields: Handles gracefully
- Database errors: Returns error message

---

## Security Features

### 1. SQL Injection Prevention
- **Prepared Statements**: All database queries use PDO prepared statements
- **Parameter Binding**: Uses `bindParam()` to bind parameters
- **No String Concatenation**: Never concatenates user input into SQL queries

**Example**:
```php
$stmt = $this->conn->prepare("SELECT * FROM recipes WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
```

### 2. XSS (Cross-Site Scripting) Prevention
- **HTML Escaping**: All user input is escaped using `htmlspecialchars()`
- **Output Encoding**: All displayed data is properly encoded
- **No Raw Output**: Never outputs user input directly without escaping

**Example**:
```php
echo htmlspecialchars($recipe->getTitle());
```

### 3. File Upload Security
- **File Type Validation**: Checks MIME type and file extension
- **Allowed Types Only**: Only accepts image files (JPEG, PNG, GIF)
- **Unique Filenames**: Prevents filename conflicts and overwrites
- **Directory Protection**: `.htaccess` prevents direct PHP execution

### 4. Input Validation
- **Required Fields**: Client-side and server-side validation
- **Type Checking**: Validates data types (integers for IDs)
- **Sanitization**: Cleans input data before processing

### 5. Error Handling
- **Graceful Failures**: Errors don't expose system information
- **User-Friendly Messages**: Clear error messages for users
- **No Stack Traces**: Production errors don't show debug information

---

## User Flows & Use Cases

### Use Case 1: Adding a New Recipe

**Actor**: User (anyone, no login required)

**Preconditions**: 
- User has access to the website
- Database is accessible

**Main Flow**:
1. User navigates to home page
2. User clicks "➕ Add Recipe" in navigation
3. User fills in recipe form:
   - Enters recipe title
   - Enters ingredients
   - Enters cooking steps
   - (Optional) Uploads recipe image
4. User clicks "Add Recipe" button
5. System validates input
6. System uploads image (if provided)
7. System creates recipe in database
8. System displays success message
9. Form is cleared
10. User can add another recipe or return home

**Alternative Flow**:
- If validation fails: System displays error message, user corrects and resubmits
- If image upload fails: System continues without image, recipe is still created

**Postconditions**:
- New recipe is stored in database
- Recipe is visible on home page
- Recipe can be viewed, edited, or exported

---

### Use Case 2: Editing an Existing Recipe

**Actor**: User (anyone, no login required)

**Preconditions**:
- Recipe exists in database
- User knows recipe ID or finds recipe on home page

**Main Flow**:
1. User navigates to home page
2. User finds recipe to edit
3. User clicks "✏️ Edit" button on recipe card
4. System loads recipe data
5. User modifies recipe details:
   - Changes title, ingredients, or steps
   - (Optional) Uploads new image
6. User clicks "Update Recipe" button
7. System validates input
8. System uploads new image (if provided)
9. System deletes old image (if new image uploaded)
10. System updates recipe in database
11. System displays success message
12. Recipe is reloaded with updated data

**Alternative Flow**:
- If recipe doesn't exist: System redirects to home page
- If validation fails: System displays error message

**Postconditions**:
- Recipe is updated in database
- Updated recipe is visible on home page
- Old image is deleted (if replaced)

---

### Use Case 3: Viewing a Recipe

**Actor**: User (anyone, no login required)

**Preconditions**:
- Recipe exists in database

**Main Flow**:
1. User navigates to home page
2. User finds recipe to view
3. User clicks "👁️ View" button on recipe card
4. System loads recipe by ID
5. System displays:
   - Recipe title and ID badge
   - Recipe image (if available)
   - Full ingredients list
   - Full cooking steps
6. User can click "Edit Recipe" to modify
7. User can click "Back to Home" to return

**Postconditions**:
- User has viewed recipe details
- User can edit or return home

---

### Use Case 4: Searching for Recipes

**Actor**: User (anyone, no login required)

**Preconditions**:
- Recipes exist in database

**Main Flow**:
1. User navigates to home page
2. User types search term in search bar
3. System filters recipes in real-time:
   - Searches in title
   - Searches in ingredients
   - Searches in steps
4. System displays matching recipes
5. User can click on recipe to view or edit
6. User can clear search to show all recipes

**Alternative Flow**:
- If no results: System displays "No Recipes Found" message

**Postconditions**:
- User sees filtered recipes
- User can view, edit, or clear search

---

### Use Case 5: Exporting Recipes

**Actor**: User (anyone, no login required)

**Preconditions**:
- Recipes exist in database

**Main Flow**:
1. User navigates to home page
2. User clicks "📤 Export" in navigation
3. User chooses format (XML or JSON)
4. User clicks export button
5. System generates file with all recipes
6. System sends file to browser
7. File is downloaded to user's computer
8. User can use file for backup or sharing

**Postconditions**:
- User has downloaded recipes file
- File can be imported later or shared

---

### Use Case 6: Importing Recipes

**Actor**: User (anyone, no login required)

**Preconditions**:
- User has XML or JSON file with recipes

**Main Flow**:
1. User navigates to home page
2. User clicks "📥 Import" in navigation
3. User selects XML or JSON file
4. User clicks "Import Recipes" button
5. System validates file format
6. System parses file
7. System creates Recipe objects
8. System inserts recipes into database
9. System displays success message with count
10. User can view imported recipes on home page

**Alternative Flow**:
- If file format is invalid: System displays error message
- If file is empty: System displays error message

**Postconditions**:
- Recipes are imported into database
- Imported recipes are visible on home page

---

### Use Case 7: Using the API

**Actor**: Developer or System

**Preconditions**:
- API endpoint is accessible
- Recipes exist in database

**Main Flow (JSON API)**:
1. Developer sends GET request to `recipes_json.php`
2. System retrieves all recipes from database
3. System converts recipes to JSON
4. System returns JSON response
5. Developer receives JSON data

**Main Flow (XML API)**:
1. Developer sends GET request to `recipes_xml.php`
2. System retrieves all recipes from database
3. System converts recipes to XML
4. System returns XML response
5. Developer receives XML data

**Main Flow (SOAP Service)**:
1. Developer creates SOAP client
2. Developer calls SOAP method (e.g., `getRecipesXML()`)
3. System processes SOAP request
4. System returns SOAP response
5. Developer receives data

**Postconditions**:
- Developer has recipe data in requested format
- Data can be used in other applications

---

## Technical Implementation Details

### 1. Object-Oriented Programming (OOP)

**Classes Implemented**:
1. **Recipe** - Entity class representing a recipe
2. **RecipeManager** - Service class for database operations
3. **RecipeService** - Service class for XML/JSON conversion
4. **Database** - Utility class for database connection

**OOP Concepts Used**:
- **Encapsulation**: Private properties with public getters/setters
- **Abstraction**: Classes hide implementation details
- **Polymorphism**: Methods can work with different data types
- **Static Methods**: `Recipe::fromArray()` for factory pattern
- **Constructor**: Object initialization
- **Method Overloading**: Not used (PHP doesn't support directly)

---

### 2. Database Connectivity

**Technology**: PDO (PHP Data Objects)

**Connection Method**:
```php
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
```

**Prepared Statements**:
- All queries use prepared statements
- Parameters are bound using `bindParam()`
- Prevents SQL injection attacks

**Error Handling**:
- PDO exceptions are caught and handled
- User-friendly error messages
- Database errors don't expose system information

---

### 3. Web Services (SOAP)

**SOAP Server Implementation**:
- Uses PHP's `SoapServer` class
- Non-WSDL mode for simplicity
- Handles SOAP requests via POST
- Returns SOAP responses

**SOAP Methods**:
1. `getRecipesXML()` - Returns all recipes as XML
2. `getRecipesJSON()` - Returns all recipes as JSON
3. `getRecipeByIdXML($id)` - Returns single recipe as XML

**SOAP Client Testing**:
- `soap_client.php` provides interactive testing interface
- Can test all SOAP methods
- Displays results in formatted way

---

### 4. XML Handling

**Technology**: SimpleXML

**XML Generation**:
```php
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><recipes></recipes>');
$recipeElement = $xml->addChild('recipe');
$recipeElement->addChild('title', htmlspecialchars($title));
```

**XML Parsing**:
```php
$xml = simplexml_load_string($xmlString);
foreach ($xml->recipe as $recipeData) {
    // Process recipe
}
```

**Features**:
- Escapes HTML special characters
- Creates structured XML
- Handles errors gracefully

---

### 5. JSON Data Encoding and Decoding

**JSON Encoding**:
```php
$json = json_encode($recipes, JSON_PRETTY_PRINT);
```

**JSON Decoding**:
```php
$data = json_decode($jsonString, true);
```

**Features**:
- Pretty printing for readability
- Associative arrays for easier handling
- Error handling for invalid JSON

---

### 6. Client URL Functions (cURL)

**Usage**:
- SOAP client uses PHP's SoapClient (which uses cURL internally)
- Can be used to test SOAP service
- Can be used to call JSON/XML API endpoints

**Example**:
```php
$client = new SoapClient(null, [
    'location' => 'http://localhost/Recipedia/soap_service/recipe_service.php',
    'uri' => 'http://localhost/Recipedia/soap_service/recipe_service.php'
]);
$result = $client->getRecipesXML();
```

---

## Features Breakdown

### 1. Recipe Management

**Add Recipe**:
- Form-based input
- Image upload support
- Validation
- Success/error feedback

**Edit Recipe**:
- Pre-filled form
- Image update support
- ID display
- Validation

**View Recipe**:
- Full recipe details
- Image display
- ID badge
- Edit/Home navigation

**Delete Recipe**:
- Available via RecipeManager class
- Not exposed in UI (can be added)

**Search Recipes**:
- Real-time search
- Searches title, ingredients, steps
- Case-insensitive
- Clear search option

---

### 2. Data Import/Export

**Export**:
- XML format
- JSON format
- File download
- All recipes included

**Import**:
- XML file support
- JSON file support
- File validation
- Batch import
- Success/error feedback

---

### 3. API & Web Services

**JSON API**:
- Get all recipes
- Get recipe by ID
- RESTful design
- Proper HTTP headers

**XML API**:
- Get all recipes
- Get recipe by ID
- Standard XML format
- Proper HTTP headers

**SOAP Service**:
- Multiple methods
- XML/JSON support
- Error handling
- Client testing interface

---

### 4. User Interface

**Design Theme**:
- Red and white picnic theme
- Chessboard-like pattern
- Floating food emojis
- Black borders
- Modern card layout

**Responsive Design**:
- Works on desktop
- Works on mobile
- Flexible grid layout
- Adaptive navigation

**User Experience**:
- Clear navigation
- Intuitive forms
- Success/error messages
- Loading states
- Hover effects

---

### 5. Security

**SQL Injection Prevention**:
- Prepared statements
- Parameter binding
- Input validation

**XSS Prevention**:
- HTML escaping
- Output encoding
- No raw output

**File Upload Security**:
- File type validation
- MIME type checking
- Directory protection
- Unique filenames

---

## Summary

Recipepedia is a comprehensive recipe storage and sharing application that demonstrates:

1. **Object-Oriented Programming**: Four core classes with proper OOP principles
2. **Database Connectivity**: PDO with prepared statements for secure database operations
3. **File Processing**: Image uploads and XML/JSON file handling
4. **Web Services**: SOAP web service with multiple methods
5. **XML Handling**: XML generation and parsing using SimpleXML
6. **JSON Encoding/Decoding**: JSON export/import functionality
7. **cURL Integration**: SOAP client testing and API consumption

The application provides a complete user experience with:
- Recipe CRUD operations
- Search functionality
- Import/export capabilities
- API endpoints for integration
- Beautiful, responsive user interface
- Comprehensive security measures

All features are fully functional and ready for use in a local XAMPP environment.

---

## Additional Resources

- **GitHub Repository**: https://github.com/remaruru/Recipepedia
- **Setup Instructions**: See `SETUP.md`
- **README**: See `README.md`
- **Database Schema**: See `database/schema.sql`

---

**Documentation Version**: 1.0  
**Last Updated**: 2025  
**Project**: Recipepedia - SIA Final Project

