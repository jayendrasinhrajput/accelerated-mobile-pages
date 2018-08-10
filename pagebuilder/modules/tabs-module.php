<?php 
$output = '
<amp-selector role="tablist" layout="container" class="ampTabContainer">
	{{repeater_tab_content}}
</amp-selector>
';
$css = '
{{module-class}}{margin:{{margin_css}};padding:{{padding_css}};width:{{width}}}
{{module-class}} .tab-img amp-img{
	width:100%;
	height:auto;
}
{{module-class}} .ampTabContainer {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}
{{module-class}} .tabs amp-selector [option][selected] {
    cursor: pointer;
    outline:none;
    border-radius: 50px;
}
{{module-class}} .tabButton[selected] {
    outline: none;
    background:{{hdng_bg_color}};
    border-radius: 50px;
    
}
{{module-class}} .tabButton[selected] h2{
	color:{{hdng_font_color}};
}
{{module-class}} .tabButton {
    list-style: none;
    text-align: center;
    cursor: pointer;
    border-radius: 50px;
    transition: 0.3s ease-in-out 0s;
} 
{{module-class}} .tabContent {
    display: none;
    width: 100%;
    order: 1;
}
{{module-class}} .tabButton h2{
	color:{{hdng_bg_color}};
	padding: 4px 15px 5px 15px;
	font-size:{{hdng_fnt_sz}};
	font-weight:{{hdng_font_type}};
}
{{module-class}} .tabButton[selected]+.tabContent {
    display: grid;
    margin-top: 50px;
    grid-template-columns: 1fr 1fr;
    grid-gap: 0px 60px;
    align-items:center;
}
{{module-class}} .tab-cntn h3{
	color:{{tlt_font_color}};
	font-size:{{tlt_fnt_sz}};
	font-weight:{{tlt_font_type}};
	line-height:1.4;
	margin-bottom:30px;
}
{{module-class}} .tab-cntn{
	color:{{cnt_font_color}};
	font-size:{{cnt_fnt_sz}};
	font-weight:{{cnt_font_type}};
	line-height:1.4;
}
{{module-class}} .tab-cntn a{
	color:{{btn_font_color}};
	padding:10px 30px;
	border-radius:50px;
	border:2px solid {{btn_font_color}};
	display: inline-block;
	margin-top: 30px;
	font-size:{{btn_fnt_sz}};
	font-weight:{{btn_font_type}};
	background:{{btn_bg_color}};
}

/** Animation CSS **/
.animate {
  animation-duration: 1s;
  animation-fill-mode: both;
}

@keyframes fadeInLeft {
  from {opacity: 0;transform: translate3d(-0%, 0, 0);}
  to {opacity: 1;transform: none;}
}
.fadeInLeft {
  animation-name: fadeInLeft;
}

@keyframes fadeInRight {
  from {opacity: 0;transform: translate3d(0%, 0, 0);}
  to {opacity: 1;transform: none;}
}
.fadeInRight {
  animation-name: fadeInRight;
}

@media(max-width:768px){
	{{module-class}} .tabButton {
		margin-bottom:15px;
	}
}
@media(max-width:600px){
	{{module-class}} .tabButton[selected]+.tabContent{
		grid-template-columns: 1fr;
		margin-top:15px;
	}
	{{module-class}} .tab-cntn{
		margin-top:30px;
	}
}
.
';

return array(
		'label' =>'Tabs',
		'name' =>'tabs',
		'default_tab'=> 'customizer',
		'tabs' => array(
              'customizer'=>'Content',
              'design'=>'Design',
              'layout' => 'Layout',
              'advanced' => 'Advanced',
            ),
		'fields' => array(
                        array(		
	 						'type'		=>'text',		
	 						'name'		=>"width",		
	 						'label'		=>'Tab Width',
	           				 'tab'      =>'customizer',
	 						'default'	=>'90%',	
	           				'content_type'=>'css',
 						),
	 					array(
								'type'		=>'checkbox',
								'name'		=>"image_layout",
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
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"hdng_fnt_sz",		
		 						'label'		=>'Tab Heading Font Size',
		           				 'tab'     =>'design',
		 						'default'	=>'18px',	
		           				'content_type'=>'css',
	 						),
						array(		
	 							'type'	=>'select',		
	 							'name'  =>'hdng_font_type',		
	 							'label' =>"Tab Heading Font Weight",
								'tab'     =>'design',
	 							'default' =>'600',
	 							'options_details'=>array(
                                    '300'   =>'Light',
                                    '400'  	=>'Regular',
                                    '500'  	=>'Medium',
                                    '600'  	=>'Semi Bold',
                                    '700'  	=>'Bold',
                                ),
	 							'content_type'=>'css',
	 						),
						array(
								'type'		=>'color-picker',
								'name'		=>"hdng_font_color",
								'label'		=>'Tab Heading Color',
								'tab'		=>'design',
								'default'	=>'#fff',
								'content_type'=>'css'
							),
						array(
								'type'		=>'color-picker',
								'name'		=>"hdng_bg_color",
								'label'		=>'Tab Heading Background Color',
								'tab'		=>'design',
								'default'	=>'#8898aa',
								'content_type'=>'css'
							),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"tlt_fnt_sz",		
		 						'label'		=>'Tab Title Font Size',
		           				 'tab'     =>'design',
		 						'default'	=>'30px',	
		           				'content_type'=>'css',
	 						),
						array(		
	 							'type'	=>'select',		
	 							'name'  =>'tlt_font_type',		
	 							'label' =>"Tab Title Font Weight",
								'tab'     =>'design',
	 							'default' =>'600',
	 							'options_details'=>array(
                                    '300'   =>'Light',
                                    '400'  	=>'Regular',
                                    '500'  	=>'Medium',
                                    '600'  	=>'Semi Bold',
                                    '700'  	=>'Bold',
                                ),
	 							'content_type'=>'css',
	 						),
						array(
								'type'		=>'color-picker',
								'name'		=>"tlt_font_color",
								'label'		=>'Tab Title Color',
								'tab'		=>'design',
								'default'	=>'#000',
								'content_type'=>'css'
							),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"cnt_fnt_sz",		
		 						'label'		=>'Tab Content Font Size',
		           				 'tab'     =>'design',
		 						'default'	=>'18px',	
		           				'content_type'=>'css',
	 						),
						array(		
	 							'type'	=>'select',		
	 							'name'  =>'cnt_font_type',		
	 							'label' =>"Tab Content Font Weight",
								'tab'     =>'design',
	 							'default' =>'400',
	 							'options_details'=>array(
                                    '300'   =>'Light',
                                    '400'  	=>'Regular',
                                    '500'  	=>'Medium',
                                    '600'  	=>'Semi Bold',
                                    '700'  	=>'Bold',
                                ),
	 							'content_type'=>'css',
	 						),
						array(
								'type'		=>'color-picker',
								'name'		=>"cnt_font_color",
								'label'		=>'Tab Content Color',
								'tab'		=>'design',
								'default'	=>'#797f7f',
								'content_type'=>'css'
							),
						array(		
		 						'type'		=>'text',		
		 						'name'		=>"btn_fnt_sz",		
		 						'label'		=>'Tab Button Font Size',
		           				 'tab'     =>'design',
		 						'default'	=>'18px',	
		           				'content_type'=>'css',
	 						),
						array(		
	 							'type'	=>'select',		
	 							'name'  =>'btn_font_type',		
	 							'label' =>"Tab Button Font Weight",
								'tab'     =>'design',
	 							'default' =>'500',
	 							'options_details'=>array(
                                    '300'   =>'Light',
                                    '400'  	=>'Regular',
                                    '500'  	=>'Medium',
                                    '600'  	=>'Semi Bold',
                                    '700'  	=>'Bold',
                                ),
	 							'content_type'=>'css',
	 						),
						array(
								'type'		=>'color-picker',
								'name'		=>"btn_font_color",
								'label'		=>'Tab Button Color',
								'tab'		=>'design',
								'default'	=>'#797f7f',
								'content_type'=>'css'
							),
						array(
								'type'		=>'color-picker',
								'name'		=>"btn_bg_color",
								'label'		=>'Tab Button Background Color',
								'tab'		=>'design',
								'default'	=>'#ffffff',
								'content_type'=>'css'
							),
						array(
								'type'		=>'spacing',
								'name'		=>"margin_css",
								'label'		=>'Margin',
								'tab'		=>'advanced',
								'default'	=>
                            array(
                                'top'=>'20px',
                                'right'=>'auto',
                                'bottom'=>'20px',
                                'left'=>'auto',
                            ),
								'content_type'=>'css',
							),
							array(
								'type'		=>'spacing',
								'name'		=>"padding_css",
								'label'		=>'Padding',
								'tab'		=>'advanced',
								'default'	=>array(
													'left'=>'0px',
													'right'=>'0px',
													'top'=>'0px',
													'bottom'=>'0px'
												),
								'content_type'=>'css',
							),
							array(		
	 						'type'		=>'require_script',		
	 						'name'		=>"selector_script",		
	 						'label'		=>'amp-selector',
	 						'default'	=>'https://cdn.ampproject.org/v0/amp-selector-0.1.js',	
	           				'content_type'=>'js',
 						),

			),
		'front_template'=> $output,
		'front_css'=> $css,
		'front_common_css'=>'',
		'repeater'=>array(
	          'tab'=>'customizer',
	          'fields'=>array(
	          				array(		
		 						'type'		=>'text',		
		 						'name'		=>"tab_hdng",		
		 						'label'		=>'Tab Heading',
		           				'tab'       =>'customizer',
		 						'default'	=>'Tab Heading',	
		           				'content_type'=>'html',
	 						),
			                array(		
		 						'type'		=>'upload',		
		 						'name'		=>"img_upload",		
		 						'label'		=>'Upload',
		           				'tab'     =>'customizer',
		 						'default'	=>'',	
		           				'content_type'=>'html',

	 						),
	 						array(		
		 						'type'		=>'text',		
		 						'name'		=>"tab_tlt",		
		 						'label'		=>'Title',
		           				'tab'       =>'customizer',
		 						'default'	=>'Make Something Amazing',	
		           				'content_type'=>'html',
	 						),
	 						array(		
		 						'type'		=>'text-editor',		
		 						'name'		=>"content",		
		 						'label'		=>'Content',
		           				'tab'       =>'customizer',
		 						'default'	=>'<p>We believe the best way to learn is by putting your skills to 			use.</p>',	
		           				'content_type'=>'html',
	 						),
	 						array(		
		 						'type'		=>'text',		
		 						'name'		=>"tab_btn",		
		 						'label'		=>'Button Text',
		           				'tab'       =>'customizer',
		 						'default'	=>'Button',	
		           				'content_type'=>'html',
	 						),
	 						array(		
		 						'type'		=>'text',		
		 						'name'		=>"btn_lnk",		
		 						'label'		=>'Button Link',
		           				'tab'       =>'customizer',
		 						'default'	=>'#',	
		           				'content_type'=>'html',
	 						),
	              ),
	          'front_template'=>
	          		array(
	          			"tab_content" => 
								'<div role="tab"class="tabButton" {{if_condition_repeater_unique==0}}selected{{ifend_condition_repeater_unique_0}} option="{{repeater_unique}}">
								    <h2>{{tab_hdng}}</h2>
								</div>
								<div role="tabpanel" class="tabContent">
									<div class="tab-img animate fadeInLeft">
										{{if_img_upload}}<amp-img src="{{img_upload}}" width="{{image_width}}" height="{{image_height}}" {{if_image_layout}}layout="{{image_layout}}"{{ifend_image_layout}} alt="{{image_alt}}"></amp-img>
										{{ifend_img_upload}}
								    </div>
								    <div class="tab-cntn animate fadeInRight">
								    	<h3>{{tab_tlt}}</h3>
								    	{{content}}
								    	<a href="{{btn_lnk}}">{{tab_btn}}</a>
								    </div>
								</div>
								',
						
			      
			      
	          		)
	        	
	          ),
	);
?>