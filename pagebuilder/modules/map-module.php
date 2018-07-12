<?php 
$output = '
	<amp-iframe width="{{width}}" height="{{height}}"
    sandbox="allow-scripts allow-same-origin"
    {{if_condition_map_layout}}layout="{{map_layout}}"{{ifend_condition_map_layout}}
    {{if_condition_mode_type==place}}src="https://www.google.com/maps/embed/v1/place?key={{map_key}}&q={{address}}"{{ifend_condition_mode_type_place}}
    {{if_condition_mode_type==view}}src="https://www.google.com/maps/embed/v1/view?key={{map_key}}&center={{latitude}},{{longitude}}&zoom={{zooming}}&maptype={{map_type}}"{{ifend_condition_mode_type_view}}>
</amp-iframe>';

$css = '';

return array(
		'label' =>'Google Map',
		'name' =>'map',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              //'advanced' => 'Advanced'
            ),
		'fields' => array(
						
                            array(		
		 						'type'		=>'text',		
		 						'name'		=>"width",		
		 						'label'		=>'Map Width',
		           				'tab'      =>'design',
		 						'default'	=>'600',	
		           				'content_type'=>'html',
	 						),
	 						array(		
		 						'type'		=>'text',		
		 						'name'		=>"height",		
		 						'label'		=>'Map Height',
		           				'tab'      =>'design',
		 						'default'	=>'450',	
		           				'content_type'=>'html',
	 						),
	 						
	 						array(		
		 						'type'		=>'text',		
		 						'name'		=>"map_key",		
		 						'label'		=>'Map Key',
		           				'tab'      =>'customizer',
		 						'default'	=>'AIzaSyDG9YXIhKBhqclZizcSzJ0ROiE0qgVfwzI&q=europe',	
		           				'content_type'=>'html',
	 						),
	 						array(		
	 							'type'	=>'select',		
	 							'name'  =>'mode_type',		
	 							'label' =>"Select Mode Type",
								'tab'     =>'customizer',
	 							'default' =>'place',
	 							'options_details'=>array(
		 												'place' =>'Place Mode',
		 												'view'  =>'View Mode',
	 												),
	 							'content_type'=>'html',
	 						),
		 						array(		
			 						'type'		=>'text',		
			 						'name'		=>"address",		
			 						'label'		=>'Address',
			           				'tab'     =>'customizer',
			 						'default'	=>'Eiffel Tower,Paris France',	
			           				'content_type'=>'html',
			           				'required'  => array('mode_type'=>'place'),
		 						),
		 						array(		
			 						'type'		=>'text',		
			 						'name'		=>"latitude",		
			 						'label'		=>'Latitude',
			           				'tab'     =>'customizer',
			 						'default'	=>'-33.8569',	
			           				'content_type'=>'html',
			           				'required'  => array('mode_type'=>'view'),
		 						),
		 						array(		
			 						'type'		=>'text',		
			 						'name'		=>"longitude",		
			 						'label'		=>'Longitude',
			           				'tab'     =>'customizer',
			 						'default'	=>'151.2152',	
			           				'content_type'=>'html',
			           				'required'  => array('mode_type'=>'view'),
		 						),
		 						array(		
			 						'type'		=>'text',		
			 						'name'		=>"zooming",		
			 						'label'		=>'Zooming',
			           				'tab'     =>'customizer',
			 						'default'	=>'18',	
			           				'content_type'=>'html',
			           				'required'  => array('mode_type'=>'view'),
		 						),
		 						array(		
			 						'type'		=>'select',		
			 						'name'		=>"map_type",		
			 						'label'		=>'Map Type',
			           				'tab'     =>'customizer',
			 						'default'	=>'roadmap',	
			           				'content_type'=>'html',
			           				'required'  => array('mode_type'=>'view'),
			           				'options_details'=>array(
		 												'satellite' =>'SATELLITE',
		 												'roadmap'  =>'ROADMAP',
		 												'hybrid' => 'HYBRID',
		 												'terrain' => 'TERRAIN'
	 												),
		 						),
	 						array(
								'type'		=>'checkbox',
								'name'		=>"map_layout",
								'tab'		=>'customizer',
								'default'	=>array('responsive'),
								'options'	=>array(
												array(
													'label'=>'Responsive',
													'value'=>'responsive',
												),
											),
								'content_type'=>'html',
							),
							
			),
		'front_template'=> $output,
		'front_css'=> $css,
		'front_common_css'=>'',
	);

?>