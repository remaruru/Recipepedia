# Recipepedia Setup Guide 🍕

Complete step-by-step setup instructions for Recipepedia on XAMPP.

## 📋 Prerequisites

- **XAMPP** installed (Apache + MySQL + PHP)
- **Windows** operating system (or adjust paths for other OS)
- **Web browser** (Chrome, Firefox, Edge, etc.)

## 🚀 Quick Setup (5 Minutes)

### Step 1: Install Project Files

1. **Download or Clone**
   - Clone from GitHub: `git clone https://github.com/remaruru/Recipepedia.git`
   - Or download ZIP and extract to `C:\xampp\htdocs\Recipedia\`

2. **Verify Files**
   - Check that all files are in `C:\xampp\htdocs\Recipedia\`
   - Should include: `index.php`, `classes/`, `config/`, `database/`, etc.

### Step 2: Start XAMPP Services

1. **Open XAMPP Control Panel**
   - Launch XAMPP Control Panel from Start Menu or Desktop

2. **Start Services**
   - Click "Start" button for **Apache**
   - Click "Start" button for **MySQL**
   - Both should show green "Running" status

### Step 3: Create Database

1. **Open phpMyAdmin**
   - Go to: http://localhost/phpmyadmin
   - Or click "Admin" next to MySQL in XAMPP Control Panel

2. **Import Database Schema**
   - Click on "SQL" tab in phpMyAdmin
   - Open `database/schema.sql` in a text editor
   - Copy all contents
   - Paste into the SQL text area in phpMyAdmin
   - Click "Go" button
   - You should see: "Database 'recipepedia' created" and sample recipes inserted

3. **Verify Database**
   - Check left sidebar for `recipepedia` database
   - Click on it and verify `recipes` table exists
   - Click on `recipes` table to see sample data

### Step 4: Configure PHP Extensions

1. **Open php.ini**
   - Navigate to: `C:\xampp\php\php.ini`
   - Open in Notepad or any text editor

2. **Enable Required Extensions**
   - Press `Ctrl+F` to search
   - Find and uncomment (remove `;`) these lines:
     ```ini
     extension=pdo_mysql
     extension=soap
     extension=curl
     extension=simplexml
     extension=json
     ```
   - Note: Some extensions might already be enabled

3. **Save and Restart**
   - Save `php.ini` file
   - Restart Apache in XAMPP Control Panel (Stop then Start)

4. **Verify Extensions** (Optional)
   - Create `test_extensions.php` in `C:\xampp\htdocs\`:
     ```php
     <?php
     echo "PDO MySQL: " . (extension_loaded('pdo_mysql') ? '✓ Enabled' : '✗ Disabled') . "<br>";
     echo "SOAP: " . (extension_loaded('soap') ? '✓ Enabled' : '✗ Disabled') . "<br>";
     echo "cURL: " . (extension_loaded('curl') ? '✓ Enabled' : '✗ Disabled') . "<br>";
     echo "SimpleXML: " . (extension_loaded('simplexml') ? '✓ Enabled' : '✗ Disabled') . "<br>";
     echo "JSON: " . (extension_loaded('json') ? '✓ Enabled' : '✗ Disabled') . "<br>";
     ?>
     ```
   - Visit: http://localhost/test_extensions.php
   - All should show "✓ Enabled"
   - Delete `test_extensions.php` after verification

### Step 5: Configure Database Connection

1. **Check Database Config**
   - Open: `C:\xampp\htdocs\Recipedia\config\database.php`
   - Default settings (usually works):
     ```php
     private $host = 'localhost';
     private $dbname = 'recipepedia';
     private $username = 'root';
     private $password = '';
     ```

2. **Modify if Needed**
   - If you changed MySQL root password, update `$password`
   - If using different database name, update `$dbname`

### Step 6: Set Up Uploads Directory

1. **Automatic Creation**
   - The `uploads/` directory will be created automatically
   - First time you upload an image, it will be created

2. **Manual Creation** (if needed)
   - Navigate to: `C:\xampp\htdocs\Recipedia\`
   - Create folder named `uploads`
   - Right-click → Properties → Security
   - Give "Everyone" or "Users" full control (for Windows)
   - Or set permissions to 777 (for Linux/Mac)

### Step 7: Access the Application

1. **Open Browser**
   - Go to: **http://localhost/Recipedia/**

2. **Verify It Works**
   - You should see the home page with recipe cards
   - Red and white picnic theme with floating emojis
   - Sample recipes should be displayed

### Step 8: Add Sample Recipes (Optional)

1. **Using PHP Script**
   - Go to: http://localhost/Recipedia/add_sample_recipes.php
   - Script will add 24+ sample recipes
   - Duplicate recipes will be skipped

2. **Using SQL File**
   - Open phpMyAdmin
   - Select `recipepedia` database
   - Click "SQL" tab
   - Open `database/sample_recipes.sql`
   - Copy and paste contents
   - Click "Go"

## ✅ Testing the Application

### Test Home Page
- ✅ View all recipes
- ✅ Search functionality works
- ✅ Recipe cards display correctly
- ✅ Images load (if any)

### Test Adding Recipe
1. Click "➕ Add Recipe"
2. Fill in form:
   - Title: "Test Recipe"
   - Ingredients: "1 cup flour, 2 eggs"
   - Steps: "Mix ingredients, Cook"
3. (Optional) Upload an image
4. Click "Save Recipe"
5. ✅ Recipe appears on home page

### Test Viewing Recipe
1. Click "View" on any recipe
2. ✅ Recipe details display
3. ✅ Recipe ID is shown in badge
4. ✅ Image displays (if available)

### Test Editing Recipe
1. Click "Edit" on any recipe
2. ✅ Recipe ID is displayed (non-editable)
3. Modify recipe details
4. Click "Update Recipe"
5. ✅ Changes are saved

### Test Export
1. Click "📤 Export"
2. Click "Export as XML" or "Export as JSON"
3. ✅ File downloads
4. ✅ Open file in text editor to verify content

### Test Import
1. Click "📥 Import"
2. Select an exported XML or JSON file
3. Click "Import Recipes"
4. ✅ Recipes are imported
5. ✅ Check home page for new recipes

### Test API
1. Click "🔌 API"
2. Test "Get ALL Recipes (JSON)"
3. ✅ Recipes display in JSON format
4. Test "Get ALL Recipes (XML)"
5. ✅ Recipes display in XML format
6. Test "Get Recipe by ID"
7. ✅ Single recipe displays

### Test SOAP Service
1. Go to: http://localhost/Recipedia/soap_service/recipe_service.php
2. ✅ XML data is displayed
3. Use SOAP Client page to test methods
4. ✅ All methods work correctly

## 🐛 Troubleshooting

### Problem: Database Connection Error

**Error Message**: "Could not connect to database" or "Access denied"

**Solutions**:
1. ✅ Check MySQL is running in XAMPP
2. ✅ Verify database `recipepedia` exists in phpMyAdmin
3. ✅ Check `config/database.php` credentials
4. ✅ Try creating database manually:
   ```sql
   CREATE DATABASE recipepedia;
   ```
5. ✅ Check MySQL port (default: 3306)

### Problem: SOAP Service Not Working

**Error Message**: "Class 'SoapServer' not found" or "SOAP extension not loaded"

**Solutions**:
1. ✅ Enable SOAP extension in `php.ini`:
   ```ini
   extension=soap
   ```
2. ✅ Restart Apache after editing `php.ini`
3. ✅ Verify extension is loaded (use test_extensions.php)
4. ✅ Check PHP version (PHP 7.4+ required)

### Problem: Image Upload Not Working

**Error Message**: "Failed to upload image" or "Permission denied"

**Solutions**:
1. ✅ Check `uploads/` folder exists
2. ✅ Verify folder has write permissions
3. ✅ Check PHP `upload_max_filesize` in `php.ini`:
   ```ini
   upload_max_filesize = 10M
   ```
4. ✅ Check PHP `post_max_size` in `php.ini`:
   ```ini
   post_max_size = 10M
   ```
5. ✅ Restart Apache after changes

### Problem: 404 Errors

**Error Message**: "404 Not Found" or "Page not found"

**Solutions**:
1. ✅ Ensure Apache is running
2. ✅ Check URL: `http://localhost/Recipedia/` (case-sensitive)
3. ✅ Verify files are in `C:\xampp\htdocs\Recipedia\`
4. ✅ Check `.htaccess` file (if exists) for issues
5. ✅ Try accessing: `http://localhost/Recipedia/index.php` directly

### Problem: White Background / No Styling

**Error Message**: Page loads but looks plain/white

**Solutions**:
1. ✅ Check browser console for CSS loading errors
2. ✅ Verify `assets/css/style.css` exists
3. ✅ Check file permissions on CSS file
4. ✅ Clear browser cache (Ctrl+F5)
5. ✅ Check Apache error logs: `C:\xampp\apache\logs\error.log`

### Problem: PHP Errors Displaying

**Error Message**: PHP warnings/notices on page

**Solutions**:
1. ✅ Check `php.ini` error settings:
   ```ini
   display_errors = Off  ; For production
   display_errors = On   ; For development
   error_reporting = E_ALL
   ```
2. ✅ Check error logs: `C:\xampp\php\logs\php_error_log`
3. ✅ Fix any code errors reported
4. ✅ Restart Apache after changes

### Problem: Recipes Not Displaying

**Error Message**: Empty page or "No recipes found"

**Solutions**:
1. ✅ Check database has recipes:
   - Open phpMyAdmin
   - Select `recipepedia` database
   - Click on `recipes` table
   - Verify data exists
2. ✅ Run `add_sample_recipes.php` to add sample data
3. ✅ Check database connection in `config/database.php`
4. ✅ Verify table structure matches `database/schema.sql`

### Problem: Search Not Working

**Error Message**: Search doesn't filter recipes

**Solutions**:
1. ✅ Check browser console for JavaScript errors
2. ✅ Verify JavaScript is enabled in browser
3. ✅ Clear browser cache
4. ✅ Check `index.php` search functionality

### Problem: Export/Import Not Working

**Error Message**: "Failed to export" or "Invalid file format"

**Solutions**:
1. ✅ Check file permissions
2. ✅ Verify file format (XML or JSON)
3. ✅ Check PHP file upload settings
4. ✅ Verify XML/JSON structure is correct
5. ✅ Check browser allows downloads

## 🔧 Advanced Configuration

### Change Database Name

1. Edit `config/database.php`:
   ```php
   private $dbname = 'your_database_name';
   ```
2. Create database in phpMyAdmin:
   ```sql
   CREATE DATABASE your_database_name;
   ```
3. Import `database/schema.sql` to new database

### Change Port Number

If MySQL is on a different port:

1. Edit `config/database.php`:
   ```php
   private $host = 'localhost:3307';  // Change port
   ```

### Enable Error Display (Development Only)

1. Edit `C:\xampp\php\php.ini`:
   ```ini
   display_errors = On
   error_reporting = E_ALL
   ```
2. Restart Apache

### Increase Upload Size

1. Edit `C:\xampp\php\php.ini`:
   ```ini
   upload_max_filesize = 50M
   post_max_size = 50M
   memory_limit = 128M
   ```
2. Restart Apache

## 📚 Additional Resources

- **XAMPP Documentation**: https://www.apachefriends.org/docs/
- **PHP Documentation**: https://www.php.net/docs.php
- **MySQL Documentation**: https://dev.mysql.com/doc/
- **SOAP PHP Documentation**: https://www.php.net/manual/en/book.soap.php

## ✅ Setup Checklist

- [ ] XAMPP installed
- [ ] Apache and MySQL running
- [ ] Database `recipepedia` created
- [ ] Database schema imported
- [ ] PHP extensions enabled (PDO, SOAP, cURL, SimpleXML, JSON)
- [ ] Apache restarted after php.ini changes
- [ ] `uploads/` directory created (or will be auto-created)
- [ ] Application accessible at http://localhost/Recipedia/
- [ ] Home page displays recipes
- [ ] Can add new recipes
- [ ] Can edit recipes
- [ ] Can view recipes
- [ ] Export works (XML/JSON)
- [ ] Import works (XML/JSON)
- [ ] API endpoints work
- [ ] SOAP service works

## 🎉 You're All Set!

Once all checklist items are complete, you're ready to use Recipepedia!

**Next Steps**:
1. Add your own recipes
2. Test all features
3. Export/import recipes
4. Use the API endpoints
5. Customize the design (if desired)

**Enjoy cooking with Recipepedia! 🍕🍔🍟🍝🍜🍲**

---

## 📞 Need Help?

If you encounter any issues not covered in this guide:

1. Check the troubleshooting section above
2. Review error logs:
   - Apache: `C:\xampp\apache\logs\error.log`
   - PHP: `C:\xampp\php\logs\php_error_log`
3. Verify all requirements are met
4. Check GitHub issues: https://github.com/remaruru/Recipepedia/issues
