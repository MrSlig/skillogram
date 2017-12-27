<?php
class Post {
    public $id;
    public $title;
    public $text;
    public static function getPost(DB $db, $id) {
        $stmt = $db->getPDO()->prepare(
            'SELECT id, title, text
            FROM posts
            WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        $post = new Post();
        $post->id = $row['id'];
        $post->title = $row['title'];
        $post->text = $row['text'];
        return $post;
    }
}