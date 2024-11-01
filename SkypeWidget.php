<?php
/*
Plugin Name: Skype widget
Plugin URI: http://www.haytabay.de/development/wordpress/skype-widget/
Description: Show some skype icons on your sidebar
Author: Alper Haytabay
Version: 1.0
Author URI: http://www.haytabay.de
*/


// Put functions into one big function we'll call at the plugins_loaded
// action. This ensures that all required plugin functions are defined.
function widget_skypewidget_init() {

	// Check for the required plugin functions. This will prevent fatal
	// errors occurring when you deactivate the dynamic-sidebar plugin.
	if ( !function_exists('register_sidebar_widget') )
		return;

	// This is the function that outputs our little Google search form.
	function widget_skypewidget($args) {
		global $post;
		// $args is an array of strings that help widgets to conform to
		// the active theme: before_widget, before_title, after_widget,
		// and after_title are the array keys. Default tags: li and h2.
		extract($args);
		
		// Each widget can store its own options. We keep strings here.
		$options = get_option('widget_skypewidget');
		$title = $options['title'];		
		$user = $options['user'];
		$call = $options['call'];
		$add = $options['add'];
		$chat = $options['chat'];
		$info = $options['info'];
		$voicemail = $options['voicemail'];
		$sendfile = $options['sendfile'];
		$color = $options['color'];
		    
    
    echo $before_widget.$before_title;  
    echo '<img src="http://mystatus.skype.com/smallicon/'.$user.'" align="absmiddle">'.$title.$after_title;
    if ($call)
    {
        echo '<a href="skype:'.$user.'?call"><img src="http://download.skype.com/share/skypebuttons/buttons/call_'.$color.'_transparent_70x23.png" style="border: none;" width="70" height="23" alt="Skype Me™!" /></a><br/>';
    }
    if ($add)
    {
        echo '<a href="skype:'.$user.'?add"><img src="http://download.skype.com/share/skypebuttons/buttons/add_'.$color.'_transparent_118x23.png" style="border: none;" width="118" height="23" alt="Skype Me™!" /></a><br/>';
    }
    if ($chat)
    {
      echo '<a href="skype:'.$user.'?chat"><img src="http://download.skype.com/share/skypebuttons/buttons/chat_'.$color.'_transparent_97x23.png" style="border: none;" width="97" height="23" alt="Chat with me" /></a><br/>';
    }
    if ($info)
    {
      echo '<a href="skype:'.$user.'?userinfo"><img src="http://download.skype.com/share/skypebuttons/buttons/userinfo_'.$color.'_transparent_108x23.png" style="border: none;" width="108" height="23" alt="View my profile" /></a><br/>';
    }
    if ($voicemail)
    {
      echo '<a href="skype:'.$user.'?voicemail"><img src="http://download.skype.com/share/skypebuttons/buttons/voicemail_'.$color.'_transparent_129x23.png" style="border: none;" width="129" height="23" alt="Leave me voicemail" /></a><br/>';
    }
    if ($sendfile)
    {
      echo '<a href="skype:'.$user.'?sendfile"><img src="http://download.skype.com/share/skypebuttons/buttons/sendfile_'.$color.'_transparent_98x23.png" style="border: none;" width="98" height="23" alt="Send me a file" /></a><br/>';
    }
    echo $after_widget;      

	}

	// This is the function that outputs the form to let the users edit
	// the widget's title. It's an optional feature that users cry for.
	function widget_skypewidget_control() {

		// Get our options and see if we're handling a form submission.
		$options = get_option('widget_skypewidget');
		if ( !is_array($options) )
			$options = array('title'=>'', 'user'=>'', 'call'=>0, 'add'=>0, 'chat'=>0, 'info'=>0, 'voicemail'=>0, 'sendfile'=>0, 'color'=>'green');
		if ( $_POST['skypewidget-submit'] ) {

			// Remember to sanitize and format use input appropriately.
			$options['title'] = strip_tags(stripslashes($_POST['skypewidget-title']));			
			$options['user'] = strip_tags(stripslashes($_POST['skypewidget-user']));
			$options['color'] = strip_tags(stripslashes($_POST['skypewidget-color']));
			$options['call'] = isset($_POST['skypewidget-call']);
			$options['add'] = isset($_POST['skypewidget-add']);
			$options['chat'] = isset($_POST['skypewidget-chat']);
			$options['info'] = isset($_POST['skypewidget-info']);
			$options['voicemail'] = isset($_POST['skypewidget-voicemail']);
			$options['sendfile'] = isset($_POST['skypewidget-sendfile']);
			
			update_option('widget_skypewidget', $options);
		}

		// Be sure you format your options to be valid HTML attributes.
		$title = htmlspecialchars($options['title'], ENT_QUOTES);		
		$user = htmlspecialchars($options['user'], ENT_QUOTES);
		$call = $options['call'] ? 'checked="checked"' : '';
		$add   = $options['add'] ? 'checked="checked"' : '';
		$chat   = $options['chat'] ? 'checked="checked"' : '';
		$info   = $options['info'] ? 'checked="checked"' : '';
		$voicemail   = $options['voicemail'] ? 'checked="checked"' : '';
		$sendfile   = $options['sendfile'] ? 'checked="checked"' : '';
		$color = $options['color'];
		$green = $color == 'green' ? 'checked="checked"' : '';
		$blue = $color == 'blue' ? 'checked="checked"' : '';
		
		// Here is our little form segment. Notice that we don't need a
		// complete form. This will be embedded into the existing form.
		echo '<p style="text-align:right;"><label for="skypewidget-title">' . __('Title:') . ' <input style="width: 200px;" id="skypewidget-title" name="skypewidget-title" type="text" value="'.$title.'" /></label></p>';		
		echo '<p style="text-align:right;"><label for="skypewidget-user">' . __('User:') . ' <input style="width: 200px;" id="skypewidget-user" name="skypewidget-user" type="text" value="'.$user.'" /></label></p>';
		echo '<p style="text-align:right;margin-right:40px;"><label for="skypewidget-call" style="text-align:right;">'.__('Show call:').'<input class="checkbox" type="checkbox"'.$call.'id="skypewidget-call" name="skypewidget-call" /></label></p>';
		echo '<p style="text-align:right;margin-right:40px;"><label for="skypewidget-add" style="text-align:right;">'.__('Show add:').'<input class="checkbox" type="checkbox"'.$add.'id="skypewidget-add" name="skypewidget-add" /></label></p>';
		echo '<p style="text-align:right;margin-right:40px;"><label for="skypewidget-chat" style="text-align:right;">'.__('Show chat:').'<input class="checkbox" type="checkbox"'.$chat.'id="skypewidget-chat" name="skypewidget-chat" /></label></p>';
		echo '<p style="text-align:right;margin-right:40px;"><label for="skypewidget-info" style="text-align:right;">'.__('Show info:').'<input class="checkbox" type="checkbox"'.$info.'id="skypewidget-info" name="skypewidget-info" /></label></p>';
		echo '<p style="text-align:right;margin-right:40px;"><label for="skypewidget-voicemail" style="text-align:right;">'.__('Show voicemail:').'<input class="checkbox" type="checkbox"'.$voicemail.'id="skypewidget-voicemail" name="skypewidget-voicemail" /></label></p>';
		echo '<p style="text-align:right;margin-right:40px;"><label for="skypewidget-sendfile" style="text-align:right;">'.__('Show sendfile:').'<input class="checkbox" type="checkbox"'.$sendfile.'id="skypewidget-sendfile" name="skypewidget-sendfile" /></label></p>';
		echo '<p style="text-align:right;margin-right:40px;"><label for="skypewidget-color" style="text-align:right;">'.__('Color:').'<input type="radio" name="skypewidget-color" id="skypewidget-color-green" value="green"'.$green.'>Green&nbsp;&nbsp;<input type="radio" name="skypewidget-color" id="skypewidget-color-blue" value="blue"'.$blue.'>Blue</label></p>';
		echo '<input type="hidden" id="skypewidget-color2" name="skypewidget-color2" value="green" />';
		echo '<input type="hidden" id="skypewidget-submit" name="skypewidget-submit" value="1" />';
		echo '<p>&copy; by <a href="http://www.haytabay.de">Alper Haytabay</a>.</p>';
	}
	
	
	// This registers our widget so it appears with the other available
	// widgets and can be dragged and dropped into any active sidebars.
	register_sidebar_widget(array('Skype Widget Menu', 'widgets'), 'widget_skypewidget');

	// This registers our optional widget control form. Because of this
	// our widget will have a button that reveals a 300x100 pixel form.
	register_widget_control(array('Skype Widget Menu', 'widgets'), 'widget_skypewidget_control', 300, 315);
}

// Run our code later in case this loads prior to any required plugins.
add_action('widgets_init', 'widget_skypewidget_init');

?>
