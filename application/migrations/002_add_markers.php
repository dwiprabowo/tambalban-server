<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_markers extends CI_Migration{

    private $tablename = "markers";

    public function up(){
        $this->dbforge->add_field('id');
        $this->dbforge->add_field([
            'lat' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'lng' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);
        $this->dbforge->create_table($this->tablename);
    }

    public function down(){
        $this->dbforge->drop_table($this->tablename);
    }
}