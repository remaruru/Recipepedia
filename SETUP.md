# Recipepedia Setup Guide

## Quick Setup for XAMPP

### Step 1: Database Setup

1. **Start XAMPP**
   - Open XAMPP Control Panel
   - Start **Apache** and **MySQL** services

2. **Create Database**
   - Open phpMyAdmin: http://localhost/phpmyadmin
   - Click on "SQL" tab
   - Copy and paste the contents of `database/schema.sql`
   - Click "Go" to execute
   - Database `recipepedia` will be created with sample recipes

### Step 2: PHP Configuration

1. **Check PHP Extensions**
   - Open `C:\xampp\php\php.ini`
   - Make sure these lines are uncommented (remove `;` if present):
     ```ini
     extension=pdo_mysql
     extension=soap
     extension=curl
     extension=simplexml
     extension=json
     ```
   - Save the file and restart Apache

2. **Verify Extensions** (Optional)
   - Create a file `info.php` in `htdocs`:
     ```php
     <?php phpinfo(); ?>
     ```
   - Visit http://localhost/info.php
   - Search for "soap", "curl", "pdo_mysql" to verify they're loaded

### Step 3: File Permissions

1. **Create Uploads Directory**
   - The `uploads/` folder will be created automatically
   - If you get permission errors, manually create it:
     - Right-click `uploads` folder → Properties → Security
     - Give "Everyone" or "Users" write permissions

### Step 4: Access the Application

1. **Open Browser**
   - Navigate to: http://localhost/Recipedia/
   - You should see the home page with sample recipes

### Step 5: Test Features

1. **Home Page**: View all recipes
2. **Search**: Type in search bar to filter recipes
3. **Add Recipe**: Click "Add Recipe" to create new recipe
4. **View Recipe**: Click "View" on any recipe card
5. **Edit Recipe**: Click "Edit" to modify recipes
6. **Export**: Go to "Export Recipes" and download XML/JSON
7. **Import**: Go to "Import Recipes" and upload XML/JSON file
8. **SOAP Client**: Test the SOAP web service

## Troubleshooting

### Database Connection Error
- Check MySQL is running in XAMPP
- Verify database name is `recipepedia`
- Check `config/database.php` for correct credentials (default: root, no password)

### SOAP Service Not Working
- Enable SOAP extension in php.ini
- Restart Apache after changes
- Check if SOAP extension is loaded: http://localhost/info.php

### Image Upload Not Working
- Check `uploads/` folder exists and has write permissions
- Check PHP `upload_max_filesize` in php.ini (default: 2M)
- Check PHP `post_max_size` in php.ini (should be larger than upload_max_filesize)

### 404 Errors
- Ensure Apache is running
- Check URL: http://localhost/Recipedia/ (case-sensitive on some systems)
- Verify files are in correct location: `C:\xampp\htdocs\Recipedia\`

### PHP Errors
- Check `C:\xampp\php\logs\php_error_log` for detailed error messages
- Enable error display in php.ini (for development only):
  ```ini
  display_errors = On
  error_reporting = E_ALL
  ```

## Testing the SOAP Service

1. **Direct Access**: http://localhost/Recipedia/soap_service/recipe_service.php
   - Should show service information page

2. **Via SOAP Client**: http://localhost/Recipedia/soap_client.php
   - Click buttons to test different methods
   - Results will be displayed on the page

3. **JSON API**: http://localhost/Recipedia/recipes_json.php
   - Should return JSON data of all recipes

## Default Sample Data

The database includes 2 sample recipes:
- Pancakes
- Chocolate Cake

You can add more recipes using the "Add Recipe" page.

## Notes

- No user authentication required (Wikipedia-style)
- All recipes are publicly viewable and editable
- Images are stored in `uploads/` directory
- SOAP service uses non-WSDL mode for simplicity

