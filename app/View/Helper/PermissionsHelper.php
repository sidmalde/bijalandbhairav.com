<?php
class PermissionsHelper extends AppHelper {
    
    var $helpers = array('Session');
    
    function check($path){
			$acl = Configure::read('acl');
			$path = explode(".", $path);
			if($acl->check(array('User' => $this->Session->read('Auth.User')), 'controllers/'.$path[0].'/'.$path[1])){
				return true;
			}
			return false;
    }
}