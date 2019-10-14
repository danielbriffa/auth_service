<?php 

namespace App\Managers;

use App\UserData;
use App\User;

class UsersManager {

    function getUserByID($_user_id) 
    {
        return User::where('id', $_user_id)->firstOrFail();
    }

    function getUserDataByUserID($_user_id)
    {
        return  UserData::where('user_id', $_user_id)->firstOrFail();
    }

    function getUserDataAll($_user_id) 
    {
        $user_data = $this->getUserDataByUserID($_user_id);

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
        $user_data = $this->getUserDataByUserID($_user_id); 

        if (!isset($user_data->data))
        {
            //Throw Error - Error retrieving user or data object
        }

        $data = $user_data->data;
        //user exists? and data object exists ?
        if ($data !== null && isset($data))
        {
            //if key does not exist, create it
            if (!isset($data[$_key]))
            {
                $data[$_key] = [];
            }

            //insert value only if it does not exist
            if (!array_search($_value, $data[$_key]))
            {
                array_push($data[$_key], $_value); 
            }

            $user_data->data = $data;

            return $user_data->save();
            
        }

        return false;
    }

    function removeUserDataValueByKey($_user_id, $_key, $_value) 
    {   
        $user_data = $this->getUserDataByUserID($_user_id);
        
        if (!isset($user_data->data))
        {
            //Throw Error - Error retrieving user or data object
        }
        
        $data = $user_data->data;
        //user exists? and data object exists ?
        if ($data !== null && isset($data))
        {
            if ($data[$_key])
            {
                //Throw Error - Key does not exist
            }

            if (($key = array_search($_value, $data[$_key])) !== false) {
                unset($data[$_key][$key]); 

                $user_data->data = $data;
                
                return $user_data->save();
            }
            
            //in case the value is not found, still return success.
            return true;
            
        }

        return false;
       
    }

    function removeUserDataByKey($_user_id, $_key) 
    {
        //get fields of user        
        $user_data = $this->getUserDataByUserID($_user_id); 

        if (!isset($user_data->data))
        {
            //Throw Error - Error retrieving user or data object
        }

        $data = $user_data->data;
        if ($data !== null && isset($data))
        {

            if ($data[$_key])
            {
                //Throw Error - Key does not exist
            }

            if(isset($data[$_key]))
            {
                unset($data[$_key]);
            }

            $user_data->data = $data;

            return $user_data->save();            
        }

        return false;
    }

}