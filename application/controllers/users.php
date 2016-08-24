<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User');
		$this->load->model('Product');
	}

	public function index()
	{
		if(!$this->session->userdata('id'))
		{
			$this->load->view('index');
		}
		else
		{
			redirect('/Users/main');
		}
	}

	public function main()
	{
		$info['id'] = $this->session->userdata('id');
		$id = $info['id'];
		$user = $this->User->get_user_by_id($id);
		$homeAndGarden = $this->Product->get_newest_home_and_garden();
		$clothingAndFootwear = $this->Product->get_newest_clothing_and_footwear();
		$technologyAndGadgets = $this->Product->get_newest_technology_and_gadgets();
		$popular_hg = $this->Product->get_most_popular_home_and_garden();
		$popular_cf = $this->Product->get_most_popular_clothing_and_footwear();
		$popular_tg = $this->Product->get_most_popular_technology_and_gadgets();
		$cart_count = count($this->Product->get_products_in_cart($id));
		$wishlist_count = count($this->Product->get_wishlist_by_user_id($id));
		$content = array(
			'user' => $user,
			'homeAndGarden' => $homeAndGarden,
			'clothingAndFootwear' => $clothingAndFootwear,
			'technologyAndGadgets' => $technologyAndGadgets,
			'popular_homeAndGarden' => $popular_hg,
			'popular_clothingAndFootwear' => $popular_cf,
			'popular_technologyAndGadgets' => $popular_tg,
			'cart_count' => $cart_count,
			'wishlist_count' => $wishlist_count,
			'logged_in_user' => $id,
			'admin' => 1
		);
		$this->load->view('dashboard', array('content' => $content));
	}

	public function register()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('f_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('l_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('password_confirmation', 'Password Confirmation', 'trim|required|matches[password]');
		if($this->form_validation->run() === FALSE)
		{
			$this->session->set_flashdata('errors', validation_errors());
			redirect('/');
		}
		else
		{

			$user_info = array(
				'username' => $this->input->post('username'),
				'f_name' => $this->input->post('f_name'),
				'l_name' => $this->input->post('l_name'),
				'email' => $this->input->post('email'),
				'password' => do_hash($this->input->post('password'), 'md5')
				);
			$added = $this->User->add_user($user_info);
			if($added)
			{
				$info['email'] = $user_info['email'];
				$info['password'] = $user_info['password'];
				$user = $this->User->get_user($info);
				if($user) {
					$this->session->set_userdata('id', $user['id']);
					redirect('/Users/main');
				}
			}
		}
	}

	public function login()
	{
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('errors2', validation_errors());
			redirect('/');
		}
		else
		{
			$info['email'] = $this->input->post('email');
			$info['password'] = do_hash($this->input->post('password'), 'md5');
			$user = $this->User->get_user($info);
			if($user['email'] == $info['email'])
			{
				if($user['password'] == $info['password'])
				{
					$this->session->set_userdata('id', $user['id']);
					redirect('Users/main');
				}
				else
				{
					$this->session->set_flashdata('errors3', 'Incorrect email or password');
					redirect('/');
				}
			}
			else
			{
				$this->session->set_flashdata('errors3', 'Please enter valid credentials');
				redirect('/');
			}
		}
	}

	public function cart()
	{
		$id = $this->session->userdata('id');
		$user_id = $this->session->userdata('id');
		$user = $this->User->get_user_by_id($id);
		$cart = $this->Product->get_products_in_cart($user_id);
		$cart_count = count($this->Product->get_products_in_cart($id));
		$wishlist_count = count($this->Product->get_wishlist_by_user_id($id));
		$content['user'] = $user;
		$content['cart'] = $cart;
		$content['cart_count'] = $cart_count;
		$content['wishlist_count'] = $wishlist_count;
		$this->load->view('cart', array('content' => $content));
	}

	public function add_to_cart($product_id)
	{
		$in_cart = $this->Product->get_products_in_cart($this->session->userdata('id'));
		// check if cart is empty
		if(!count($in_cart)) {
			$info['quantity'] = $this->input->post('quantity');
			$info['product_id'] = $product_id;
			$info['user_id'] = $this->session->userdata('id');
			// if it is add this product
			$added = $this->Product->add_to_cart($info);
			if($added) {
				// if product was added, decrement the product count
				// this is not the most accurate place to edit the count, but this is fine for functional purposes first
				$product = $this->Product->get_product_by_id($product_id);
				$info['quantity'] = $product['quant_avail'] -= $this->input->post('quantity');
				// if the count after the decrement is 0, set it back to 50 (full stock)
				if($info['quantity'] == 0) {
					$info['quantity'] = 50;
				}
				$updated = $this->Product->update_product_quantity($info);
				// now lets get back to shopping
				if($updated) {
					redirect('/Users/main');
				}
			}
		} else {
			// if the cart is not empty, check if product is already in cart
			foreach($in_cart as $item) {
				// if the id never matches, just add it
				if($item['id'] != $product_id) {
					$info['quantity'] = $this->input->post('quantity');
					$info['product_id'] = $product_id;
					$info['user_id'] = $this->session->userdata('id');
					$added = $this->Product->add_to_cart($info);
					if($added) {
						// then decrement the product count for inventory
						$product = $this->Product->get_product_by_id($product_id);
						$info['quantity'] = $product['quant_avail'] -= $this->input->post('quantity');
						// if the product is out of stock after purchase, replenish stock
						if($info['quantity'] == 0) {
							$info['quantity'] = 50;
						}
						$updated = $this->Product->update_product_quantity($info);
						if($updated) {
							// back to shopping
							redirect('/Users/main');
						}
					}
				} else {
					// if the product id being added matches one in the cart
					// increment quantity for the item
					$item['quantity'] += $this->input->post('quantity');
					$info = array(
						'quantity' => $item['quantity'],
						'user_id' => $this->session->userdata('id'),
						'product_id' => $product_id
					);
					$updated = $this->Product->update_item_quantity_in_cart($info);
					if($updated) {
						// if it was added successfully, decrement inventory count by quantity purchased
						$product = $this->Product->get_product_by_id($product_id);
						$info['quantity'] = $product['quant_avail'] -= $this->input->post('quantity');
						// if quantity is 0 after assignment, set it to 50 to replenish stock
						if($info['quantity'] == 0) {
							$info['quantity'] = 50;
						}
						$updated = $this->Product->update_product_quantity($info);
						if($updated) {
							// back to shopping
							redirect('/Products/show/'.$product_id.'/');
						}
					}
				}
			}
		}
	}

	public function remove_from_cart($product_id,$quantity)
	{
		$info['product_id'] = $product_id;
		$info['user_id'] = $this->session->userdata('id');
		$info['quantity'] = $quantity;
		$removed = $this->Product->remove_from_cart($info);
		if($removed) {
			redirect('/Users/cart');
		}
	}

	public function wishlist()
	{
		$id = $this->session->userdata('id');
		$cart_count = count($this->Product->get_products_in_cart($id));
		$wishlist = $this->Product->get_wishlist_by_user_id($id);
		$wishlist_count = count($this->Product->get_wishlist_by_user_id($id));
		$content = array(
			'user' => $this->User->get_user_by_id($id),
			'cart_count' => $cart_count,
			'wishlist_count' => $wishlist_count,
			'wishlist' => $wishlist
		);
		$this->load->view('wishlist.php', array('content' => $content));
	}

	public function add_to_wishlist($product_id)
	{
		$on_wishlist = $this->Product->get_wishlist_ids_by_user_id($this->session->userdata('id'));
		foreach($on_wishlist as $item) {
			// check if item is already on wishlist
			if($item['id'] != $product_id){
				// if not, add it
				$info['product_id'] = $product_id;
				$info['user_id'] = $this->session->userdata('id');
				$added = $this->Product->add_to_wishlist($info);
				if($added) {
					redirect('/Products/show/'.$product_id.'/');
				}
			} else {
				// otherwise, let the customer know it's already there
				$this->session->set_flashdata('wishlist_error', 'Item already on wishlist!');
				redirect('/Products/show/'.$product_id.'/');
			}
		}
	}

	public function remove_from_wishlist($product_id,$quantity)
	{
		$info['product_id'] = $product_id;
		$info['user_id'] = $this->session->userdata('id');
		$info['quantity'] = $quantity;
		$removed = $this->Product->remove_from_wishlist($info);
		if($removed) {
			redirect('/Users/wishlist');
		}
	}

	public function account()
	{
		$id = $this->session->userdata('id');
		$products = $this->Product->get_products();
		$cart_count = count($this->Product->get_products_in_cart($id));
		$wishlist_count = count($this->Product->get_wishlist_by_user_id($id));
		$addresses = $this->User->get_addresses($id);
		$payment = $this->User->get_payment_methods($id);
		$order_history = $this->User->get_order_history_by_user_id($id);

		foreach($order_history as $key => $r) {
            $date = explode(" ", $r['created_at']);
            $date = $date[0];
            $time = date_format(date_create($date), "D F d, Y");
            $order_history[$key]['created_at'] = $time;
        }

		$content = array(
			'user' => $this->User->get_user_by_id($id),
			'products' => $products,
			'cart_count' => $cart_count,
			'wishlist_count' => $wishlist_count,
			'addresses' => $addresses,
			'order_history' => $order_history,
			'payment' => $payment
		);
		$this->load->view('account', array('content' => $content));
	}

	public function new_address()
	{
		$id = $this->session->userdata('id');
		$products = $this->Product->get_products();
		$cart_count = count($this->Product->get_products_in_cart($id));
		$wishlist_count = count($this->Product->get_wishlist_by_user_id($id));
		$content['user'] = $this->User->get_user_by_id($id);
		$content['products'] = $products;
		$content['cart_count'] = $cart_count;
		$content['wishlist_count'] = $wishlist_count;
		$this->load->view('new_address', array('content' => $content));
	}

	public function add_address()
	{
		$this->form_validation->set_rules('street', 'Street', 'trim|required');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('state', 'State', 'trim|required|max_length[2]');
		$this->form_validation->set_rules('zip', 'Zipcode', 'trim|required|max_length[5]');
		if($this->form_validation->run() === FALSE)
		{
			$this->session->set_flashdata('add_address_errors', validation_errors());
			redirect('/Users/new_address');
		}
		else
		{
			$info['main'] = $this->input->post('main') ? '1' : '0';
			$info['user_id'] = $this->session->userdata('id');
			$info['street'] = $this->input->post('street');
			$info['city'] = $this->input->post('city');
			$info['state'] = $this->input->post('state');
			$info['zip'] = $this->input->post('zip');
			$added = $this->User->add_address($info);
			if($added)
			{
				redirect('/Users/account');
			}
		}
	}

	public function new_payment_method()
	{
		$id = $this->session->userdata('id');
		$products = $this->Product->get_products();
		$cart_count = count($this->Product->get_products_in_cart($id));
		$wishlist_count = count($this->Product->get_wishlist_by_user_id($id));
		$content['user'] = $this->User->get_user_by_id($id);
		$content['products'] = $products;
		$content['cart_count'] = $cart_count;
		$content['wishlist_count'] = $wishlist_count;
		$content['cardtypes'] = array('','VISA','MASTERCARD','DISCOVER','AMEX');
		$this->load->view('new_payment_method', array('content' => $content));
	}

	public function add_payment_method()
	{
		$this->form_validation->set_rules('number', 'Card number', 'trim|required|min_length[16]|max_length[16]|xss_clean|md5');
		$this->form_validation->set_rules('cardholder', 'Name on card', 'trim|required|xss_clean');
		$this->form_validation->set_rules('type', 'Card type', 'required');
		$this->form_validation->set_rules('exp', 'Expiration date', 'required');
		$this->form_validation->set_rules('code', 'Security code', 'trim|required|min_length[3]|max_length[3]|xss_clean|md5');
		if($this->form_validation->run() === FALSE)
		{
			$this->session->set_flashdata('add_payment_method_errors', validation_errors());
			redirect('/Users/new_payment_method/');
		}
		else
		{
			$info['user_id'] = $this->session->userdata('id');
			$info['number'] = $this->input->post('number');
			$info['name'] = $this->input->post('cardholder');
			$info['type'] = $this->input->post('type');
			$info['exp'] = $this->input->post('exp');
			$info['sec_code'] = $this->input->post('code');
			$info['main'] = $this->input->post('main') ? '1' : '0';
			$added = $this->User->add_payment_method($info);
			if($added)
			{
				redirect('/Users/account/');
			}
		}
	}

	public function edit()
	{
		$id = $this->session->userdata('id');
		$products = $this->Product->get_products();
		$cart_count = count($this->Product->get_products_in_cart($id));
		$wishlist_count = count($this->Product->get_wishlist_by_user_id($id));
		$addresses = $this->User->get_addresses($id);
		$content['user'] = $this->User->get_user_by_id($id);
		$content['products'] = $products;
		$content['cart_count'] = $cart_count;
		$content['wishlist_count'] = $wishlist_count;
		$content['addresses'] = $addresses;
		$this->load->view('edit', array('content' => $content));
	}

	public function update()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('f_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('l_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		if($this->form_validation->run() === FALSE)
		{
			$this->session->set_flashdata('update_errors', validation_errors());
			redirect('/Users/edit');
		}
		else
		{
			$info['username'] = $this->input->post('username');
			$info['f_name'] = $this->input->post('f_name');
			$info['l_name'] = $this->input->post('l_name');
			$info['email'] = $this->input->post('email');
			$info['id'] = $this->session->userdata('id');
			$updated = $this->User->update_user_info($info);
			if($updated)
			{
				redirect('/Users/account');
			}
		}
	}

	public function edit_password()
	{
		$id = $this->session->userdata('id');
		$products = $this->Product->get_products();
		$cart_count = count($this->Product->get_products_in_cart($id));
		$wishlist_count = count($this->Product->get_wishlist_by_user_id($id));
		$addresses = $this->User->get_addresses($id);
		$content['user'] = $this->User->get_user_by_id($id);
		$content['products'] = $products;
		$content['cart_count'] = $cart_count;
		$content['wishlist_count'] = $wishlist_count;
		$content['addresses'] = $addresses;
		$this->load->view('edit_password', array('content' => $content));
	}

	public function update_password()
	{
		$this->form_validation->set_rules('password', 'New Password', 'required|trim|min_length[6]|matches[password_conf]');
		$this->form_validation->set_rules('password_conf', 'New Password confirmation', 'required|trim');
		if($this->form_validation->run() === FALSE)
		{
			$this->session->set_flashdata('update_password_errors', validation_errors());
			redirect('/Users/edit_password');
		}
		else
		{
			$info['password'] = do_hash($this->input->post('password'), 'md5');
			$updated = $this->User->update_password($info);
			if($updated)
			{
				redirect('/Users/edit');
			}
		}
	}

	public function add_review($user_id,$product_id)
	{
		$info['user_id'] = $user_id;
		$info['product_id'] = $product_id;
		$info['rating'] = $this->input->post('score');
		$info['text'] = $this->input->post('text');
		$submitted = $this->Product->add_review($info);
		if($submitted)
		{
			redirect('/Products/show/'.$product_id.'/');
		}
	}

	public function get_checkout()
	{
		$user_id = $this->session->userdata('id');
		$items = $this->Product->get_products_in_cart($user_id);
		$order_created = $this->User->create_order($user_id);
		if($order_created)
		{
			$order = $this->User->last_order_placed();
			if($order)
			{
				foreach($items as $item)
				{
					$info['order_id'] = $order['id'];
					$info['product_id'] = $item['id'];
					$info['quantity'] = $item['quantity'];
					$this->User->add_product_to_order($info);
				}
				redirect('/Users/checkout');
			}
		}
	}

	public function checkout()
	{
		$id = $this->session->userdata('id');
		$user_id = $this->session->userdata('id');
		$user = $this->User->get_user_by_id($id);
		$cart = $this->Product->get_products_in_cart($user_id);
		$checkout = $this->User->get_checkout_by_user_id($user_id);
		$amount = $checkout[0]['price'] * $checkout[0]['quantity'];

		$total = 0;
		foreach($checkout as $k => $v)
		{
			// get checkout total
			$total += $v['price'] * $v['quantity'];
		}
		// remove decimal for stripe
		$el = explode(".", $total);
		$total = implode($el);

		$address = $this->User->get_primary_address($id);
		$payment = $this->User->get_primary_payment_method($id);
		$cart_count = count($this->Product->get_products_in_cart($id));
		$wishlist_count = count($this->Product->get_wishlist_by_user_id($id));
		// package all checkout data
		$content['user'] = $user;
		$content['cart'] = $cart;
		$content['cart_count'] = $cart_count;
		$content['wishlist_count'] = $wishlist_count;
		$content['checkout'] = $checkout; // order details from db
		$content['address'] = $address;
		$content['payment'] = $payment;
		$content['amount'] = $amount; // total with decimal 
		$content['total'] = $total; // stripe total with decimal removed
		$this->load->view('checkout', array('content' => $content));
	}

	public function logout()
	{
		$this->session->unset_userdata('id');
		redirect('/');
	}
}
