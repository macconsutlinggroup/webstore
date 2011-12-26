<?php
/*
  LightSpeed Web Store
 
  NOTICE OF LICENSE
 
  This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to support@lightspeedretail.com <mailto:support@lightspeedretail.com>
 * so we can send you a copy immediately.
   
 * @copyright  Copyright (c) 2011 Xsilva Systems, Inc. http://www.lightspeedretail.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 
 */

/**
 * Web Admin panel template called by xlsws_admin class
 * General use for item editing
 * 
 *
 */

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" dir="ltr">
<head>
	<title><?php _xt("Admin configuration") ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=<?= _xls_get_conf('CHARSET' , 'utf-8') ?>" />
	
	<link rel="stylesheet" type="text/css" href="<?= adminTemplate('css/admin.css') ?>" />
	<link rel="stylesheet" type="text/css" href="<?= adminTemplate('css/superfish.css') ?>" />
	
    <script type="text/javascript" src="<?=  adminTemplate('js/jquery.min.js');  ?>"></script>     
    <script type="text/javascript" src="<?=  adminTemplate('js/jquery.ui.js');  ?>"></script>     
	<script type="text/javascript" src="<?=  adminTemplate('js/admin.js'); ?>"></script>
	<script type="text/javascript" src="<?=  adminTemplate('js/corners.js'); ?>"></script>

	<script type="text/javascript"> 
    $(document).ready(function(){ 
        $("ul.sf-menu").superfish(); 
    });
	</script>
	
	<script type="text/javascript">
		function doRefresh(){
    $('.rounded').corners();
    $('.rounded').corners(); /* test for double rounding */
    $('table', $('#featureTabsc_info .tab')[0]).each(function(){$('.native').hide();});
    $('#featureTabsc_info').show();
    tab(0);
    	tooltip();
		
		}
	
  $(document).ready(function(){
  	doRefresh();
  });
  function tab(n) {
    $('#featureTabsc_info .tab').removeClass('tab_selected');
    $($('#featureTabsc_info .tab')[n]).addClass('tab_selected');
    $('#featureElementsc_info .feature').hide();
    $($('#featureElementsc_info .feature')[n]).show();
  }
  function highlight_div(checkbox_node)
	{
	    label_node = checkbox_node.parentNode;
	
	    if (checkbox_node.checked)
		{
			label_node.style.backgroundColor='#0a246a';
			label_node.style.color='#fff';
		}
		else
		{
			label_node.style.backgroundColor='#fff';
			label_node.style.color='#000';
		}
	}

  $(function() {
        $("#promodefine").live('click', function(event) {

            $(this).addClass("selected").parent().append('<div class="messagepop pop"><form method="post" id="new_message" action="/messages"><div style="font:13.3px sans-serif;width:150px;border-left:1px solid #808080;border-top:1px solid #808080;border-bottom:1px solid #fff; border-right:1px solid #fff;">' + 
            '<div style="background:#fff; overflow:auto;height:150px;border-left:1px solid #404040;border-top:1px solid #404040;border-bottom:1px solid #d4d0c8;border-right:1px solid #d4d0c8;">' + 
            '<label for="cb1" style="padding-left:8px;padding-right:3px;padding-bottom:5px;display:block;">' + 
            '<input name="checkbox[]" value="1" type="checkbox" id="cb1" onclick="highlight_div(this);">dill pickle</label>\n' +
            '<label for="cb2" style="padding-left:8px;padding-right:3px;padding-bottom:5px;display:block;">' + 
            '<input name="checkbox[]" value="2" type="checkbox" id="cb2" onclick="highlight_div(this);">dime</label>\n' +
            '<label for="cb3" style="padding-left:8px;padding-right:3px;padding-bottom:5px;display:block;">' + 
            '<input name="checkbox[]" value="3" type="checkbox" id="cb3" onclick="highlight_div(this);">dinosaur</label>\n' +
            '</div></div><p><a class="f_submit" href="/"><b>Apply</b></a> or <a class="close" href="/"><b>Cancel</b></a></p></form></div>');
            $(".pop").slideFadeToggle(function() { 
                $("#email").focus();
            });
            return false;
        });

		$(".f_submit").live('click', function() {
            $(".pop").slideFadeToggle(function() { 
                $("#contact").removeClass("selected");
            });
            return false;
        });
        
        $(".close").live('click', function() {
            $(".pop").slideFadeToggle(function() { 
                $("#contact").removeClass("selected");
            });
            return false;
        });
    });

    $.fn.slideFadeToggle = function(easing, callback) {
        return this.animate({ opacity: 'toggle', height: 'toggle' }, "fast", easing, callback);
    };    
    
    
  </script>
	
		
</head>
<body>

<?php include_once(adminTemplate('pages.tpl.php')); ?>


<?php $this->RenderBegin(); ?>



		<br /><br />
			
		<div id="options" class="accord rounded" style="width:890px" > 
		<div id="tabs" style="margin-top: -43px;">
			<ul>
				<?php foreach($this->arrTabs as $type=>$label): ?>
				<a href="<?= $this->get_uri($type); ?>" >
					<li class="rounded 
						<?php if($type == $this->currentTab): ?>
							active
						<?php endif; ?> {5px top transparent}" style="display:block; float: left">
						<?= $label; ?>
					</li>
				</a>
				<?php endforeach; ?>
			</ul>
		</div>

<div class="content">
<?php

$this->dtgItems->Render('CssClass="rounded wide"');

?>


<div style="margin: -6px 0 0 0; background:  url(<?= adminTemplate('css/images/header.png') ?>); height: 37px;" class="rounded-bottom">
<?php if($this->canNew()): ?>
	<img src="<?= adminTemplate('css/images/btn_add.png') ?>" style="margin: 12px 5px 0 15px; display: block; float: left;" />
	<div class="add" <?php $this->btnNew->RenderAsEvents(); ?>>Add</div>
<?php endif; ?>
</div>
	
<?php if($this->canFilter()): ?>
	<div class="search">
		<?php $this->txtSearch->Render('CssClass=searchBox'); ?>
		<?php $this->btnSearch->Render('CssClass=searchButton button rounded' , 'Width=50'); ?>
	</div>
<?php endif; ?>
</div>
</div>

<?php $this->RenderEnd(); ?>

</body>
</html>
