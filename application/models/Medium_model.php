<?php
class Medium_model extends CI_model
{
	//CREATE
	public function register_user($table,$data)
  	{
  		$this->db->where('email',$data['email']);
  		$cek = $this->db->get('users');
  		if ($cek->num_rows() < 1){
	    	$insert = $this->db->insert($table, $data);
	    	if ($insert) return TRUE;
	    }
	    return FALSE;
  	}

  	public function tambahStory($data)
	{
		$insert = $this->db->insert('post',$data);
		if ($insert) return TRUE;
		else return FALSE;
	}

	//READ
	public function login_user($email, $password)
	{
    	$this->db->where('email',$email);
    	$this->db->where('password',$password);

    	$result = $this->db->get('users');
    	if($result->num_rows()==1){
        	return $result->row(0);
    	}else{
        	return false;
    	}
  	}

  	public function getAllPost()
	{
		$this->db->select('*,fullname');
		$this->db->from('post');
		$this->db->join('users','post.id_user=users.id_user');
		return $this->db->get()->result();
	}

  	public function getPostById($id_post)
	{
		$this->db->select('*,fullname');
		$this->db->from('post');
		$this->db->join('users','post.id_user = users.id_user');
		$this->db->where('id_post',$id_post);
		return $this->db->get()->result();
	}

	public function getUserByEmail($email)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email',$email);
		return $this->db->get()->result();
	}

	public function getUserById($id_user)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id_user',$id_user);
		return $this->db->get()->result();
	}

	public function getUserPost($id_user)
	{
		$this->db->select('*');
		$this->db->from('post');
		$this->db->where('id_user',$id_user);
		return $this->db->get()->result();
	}
	//UPDATE
	public function editStory($data,$id_post)
	{
		$this->db->where('id_post',$id_post);
		$update = $this->db->update('post',$data);
		if ($update) return TRUE;
		else return FALSE;
	}

	public function editProfile($data,$id_user)
	{
		$this->db->where('id_user',$id_user);
		$update = $this->db->update('users',$data);
		if ($update) return TRUE;
		else return FALSE;
	}

	//DELETE
	public function deletePost($id_post)
	{
		$this->db->where('id_post',$id_post);
		$this->db->delete('post');
	}

	public function deleteUser($id_user)
	{
		$this->db->where('id_user',$id_user);
		$this->db->delete('post');
		$this->db->where('id_user',$id_user);
		$delete = $this->db->delete('users');
		if ($delete) return TRUE;
		else return FALSE;
	}
}