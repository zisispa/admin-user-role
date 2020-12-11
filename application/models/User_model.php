<?php

class User_model extends CI_Model
{


    //Start Users functions

    //Select all users
    public function get_entries()
    {
        $query_user = $this->db->get('dv_users');
        return $query_user->result();
    }

    //Insert Users
    public function insert_entry($data)
    {
        return $this->db->insert('dv_users', $data);
    }

    //Edit user
    public function edit_entry($id)
    {
        $this->db->select('*');
        $this->db->from('dv_users');
        $this->db->where('user_id', $id);

        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->row();
        }
    }

    //Delete user
    public function delete_entry($id)
    {
        return $this->db->delete('dv_users', array('user_id' => $id));
    }

    //Update user
    public function update_entry($data)
    {

        return $this->db->update('dv_users', $data, array('user_id' => $data['user_id']));
    }

    //Select max user id
    public function select_max_user_id()
    {
        $this->db->select_max('user_id', 'max');
        $query = $this->db->get('dv_users');
        if ($query->num_rows() == 0) {
            return 1;
        }
        $max = $query->row()->max;
        return $max;
    }

    //Select user id only
    public function select_user_id()
    {
        $this->db->select('user_id');
        $this->db->from('dv_users');

        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->result();
        }
    }

    //End Users functions

    //Select all Roles
    public function get_roles()
    {
        $query_roles = $this->db->get('dv_users_roles');
        return $query_roles->result();
    }

    //Select the roles ids pou exei o xristis
    public function get_roles_details($edit_id)
    {
        $this->db->select('ru.dv_users_roles_id');
        $this->db->from('dv_users u');
        $this->db->join('dv_users_roles_has_dv_users ru', 'u.user_id = ru.dv_users_id');
        $this->db->join('dv_users_roles r', 'r.roles_id = ru.dv_users_roles_id');
        $this->db->where('u.user_id', $edit_id);

        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->result();
        }
    }

    //Insert has_role
    public function insert_role_id_to_has_role($roles_id, $users_id)
    {

        foreach ($roles_id as $role_id) {
            $this->db->set('dv_users_roles_id ', $role_id);
            $this->db->set('dv_users_id ', $users_id);
            $this->db->insert('dv_users_roles_has_dv_users');
        }
    }

    //Get roles names
    public function get_roles_name($user_id)
    {
        $this->db->select('r.roles_name, u.name, u.username, u.user_id, u.is_active');
        $this->db->from('dv_users u');
        $this->db->join('dv_users_roles_has_dv_users ru', 'u.user_id = ru.dv_users_id');
        $this->db->join('dv_users_roles r', 'r.roles_id = ru.dv_users_roles_id');
        $this->db->where_in('u.user_id', $user_id);

        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->result();
        }
    }

    //Ta roles id pou exei o xristis wste na ta emfanisw sto edit modal
    public function get_roles_id($edit_id)
    {
        $this->db->select('r.roles_id, r.roles_name');
        $this->db->from('dv_users u');
        $this->db->join('dv_users_roles_has_dv_users ru', 'u.user_id = ru.dv_users_id');
        $this->db->join('dv_users_roles r', 'r.roles_id = ru.dv_users_roles_id');
        $this->db->where_in('u.user_id', $edit_id);

        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->result();
        }
    }

    //Diagrafi tn roles ids pou exe idi o xristis
    public function delete_role_id($role_id, $user_id)
    {
        foreach ($role_id as $role_ids) {
            $this->db->query("DELETE ru FROM dv_users u INNER JOIN dv_users_roles_has_dv_users ru ON u.user_id = ru.dv_users_id INNER JOIN dv_users_roles r ON r.roles_id = ru.dv_users_roles_id WHERE u.user_id = ? AND r.roles_id = ?", array($user_id, $role_ids));
        }
    }
}
