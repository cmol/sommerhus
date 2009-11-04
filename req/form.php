<?php
	
	$c['tf'] = 0;
	$c['pw'] = 0;
	$c['dd'] = 0;
	$c['rb'] = 0;
	$c['ta'] = 0;
	$c['submit'] = 0;
	
	function MakeForm($title, $name, $value, $type, $validate, $error_text, $input_class = "user_data")
	{
		global $c;
		if($type == "tf" || $type == "pw" || $type == "dd" || $type == "rb" || $type == "ta" || $type == "submit")
		{
			if (isset($c[$type]) && $validate)
			{
				$c[$type]++;
			}
			elseif(!isset($c[$type]) && $validate)
			{
				$c[$type] = 1;
			}
			
			switch ($type)
			{
				// input type text
				case 'tf':
					if ($validate)
					{
						$return = '
<p class="user_data"><span class="user_data">'.$title.': </span><input id="MyTextField'.$c['tf'].'" type="text" name="'.$name.'" value="'.$value.'" class="'.$input_class.'_'.$type.'"></p><div id="MyTextFieldAlert'.$c['tf'].'" class="field_error">'.$error_text.'</div>';
					}
					else
					{
						$return = '
<p class="user_data"><span class="user_data">'.$title.': </span><input type="text" name="'.$name.'" value="'.$value.'" class="'.$input_class.'_'.$type.'"></p>';
					}
				break;
				
				// input type password
				case 'pw':
					if ($validate)
					{
						$return = '
<p class="user_data"><span class="user_data">'.$title.': </span><input id="MyPasswordField'.$c['pw'].'" type="password" name="'.$name.'" value="'.$value.'" class="'.$input_class.'_'.$type.'"></p><div id="MyPasswordFieldAlert'.$c['pw'].'" class="field_error">'.$error_text.'</div>';
					}
					else
					{
						$return = '
<p class="user_data"><span class="user_data">'.$title.': </span><input type="password" name="'.$name.'" value="'.$value.'" class="'.$input_class.'_'.$type.'"></p>';
					}
				break;
				
				// select
				case 'dd':
					if ($validate)
					{
						$return = '<p class="alert">Not yet supported</p>';
					}
					else
					{
						$return = '<p class="alert">Not yet supported</p>';
					}
				break;
				
				// select?
				case 'rb':
					if ($validate)
					{
						$return = '<p class="alert">Not yet supported</p>';
					}
					else
					{
						$return = '<p class="alert">Not yet supported</p>';
					}
				break;
				
				// textarea
				case 'ta':
					if ($validate)
					{
						$add = "";
						if($input_class != "user_data") $add = "_large";
						$return = '
<p class="user_data_textarea'.$add.'"><span class="user_data">'.$title.': </span><textarea id="MyTextArea'.$c['ta'].'" type="text" name="'.$name.'" class="'.$input_class.'_'.$type.'">'.$value.'</textarea></p><div id="MyTextAreaAlert'.$c['ta'].'" class="field_error">'.$error_text.'</div>';
					}
					else
					{
						$return = '
<p class="user_data"><span class="user_data">'.$title.': </span><textarea type="text" name="'.$name.'" class="'.$input_class.'_'.$type.'">'.$value.'</textarea></p>';
					}
				break;
				
				// Submit (button)
			case 'submit':
				$return = '
<p class="user_data"><input type="submit" value="'.$value.'" onclick="return CheckForm('.$c['tf'].','.$c['pw'].','.$c['dd'].','.$c['rb'].','.$c['ta'].')"></p>';
			break;
				
				// Default, return error
				default:
					$return = "<p class=\"alert\">Error making form element: $type. Values- title: $title, name: $name, value: $value, validate: $validate, error_text: $error_text</p>";
				break;
			}
			return $return;
		}
		else
		{
			return false;
		}
	}

?>
