<?php

	Router::connect('/', array('controller' => 'pages', 'action' => 'home'));
	Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
	Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
	Router::connect('/search', array('controller' => 'pages', 'action' => 'search'));
	
	// Groups
	Router::connect('/system-management/groups', array('controller' => 'groups', 'action' => 'index', 'admin' => true));
	Router::connect('/system-management/groups/new', array('controller' => 'groups', 'action' => 'add', 'admin' => true));
	Router::connect('/system-management/groups/:group', array('controller' => 'groups', 'action' => 'view', 'admin' => true));
	Router::connect('/system-management/groups/:group/edit', array('controller' => 'groups', 'action' => 'edit', 'admin' => true));
	Router::connect('/system-management/groups/:group/delete', array('controller' => 'groups', 'action' => 'delete', 'admin' => true));
	
	// Users
	Router::connect('/dashboard', array('controller' => 'users', 'action' => 'index', 'admin' => true));
	Router::connect('/system-management/users', array('controller' => 'users', 'action' => 'index', 'admin' => true));
	Router::connect('/system-management/users/new', array('controller' => 'users', 'action' => 'add', 'admin' => true));
	Router::connect('/system-management/users/:user', array('controller' => 'users', 'action' => 'view', 'admin' => true));
	Router::connect('/system-management/users/:user/edit', array('controller' => 'users', 'action' => 'edit', 'admin' => true));
	Router::connect('/system-management/users/:user/delete', array('controller' => 'users', 'action' => 'delete', 'admin' => true));
	
	// Users
	Router::connect('/system-management/faqs', array('controller' => 'frequently_asked_questions', 'action' => 'index', 'admin' => true));
	Router::connect('/system-management/faqs/new', array('controller' => 'frequently_asked_questions', 'action' => 'add', 'admin' => true));
	Router::connect('/system-management/faqs/:faq', array('controller' => 'frequently_asked_questions', 'action' => 'view', 'admin' => true));
	Router::connect('/system-management/faqs/:faq/edit', array('controller' => 'frequently_asked_questions', 'action' => 'edit', 'admin' => true));
	Router::connect('/system-management/faqs/:faq/delete', array('controller' => 'frequently_asked_questions', 'action' => 'delete', 'admin' => true));
	
	// Pages
	Router::connect('/system-management/dashboard', array('controller' => 'pages', 'action' => 'dashboard', 'admin' => true));
	Router::connect('/content-management/pages', array('controller' => 'pages', 'action' => 'index', 'admin' => true));
	Router::connect('/content-management/pages/new', array('controller' => 'pages', 'action' => 'add', 'admin' => true));
	Router::connect('/content-management/pages/:page', array('controller' => 'pages', 'action' => 'view', 'admin' => true));
	Router::connect('/content-management/pages/:page/edit', array('controller' => 'pages', 'action' => 'edit', 'admin' => true));
	Router::connect('/content-management/pages/:page/delete', array('controller' => 'pages', 'action' => 'delete', 'admin' => true));
	
	// Content
	Router::connect('/', array('controller' => 'pages', 'action' => 'home'));
	Router::connect('/how-to-get-to-cordoba', array('controller' => 'pages', 'action' => 'how_to_get_to_cordoba'));
	Router::connect('/accommodation', array('controller' => 'pages', 'action' => 'accommodation'));
	Router::connect('/wedding-schedule', array('controller' => 'pages', 'action' => 'wedding_schedule'));
	Router::connect('/places-to-visit', array('controller' => 'pages', 'action' => 'places_to_visit'));
	Router::connect('/gift-list', array('controller' => 'pages', 'action' => 'gift_list'));
	Router::connect('/ask-us-a-question/ask', array('controller' => 'frequently_asked_questions', 'action' => 'add'));
	Router::connect('/upload-your-media', array('controller' => 'pages', 'action' => 'upload_your_media'));
	


	Router::connect('/*', array('controller' => 'pages', 'action' => 'view'));
	
	CakePlugin::routes();
	
	require CAKE . 'Config' . DS . 'routes.php';
