<?php
include_once 'db_connect.php';

function getNewId($table){
    global $gbd;

    $sql = "SELECT max(id) FROM $table";
    $gsent = $gbd->prepare($sql);
    $gsent->execute();
    $result = $gsent->fetch();
    
    return $result[0]+1;
}

function getAllNotes(){ 
    global $gbd;

    $sql = 'SELECT * from notes';
    $gsent = $gbd->prepare($sql);
    $gsent->execute();
    $result = $gsent->fetchAll();
    
    return $result;
};

function getNoteById($id){ 
    global $gbd;

    $sql = 'SELECT * from notes where id = ?';
    $gsent = $gbd->prepare($sql);
    $gsent->execute(array($id));
    $result = $gsent->fetch();
    
    return $result;
};

function getColorClassOfNote($id){
    global $gbd;

    $sql = 'SELECT colors.bootstrap from colors INNER JOIN notes where notes.id = ? AND notes.color = colors.id ';
    $gsent = $gbd->prepare($sql);
    $gsent->execute(array($id));
    $result = $gsent->fetch();
    
    return $result[0];
};

function getColorIdOfNote($id){
    global $gbd;

    $sql = 'SELECT colors.id from colors INNER JOIN notes where notes.id = ? AND notes.color = colors.id ';
    $gsent = $gbd->prepare($sql);
    $gsent->execute(array($id));
    $result = $gsent->fetch();
    
    return $result[0];
};

function getAllColors(){
    global $gbd;

    $sql = 'SELECT * from colors';
    $gsent = $gbd->prepare($sql);
    $gsent->execute();
    $result = $gsent->fetchAll();
    
    return $result;
};

function insertNote($title, $description, $color){
    global $gbd;
    try{
        $newId = getNewId("notes");             
        $sql = "INSERT INTO notes (title, description, color, id) VALUES (?, ?, ?, ?)";
        $gsent = $gbd->prepare($sql);
        $gsent->execute(array($title, $description, $color, $newId));
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
};

function updateNote($id, $title, $description, $color){
    global $gbd;
    try{
        $sql = "UPDATE notes SET title = ?, description = ?, color = ? WHERE id = ?";
        $gsent = $gbd->prepare($sql);
        $gsent->execute(array($title, $description, $color, $id));
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
};

function deleteNote($id){
    global $gbd;
    try{
        $sql = "DELETE FROM notes WHERE id = ?";
        $gsent = $gbd->prepare($sql);
        $gsent->execute(array($id));
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
};

?>