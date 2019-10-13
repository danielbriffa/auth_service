<?php 

namespace App\Managers;

use App\UserData;
use App\User;

class UsersManager {

    function getUserByID($_user_id) 
    {
        return User::where('id', $_user_id)->first();
    }

    function getUserDataObject($_user_id)
    {
        return  UserData::where('user_id', $_user_id)->first();
    }

    function getUserDataAll($_user_id) 
    {
        $user_data = $this->getUserDataObject($_user_id);

        return $user_data->data ?: null;
    }

    function getUserDataByKey($_user_id, $_key) 
    {
        //get fields of user        
        $user_data = $this->getUserDataAll($_user_id); 

        if ($user_data !== null)
        {
            $user_data = isset($user_data[$_key]) ? $user_data[$_key] : null;
        }

        return $user_data;
    }

    function insertUserDataValueByKey($_user_id, $_key, $_value) 
    {
        $user_data = $this->getUserDataObject($_user_id); 
    
        //user exists? and data object exists ?
        if ($user_data !== null && isset($user_data->data))
        {
            //if key does not exist, create it
            if (!isset($user_data->data[$_key]))
            {
                $user_data->data[$_key] = [];
            }
            
            //insert value only if it does not exist
            if (!array_search($_value, $user_data->data[$_key]))
            {
                array_push($user_data->data[$_key], $_value); 
            }

            return $user_data->save();
            
        }

        return false;
    }

    function removeUserDataValueByKey($_user_id, $_key, $_value) 
    {   
        $user_data = $this->getUserDataObject($_user_id); 

        //user exists? and data object exists ?
        if ($user_data !== null && isset($user_data->data))
        {
            if (($key = array_search($_value, $response[$_key])) !== false) {
                unset($user_data->data[$_key][$key]);
            }

            return $user_data->save();
            
        }

        return false;
       
    }

    function removeUserDataByKey($_user_id, $_key) 
    {
        //get fields of user        
        $user_data = $this->getUserDataObject($_user_id); 

        if ($user_data !== null && isset($user_data->data))
        {

            if(isset($user_data->data[$_key]))
            {
                unset($user_data->data[$_key]);
            }

            return $user_data->save();            
        }

        return false;
    }

}