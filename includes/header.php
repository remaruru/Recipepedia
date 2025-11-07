<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' : ''; ?>Recipepedia</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Left column emojis - seamless infinite scroll */
        .left-column-emojis {
            position: fixed;
            top: 0;
            left: 0;
            width: 20%;
            height: 200vh;
            z-index: 1;
            pointer-events: none;
            animation: scrollDownLeft 50s infinite linear;
            overflow: hidden;
        }
        
        .left-column-emojis-inner {
            display: flex;
            flex-direction: column;
            font-size: 3rem;
            color: #000000;
            line-height: 3.5;
            text-align: center;
            padding: 2rem 1rem;
            filter: drop-shadow(2px 2px 4px rgba(0, 0, 0, 0.6));
            white-space: pre-wrap;
        }
        
        /* Right column emojis - seamless infinite scroll */
        .right-column-emojis {
            position: fixed;
            top: 0;
            right: 0;
            width: 20%;
            height: 200vh;
            z-index: 1;
            pointer-events: none;
            animation: scrollUpRight 50s infinite linear;
            overflow: hidden;
        }
        
        .right-column-emojis-inner {
            display: flex;
            flex-direction: column;
            font-size: 3rem;
            color: #000000;
            line-height: 3.5;
            text-align: center;
            padding: 2rem 1rem;
            filter: drop-shadow(-2px 2px 4px rgba(0, 0, 0, 0.6));
            white-space: pre-wrap;
        }
        
        @keyframes scrollDownLeft {
            0% {
                transform: translateY(0);
            }
            100% {
                transform: translateY(-50%);
            }
        }
        
        @keyframes scrollUpRight {
            0% {
                transform: translateY(-50%);
            }
            100% {
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <!-- Left column emojis -->
    <div class="left-column-emojis">
        <div class="left-column-emojis-inner">🍕 🍔 🍟 🌮 🍝 🍜 🍣 🍱 🍛 🥟 🍤 🍗 🥩 🌭 🥨 🥐 🥯 🧇 🥞 🥓 🍖 🍕 🍔 🍟 🌮 🍝 🍜 🍣 🍱 🍛 🥟 🍤 🍗 🥩 🌭 🥨 🥐 🥯 🧇 🥞 🥓 🍖 🍕 🍔 🍟 🌮 🍝 🍜 🍣 🍱 🍛 🥟 🍤 🍗 🥩 🌭 🥨 🥐 🥯 🧇 🥞 🥓 🍖 🍕 🍔 🍟 🌮 🍝 🍜 🍣 🍱 🍛 🥟 🍤 🍗 🥩 🌭 🥨 🥐 🥯 🧇 🥞 🥓 🍖 🍕 🍔 🍟 🌮 🍝 🍜 🍣 🍱 🍛 🥟 🍤 🍗 🥩 🌭 🥨 🥐 🥯 🧇 🥞 🥓 🍖 🍕 🍔 🍟 🌮 🍝 🍜 🍣 🍱 🍛 🥟 🍤 🍗 🥩 🌭 🥨 🥐 🥯 🧇 🥞 🥓 🍖</div>
        <div class="left-column-emojis-inner">🍕 🍔 🍟 🌮 🍝 🍜 🍣 🍱 🍛 🥟 🍤 🍗 🥩 🌭 🥨 🥐 🥯 🧇 🥞 🥓 🍖 🍕 🍔 🍟 🌮 🍝 🍜 🍣 🍱 🍛 🥟 🍤 🍗 🥩 🌭 🥨 🥐 🥯 🧇 🥞 🥓 🍖 🍕 🍔 🍟 🌮 🍝 🍜 🍣 🍱 🍛 🥟 🍤 🍗 🥩 🌭 🥨 🥐 🥯 🧇 🥞 🥓 🍖 🍕 🍔 🍟 🌮 🍝 🍜 🍣 🍱 🍛 🥟 🍤 🍗 🥩 🌭 🥨 🥐 🥯 🧇 🥞 🥓 🍖 🍕 🍔 🍟 🌮 🍝 🍜 🍣 🍱 🍛 🥟 🍤 🍗 🥩 🌭 🥨 🥐 🥯 🧇 🥞 🥓 🍖 🍕 🍔 🍟 🌮 🍝 🍜 🍣 🍱 🍛 🥟 🍤 🍗 🥩 🌭 🥨 🥐 🥯 🧇 🥞 🥓 🍖</div>
    </div>
    
    <!-- Right column emojis -->
    <div class="right-column-emojis">
        <div class="right-column-emojis-inner">🍕 🍔 🍟 🌮 🍝 🍜 🍣 🍱 🍛 🥟 🍤 🍗 🥩 🌭 🥨 🥐 🥯 🧇 🥞 🥓 🍖 🍕 🍔 🍟 🌮 🍝 🍜 🍣 🍱 🍛 🥟 🍤 🍗 🥩 🌭 🥨 🥐 🥯 🧇 🥞 🥓 🍖 🍕 🍔 🍟 🌮 🍝 🍜 🍣 🍱 🍛 🥟 🍤 🍗 🥩 🌭 🥨 🥐 🥯 🧇 🥞 🥓 🍖 🍕 🍔 🍟 🌮 🍝 🍜 🍣 🍱 🍛 🥟 🍤 🍗 🥩 🌭 🥨 🥐 🥯 🧇 🥞 🥓 🍖 🍕 🍔 🍟 🌮 🍝 🍜 🍣 🍱 🍛 🥟 🍤 🍗 🥩 🌭 🥨 🥐 🥯 🧇 🥞 🥓 🍖 🍕 🍔 🍟 🌮 🍝 🍜 🍣 🍱 🍛 🥟 🍤 🍗 🥩 🌭 🥨 🥐 🥯 🧇 🥞 🥓 🍖</div>
        <div class="right-column-emojis-inner">🍕 🍔 🍟 🌮 🍝 🍜 🍣 🍱 🍛 🥟 🍤 🍗 🥩 🌭 🥨 🥐 🥯 🧇 🥞 🥓 🍖 🍕 🍔 🍟 🌮 🍝 🍜 🍣 🍱 🍛 🥟 🍤 🍗 🥩 🌭 🥨 🥐 🥯 🧇 🥞 🥓 🍖 🍕 🍔 🍟 🌮 🍝 🍜 🍣 🍱 🍛 🥟 🍤 🍗 🥩 🌭 🥨 🥐 🥯 🧇 🥞 🥓 🍖 🍕 🍔 🍟 🌮 🍝 🍜 🍣 🍱 🍛 🥟 🍤 🍗 🥩 🌭 🥨 🥐 🥯 🧇 🥞 🥓 🍖 🍕 🍔 🍟 🌮 🍝 🍜 🍣 🍱 🍛 🥟 🍤 🍗 🥩 🌭 🥨 🥐 🥯 🧇 🥞 🥓 🍖 🍕 🍔 🍟 🌮 🍝 🍜 🍣 🍱 🍛 🥟 🍤 🍗 🥩 🌭 🥨 🥐 🥯 🧇 🥞 🥓 🍖</div>
    </div>
    <header>
        <div class="container">
            <h1><a href="index.php">🍕 <span>Recipepedia</span></a></h1>
            <nav>
                <a href="index.php">🏠 Home</a>
                <a href="add_recipe.php">➕ Add Recipe</a>
                <a href="export_recipes.php">📤 Export</a>
                <a href="import_recipes.php">📥 Import</a>
                <a href="soap_client.php">🔌 API</a>
            </nav>
        </div>
    </header>
    <main class="container">

