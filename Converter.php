<?php

class Converter
{
    // Source database variables
    private $source_db_type;
    private $source_db_server;
    private $source_db_user;
    private $source_db_pass;
    private $source_db_name;

    // Target database variables
    private $target_db_type;
    private $target_db_server;
    private $target_db_user;
    private $target_db_pass;
    private $target_db_name;

    // Constructor
    function __construct($source_db_type, $source_db_server, $source_db_user, $source_db_pass, $source_db_name, $target_db_type, $target_db_server, $target_db_user, $target_db_pass, $target_db_name)
    {
        $this->source_db_type = $source_db_type;
        $this->source_db_server = $source_db_server;
        $this->source_db_user = $source_db_user;
        $this->source_db_pass = $source_db_pass;
        $this->source_db_name = $source_db_name;
        $this->target_db_type = $target_db_type;
        $this->target_db_server = $target_db_server;
        $this->target_db_user = $target_db_user;
        $this->target_db_pass = $target_db_pass;
        $this->target_db_name = $target_db_name;
    }

    public function convert()
    {

    }

}