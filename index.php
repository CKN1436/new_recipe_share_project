<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Share</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "header.php"; ?>
    <main>
    <div class="card-container">
        <?php
      $recipes = file_exists('recipes.json') ? json_decode(file_get_contents('recipes.json'), true) : [];
     foreach ($recipes as $index => $recipe)
         {
    echo '<div class="card">';
    echo '<img src="' . $recipe['image'] . '" alt="Recipe">';
    echo '<h4>' .$recipe['name']. '</h4>';
    echo '<button class="readmore_btn" onclick="openModal(' . $index . ')">Read More...</button>';
    echo '</div>';
       }
    ?>
   </div>
   
   <div id="recipeModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h3 id="modalTitle"></h3>
        <img id="modalImage" src="" alt="Recipe Image">
        <h2>Description</h2>
        <p id="modalDesc"></p>
    </div>
</div>
       <script>
        const recipes = <?php echo json_encode($recipes); ?>;

        function openModal(index) {
            const recipe = recipes[index];
            document.getElementById('modalTitle').innerText = recipe.name;
            document.getElementById('modalImage').src = recipe.image;
            document.getElementById('modalDesc').innerText = recipe.description;
            document.getElementById('recipeModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('recipeModal').style.display = 'none';
        }
        </script>
    </main>
      <?php include "footer.php"; ?>
</body>
</html>