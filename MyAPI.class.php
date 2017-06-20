<?php

include_once 'helpers/requires.php';
require_once 'API.class.php';

class MyAPI extends API
{
    protected $User;
    
    public function __construct($request, $origin)
    {
        parent::__construct($request);
        if (($this->User_type = Utilities::validate_key($this->APIkey))==null) { //validar APIkey
            throw new Exception('API Key not recognized');
        }
    }
    
    /**
    * Example of an Endpoint
    */
    protected function example($values)
    {
        if ($this->method == 'GET') {
            return 'My name is '.$values[0];
        } else {
            return "Only accepts GET requests";
        }
    }
    
    protected function contacts($values)
    {
        if (!Utilities::validate_user($this->User_type, $this->method)) {
            throw new Exception('Not permited');
        }
        if ($this->method=='GET') {
            return Contacts::get_contacts();
        } elseif ($this->method=='POST') {
            return Contacts::update_contacts();
        }
    }
    
    protected function events($values)
    {
        if (!Utilities::validate_user($this->User_type, $this->method)) {
            throw new Exception('Not permited');
        }
        if ($this->method=='GET') {
            if (empty($values)) {
                return Event::get_events();
            } elseif (!empty($values)) {
                if ($this->verb=="") {
                    return Event::get_event_by_id($values[0]);
                } elseif ($this->verb=="tags") {
                    return Event::get_event_by_tag($values);
                } elseif ($this->verb=="date") {
                    return Event::get_event_by_date($values[0]);
                } else {
                    return null;
                }
            } elseif ($this->method=='POST') {
                        return null;
            }
        }
    }
    
    protected function news($values)
    {
        if (!Utilities::validate_user($this->User_type, $this->method)) {
            throw new Exception('Not permited');
        }
        if ($this->method=='GET') {
            if (empty($values)) {
                return News::get_news();
            } elseif (!empty($values)) {
                if ($this->verb=="") {
                    return News::get_news_by_id($values[0]);
                } else {
                    return News::get_news_by_tag($values);
                }
            } elseif ($this->method=='POST') {
                        return null;
            }
        }
    }

    protected function social($values)
    {
        if (!Utilities::validate_user($this->User_type, $this->method)) {
            throw new Exception('Not permited');
        }
        if ($this->method=='GET') {
            return SocialNetworks::get_social_networks();
        } elseif ($this->method=='POST') {
            return SocailNetworks::update_social_networks();
        }
    }

    protected function info($values)
    {
        if (!Utilities::validate_user($this->User_type, $this->method)) {
            throw new Exception('Not permited');
        }
        if ($this->method=='GET') {
            return Info::get_info();
        } elseif ($this->method=='POST') {
            return Info::update_info();
        }
    }

    protected function image($values)
    {
        if (!Utilities::validate_user($this->User_type, $this->method)) {
            throw new Exception('Not permited');
        }
        if ($this->method=='GET') {
            if (!empty($values)) {
                return Image::get_image($this->verb, $values[0]);
            } else {
                throw new Exception('No image requested');
            }
        } elseif ($this->method=='POST') {
            // return Info::update_info();
        }
    }

    protected function price()
    {
        if (!Utilities::validate_user($this->User_type, $this->method)) {
            throw new Exception('Not permited');
        }
        if ($this->method=='GET') {
            return Price::get_prices();
        } elseif ($this->method=='POST') {
            return Price::update_price();
        }
    }

    protected function schedule()
    {
        if (!Utilities::validate_user($this->User_type, $this->method)) {
            throw new Exception('Not permited');
        }
        if ($this->method=='GET') {
            return Schedule::get_schedule();
        } elseif ($this->method=='POST') {
            return Schedule::update_schedule();
        }
    }

    protected function form()
    {
        if (!Utilities::validate_user($this->User_type, $this->method, $this->endpoint)) {
            throw new Exception('Not permited');
        }
        if ($this->method=='GET') {
            return Form::get_questions();
        } elseif ($this->method=='POST') {
            if ($this->verb=="answer") {
                return Form::answer($values[0], $values[1]);
            } elseif ($this->verb=="update") {
                return Form::update_question($values[0], $values[1]);
            } elseif ($this->verb=="insert") {
                return Form::insert_questions($values);
            }
        }
    }
}