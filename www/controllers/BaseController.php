<?php
require_once("models/BaseModel.php");

class BaseController
{
    protected BaseModel $model;
    protected string $modelName;

    public function __construct(BaseModel $model)
    {
        $this->model = $model;
        $this->modelName = strtolower(get_class($this->model));
    }

    public function create()
    {
        require_once("views/$this->modelName/create.php");
    }

    public function read(int $id): void
    {
        $data = $this->model->read($id);
        require_once("views/$this->modelName/detail.php");
    }

    public function edit(int $id): void
    {
        $data = $this->model->read($id);
        require_once("views/$this->modelName/update.php");
    }

    public function readAll(): void
    {
        $data = $this->model->readAll();
        require_once("views/$this->modelName/list.php");
    }

    public function redirect(string $url, ?string $msgStatus = null, ?string $msg = null): void
    {
        if (isset($msgStatus) && isset($msg))
            setcookie($msgStatus, $msg, time() + 1);
        header("Location: $url");
        exit();
    }

}