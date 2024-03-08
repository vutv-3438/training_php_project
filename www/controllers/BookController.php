<?php
require_once("BaseController.php");
require_once("models/Book.php");

class BookController extends BaseController
{
    public function __construct()
    {
        parent::__construct(new Book());
    }

    public function add($data)
    {
        $redirectUrl = 'index.php?model=book&action=create';
        if (!$this->validate($data)) {
            $this->redirect($redirectUrl, Variable::MSG_FAIL_STATUS, Variable::REQUIRE_ERROR_MESSAGE);
        }

        $isAddSuccess = $this->model->add($data);
        if ($isAddSuccess)
            $this->redirect('index.php?model=book&action=readAll', Variable::MSG_SUCCESS_STATUS, Variable::SUCCESS_ADD_MESSAGE);
        $this->redirect($redirectUrl, Variable::MSG_FAIL_STATUS, Variable::ERROR_ADD_MESSAGE);
    }

    public function update($data)
    {
        $redirectUrl = 'index.php ? model=book&action=edit&id=' . $data['id'];
        if (!$this->validate($data) || !$data['id']) {
            $this->redirect($redirectUrl, Variable::REQUIRE_ERROR_MESSAGE);
        }

        $isUpdateSuccess = $this->model->update($data);
        if ($isUpdateSuccess)
            $this->redirect('index.php?model=book&action=readAll', Variable::MSG_SUCCESS_STATUS, Variable::SUCCESS_UPDATE_MESSAGE);
        $this->redirect($redirectUrl, Variable::MSG_FAIL_STATUS, Variable::ERROR_UPDATE_MESSAGE);
    }

    public function delete(int $id)
    {
        $redirectUrl = 'index.php?model=book&action=readAll';
        if (!hash_equals($_SESSION['csrf_token'], $_GET['csrf_token']))
            $this->redirect($redirectUrl, Variable::MSG_FAIL_STATUS, Variable::ERROR_DELETE_MESSAGE);

        $isUpdateSuccess = $this->model->delete($id);
        if ($isUpdateSuccess)
            $this->redirect($redirectUrl, Variable::MSG_SUCCESS_STATUS, Variable::SUCCESS_DELETE_MESSAGE);
        $this->redirect($redirectUrl, Variable::MSG_FAIL_STATUS, Variable::ERROR_DELETE_MESSAGE);
    }

    public function validate($data)
    {
        if (empty($data['name']) ||
            empty($data['author']) ||
            empty($data['price']) ||
            $data['price'] <= 0 ||
            !hash_equals($_SESSION['csrf_token'], $data['csrf_token'])) return false;
        return true;
    }
}