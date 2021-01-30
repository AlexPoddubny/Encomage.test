<?php
    
    
    namespace App\Controllers;
    
    
    use App\Models\User;

    class Users extends Base
    {
        protected function actionIndex()
        {
            $this->view->users = User::findAll();
            $this->view->title = 'Users List';
            $this->view->display(__DIR__ . '/../Views/users/index.php');
        }
    
        protected function actionAdd()
        {
            $this->view->title = 'Add User';
            $this->view->display(__DIR__ . '/../Views/users/add.php');
        }
    
        protected function actionSave()
        {
            $user = $this->getUser();
            $user->save($_POST);
            return header('Location: /');
        }
    
        /*
         * Save & Continue Edit реализован через AJAX для
         * получения id записи в случае добавления нового пользователя
         */
        protected function actionSaveedit()
        {
            $user = $this->getUser();
            echo $user->save($_POST);
        }
    
        protected function actionEdit($id)
        {
            $this->view->user = User::findById($id);
            $this->view->title = 'Edit User';
            $this->view->display(__DIR__ . '/../Views/users/add.php');
        }
        
        protected function getUser()
        {
            if (!empty($_POST['id'])){
                return $user = User::findById($_POST['id']);
            }
            return $user = new User;
        }
    
        protected function actionSort()
        {
            $param['order'] = $_POST['column'];
            $param['sort'] = $_POST['sort'];
            $this->view->users = User::findAll($_POST);
            $this->view->display(__DIR__ . '/../Views/users/tbody.php', false);
        }
    
        protected function actionFilter()
        {
            if ($this->view->users = User::search($_POST)) {
                $this->view->display(__DIR__ . '/../Views/users/tbody.php', false);
            }
        }
    }