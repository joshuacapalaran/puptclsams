<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use Modules\userManagement\Models\PermissionsModel;
use Modules\userManagement\Models\ModulesModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['link', 'namesearch'];
	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();
		$this->session = \Config\Services::session();
		$this->session->start();
		$this->validation = \Config\Services::validation();
	}

	public function __construct()
	{
		$this->session = \Config\Services::session();

		$model_permission = new PermissionsModel();
		$model_module = new ModulesModel();
		
		if(isset($_SESSION['user_logged_in']))
		{
			$this->permissions = $model_permission->like('allowed_roles', $_SESSION['rid'])->findAll();
			$this->modules = $model_module->findAll();

			$_SESSION['appmodules'] = $this->modules;
			$_SESSION['userPermmissions'] = $this->permissions;
		}
		
	}
}
