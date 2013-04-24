<?php if (!defined('APPLICATION')) exit();

//This plugin is based on Picture Gallery 0.2.1 by Yohn,john@skem9.com,http://www.skem9.com later edited by Trey but did not work, Last modified by VrijVlinder
// Define the plugin:

$PluginInfo['PictureGallery'] = array(
   'Name' => 'Picture Gallery',
   'Description' => 'Adds an Image gallery to you website for you and users to add new pictures to the gallery.You can create seperate folders and upload forms for everyone to use.<br />',
   'Version' => '1.0',
   'Author' => 'VrijVlinder',
   'AuthorEmail' => 'contact@vrijvlinder.com',
   'AuthorUrl' => 'http://www.vrijvlinder.com'
  
);



class PictureGallery extends Gdn_Plugin {

	public function Base_Render_Before($Sender) {
		$Session = Gdn::Session();
       if ($Sender->Menu){
$Sender->Menu->AddLink('PictureGallery','/gallery', T('Gallery'),array(), array('target'=>'_blank'),array('class' => 'Button')); 
	}
	} 
	public function PluginController_Manager_Create($Sender) {
//			$Sender->AddSideMenu('plugin/manager');
                        $Sender->Render($this->GetView('manager.php'));
	}
	
	public function PluginController_Gallery_Create($Sender) {
			$Sender->ClearCssFiles();
			$Sender->AddCssFile('style.css');
			$Sender->MasterView = 'default';
			$Sender->Render($this->GetView('gallery.php'));
                       
	}

//	public function Base_GetAppSettingsMenuItems_Handler($Sender) {
//		$Menu = $Sender->EventArguments['SideMenu'];
//		$Menu->AddLink('Appearance', T('Picture Gallery'), 'plugin/manager/', 'Garden.Settings.Manage');
//	}
	
	public function Setup() { 
		Gdn::Router()->SetRoute('gallery','plugin/gallery','Internal');
		if(!is_dir('uploads/picgal/')) $go = mkdir('uploads/picgal/', 0775);
	}
	
	 public function OnDisable() {
		SaveToConfig('EnabledPlugins.PictureGallery', FALSE);
   }
	
}