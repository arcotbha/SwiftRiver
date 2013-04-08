<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Account Service
 *
 * PHP version 5
 * LICENSE: This source file is subject to the AGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/agpl.html
 * @author      Ushahidi Team <team@ushahidi.com> 
 * @package     SwiftRiver - https://github.com/ushahidi/SwiftRiver
 * @category    Services
 * @copyright   Ushahidi - http://www.ushahidi.com
 * @license     http://www.gnu.org/licenses/agpl.html GNU Affero General Public License (AGPL)
 */

class Service_Account extends Service_Base {
		
	/**
	 * Register an account.
	 *
	 * @return	Array
	 */
	public function create_account($fullname, $email, $username, $password)
	{
		return $this->api->get_accounts_api()->create_account(
					$fullname, 
					$email, 
					$username, 
					$password
				);
	}
	
	/**
	 * Return the Account array for the logged in user.
	 *
	 * @return	Array
	 */
	public function get_logged_in_account()
	{
		return $this->api->get_accounts_api()->get_logged_in_account();
	}
	
	/**
	 * Return the Account array for the given account path
	 *
	 * @return	Array
	 */
	public function get_account_by_name($account_path)
	{
		return $this->api->get_accounts_api()->get_account_by_name($account_path);
	}
	
	/**
	 * Return the Account array for the given email
	 *
	 * @return	Array
	 */
	public function get_account_by_email($email, $token = FALSE)
	{
		return $this->api->get_accounts_api()->get_account_by_email($email, $token);
	}
	
	/**
	 * Search accounts
	 *
	 * @return	Array
	 */
	public function search($query)
	{
		return $this->api->get_accounts_api()->search($query);
	}
	
	/**
	* Activate a newly created account
	*
	* @return Array
	*/
	public function activate_account($email, $token) 
	{
		$account = $this->get_account_by_email($email);
		return $this->api->get_accounts_api()->update_account($account['id'], array('token' => $token));
	}
	
	/**
	* Request an activation token for the given account.
	*
	* @return Array
	*/
	public function get_token($email)
	{
		return $this->get_account_by_email($email, TRUE);
	}
	
	/**
	* Reset password
	*
	* @return Array
	*/
	public function reset_password($email, $token, $password)
	{
		$parameters = array(
			'token' => $token,
			'owner' => array(
				'password' => $password
			)
		);
		$account = $this->get_account_by_email($email);
		return $this->api->get_accounts_api()->update_account($account['id'], $parameters);
	}
	
	/**
	 * Get a single rivers array for the specified $account
	 *
	 * @param   array account          Account that owns the rivers to be returned
	 * @param   array querying_account Account requesting for the rivers
	 * @return	array
	 */
	public function get_rivers($account, $querying_account)
	{
		$rivers = array();
		
		// Own rivers
		foreach ($account['rivers'] as $river)
		{
			$rivers[] = Service_River::get_array($river, $querying_account);
		}
		
		// Collaborating rivers
		foreach ($account['collaborating_rivers'] as $river)
		{
			$rivers[] = Service_River::get_array($river, $querying_account);
		}
		
		// Following rivers
		foreach ($account['following_rivers'] as $river)
		{
			$rivers[] = Service_River::get_array($river, $querying_account);
		}
		
		return $rivers;
	}
	
	/**
	 * Get a single buckets array for the given account.
	 *
	 * @param   array   account          Account that owns the buckets to be returned
	 * @param   array   querying_account Account requesting for the buckets
	 * @return	array
	 */
	public function get_buckets($account, $querying_account)
	{
		$buckets = array();
		
		// Own buckets
		foreach ($account['buckets'] as $bucket)
		{
			$buckets[] = Service_Bucket::get_array($bucket, $querying_account);
		}
		
		// Collaborating buckets
		foreach ($account['collaborating_buckets'] as $bucket)
		{
			$buckets[] = Service_Bucket::get_array($bucket, $querying_account);
		}
		
		// Following buckets
		foreach ($account['following_buckets'] as $bucket)
		{
			$buckets[] = Service_Bucket::get_array($bucket, $querying_account);
		}
		
		return $buckets;
	}
	
	/**
	 * Get a single forms array for the given account.
	 *
	 * @param   array   account          Account that owns the forms to be returned
	 * @param   array   querying_account Account requesting for the forms
	 * @return	array
	 */
	public function get_forms($account, $querying_account)
	{
		$forms = array();
		
		// Own forms
		foreach ($account['forms'] as $form)
		{
			$forms[] = Service_Form::get_array($form, $querying_account);
		}
		
		return $forms;
	}
	
	
	/**
	 * Verifies where the account in $query_account_id is following the account in $id
	 *
	 * @param  int  id
	 * @param  int  query_account_id
	 * @return bool
	 */
	public function is_account_follower($id, $query_account_id)
	{
		return $this->api->get_accounts_api()->is_account_follower($id, $query_account_id);
	}
	
	/**
	 * Adds the account with the specified follower_account_id to the list of followers
	 * for the account specified by id
	 *
	 * @param  int id ID of the account to be followed
	 * @param  int follower_account_id ID of the Account to be added to the list of followers
	 * @return bool TRUE on success, FALSE otherwise
	 */
	public function add_follower($id, $follower_account_id)
	{
		return $this->api->get_accounts_api()->add_follower($id, $follower_account_id);
	}
	
	/**
	 * Removes the account specified in $follower_account_id from the list of followers
	 * for the account specifid in $id
	 *
	 * @param  int id
	 * @param  int follower_account_id
	 * @return bool TRUE on success, FALSE otherwise
	 */
	public function remove_follower($id, $follower_account_id)
	{
		return $this->api->get_accounts_api()->remove_follower($id, $follower_account_id);
	}
	
	/**
	 * Updates the profile information for the specified account
	 *
	 * @param int account_id
	 * @param array profile_data
	 * @return array
	 */
	public function update_account($account_id, $profile_data)
	{
		// Validate the profile data
		$validation = Validation::factory($profile_data)
			->rule('name', 'not_empty')
			->rule('account_path', 'not_empty')
			->rule('email', 'email');
		
		if ( ! $validation->check())
		{
			return FALSE;
		}
		
		// Marshall the request data for consumption by the API
		$account_data = array(
			'account_path' => $profile_data['account_path'],
			'owner' => array(
				'name' => $profile_data['name'],
				'email' => $profile_data['email']
			)
		);

		// Execute API request
		return $this->api->get_accounts_api()->update_account($account_id, $account_data);
	}
	
	/**
	 * Change password
	 */
	public function change_password($account_id, $password_data)
	{
		$validation = Validation::factory($password_data)
			->rule('current_password', 'not_empty')
			->rule('new_password', 'matches', array(':validation', 'new_password', 'confirm_password'));
		
		if ($validation->check())
		{
			$params = array(
				'owner' => array(
					'current_password' => $password_data['current_password'],
					'password' => $password_data['new_password']
				)
			);

			$this->accounts_api->update_account($account_id, $params);
		}
		else
		{
			throw new Validation_Exception($validation);
		}
	}
	
	/**
	 * Get the view account's activity stream
	 *
	 * @param  Array activities
	 *
	 * @return	Array
	 */
	public function format_activities(& $activities)
	{
		foreach ($activities as & $activity)
		{
			// URL of the user that did the action
			$activity['actor_url'] = URL::site($activity['account']['account_path']);
			
			// URL of the target of the action
			switch ($activity["action_on"]) {
				case "river":
					$activity['action_on_url'] = Service_River::get_base_url($activity['action_on_obj']);
					break;
				case "river_collaborator":
					$activity['action_to_url'] = URL::site($activity['action_on_obj']['account']['account_path']);
					$activity['invite_to_url'] = Service_River::get_base_url($activity['action_on_obj']['river']);
					break;
				case "bucket":
					$activity['action_on_url'] = Service_Bucket::get_base_url($activity['action_on_obj']);
					break;
				case "bucket_collaborator":
					$activity['action_to_url'] = URL::site($activity['action_on_obj']['account']['account_path']);
					$activity['invite_to_url'] = Service_River::get_base_url($activity['action_on_obj']['bucket']);
					break;
				case "account":
					$activity['action_on_url'] = URL::site($activity['action_on_obj']['account_path']);
					break;
			}
		}
	}
	
	/**
	 * Get the view account's activity stream
	 *
	 * @param  Array account
	 *
	 * @return	Array
	 */
	public function get_account_activities($account_id)
	{
		$activities = $this->api->get_accounts_api()->get_account_activities($account_id);
		
		return $activities;
	}
	
	/**
	 * Get activities of the account the authenticated user is following
	 *
	 * @return	Array
	 */
	public function get_following_activities()
	{
		$activities = $this->api->get_accounts_api()->get_following_activities();
	}
}