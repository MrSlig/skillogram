<?php
class DefaultController {
    public function indexAction() {
        return render ('index');
    }
    public function categoriesAction() {
        $data['categories'] = [
            [
                'id' => 1,
                'name' => 'Интструменты',

            ],
            [
                'id' => 2,
                'name' => 'Одежда',
            ],
        ];
        $data['categoriesCount'] = 18;
        return render('categories', $data);
    }
    public function postsAction() {
        $stmt = DB::getInstance()->getPDO()
            ->prepare('SELECT * FROM posts');
        $stmt->execute();
        $data['posts'] = $stmt->fetchAll();
        return render('posts', $data);
    }
    public function postAction() {
        require_once __DIR__ . '/../model/Post.php';
        $data['post'] = Post::getPost(DB::getInstance(), $_GET['id']);
        return render('post', $data);
    }
}