# Recipepedia 🍕 - Recipe Storage and Sharing Service

A beautiful Wikipedia-style Recipe Storage and Recipe Share Service where users can view, add, edit, and share recipes without needing an account. Built with PHP, MySQL, and featuring a modern red and white picnic-themed UI with floating food emojis.

![Recipepedia](https://img.shields.io/badge/PHP-7.4+-blue.svg)
![License](https://img.shields.io/badge/License-Educational-green.svg)

## ✨ Features

- 🏠 **Home Page**: Browse all recipes with real-time search functionality
- ➕ **Add Recipe**: Create new recipes with title, ingredients, steps, and optional image upload
- ✏️ **Edit Recipe**: Edit any recipe (Wikipedia-style) with recipe ID display
- 👁️ **View Recipe**: View detailed recipe information with ID badge
- 📤 **Export Recipes**: Export all recipes to XML or JSON format
- 📥 **Import Recipes**: Import recipes from XML or JSON files
- 🔌 **SOAP Web Service**: Share recipes via SOAP API
- 📡 **JSON/XML API**: Access recipes via RESTful JSON and XML endpoints
- 🎨 **Beautiful UI**: Red and white picnic-themed design with floating food emojis
- 🔍 **Search**: Real-time recipe search functionality
- 📱 **Responsive**: Works on desktop and mobile devices

## 🎨 Design Features

- **Picnic Theme**: Red and white color scheme with chessboard-like pattern
- **Floating Emojis**: Animated food emojis in side columns
- **Modern Cards**: Beautiful recipe cards with hover effects
- **Black Borders**: Clean, bold borders for headers, footers, and cards
- **Smooth Animations**: Seamless scrolling animations and transitions

## 📋 Requirements

- **XAMPP** (Apache + MySQL + PHP)
- **PHP 7.4** or higher
- **PHP Extensions**: 
  - PDO (MySQL)
  - SOAP
  - cURL
  - SimpleXML
  - JSON

## 🚀 Installation

### Step 1: Clone or Download

```bash
git clone https://github.com/remaruru/Recipepedia.git
```

Or download the ZIP file and extract to `C:\xampp\htdocs\Recipedia\`

### Step 2: Database Setup

1. Start **XAMPP** Control Panel
2. Start **Apache** and **MySQL** services
3. Open phpMyAdmin: http://localhost/phpmyadmin
4. Import the database schema:
   - Click on "SQL" tab
   - Copy and paste contents of `database/schema.sql`
   - Click "Go" to execute
5. (Optional) Add sample recipes:
   - Run `add_sample_recipes.php` in your browser
   - Or import `database/sample_recipes.sql` manually

### Step 3: PHP Configuration

1. Open `C:\xampp\php\php.ini`
2. Ensure these extensions are enabled:
   ```ini
   extension=pdo_mysql
   extension=soap
   extension=curl
   extension=simplexml
   extension=json
   ```
3. Restart Apache

### Step 4: Access the Application

Navigate to: **http://localhost/Recipedia/**

## 📖 Usage

### Viewing Recipes
- Browse all recipes on the home page
- Use the search bar to filter recipes by title
- Click "View" to see full recipe details with ID
- Click "Edit" to modify any recipe

### Adding Recipes
1. Click "➕ Add Recipe" in navigation
2. Fill in recipe title, ingredients, and steps
3. (Optional) Upload a recipe image
4. Click "Save Recipe"

### Editing Recipes
1. Click "Edit" on any recipe card
2. Modify the recipe details
3. Recipe ID is displayed (non-editable)
4. Click "Update Recipe" to save changes

### Exporting Recipes
1. Click "📤 Export" in navigation
2. Choose XML or JSON format
3. File will be downloaded automatically

### Importing Recipes
1. Click "📥 Import" in navigation
2. Select an XML or JSON file
3. Recipes will be imported to the database

### API Testing
1. Click "🔌 API" in navigation
2. Use the SOAP Client interface to test APIs
3. View all recipes or get specific recipes by ID
4. Test JSON and XML endpoints

## 🔌 API Endpoints

### JSON API
- **Get All Recipes**: `http://localhost/Recipedia/recipes_json.php`
- **Get Recipe by ID**: `http://localhost/Recipedia/recipes_json.php?id=1`

### XML API
- **Get All Recipes**: `http://localhost/Recipedia/recipes_xml.php`

### SOAP Service
- **SOAP Endpoint**: `http://localhost/Recipedia/soap_service/recipe_service.php`
- **GET Request**: Returns XML of all recipes
- **Methods**:
  - `getRecipesXML()` - Get all recipes as XML
  - `getRecipesJSON()` - Get all recipes as JSON
  - `getRecipeByIdXML($id)` - Get recipe by ID as XML

### SOAP Client
- **Test Interface**: `http://localhost/Recipedia/soap_client.php`
- Interactive UI for testing all API endpoints

## 📁 Project Structure

```
Recipedia/
├── assets/
│   └── css/
│       └── style.css          # Main stylesheet with picnic theme
├── classes/
│   ├── Recipe.php             # Recipe entity class
│   ├── RecipeManager.php      # Database operations (CRUD)
│   └── RecipeService.php      # XML/JSON conversion services
├── config/
│   └── database.php           # Database connection configuration
├── database/
│   ├── schema.sql             # Database schema with sample data
│   └── sample_recipes.sql     # Additional sample recipes (24+)
├── includes/
│   ├── header.php             # Header with navigation and emoji animations
│   └── footer.php             # Footer
├── soap_service/
│   └── recipe_service.php     # SOAP web service endpoint
├── uploads/                   # User-uploaded recipe images (auto-created)
│   └── .htaccess              # Security configuration
├── add_recipe.php             # Add new recipe page
├── add_sample_recipes.php     # Script to add sample recipes
├── edit_recipe.php            # Edit recipe page
├── export_recipes.php         # Export recipes to XML/JSON
├── import_recipes.php         # Import recipes from XML/JSON
├── index.php                  # Home page with recipe list
├── recipes_json.php           # JSON API endpoint
├── recipes_xml.php            # XML API endpoint
├── soap_client.php            # SOAP client test interface
├── view_recipe.php            # View recipe details page
├── sample_recipes.xml         # Sample XML export file
├── sample_recipes.json        # Sample JSON export file
├── .gitignore                 # Git ignore file
├── README.md                  # This file
└── SETUP.md                   # Detailed setup instructions
```

## 🛠️ Technical Implementation

- **Object-Oriented Programming (OOP)**: 
  - `Recipe` class for recipe entities
  - `RecipeManager` class for database operations
  - `RecipeService` class for XML/JSON conversion

- **Database**: 
  - MySQL database with PDO for secure connections
  - Prepared statements to prevent SQL injection

- **File Processing**: 
  - Image upload and display
  - File validation and security

- **Web Services**: 
  - SOAP API for recipe sharing
  - JSON and XML REST endpoints
  - cURL integration for testing

- **XML/JSON Handling**: 
  - Export recipes to XML/JSON format
  - Import recipes from XML/JSON files
  - SimpleXML for XML processing

- **UI/UX**: 
  - Responsive design
  - CSS animations and transitions
  - Modern card-based layout
  - Real-time search functionality

## 🎯 Key Features Explained

### Recipe ID Display
- Recipe ID is shown on both view and edit pages
- ID is displayed in a badge format (non-editable)
- Helps identify recipes for API calls

### Search Functionality
- Real-time search as you type
- Searches recipe titles
- Case-insensitive matching

### Image Handling
- Optional image upload for recipes
- Images stored in `uploads/` directory
- Automatic deletion of old images when updating

### Export/Import
- Export all recipes to XML or JSON
- Import recipes from XML or JSON files
- Validates file format before import

## 🔒 Security Features

- Prepared statements (SQL injection prevention)
- Input validation and sanitization
- File upload restrictions (image types only)
- `.htaccess` protection for uploads directory
- HTML escaping for XSS prevention

## 🐛 Troubleshooting

### Database Connection Error
- Check MySQL is running in XAMPP
- Verify database name is `recipepedia`
- Check `config/database.php` for correct credentials (default: root, no password)

### SOAP Service Not Working
- Enable SOAP extension in `php.ini`
- Restart Apache after changes
- Check if SOAP extension is loaded

### Image Upload Not Working
- Check `uploads/` folder exists and has write permissions
- Check PHP `upload_max_filesize` in `php.ini`
- Check PHP `post_max_size` in `php.ini`

### 404 Errors
- Ensure Apache is running
- Check URL: `http://localhost/Recipedia/`
- Verify files are in correct location

### White Background Issues
- Clear browser cache
- Check CSS file is loading correctly
- Verify `assets/css/style.css` exists

## 📝 Notes

- No user authentication required (Wikipedia-style editing)
- All recipes are publicly viewable and editable
- Images are stored in `uploads/` directory
- SOAP service uses non-WSDL mode for simplicity
- Database includes sample recipes (can be expanded with `add_sample_recipes.php`)

## 🚀 Future Enhancements

- User authentication system
- Recipe categories and tags
- Rating and review system
- Recipe sharing via social media
- Advanced search filters
- Recipe printing functionality

## 📄 License

This project is created for educational purposes.

## 👨‍💻 Author

Created as a demonstration project for web services and database integration.

## 🙏 Acknowledgments

- Built with PHP, MySQL, and vanilla CSS
- Uses XAMPP for local development
- Inspired by Wikipedia's collaborative editing model

---

**Enjoy cooking with Recipepedia! 🍕🍔🍟🍝🍜🍲**
