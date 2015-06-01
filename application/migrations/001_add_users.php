<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_users extends CI_Migration{

    private $tablename = "users";

    public function up(){
        $this->dbforge->add_field('id');
        $this->dbforge->add_field([
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => true,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);
        $this->dbforge->create_table($this->tablename);
    }

    public function down(){
        $this->dbforge->drop_table($this->tablename);
    }
}