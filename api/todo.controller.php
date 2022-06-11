<?php
require_once("todo.class.php");

class TodoController {
    private const PATH = __DIR__."/todo.json";
    private array $todos = [];

    public function __construct() {
        $content = file_get_contents(self::PATH);
        if ($content === false) {
            throw new Exception(self::PATH . " does not exist");
        }  
        $dataArray = json_decode($content);
        if (!json_last_error()) {
            foreach($dataArray as $data) {
                if (isset($data->id) && isset($data->title))
                $this->todos[] = new Todo($data->id, $data->title, $data->description, $data->done);
            }
        }
    }

    public function loadAll() : array {
        return $this->todos;
    }

    public function load(string $id) : Todo | bool {
        foreach($this->todos as $todo) {
            if ($todo->id == $id) {
                return $todo;
            }
        }
        return false;
    }

    public function create(Todo $todo) : bool {
        // implement your code here
        consoleLog("Reached the php function");
        $content = file_get_contents(self::PATH);
        if ($content === false) {
            throw new Exception(self::PATH . " does not exist");
        }  
        consoleLog("Got the file content");
        $dataArray = json_decode($content);
        if (!json_last_error()) {
            $dataArray[] = $todo->toArray();
            $content = json_encode($dataArray);
            file_put_contents(self::PATH, $content);
        }
        consoleLog("Processed Succesfully");

        return true;
    }

    public function update(string $id, Todo $todo) : bool {
        // implement your code here
        return true;
    }

    public function delete(string $id) : bool {
        // implement your code here
        return true;
    }

    // add any additional functions you need below
    function consoleLog($msg) {
		echo '<script type="text/javascript">' .
          'console.log(' . $msg . ');</script>';
	}
}