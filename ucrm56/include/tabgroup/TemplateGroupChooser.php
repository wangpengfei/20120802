<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

$js_loaded = FALSE;
require_once( "include/tabgroup/Template.php" );


function get_image( $image, $other_attributes, $width = "", $height = "" )
{
				global $png_support;
				if ( !$png_support )
				{
								$ext = "gif";
				}
				else
				{
								$ext = "png";
				}
				$out = "";
				if ( file_exists( $image.".".$ext ) )
				{
								$size = getimagesize( $image.".".$ext );
								if ( $width == "" )
								{
												$width = $size[0];
								}
								if ( $height == "" )
								{
												$height = $size[1];
								}
								$out = "<img src='".$image.".{$ext}' width='".$width."' height='".$height.( "' ".$other_attributes.">" );
								return $out;
				}
				if ( 0 < substr_count( $image, "themes" ) )
				{
								$path = explode( "/", $image );
								$path[1] = "Default";
								$image = implode( "/", $path );
								if ( file_exists( $image.".".$ext ) )
								{
												$size = getimagesize( $image.".".$ext );
												if ( $width == "" )
												{
																$width = $size[0];
												}
												if ( $height == "" )
												{
																$height = $size[1];
												}
												$out = "<img src='".$image.".{$ext}' width='".$width."' height='".$height.( "' ".$other_attributes.">" );
								}
				}
				return $out;
}


class TemplateGroupChooser extends Template
{

				public $args = NULL;
				public $js_loaded = FALSE;
				public $display_hide_tabs = TRUE;
				public $display_third_tabs = FALSE;

				public function TemplateGroupChooser( )
				{
				}

				public function display( )
				{
								global $mod_strings;
								global $js_loaded;
								$image_path = "themes/images/";
								if ( !$js_loaded )
								{
												$this->template_groups_chooser_js( );
												$js_loaded = TRUE;
								}
								if ( isset( $this->args['display'] ) )
								{
												$table_style = "";
								}

								else
								{
												$table_style = "display: ".$this->args['display'];
								}
								ob_start( );
								echo "<div id=\"";
								echo $this->args['id'];
								echo "\" style=\"";
								echo $table_style;
								echo "\">\r\n";
								echo $this->args['title'];
								echo "</h4>\r\n</th>\r\n</tr>\r\n<tr>\r\n\t<td>\r\n<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\r\n\r\n<tr>\r\n\t<td>&nbsp;</td>\r\n\t<td  class=\"dataLabel\" id=\"chooser_";
								echo $this->args['left_name'];
								echo "_text\" align=\"center\"><nobr><b>";
								echo $this->args['left_label'];
								echo "</b></nobr></td>\r\n\t";
								if ( $this->display_hide_tabs == true )
									
								{
												echo "\t<td>&nbsp;</td>\r\n\t<td  class=\"dataLabel\" id=\"chooser_";
												echo $this->args['right_name'];
												echo "\" align=\"center\"><nobr><b>";
												echo $this->args['right_label'];
												echo "</b></nobr></td>\r\n\t";
								}
								echo "\t";
								if ( $this->display_third_tabs == true )
								{
												echo "\t<td>&nbsp;</td>\r\n\t<td>&nbsp;</td>\r\n\t<td  class=\"dataLabel\" id=\"chooser_";
												echo $this->args['third_name'];
												echo "\" align=\"center\"><nobr><b>";
												echo $this->args['third_label'];
												echo "</b></nobr></td>\r\n\t";
								}
								echo "</tr>\r\n<tr>\r\n\t<td valign=\"top\" style=\"padding-right: 2px; padding-left: 2px;\" align=\"center\">\r\n";
								 
								if ( !isset( $this->args['disable'] ) )
								{
												echo "\r\n<a onclick=\"javascript:up('";
												echo $this->args['left_name'];
												echo "');\">";
												echo get_image( $image_path."uparrow_big", "border=\"0\" style=\"margin-bottom: 1px;\" alt=\"Sort\"" );
												echo "</a><br>\r\n<a onclick=\"javascript:down('";
												echo $this->args['left_name'];
												echo "');\">";
												echo get_image( $image_path."downarrow_big", "border=\"0\" style=\"margin-top: 1px;\"  alt=\"Sort\"" );
												echo "</a>\r\n";
								}
								echo "\t\t\t</td>\r\n\t\r\n\t<td align=\"center\">\r\n\r\n\t\t<table border=\"0\" cellspacing=0 cellpadding=\"0\" align=\"center\">\r\n\t\t<tr>\r\n\t\t\t<td id=\"";
								echo $this->args['left_name'];
								echo "_td\" align=\"center\">\r\n\t\t\t<select id=\"";
								echo $this->args['left_name'];
								echo "\" name=\"";
								echo $this->args['left_name'];
								echo "[]\" size=\"10\" multiple=\"multiple\" size=\"10\" ";
								if ( isset( $this->args['disable'] ) )
								{
												echo "DISABLED";
								}
								echo ">\r\n";
								foreach ( $this->args['values_array'][0] as $key => $value )
								{
												echo "<option value=\"";
												echo $key;
												echo "\">";
												echo $value;
												echo "</option>\r\n";
								}
								echo "</select>\r\n</td>\r\n\t\t</tr>\r\n\t\t</table>\r\n\t</td>\r\n\t";
								if ( $this->display_hide_tabs )
								{
												echo "\t<td valign=\"top\" style=\"padding-right: 2px; padding-left: 2px;\" align=\"center\">\r\n";
												if (!isset( $this->args['disable'] ) )
												{
																echo "<a onclick=\"javascript:right_to_left('";
																echo $this->args['left_name'];
																echo "','";
																echo $this->args['right_name'];
																echo "');\">";
																echo get_image( $image_path."leftarrow_big", "border=\"0\" style=\"margin-right: 1px;\" alt=\"Sort\"" );
																echo "</a><a onclick=\"javascript:left_to_right('";
																echo $this->args['left_name'];
																echo "','";
																echo $this->args['right_name'];
																echo "');\">";
																echo get_image( $image_path."rightarrow_big", "border=\"0\" style=\"margin-left: 1px;\" alt=\"Sort\"" );
																echo "</a>\r\n";
												}
												echo "</td>\r\n\t<td id=\"";
												echo $this->args['right_name'];
												echo "_td\" align=\"center\">\r\n<select id=\"";
												echo $this->args['right_name'];
												echo "\" name=\"";
												echo $this->args['right_name'];
												echo "[]\" size=\"10\" multiple=\"multiple\" ";
												if ( isset( $this->args['disable'] ) )
												{
																echo "DISABLED";
												}
												echo ">\r\n";
												foreach ( $this->args['values_array'][1] as $key => $value )
												{
																echo "<option value=\"";
																echo $key;
																echo "\">";
																echo $value;
																echo "</option>\r\n";
												}
												echo "</select>\r\n<script>\r\nobject_refs['";
												echo $this->args['right_name'];
												echo "'] = document.getElementById('";
												echo $this->args['right_name'];
												echo "');\r\n</script>\r\n\r\n\t<td valign=\"top\" style=\"padding-right: 2px; padding-left: 2px;\" align=\"center\">\r\n<!--\r\n<a onclick=\"javascript:up('";
												echo $this->args['right_name'];
												echo "');\">";
												echo get_image( $image_path."uparrow_big", "border=\"0\" style=\"margin-bottom: 1px;\" alt=\"Sort\"" );
												echo "</a><br>\r\n<a onclick=\"javascript:down('";
												echo $this->args['right_name'];
												echo "');\">";
												echo get_image( $image_path."downarrow_big", "border=\"0\" style=\"margin-top: 1px;\"  alt=\"Sort\"" );
												echo "</a>\r\n-->\r\n\r\n\t\t\t</td>\r\n\t\t\t";
								}
								echo "\t";
								if ( $this->display_third_tabs )
								{
												echo "\t<td valign=\"top\" style=\"padding-right: 2px; padding-left: 2px;\" align=\"center\">\r\n";
												if ( !isset( $this->args['disable'] ) )
												{
																echo "<a onclick=\"javascript:right_to_left('";
																echo $this->args['right_name'];
																echo "','";
																echo $this->args['third_name'];
																echo "');\">";
																echo get_image( $image_path."leftarrow_big", "border=\"0\" style=\"margin-right: 1px;\" alt=\"Sort\"" );
																echo "</a><a onclick=\"javascript:left_to_right('";
																echo $this->args['right_name'];
																echo "','";
																echo $this->args['third_name'];
																echo "');\">";
																echo get_image( $image_path."rightarrow_big", "border=\"0\" style=\"margin-left: 1px;\" alt=\"Sort\"" );
																echo "</a>\r\n";
												}
												echo "</td>\r\n\t<td id=\"";
												echo $this->args['third_name'];
												echo "_td\" align=\"center\">\r\n<select id=\"";
												echo $this->args['third_name'];
												echo "\" name=\"";
												echo $this->args['third_name'];
												echo "[]\" size=\"10\" multiple=\"multiple\" ";
												if ( isset( $this->args['disable'] ) )
												{
																echo "DISABLED";
												}
												echo ">\r\n";
												foreach ( $this->args['values_array'][2] as $key => $value )
												{
																echo "<option value=\"";
																echo $key;
																echo "\">";
																echo $value;
																echo "</option>\r\n";
												}
												echo "</select>\r\n<script>\r\nobject_refs['";
												echo $this->args['third_name'];
												echo "'] = document.getElementById('";
												echo $this->args['third_name'];
												echo "');\r\n</script>\r\n\r\n\t<td valign=\"top\" style=\"padding-right: 2px; padding-left: 2px;\" align=\"center\">\r\n<!--\r\n<a onclick=\"javascript:up('";
												echo $this->args['third_name'];
												echo "');\">";
												echo get_image( $image_path."uparrow_big", "border=\"0\" style=\"margin-bottom: 1px;\" alt=\"Sort\"" );
												echo "</a><br>\r\n<a onclick=\"javascript:down('";
												echo $this->args['third_name'];
												echo "');\">";
												echo get_image( $image_path."downarrow_big", "border=\"0\" style=\"margin-top: 1px;\"  alt=\"Sort\"" );
												echo "</a>\r\n-->\r\n\r\n\t\t\t</td>\r\n\t\t\t";
								}
								echo "<script>\r\nobject_refs['";
								echo $this->args['left_name'];
								echo "'] = document.getElementById('";
								echo $this->args['left_name'];
								echo "');\r\n</script>\r\n</tr>\r\n</table>\r\n\r\n";
								$output = ob_get_contents( );
								ob_end_clean( );
								return $output;
				}

				public function template_groups_chooser_js( )
				{
								echo "\r\n";
								echo "<s";
								echo "cript language=\"javascript\" id=\"tabchooser\">\r\nvar object_refs = new Object();\r\n\r\n\r\nfunction buildSelectHTML(info)\r\n{\r\n        var text;\r\n        text = \"";
								echo "<s";
								echo "elect\";\r\n\r\n        if ( typeof (info['select']['size']) != 'undefined')\r\n        {\r\n                text +=\" size=\\\"\"+ info['select']['size'] +\"\\\"\";\r\n        }\r\n\r\n        if ( typeof (info['select']['name']) != 'undefined')\r\n        {\r\n                text +=\" name=\\\"\"+ info['select']['name'] +\"\\\"\";\r\n        }\r\n\r\n        if ( typeof (info['select']['style']) != 'undefined')\r\n        {\r\n           ";
								echo "     text +=\" style=\\\"\"+ info['select']['style'] +\"\\\"\";\r\n        }\r\n\r\n        if ( typeof (info['select']['onchange']) != 'undefined')\r\n        {\r\n                text +=\" onChange=\\\"\"+ info['select']['onchange'] +\"\\\"\";\r\n        }\r\n\r\n        if ( typeof (info['select']['multiple']) != 'undefined')\r\n        {\r\n                text +=\" multiple\";\r\n        }\r\n        text +=\">\";\r\n\r\n        for(i=0; i";
								echo "<info['options'].length;i++)\r\n        {\r\n                option = info['options'][i];\r\n                text += \"<option value=\\\"\"+option['value']+\"\\\" \";\r\n                if ( typeof (option['selected']) != 'undefined' && option['selected']== true)\r\n                {\r\n                        text += \"SELECTED\";\r\n                }\r\n                text += \">\"+option['text']+\"</option>\";\r\n        }\r\n   ";
								echo "     text += \"</select>\";\r\n        return text;\r\n}\r\n\r\n\r\nfunction left_to_right(left_name,right_name) \r\n{\r\n\tvar display_columns_ref = object_refs[left_name];\r\n//alert(display_columns_ref);\r\n\tvar hidden_columns_ref = object_refs[right_name];\r\n\r\n\tvar left_td = document.getElementById(left_name+'_td');\r\n\tvar right_td = document.getElementById(right_name+'_td');\r\n\r\n\tvar selected_left = new Array();\r\n\tva";
								echo "r notselected_left = new Array();\r\n\tvar notselected_right = new Array();\r\n\r\n\tvar left_array = new Array();\r\n\r\n        // determine which options are selected in left \r\n\tfor (i=0; i < display_columns_ref.options.length; i++)\r\n\t{\r\n\t\tif ( display_columns_ref.options[i].selected == true) \r\n\t\t{\r\n\t\t\tselected_left[selected_left.length] = {text: display_columns_ref.options[i].text, value: display_columns_r";
								echo "ef.options[i].value};\r\n\t\t}\r\n\t\telse\r\n\t\t{\r\n\t\t\tnotselected_left[notselected_left.length] = {text: display_columns_ref.options[i].text, value: display_columns_ref.options[i].value};\r\n\t\t}\r\n\t\t\r\n\t}\r\n\r\n\tfor (i=0; i < hidden_columns_ref.options.length; i++)\r\n\t{\r\n\t\tnotselected_right[notselected_right.length] = {text:hidden_columns_ref.options[i].text, value:hidden_columns_ref.options[i].value};\r\n\t\t\r\n\t}\r\n\r\n\tv";
								echo "ar left_select_html_info = new Object();\r\n\tvar left_options = new Array();\r\n\tvar left_select = new Object();\r\n\r\n\tleft_select['name'] = left_name+'[]';\r\n\tleft_select['id'] = left_name;\r\n\tleft_select['size'] = '10';\r\n\tleft_select['multiple'] = 'true';\r\n\r\n\tvar right_select_html_info = new Object();\r\n\tvar right_options = new Array();\r\n\tvar right_select = new Object();\r\n\r\n\tright_select['name'] = right_";
								echo "name+'[]';\r\n\tright_select['id'] = right_name;\r\n\tright_select['size'] = '10';\r\n\tright_select['multiple'] = 'true';\r\n\r\n\tfor (i=0;i < notselected_right.length;i++)\r\n\t{\r\n\t\tright_options[right_options.length] = notselected_right[i];\t\r\n\t}\r\n\r\n\tfor (i=0;i < selected_left.length;i++)\r\n\t{\r\n\t\tright_options[right_options.length] = selected_left[i];\t\r\n\t}\r\n\tfor (i=0;i < notselected_left.length;i++)\r\n\t{\r\n\t\tleft_opt";
								echo "ions[left_options.length] = notselected_left[i];\t\r\n\t}\r\n\tleft_select_html_info['options'] = left_options;\r\n\tleft_select_html_info['select'] = left_select;\r\n\tright_select_html_info['options'] = right_options;\r\n\tright_select_html_info['select'] = right_select;\r\n\tright_select_html_info['style'] = 'background: lightgrey';\r\n\r\n\tvar left_html = buildSelectHTML(left_select_html_info);\r\n\tvar right_html = bu";
								echo "ildSelectHTML(right_select_html_info);\r\n\r\n\tleft_td.innerHTML = left_html;\r\n\tright_td.innerHTML = right_html;\r\n\tobject_refs[left_name] = left_td.getElementsByTagName('select')[0];\r\n\tobject_refs[right_name] = right_td.getElementsByTagName('select')[0];\r\n}\r\n\r\n\r\nfunction right_to_left(left_name,right_name) \r\n{\r\n\tvar display_columns_ref = object_refs[left_name];\r\n\tvar hidden_columns_ref = object_refs[r";
								echo "ight_name];\r\n\r\n\tvar left_td = document.getElementById(left_name+'_td');\r\n\tvar right_td = document.getElementById(right_name+'_td');\r\n\r\n\tvar selected_right = new Array();\r\n\tvar notselected_right = new Array();\r\n\tvar notselected_left = new Array();\r\n\r\n\tfor (i=0; i < hidden_columns_ref.options.length; i++)\r\n\t{\r\n\t\tif (hidden_columns_ref.options[i].selected == true) \r\n\t\t{\r\n\t\t\tselected_right[selected_rig";
								echo "ht.length] = {text:hidden_columns_ref.options[i].text, value:hidden_columns_ref.options[i].value};\r\n\t\t}\r\n\t\telse\r\n\t\t{\r\n\t\t\tnotselected_right[notselected_right.length] = {text:hidden_columns_ref.options[i].text, value:hidden_columns_ref.options[i].value};\r\n\t\t}\r\n\t\t\r\n\t}\r\n\r\n\tfor (i=0; i < display_columns_ref.options.length; i++)\r\n\t{\r\n\t\tnotselected_left[notselected_left.length] = {text:display_columns_ref";
								echo ".options[i].text, value:display_columns_ref.options[i].value};\r\n\t\t\r\n\t}\r\n\r\n\tvar left_select_html_info = new Object();\r\n\tvar left_options = new Array();\r\n\tvar left_select = new Object();\r\n\r\n\tleft_select['name'] = left_name+'[]';\r\n\tleft_select['id'] = left_name;\r\n\tleft_select['multiple'] = 'true';\r\n\tleft_select['size'] = '10';\r\n\r\n\tvar right_select_html_info = new Object();\r\n\tvar right_options = new A";
								echo "rray();\r\n\tvar right_select = new Object();\r\n\r\n\tright_select['name'] = right_name+ '[]';\r\n\tright_select['id'] = right_name;\r\n\tright_select['multiple'] = 'true';\r\n\tright_select['size'] = '10';\r\n\r\n\tfor (i=0;i < notselected_left.length;i++)\r\n\t{\r\n\t\tleft_options[left_options.length] = notselected_left[i];\t\r\n\t}\r\n\r\n\tfor (i=0;i < selected_right.length;i++)\r\n\t{\r\n\t\tleft_options[left_options.length] = selected_";
								echo "right[i];\t\r\n\t}\r\n\tfor (i=0;i < notselected_right.length;i++)\r\n\t{\r\n\t\tright_options[right_options.length] = notselected_right[i];\t\r\n\t}\r\n\tleft_select_html_info['options'] = left_options;\r\n\tleft_select_html_info['select'] = left_select;\r\n\tright_select_html_info['options'] = right_options;\r\n\tright_select_html_info['select'] = right_select;\r\n\tright_select_html_info['style'] = 'background: lightgrey';\r\n\r\n\t";
								echo "var left_html = buildSelectHTML(left_select_html_info);\r\n\tvar right_html = buildSelectHTML(right_select_html_info);\r\n\r\n\tleft_td.innerHTML = left_html;\r\n\tright_td.innerHTML = right_html;\r\n\tobject_refs[left_name] = left_td.getElementsByTagName('select')[0];\r\n\tobject_refs[right_name] = right_td.getElementsByTagName('select')[0];\r\n}\r\n\r\n\r\nfunction up(name) {\r\n\tvar td = document.getElementById(name+'_td";
								echo "');\r\n\tvar obj = td.getElementsByTagName('select')[0];\r\n\tobj = (typeof obj == \"string\") ? document.getElementById(obj) : obj;\r\n\tif (obj.tagName.toLowerCase() != \"select\" && obj.length < 2)\r\n\t\treturn false;\r\n\tvar sel = new Array();\r\n\tfor (i=0; i<obj.length; i++) {\r\n\t\tif (obj[i].selected == true) {\r\n\t\t\tsel[sel.length] = i;\r\n\t\t}\r\n\t}\r\n\tfor (i in sel) {\r\n\t\tif (sel[i] != 0 && typeof (obj[sel[i]-1]) != 'und";
								echo "efined' && !obj[sel[i]-1].selected) {\r\n\t\t\tvar tmp = new Array(obj[sel[i]-1].text, obj[sel[i]-1].value);\r\n\t\t\tobj[sel[i]-1].text = obj[sel[i]].text;\r\n\t\t\tobj[sel[i]-1].value = obj[sel[i]].value;\r\n\t\t\tobj[sel[i]].text = tmp[0];\r\n\t\t\tobj[sel[i]].value = tmp[1];\r\n\t\t\tobj[sel[i]-1].selected = true;\r\n\t\t\tobj[sel[i]].selected = false;\r\n\t\t}\r\n\t}\r\n}\r\n\r\n\r\nfunction down(name) {\r\n\tvar td = document.getElementById(na";
								echo "me+'_td');\r\n\tvar obj = td.getElementsByTagName('select')[0];\r\n\tif (obj.tagName.toLowerCase() != \"select\" && obj.length < 2)\r\n\t\treturn false;\r\n\tvar sel = new Array();\r\n\tfor (i=obj.length-1; i>-1; i--) {\r\n\t\tif (obj[i].selected == true) {\r\n\t\t\tsel[sel.length] = i;\r\n\t\t}\r\n\t}\r\n\tfor (i in sel) {\r\n\t\tif (sel[i] != obj.length-1 && typeof (obj[sel[i]+1]) != 'undefined' && !obj[sel[i]+1].selected) {\r\n\t\t\tvar tmp";
								echo " = new Array(obj[sel[i]+1].text, obj[sel[i]+1].value);\r\n\t\t\tobj[sel[i]+1].text = obj[sel[i]].text;\r\n\t\t\tobj[sel[i]+1].value = obj[sel[i]].value;\r\n\t\t\tobj[sel[i]].text = tmp[0];\r\n\t\t\tobj[sel[i]].value = tmp[1];\r\n\t\t\tobj[sel[i]+1].selected = true;\r\n\t\t\tobj[sel[i]].selected = false;\r\n\t\t}\r\n\t}\r\n}\r\n\r\n</script>\r\n";
				}

}

?>
