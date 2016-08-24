<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('UTC');
        $this->load->model('User');
        $this->load->model('Product');
    }

    public function new_product()
    {
        $this->load->view('new_product');
    }

    public function add_product()
    {
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $price = $this->input->post('price');
        $quant_avail = $this->input->post('quant_avail');
        $url = $this->input->post('url');
        $category = $this->input->post('category');
        $info = array(
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'quant_avail' => $quant_avail,
            'url' => $url,
            'category' => $category
        );
        $added = $this->Product->add_product($info);
        if($added){
            redirect('/Users/main');
        }
    }

    public function show($product_id)
    {
        $info['id'] = $id = $this->session->userdata('id');
		$user = $this->User->get_user_by_id($id);
		$product = $this->Product->show_product($product_id);
		$cart_count = count($this->Product->get_products_in_cart($id));
        $wishlist_count = count($this->Product->get_wishlist_by_user_id($id));
        $info['user_id'] = $id;
        $info['product_id'] = $product_id;
        $reviews = $this->Product->get_product_reviews_by_id($info);

        foreach($reviews as $key => $r) {
            $date = explode(" ", $r['created_at']);
            $date = $date[0];
            $time = date_format(date_create($date), "D F d, Y");
            $reviews[$key]['created_at'] = $time;
        }

		$content['user'] = $user;
        $content['id'] = $id;
		$content['product'] = $product;
		$content['cart_count'] = $cart_count;
        $content['wishlist_count'] = $wishlist_count;
        $content['reviews'] = $reviews;
        $content['rating'] = array(10,9,8,7,6,5,4,3,2,1);
        $content['logged_in_user'] = $id;
        $content['admin'] = 1;
        $this->load->view('show', array('content' => $content));
    }

    public function move_to_cart($product_id)
    {
        $info['product_id'] = $product_id;
        $info['user_id'] = $this->session->userdata('id');
        $removed = $this->Product->remove_from_wishlist($info);
        if($removed) {
            $info['quantity'] = $this->input->post('quantity');
            $added = $this->Product->add_to_cart($info);
            if($added) {
                redirect('/Users/cart');
            }
        }
    }

    public function homegarden()
    {
        $id = $this->session->userdata('id');
        $user_id = $this->session->userdata('id');
        $user = $this->User->get_user_by_id($id);
        $cart = $this->Product->get_products_in_cart($user_id);
        $cart_count = count($this->Product->get_products_in_cart($id));
        $wishlist_count = count($this->Product->get_wishlist_by_user_id($id));
        $category = $this->Product->all_popular_home_and_garden();
        $content['user'] = $user;
        $content['cart'] = $cart;
        $content['cart_count'] = $cart_count;
        $content['wishlist_count'] = $wishlist_count;
        $content['logged_in_user'] = $id;
        $content['admin'] = 1;
        $content['category'] = $category;
        $this->load->view('homegarden', array('content' => $content));
    }

    public function clothingfootwear()
    {
        $id = $this->session->userdata('id');
        $user_id = $this->session->userdata('id');
        $user = $this->User->get_user_by_id($id);
        $cart = $this->Product->get_products_in_cart($user_id);
        $cart_count = count($this->Product->get_products_in_cart($id));
        $wishlist_count = count($this->Product->get_wishlist_by_user_id($id));
        $category = $this->Product->all_popular_clothing_and_footwear();
        $content['user'] = $user;
        $content['cart'] = $cart;
        $content['cart_count'] = $cart_count;
        $content['wishlist_count'] = $wishlist_count;
        $content['logged_in_user'] = $id;
        $content['admin'] = 1;
        $content['category'] = $category;
        $this->load->view('clothingfootwear', array('content' => $content));
    }

    public function technologygadgets()
    {
        $id = $this->session->userdata('id');
        $user_id = $this->session->userdata('id');
        $user = $this->User->get_user_by_id($id);
        $cart = $this->Product->get_products_in_cart($user_id);
        $cart_count = count($this->Product->get_products_in_cart($id));
        $wishlist_count = count($this->Product->get_wishlist_by_user_id($id));
        $category = $this->Product->all_popular_technology_and_gadgets();
        $content['user'] = $user;
        $content['cart'] = $cart;
        $content['cart_count'] = $cart_count;
        $content['wishlist_count'] = $wishlist_count;
        $content['logged_in_user'] = $id;
        $content['admin'] = 1;
        $content['category'] = $category;
        $this->load->view('techgadgets', array('content' => $content));
    }

}
