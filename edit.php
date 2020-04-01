<?php 
$dsn = "mysql:host=localhost;dbname=blog";
$user = "root";
$password = "root";
$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

if ($pdo === false) {
    echo 'Error connection' . $pdo->error_log();
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $request ="SELECT * FROM article WHERE id=$id";
    $sendRequest = $pdo->query($request);
    $article = $sendRequest->fetchObject();
}
// UPDATE article SET title= content= author= WHERE id=
if (isset($_POST) && !empty($_POST)) {
    var_dump($_POST);
    $id = $_GET['id'];
    if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['author'])) {
        $updateArticle = $pdo->prepare("UPDATE article SET title=:title, content=:content, author=:author WHERE id=:id");
        $updateArticle->execute([
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'author' => $_POST['author'],
            'id' => $id,
            ]);
        header('Location: http://localhost:8000');
    } else {
        echo 'veuillez remplir tous les champs';
    }
}

?>

<form method="POST">
    <label for="title"></label>
    <input type="text" name="title" id="title" placeholder="Title" value="<?= $article->title ?>">
    <hr>
    <label for="content"></label>
    <textarea type="text" name="content" id="content" placeholder="Text" value="<?= $article->content ?>"></textarea>
    <hr>
    <label for="author"></label>
    <input type="text" name="author" id="author" placeholder="Name" value="<?= $article->author ?>">
    <hr>
    <button type="submit">Update</button>
</form>