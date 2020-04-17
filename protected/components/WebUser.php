<?php 
class WebUser extends CWebUser
{
    /**
     * Overrides a Yii method that is used for roles in controllers (accessRules).
     *
     * @param string $operation Name of the operation required (here, a role).
     * @param mixed $params (opt) Parameters for this operation, usually the object to access.
     * @return bool Permission granted?
     */
    public function checkAccess($operation, $params=array())
    {
        if (empty($this->id)) {
            // Not identified => no rights
            return false;
        }
        $role = $this->getState("roles");

        // allow access if the operation request is the current user's role
        return ($operation === $role);
    }

    public function isAdmin() {
        if ( $this->checkAccess('admin') ){
            return true;
        }
        return false;
    }

    public function isOwner($user_id) {
		if ( $this->isAdmin() ) {
			return  true;
		}
        if ( Yii::app()->user->getState('user')->user_id == $user_id ){
            return true;
        }
        return false;
    }
}
