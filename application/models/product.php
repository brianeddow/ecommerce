<?php

class Product extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('UTC');
    }

    public function get_products()
    {
        return $this->db->query("SELECT * FROM Products ORDER BY created_at DESC LIMIT 3")->result_array();
    }

    public function get_newest_home_and_garden()
    {
        $query = "SELECT * FROM Products WHERE category=? ORDER BY created_at DESC LIMIT 1";
        $values = array("Home & Garden");
        return $this->db->query($query,$values)->row_array();
    }

    public function get_newest_clothing_and_footwear()
    {
        $query = "SELECT * FROM Products WHERE category=? ORDER BY created_at DESC LIMIT 1";
        $values = array("Clothing & Footwear");
        return $this->db->query($query,$values)->row_array();
    }

    public function get_newest_technology_and_gadgets()
    {
        $query = "SELECT * FROM Products WHERE category=? ORDER BY created_at DESC LIMIT 1";
        $values = array("Technology & Gadgets");
        return $this->db->query($query,$values)->row_array();
    }

    public function get_popular_products()
    {
        return $this->db->query("SELECT * FROM Products ORDER BY times_purchased DESC LIMIT 3")->result_array();
    }

    public function get_most_popular_home_and_garden()
    {
        $query = "SELECT * FROM Products WHERE category=? ORDER BY times_purchased DESC LIMIT 1";
        $values = array("Home & Garden");
        return $this->db->query($query,$values)->row_array();
    }

    public function get_most_popular_clothing_and_footwear()
    {
        $query = "SELECT * FROM Products WHERE category=? ORDER BY times_purchased DESC LIMIT 1";
        $values = array("Clothing & Footwear");
        return $this->db->query($query,$values)->row_array();
    }

    public function get_most_popular_technology_and_gadgets()
    {
        $query = "SELECT * FROM Products WHERE category=? ORDER BY times_purchased DESC LIMIT 1";
        $values = array("Technology & Gadgets");
        return $this->db->query($query,$values)->row_array();
    }

    public function all_popular_home_and_garden()
    {
        $query = "SELECT * FROM Products WHERE category=? ORDER BY times_purchased DESC LIMIT 3";
        $values = array("Home & Garden");
        return $this->db->query($query,$values)->result_array();
    }

    public function all_popular_clothing_and_footwear()
    {
        $query = "SELECT * FROM Products WHERE category=? ORDER BY times_purchased DESC LIMIT 3";
        $values = array("Clothing & Footwear");
        return $this->db->query($query,$values)->result_array();
    }

    public function all_popular_technology_and_gadgets()
    {
        $query = "SELECT * FROM Products WHERE category=? ORDER BY times_purchased DESC LIMIT 3";
        $values = array("Technology & Gadgets");
        return $this->db->query($query,$values)->result_array();
    }

    public function get_product_reviews_by_id($info)
    {
        $query = "SELECT CONCAT(Users.f_name, ' ', Users.l_name) as name, product_reviews.rating as rating, product_reviews.text as text, product_reviews.created_at as created_at FROM Users
                       JOIN product_reviews ON Users.id=product_reviews.user_id
                       JOIN products ON product_reviews.product_id=products.id
                       WHERE Users.id = ? AND product_reviews.product_id = ?
                       ORDER BY product_reviews.created_at DESC";
        $values = array($info['user_id'],$info['product_id']);
        return $this->db->query($query,$values)->result_array();
    }

    public function add_product($info)
    {
        $query = "INSERT INTO Products(name,description,price,quant_avail,url,category,created_at,updated_at)
                        VALUES(?,?,?,?,?,?,NOW(),NOW())";
        $values = array($info['name'],$info['description'],$info['price'],$info['quant_avail'],$info['url'],$info['category']);
        return $this->db->query($query,$values);
    }

    public function add_review($info)
    {
        $query = "INSERT INTO product_reviews(user_id,product_id,rating,text,created_at,updated_at)
                        VALUES(?,?,?,?,NOW(),NOW())";
        $values = array($info['user_id'],$info['product_id'],$info['rating'],$info['text']);
        return $this->db->query($query,$values);
    }

    public function add_to_cart($info)
    {
        $query = "INSERT INTO Cart(user_id,product_id,quantity) VALUES(?,?,?)";
        $values = array($info['user_id'],$info['product_id'],$info['quantity']);
        return $this->db->query($query,$values);
    }

    public function update_item_quantity_in_cart($info)
    {
        $query = "UPDATE Cart SET quantity=? WHERE user_id=? AND product_id=?";
        $values = array($info['quantity'],$info['user_id'],$info['product_id']);
        return $this->db->query($query,$values);
    }

    public function update_product_quantity($info)
    {
        $query = "UPDATE Products SET quant_avail=? WHERE id=?";
        $values = array($info['quantity'],$info['product_id']);
        return $this->db->query($query,$values);
    }

    public function get_products_in_cart($user_id)
    {
        $query = "SELECT products.id, products.name, products.description,
                                   products.price, products.quant_avail, products.url,
                                   cart.quantity as quantity
                       FROM Users
                       JOIN Cart ON users.id = cart.user_id
                       JOIN Products ON cart.product_id = products.id
                       WHERE users.id =?";
        $values = array($user_id);
        return $this->db->query($query,$values)->result_array();
    }

    public function remove_from_cart($info)
    {
        $query = "DELETE FROM Cart WHERE cart.product_id=? AND cart.user_id=? AND cart.quantity=?";
        $values = array($info['product_id'],$info['user_id'],$info['quantity']);
        return $this->db->query($query,$values);
    }

    public function show_product($id)
    {
        $query = "SELECT * FROM Products WHERE id=?";
        $values = array($id);
        return $this->db->query($query,$values)->row_array();
    }

    public function add_to_wishlist($info)
    {
        $query = "INSERT INTO Wishlist(product_id,user_id) VALUES(?,?)";
        $values = array($info['product_id'],$info['user_id']);
        return $this->db->query($query,$values);
    }

    public function remove_from_wishlist($info)
    {
        $query = "DELETE FROM Wishlist WHERE product_id=? AND user_id=?";
        $values = array($info['product_id'],$info['user_id']);
        return $this->db->query($query,$values);
    }

    public function get_wishlist_by_user_id($id)
    {
        $query = "SELECT products.id, products.name, products.description, products.price, products.quant_avail, products.url, wishlist.quantity FROM Users
                       JOIN wishlist
                       ON users.id = wishlist.user_id
                       JOIN products
                       ON wishlist.product_id = products.id
                       WHERE users.id = ?";
        $values = array($id);
        return $this->db->query($query,$values)->result_array();
    }

    public function get_wishlist_ids_by_user_id($id)
    {
        $query = "SELECT products.id FROM Users
                       JOIN wishlist
                       ON users.id = wishlist.user_id
                       JOIN products
                       ON wishlist.product_id = products.id
                       WHERE users.id = ?";
        $values = array($id);
        return $this->db->query($query,$values)->result_array();
    }

    public function get_product_by_id($id)
    {
        return $this->db->query("SELECT * FROM Products WHERE id=?",$id)->row_array();
    }

}
