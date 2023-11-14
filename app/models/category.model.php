<?php

require_once './app/models/model.php';

class CategoryModel extends Model{

    function getAllCategories() {
        $query = $this->db->prepare('SELECT * FROM categories');
        $query->execute();
        $categories = $query->fetchAll(PDO::FETCH_OBJ);
        return $categories;
    }

    function getCategorybyId($id){
        $query = $this->db->prepare('SELECT products.*, categories.category_name as category FROM products JOIN categories ON products.category_id = categories.category_id WHERE products.category_id = ?');
        $query->execute([$id]);
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    function insertCategory($value){
        $query = $this->db->prepare('INSERT INTO categories(category_name) VALUES (?)');
        $query->execute([$value]);
        return $this->db->lastInsertId();
    }

    function deleteCategory($id){
        $query = $this->db->prepare('DELETE FROM categories WHERE category_id = ?');
        $query->execute([$id]);
    }

    function updateCategory($name, $id){
            $query = $this->db->prepare('UPDATE categories SET category_name = ? WHERE category_id = ?');
            $query->execute([$name, $id]);
        }

}

