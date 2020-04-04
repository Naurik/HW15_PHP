<?php


namespace Step\Models;


use ActiveRecord\Model;

class Book extends Model
{

    public static $table_name = 'books';
    public $user;

    public function __construct(array $attributes = array(), $guard_attributes = true, $instantiating_via_find = false, $new_record = true)
    {
        parent::__construct($attributes, $guard_attributes, $instantiating_via_find, $new_record);

        $this->user = $this->user();

    }

    public function user() {
        return User::find_by_id($this->user_id ?? 0);
    }

}
