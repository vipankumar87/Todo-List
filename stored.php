<?php
$dsn = 'mysql:host=localhost;dbname=todo_list';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $entryId = $_POST['entry_id'] ?? null;
    $tags = $_POST['tags'] ?? '';

    error_log("Received entry_id: $entryId");
    error_log("Received tags: $tags");

    if ($entryId && !empty($tags)) {
        $tagArray = array_map('trim', explode(',', $tags));

        foreach ($tagArray as $tagName) {
            if (!empty($tagName)) {
                $stmt = $pdo->prepare("INSERT INTO entry_tags (entry_id, Tags) VALUES (:entry_id, :tag_name)");
                $stmt->execute(['entry_id' => $entryId, 'tag_name' => $tagName]);
            }
        }

        echo "Tags submitted successfully!";
    } else {
        echo "Invalid entry ID or no tags selected.";
    }
} catch (PDOException $e) {
    error_log("Error: " . $e->getMessage());
    echo "There was an error processing your request. Please try again later.";
}
?>
