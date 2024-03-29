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

    protected function contacts($values)
    {
        if (!Utilities::validate_user($this->User_type, $this->method)) {
            throw new Exception('Not permited');
        }
        if ($this->method=='GET') {
            return Contacts::get_contacts();
        } elseif ($this->method=='POST') {
            if($this->verb=="update") {
                return Contacts::update_contacts($values);
            } else {
                return null;
            }
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
            }
        } elseif ($this->method=='POST') {
            if ($this->verb=="add") {
                return Event::add_event($values);
            } elseif ($this->verb=="update") {
                return Event::update_event($values);
            } else {
                return null;
            }
        } elseif ($this->method=='DELETE') {
            return event::delete_event($values[0]);
        } else {
            return null;
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
            } else{
                return null;
            }
        } elseif ($this->method=='POST') {
            if ($this->verb=="add") {
                return News::add_news($values);
            } elseif ($this->verb=="update") {
                return News::update_news($values);
            } else {
                return null;
            }
        } elseif ($this->method=='DELETE') {
            return News::delete_news($values[0]);
        } else {
            return null;
        }

    }

    protected function services($values)
    {
        if (!Utilities::validate_user($this->User_type, $this->method)) {
            throw new Exception('Not permited');
        }
        if ($this->method=='GET') {
            if (empty($values)) {
                return Service_Project::get_services_projects();
            } elseif (!empty($values)) {
                if ($this->verb=="") {
                    return Service_Project::get_services_projects_by_id($values[0]);
                } elseif ($this->verb=="type") {
                    return Service_Project::get_services_projects_by_type($values[0]);
                } else {
                    return null;
                }
            } else {
                return null;
            }
        } elseif ($this->method=='POST') {
            if ($this->verb=="add") {
                return Service_Project::add_services_projects($values);
            } elseif ($this->verb=="update") {
                return Service_Project::update_services_projects($values);
            } else {
                return null;
            }
        } elseif ($this->method=='DELETE') {
            return Service_Project::delete_services_projects($values[0]);
        } else {
            return null;
        }
    }

    protected function modules($values)
    {
        if (!Utilities::validate_user($this->User_type, $this->method)) {
            throw new Exception('Not permited');
        }
        if ($this->method=='GET') {
            if (empty($values)) {
                return Modules::get_modules();
            } elseif (!empty($values)) {
                if ($this->verb=="") {
                    return Modules::get_modules_by_id($values[0]);
                } else {
                    return null;
                }
            } else{
                return null;
            }
        } elseif ($this->method=='POST') {
            if ($this->verb=="add") {
                return Modules::add_modules($values);
            } elseif ($this->verb=="update") {
                return Modules::update_modules($values);
            } else {
                return null;
            }
        } elseif ($this->method=='DELETE') {
            return Modules::delete_modules($values[0]);
        } else {
            return null;
        }

    }

    protected function reservation($values)
    {
        if (!Utilities::validate_user($this->User_type, $this->method)) {
            throw new Exception('Not permited');
        }
        if ($this->method=='GET') {
            if (empty($values)) {
                return Reservation::get_reservation();
            } elseif (!empty($values)) {
                if ($this->verb=="") {
                    return Reservation::get_reservation_by_id($values[0]);
                }
            } else{
                return null;
            }
        }  elseif ($this->method=='POST') {
            if ($this->verb == "add") {
                return Reservation::add_reservation($values);
            } else {
                return null;
            }
        } else {
            return null;
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
            if($this->verb=="update") {
                return SocialNetworks::update_social_networks($values);
            } else {
                return null;
            }
        } else {
            return null;
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
            if($this->verb=="update") {
                return Info::update_info($values);
            } else {
                return null;
            }
        } else {
            return null;
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
            if($this->verb=="update") {
                return Image::update_image($values);
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    protected function price($values)
    {
        if (!Utilities::validate_user($this->User_type, $this->method)) {
            throw new Exception('Not permited');
        }
        if ($this->method=='GET') {
            return Price::get_prices();
        } elseif ($this->method=='POST') {
            if($this->verb=="update") {
                return Price::update_prices($values);
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    protected function schedule($values)
    {
        if (!Utilities::validate_user($this->User_type, $this->method)) {
            throw new Exception('Not permited');
        }
        if ($this->method=='GET') {
            return Schedule::get_schedule();
        } elseif ($this->method=='POST') {
            if($this->verb=="update") {
                if($this->verb=="update") {
                    return Schedule::update_schedule($values);
                }
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    protected function form($values)
    {
        if (!Utilities::validate_user($this->User_type, $this->method, $this->endpoint)) {
            throw new Exception('Not permited');
        }
        if ($this->method=='GET') {
            if ($this->verb=="questions"){
                return Form::get_questions();
            } elseif ($this->verb=="answers"){
                return Form::get_answers();
            }
        } elseif ($this->method=='POST') {
            if ($this->verb=="answer") {
                return Form::answer($values);
            } elseif ($this->verb=="update") {
                return Form::update_question($values);
            } elseif ($this->verb=="insert") {
                return Form::insert_question($values);
            }
        } elseif ($this->method=='DELETE') {
            return Form::delete_question($values[0]);
        } else {
            return null;
        }
    }

    protected function tags($values)
    {
        if (!Utilities::validate_user($this->User_type, $this->method)) {
            throw new Exception('Not permited');
        }
        if ($this->method=='GET') {
            if (empty($values)) {
                return Tag::get_tags();
            } elseif (!empty($values)) {
              if ($this->verb == "") {
                return Tag::get_tag_by_id($values[0]);
              } else {
                return null;
              }
            }
        } elseif ($this->method=='POST') {
            if ($this->verb=="add") {
                return Tag::add_tag($values);
            } elseif ($this->verb=="update") {
                return Tag::update_tag($values);
            } else {
                return null;
            }
        } elseif ($this->method=='DELETE') {
            return Tag::delete_tag($values[0]);
        } else {
            return null;
        }
    }

    protected function themes($values)
    {
        if (!Utilities::validate_user($this->User_type, $this->method)) {
            throw new Exception('Not permited');
        }
        if ($this->method=='GET') {
            if (empty($values)) {
                return Theme::get_themes();
            } elseif (!empty($values)) {
                if ($this->verb == "") {
                    return Theme::get_theme_by_id($values[0]);
                } else {
                    return null;
                }
            }
        } elseif ($this->method=='POST') {
            if ($this->verb=="add") {
                return Theme::add_theme($values[0]);
            } elseif ($this->verb=="update") {
                return Theme::update_theme($values);
            } else {
                return null;
            }
        } elseif ($this->method=='DELETE') {
            return Theme::delete_theme($values[0]);
        } else {
            return null;
        }
    }
}
