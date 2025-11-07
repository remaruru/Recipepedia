# Recipepedia - Recipe Storage and Sharing Service

A Wikipedia-style Recipe Storage and Recipe Share Service where users can view, add, edit, and share recipes without needing an account.

## Features

- 🏠 **Home Page**: Browse all recipes with search functionality
- ➕ **Add Recipe**: Create new recipes with title, ingredients, steps, and optional image
- ✏️ **Edit Recipe**: Edit any recipe (Wikipedia-style)
- 👁️ **View Recipe**: View detailed recipe information
- 📤 **Export Recipes**: Export all recipes to XML or JSON format
- 📥 **Import Recipes**: Import recipes from XML or JSON files
- 🔌 **SOAP Web Service**: Share recipes via SOAP API
- 📡 **JSON API**: Access recipes via RESTful JSON endpoint
- 🔄 **cURL Integration**: Test SOAP service using cURL

## Requirements

- XAMPP (Apache + MySQL + PHP)
- PHP 7.4 or higher
- PHP extensions: PDO, SOAP, cURL, SimpleXML, JSON

## Installation

1. **Copy Project to XAMPP**
   - Copy the `Recipedia` folder to `C:\xampp\htdocs\`

2. **Create Database**
   - Start XAMPP and open phpMyAdmin (http://localhost/phpmyadmin)
   - Import the database schema from `database/schema.sql`
   - Or create database manually:
     ```sql
     CREATE DATABASE recipepedia;
     ```

3. **Configure Database** (if needed)
   - Edit `config/database.php` if your MySQL credentials are different
   - Default: username='root', password='' (empty)

4. **Create Upload Directory**
   - The `uploads/` directory will be created automatically
   - Make sure PHP has write permissions

5. **Enable PHP Extensions**
   - Open `php.ini` in XAMPP
   - Make sure these extensions are enabled:
     ```ini
     extension=pdo_mysql
     extension=soap
     extension=curl
     extension=simplexml
     extension=json
     ```
   - Restart Apache after changes

## Usage

1. **Start XAMPP**
   - Start Apache and MySQL services

2. **Access Application**
   - Open browser and go to: `http://localhost/Recipedia/`

3. **Features**
   - **Home**: View all recipes, search recipes
   - **Add Recipe**: Create new recipes
   - **Edit Recipe**: Click "Edit" on any recipe
   - **View Recipe**: Click "View" to see full details
   - **Export**: Download recipes as XML or JSON
   - **Import**: Upload XML/JSON file to import recipes
   - **SOAP Client**: Test the SOAP web service

## API Endpoints

### JSON API
- `http://localhost/Recipedia/recipes_json.php` - Get all recipes (JSON)
- `http://localhost/Recipedia/recipes_json.php?id=1` - Get recipe by ID (JSON)

### SOAP Service
- `http://localhost/Recipedia/soap_service/recipe_service.php` - SOAP endpoint
- Methods:
  - `getRecipesXML()` - Get all recipes as XML
  - `getRecipesJSON()` - Get all recipes as JSON
  - `getRecipeByIdXML($id)` - Get recipe by ID as XML

## Project Structure

```
Recipedia/
├── assets/
│   └── css/
│       └── style.css
├── classes/
│   ├── Recipe.php
│   ├── RecipeManager.php
│   └── RecipeService.php
├── config/
│   └── database.php
├── database/
│   └── schema.sql
├── includes/
│   ├── header.php
│   └── footer.php
├── soap_service/
│   └── recipe_service.php
├── uploads/ (created automatically)
├── add_recipe.php
├── edit_recipe.php
├── export_recipes.php
├── import_recipes.php
├── index.php
├── recipes_json.php
├── soap_client.php
├── view_recipe.php
└── README.md
```

## Technical Implementation

- **OOP**: Uses classes (Recipe, RecipeManager, RecipeService)
- **Database**: MySQL with PDO for secure connections
- **File Processing**: Image upload and display
- **Web Services**: SOAP API for recipe sharing
- **XML Handling**: Export/import XML format
- **JSON**: JSON API endpoint
- **cURL**: Used for SOAP service testing

## Notes

- No user authentication required (Wikipedia-style)
- Images are stored in `uploads/` directory
- All recipes are publicly viewable and editable
- SOAP service uses non-WSDL mode for simplicity

## Troubleshooting

1. **Database Connection Error**
   - Check MySQL is running in XAMPP
   - Verify database credentials in `config/database.php`
   - Ensure database `recipepedia` exists

2. **SOAP Service Not Working**
   - Enable SOAP extension in `php.ini`
   - Restart Apache after enabling extension

3. **Image Upload Not Working**
   - Check `uploads/` directory permissions
   - Verify PHP `upload_max_filesize` in `php.ini`

4. **404 Errors**
   - Ensure Apache is running
   - Check URL is correct: `http://localhost/Recipedia/`

## License

This project is created for educational purposes.

