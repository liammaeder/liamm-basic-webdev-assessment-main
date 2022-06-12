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

        // Read the json file info
        $jsonFile = file_get_contents(self::PATH);
        $dataArray = json_decode($jsonFile);

        // Convert the Todo to an array
        $newTodo = $this->toArray($todo);

        // Errorhandling
        if (!json_last_error()) {
            // Add the new Todo to the array and write to the json file
            $dataArray[] = $newTodo;
            $jsonFile = json_encode($dataArray, JSON_PRETTY_PRINT);
            file_put_contents(self::PATH, $jsonFile);
            return true;
        } else {
            return false;
        }
        
    }

    public function update(string $id, Todo $todo) : bool {
        // implement your code here// Read data from Json and decode it
        $json = file_get_contents(self::PATH);
        $data = json_decode($json, true);

        // Errorhandling
        if(!json_last_error()) {
            // update the item in the array
            foreach($data as $key => $item) {
                if ($item['id'] == $id) {
                    $data[$key] = $this->toArray($todo);
                }
            }

            // remove the keys from the array
            $new_data = array();
            foreach($data as $item) {
                $new_data[] = $this->arrayCleaner($item);
            }

            // Encode the array and write it to the json file
            $json = json_encode($new_data, JSON_PRETTY_PRINT);
            file_put_contents(self::PATH, $json);

            return true;
        } else {
            return false;
        }
    }

    public function delete(string $id) : bool {
        // implement your code here

        // Read data from Json and decode it
        $json = file_get_contents(self::PATH);
        $data = json_decode($json, true);

        // Errorhandling
        if(!json_last_error()) {
            // delete the item from the array
            foreach($data as $key => $item) {
                if ($item['id'] == $id) {
                    unset($data[$key]);
                }
            }

            // remove the keys from the array
            $new_data = array();
            foreach($data as $item) {
                $new_data[] = $this->arrayCleaner($item);
            }

            // Encode the array and write it to the json file
            $json = json_encode($new_data, JSON_PRETTY_PRINT);
            file_put_contents(self::PATH, $json);

            return true;
        } else {
            return false;
        }
    }

    // add any additional functions you need below
    public function toArray(Todo $todo) : array {
        $array = array (
            "id" => $todo->id,
            "title" => $todo->title,
            "description" => $todo->description,
            "done" => $todo->done
        );
        return $array;
    }

    public function arrayCleaner(array $array) : array {
        $todo = new Todo($array['id'], $array['title'], $array['description'], $array['done']);
        $todo = $this->toArray($todo);
        return $todo;
    }
}