<?php

function getTxt($id = null) {
    global $conn;
    if (!isset($id))
        return;
    $id = intval($id);
    $result = $conn->query("SELECT text FROM texts WHERE id=$id LIMIT 1");
    $data = $result->fetch_assoc();
    if ($result->num_rows > 0)
        return $data['text'];
    else
        return insertTxt($id, 'text#' . $id);
}

function setTxt($id = null, $data) {
    global $conn;
    if (!isset($id))
        return;
    $id = intval($id);
    $data = strip_tags($data);
    $data = $conn->escape_string($data);
    if ($conn->query("UPDATE texts SET text='$data' WHERE id=$id") === true)
        return $conn->affected_rows;
    else
        die("Error: " . $conn->error);
}

function insertTxt($id = null, $data) {
    global $conn;
    if (!isset($id))
        return;
    $id = intval($id);
    $data = strip_tags($data);
    $data = $conn->escape_string($data);
    if ($conn->query("INSERT INTO texts (id, text) VALUES ('$id', '$data')") === true)
        return getTxt($id);
    else
        die("Error: " . $conn->error);
}

function t($id = null) {
    global $admin;
    if (!isset($id))
        return;
    $id = intval($id);
    $adminBtn = '<span class="admin" data="/admin/edit.php?what=txt&id=' . $id . '">[' . $id . ']</span>';
    echo $admin ? '<span class="admin-wr">' . $adminBtn . getTxt($id) . '</span>' : getTxt($id);
}
