<?php
// CRUD : CREATE READ UPDATE DELETE => Objets de la BDD
require 'connect.php'; // connect sql

// CREATE - ok
if (isset($_POST)) {
    if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['author'])) {
        $insertArticle = $pdo->prepare("INSERT INTO article(title, content, author) VALUES (:title, :content, :author)");
        $insertArticle->execute([
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'author' => $_POST['author']
            ]);
        } else {
            echo 'veuillez remplir tous les champs';
        }
    }
    
    // READ (all - one) OK
    $query = "SELECT * FROM article";
    $statement = $pdo->query($query);
    $articles = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($articles as $article) {
?>
    <div>
        <p>Id :<?php echo $article['id']; ?></p>
        <p>Title :<?php echo $article['title']; ?></p>
        <p>Content :<?php echo $article['content']; ?> </p>
        <p>Author :<?php echo $article['author']; ?> </p>
        <a href=<?= "delete.php?id=".$article['id'] ?>>Delete</a>
        <a href=<?= "edit.php?id=".$article['id'] ?>>Update</a>
    </div>
<?php } ?>

<form method="POST">
    <label for="title"></label>
    <input type="text" name="title" id="title" placeholder="Title">
    <hr>
    <label for="content"></label>
    <textarea type="text" name="content" id="content" placeholder="Text"></textarea>
    <hr>
    <label for="author"></label>
    <input type="text" name="author" id="author" placeholder="Name">
    <hr>
    <button type="submit">Create</button>
</form>