<?php

class User extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('UTC');
    }

    public function get_all_users()
    {
        return $this->db->query("SELECT * FROM users")->result_array();
    }

    public function get_user($info)
    {
        $query = "SELECT * FROM Users WHERE email=? AND password=?";
        $values = array($info['email'], $info['password']);
        return $this->db->query($query, $values)->row_array();
    }

    public function get_user_by_id($id)
    {
        $query = "SELECT * FROM Users WHERE id=?";
        $values = array($id);
        return $this->db->query($query, $values)->row_array();
    }

    public function add_user($user_info)
    {
        $query = "INSERT INTO Users(username, f_name, l_name, email, password, created_at, updated_at)
                  VALUES (?,?,?,?,?,NOW(),NOW())";
        $values = array($user_info['username'],$user_info['f_name'], $user_info['l_name'], $user_info['email'], $user_info['password']);
        return $this->db->query($query, $values);
    }

    public function add_address($info)
    {
        $query = "INSERT INTO Addresses(user_id, main, street, city, state, zip, created_at, updated_at)
                        VALUES (?,?,?,?,?,?,NOW(),NOW())";
        $values = array($info['user_id'],$info['main'],$info['street'],$info['city'],$info['state'],$info['zip']);
        return $this->db->query($query,$values);
    }

    public function get_addresses($id)
    {
        $query = "SELECT Addresses.main, Addresses.street, Addresses.city, Addresses.state, Addresses.zip FROM Users
                        JOIN Addresses ON users.id=addresses.user_id WHERE users.id=?";
        $values = array($id);
        return $this->db->query($query,$values)->result_array();
    }

    public function get_primary_address($id)
    {
        $query = "SELECT Addresses.main, Addresses.street, Addresses.city, Addresses.state, Addresses.zip FROM Users
                        JOIN Addresses ON users.id=addresses.user_id WHERE Users.id=? AND Addresses.main=1";
        $values = array($id);
        return $this->db->query($query,$values)->row_array();
    }

    public function update_user_info($info)
    {
        $query = "UPDATE Users SET username=?, f_name=?, l_name=?, email=? WHERE id=?";
        $values = array($info['username'],$info['f_name'],$info['l_name'],$info['email'],$info['id']);
        return $this->db->query($query,$values);
    }

    public function update_password($info)
    {
        $query = "UPDATE Users SET password=?";
        $values = array($info['password']);
        return $this->db->query($query,$values);
    }

    public function add_payment_method($info)
    {
        $query = "INSERT INTO Creditcards(user_id,main,number,type,card_holder,exp,sec_code,created_at,updated_at)
                       VALUES(?,?,?,?,?,?,?,NOW(),NOW())";
        $values = array($info['user_id'],$info['main'],$info['number'],$info['type'],$info['name'],$info['exp'],$info['sec_code']);
        return $this->db->query($query,$values);
    }

    public function get_payment_methods($id)
    {
        $query = "SELECT * FROM Creditcards WHERE Creditcards.user_id=?";
        $values = array($id);
        return $this->db->query($query,$values)->result_array();
    }

    public function get_primary_payment_method($id)
    {
        $query = "SELECT * FROM Creditcards WHERE Creditcards.user_id=? AND Creditcards.main=1";
        $values = array($id);
        return $this->db->query($query,$values)->row_array();
    }

    public function create_order($user_id)
    {
        $query = "INSERT INTO Orders(user_id,created_at,updated_at) VALUES(?,NOW(),NOW())";
        $values = array($user_id);
        return $this->db->query($query,$values);
    }

    public function last_order_placed()
    {
        return $this->db->query("SELECT * FROM Orders ORDER BY created_at DESC LIMIT 1")->row_array();
    }

    public function add_product_to_order($info)
    {
        $query = "INSERT INTO products_on_order(order_id,product_id,quantity) VALUES(?,?,?)";
        $values = array($info['order_id'],$info['product_id'],$info['quantity']);
        return $this->db->query($query,$values);
    }

    public function get_checkout_by_user_id($user_id)
    {
        $query = "SELECT Products.id as product_id, Products.name, Products.price, Products.category, products_on_order.quantity,
                       Orders.id as order_id, Products.url FROM Users
                       JOIN Orders ON users.id=orders.user_id
                       JOIN products_on_order ON orders.id=products_on_order.order_id
                       JOIN Products ON products_on_order.product_id=products.id
                       WHERE users.id=? ORDER BY Orders.created_at DESC LIMIT 1";
        $values = array($user_id);
        return $this->db->query($query,$values)->result_array();
    }

    public function get_order_history_by_user_id($user_id)
    {
        $query = "SELECT DISTINCT Orders.id, Orders.created_at FROM Users
                       JOIN Orders ON users.id=orders.user_id
                       JOIN products_on_order ON orders.id=products_on_order.order_id
                       JOIN Products ON products_on_order.product_id=products.id
                       WHERE users.id=? ORDER BY Orders.created_at DESC";
        $values = array($user_id);
        return $this->db->query($query,$values)->result_array();
    }

}

?>
