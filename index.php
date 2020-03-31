<?php
// CRUD : CREATE READ UPDATE DELETE

$dsn = "mysql:host=localhost;dbname=blog";
$user = "root";
$password = "root";
$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

if ($pdo === false) {
    echo 'Error connection' . $pdo->error_log();
}

// CREATE - ok
if (isset($_POST)) {
    var_dump($_POST);
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
//var_dump($articles);
foreach ($articles as $article) {
?>
    <div>
        <p>Title :<?php echo $article['title']; ?></p>
        <p>Content :<?php echo $article['content']; ?> </p>
        <p>Author :<?php echo $article['author']; ?> </p>
        <a href=<?= "delete.php?id=" . $article['id'] ?>>Delete</a>
        <a href=<?="edit.php?id=" . $article['id']
                    . "&title=" . $article['title']
                    . "&content=" . $article['content']
                    . "&author=" . $article['author'] 
                ?>
        >Edit</a>
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