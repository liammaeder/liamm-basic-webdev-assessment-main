function putTodo(todo) {
    // implement your code here

    // construct the response method, headers, and body
    let options = {
        method: 'PUT',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(todo)
    };

    // send the request
    fetch(window.location.href + 'api/todo', options)
    .then(response => response.json())
    .then(json => console.log(json))
    .catch(error => showToastMessage('Failed to update the todo...'));

    console.log("calling putTodo");
    console.log(todo);
}

function postTodo(todo) {
    // implement your code here
    
    // construct the response method, headers, and body
    let options = {
        method: 'POST',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(todo)
    };

    // send the request
    fetch(window.location.href + 'api/todo', options)
    .then(response => response.json())
    .then(json => console.log(json))
    .catch(error => showToastMessage('Failed to create the todo...'));

    console.log("calling postTodo");
    console.log(todo);
}

function deleteTodo(todo) {
    // implement your code here

    // construct the response method, headers, and body
    let options = {
        method: 'DELETE',
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(todo)
    };

    // send the request
    fetch(window.location.href + 'api/todo', options)
    .then(response => response.json())
    .then(json => console.log(json))
    .catch(error => showToastMessage('Failed to delete the todo...'));
    
    console.log("calling deleteTodo");
    console.log(todo);
}

// example using the FETCH API to do a GET request
function getTodos() {
    fetch(window.location.href + 'api/todo')
    .then(response => response.json())
    .then(json => drawTodos(json))
    .catch(error => showToastMessage('Failed to retrieve todos...'));
}

getTodos();