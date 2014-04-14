<?php
function pr($array_arg)
{
	echo "<pre>";
		print_r($array_arg);
	echo "</pre>";
}
function setLanguage($lang_id=0)
{
	if($lang_id==1)
	{
		return $_SESSION['lang_file'] = 'en.php';
	}
	else
	{
		return $_SESSION['lang_file'] = 'spn.php';
	}
}

function loadParam($key, $default='')
{
	if(isset($_REQUEST[$key]))
		return $_REQUEST[$key];
	else
		return $default;
}


function loadParamPost($key, $default='')
{
	if(isset($_POST[$key]))
		return $_POST[$key];
	else
		return $default;
}

function loadParamGet($key, $default='')
{
	if(isset($_POST[$key]))
		return $_POST[$key];
	else
		return $default;
}

function loadParamGlb($key, $default='')
{
	if(isset($GLOBALS[$key]))
		return $GLOBALS[$key];
	else
		return $default;
}

function loadParamFromArray($arr,$key, $default='')
{
	if(is_array($arr))
	{
		if(isset($arr[$key]))
			return $arr[$key];
		else
			return $default;
	}
	else
	{
		return $default;
	}
}


function DisplayAlphabet()
{
	$str="A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z";
	$str=split(",",$str);
	for($i=0; $i < sizeof($str); $i++)
	{
		echo "<a href=\"#\" class='link' onClick=\"javascript:search_alpha('".$str[$i]."')\">$str[$i]</a>&nbsp;&nbsp;&nbsp;";
	}
}


// Function to sort column ascending or descending. 
// This function only changes the image based on the paramaters.

function OrderByColumn($column_name,$field_name,$order_field,$order_by)
{
	$str = "<a href=\"javascript:toggle_order('".$field_name."')\">".$column_name."</a>";
	if ($order_field == $field_name && $GLOBALS['mode_toggle'] == "toggle") $str = $str."<img src=\"".URL."admin/images/".$order_by."_order.gif\">";
	return $str;		
}

function logged_in($user_id)
{	
?>
	<script language="JavaScript">
		getData('<?=$user_id?>');
	</script>
<?
}

function unhtmlentities($string) 
{
    $trans_tbl = get_html_translation_table(HTML_ENTITIES);
    $trans_tbl = array_flip($trans_tbl);
    return strtr($string, $trans_tbl);
}

// Function to find that the given value exist in the database. 
// Option to pass other condition as well

function Exist($value, $field_name, $table_name, $other_condition='')
{
	if ($other_condition != "") $sql_other_condition = " AND ".$other_condition." ";
	else  $sql_other_condition = "";

	$sql = "select count(*) from ".$table_name." where BINARY ".$field_name."='".$value."' ".$sql_other_condition;
	$rs  = mysql_query($sql);

	$rec = mysql_fetch_array($rs);		

	if ($rec[0] > 0) return true;
	else return false;
}

//delete record function
function delete_records($row_id, $table_name, $id_field, $show_mode='')
{
	$sql = "delete from ".$table_name." where ".$id_field."=".$row_id;
	if (!mysql_query($sql)) echo mysql_error();

	$GLOBALS['mode']="";
	if($show_mode=="")		disphtml("show_list();");
}

// change status function
function change_status($row_id, $table_name, $field_name, $id_field)
{
	$sql = "update ".$table_name." set ".$field_name." = if(".$field_name."='0','1','0') where ".$id_field."=".$row_id;	
	if (!mysql_query($sql)) echo mysql_error();
	$GLOBALS['mode']="";

	disphtml("show_list();");
}

// function to fetch a single value against a ID
function getValue($TableName,$ID,$ID_Name,$FieldNames)
{
	$sql_getValue = "Select ".$FieldNames." from ".$TableName." where ".$ID_Name."='".$ID."'";	
	$query_getValue = mysql_query($sql_getValue);

	$rs_getValue = mysql_fetch_array($query_getValue);

	if (mysql_num_rows($query_getValue) > 0) return $rs_getValue[0];
	else return "";

	mysql_free_result($query_getValue);
}

function getValues($TableName,$ID,$ID_Name,$FieldNames)
{
	$sql_getValue = "Select ".$FieldNames." from ".$TableName." where ".$ID_Name."='".$ID."'";	
	$query_getValue = mysql_query($sql_getValue);

	if (mysql_num_rows($query_getValue) == 1)
	{
		$rs_getValue = mysql_fetch_array($query_getValue);
		return $rs_getValue[0];
	}
	else if(mysql_num_rows($query_getValue) > 1)
	{
		while($rs_getValue = mysql_fetch_array($query_getValue))
		{
			$arr[] = $rs_getValue[0];
		}
		
		return implode(",",$arr);
	}
	else return "";

	mysql_free_result($query_getValue);
}

// function to fetch a single value against some condition
function getValue_condition($TableName,$FieldNames,$Condition='')
{
	if($Condition=="") $Condition="";
	else $Condition=" WHERE ".$Condition;

	$sql_getValue = "Select ".$FieldNames." from ".$TableName.$Condition;
	//print $sql_getValue."<br>";
	$query_getValue = mysql_query($sql_getValue);

	$rs_getValue = mysql_fetch_array($query_getValue);

	if (mysql_num_rows($query_getValue) > 0) return $rs_getValue[0];
	else return "";

	mysql_free_result($query_getValue);
}

//Function to fetch the name of a member
function getName($user_id = '')
{
	$sql_getName = "SELECT fname,mname,lname FROM ".USER_MASTER." WHERE user_id = ".$user_id;
	$rs_getName = mysql_query($sql_getName) or die(mysql_error()." Error in getName : ".$sql_getName);

	$rec_getName = mysql_fetch_array($rs_getName);

	$getName = ucfirst(stripslashes($rec_getName['fname']))."&nbsp;".ucfirst(stripslashes($rec_getName['mname']))."&nbsp;".ucfirst(stripslashes($rec_getName['lname']));
	return $getName; 
}

function dateFormat($date = '')
{
	list($day, $month, $year) = explode(' ',$date);
	$arr1 = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
	$arr2 = array('01','02','03','04','05','06','07','08','09','10','11','12');
	$month = str_replace($arr1,$arr2,$month);
	$tempDate = $year.'-'.$month.'-'.$day;	
	return $tempDate;
}

function dateFormat1($date = '')
{
	list($month, $day, $year) = explode('-',$date);
	$tempDate = $year.'-'.$month.'-'.$day;
	return $tempDate;
}


//Function used for combo population
function PopulateSelect($combo_name, $sql, $value_field, $option_field, $selected_index, $is_multiple='', $style='')
{
	$id_arr = array();	
	if ($is_multiple != "")	
	{
		if ($selected_index == "0,0") $selected=" selected ";	
		else $id_arr = explode(",",$selected_index);
	}
	else
	{
		 $id_arr[] = $selected_index;
	}
	
	$str_select_start = "<select name=".trim($combo_name)." ".$is_multiple."  class=\"".$style."\">";
	$str_option = $str_option."<option value=\"0\"".$selected.">--Select--</option>";
	$selected="";
	$rs = mysql_query($sql);
	if (mysql_num_rows($rs) > 0)
	{
		while($rec = mysql_fetch_array($rs))
		{
			if (in_array($rec[$value_field],$id_arr)) $selected = " selected ";
			else  $selected = " ";

			$str_option = $str_option."<option title=\"".stripslashes($rec[$option_field])."\" value=".$rec[$value_field]." ".$selected." >".stripslashes($rec[$option_field])."</option>";

		}
	}
	$str_select_end = "</select>";

	mysql_free_result($rs);
	return $str_select_start.$str_option.$str_select_end;
}

/*******************************************Function used for making thumbnail*****************************************/

function MakeThumbnail($Image_path, $flname, $width, $height,$orginal="")
{
	$image_name = $flname;  //Image path retrived 
	$image_path = $Image_path;
	$Image = $Image_path.$flname;	

	list($temp_width, $temp_height, $temp_type, $temp_attr) = getimagesize($Image);

	if($temp_width > $width)
	{
		$height = ceil(($temp_height*$width)/$temp_width);
	}

    if($temp_width <= $width)
	{
		$width = $temp_width;
		$height = $temp_height;
	}

	//Identifying Image type 

    $len = strlen($image_name); 
    $pos =strpos($image_name,"."); 
    $type = substr($image_name,$pos + 1,$len); 
	$type_new = strtolower($type);
	
    if ($type_new=="jpeg" || $type_new=="jpg") 
    { 
        thumb_jpeg ($image_name, $image_path, $width, $height,$orginal); //Call to jpeg function 
    } 
    else if($type_new=="png" || $type_new=="PNG") 
    { 
        thumb_png ($image_name, $image_path, $width, $height,$orginal);  //Call to PNG function 
    } 
	else if($type_new=="gif" || $type_new=="GIF") 
    { 
        thumb_gif ($image_name, $image_path, $width, $height,$orginal);  //Call to PNG function 
    } 
}

//JPEG function 
function thumb_jpeg($image_name, $image_path, $width, $height,$orginal="") 
{ 

    $source_path = $image_path; 

	if($orginal=="")
    	$destination_path = $image_path."thumbnail/thumb_";
	else 
    	$destination_path = $image_path.$orginal;

    $new_width=$width; 
    $new_height=$height; 

    $destimg=imagecreatetruecolor($new_width,$new_height) or die("Problem In Creating image"); 
    $srcimg=ImageCreateFromJPEG($source_path.$image_name) or die("Problem In opening Source Image"); 


    ImageCopyResized($destimg,$srcimg,0,0,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg)) or die("Problem In resizing"); 
    ImageJPEG($destimg,$destination_path.$image_name) or die("Problem In saving");

	//added by dhiman
	chmod($destination_path.$image_name,0777);
} 

//PNG function 
// Some addition has been done by dhiman
function thumb_png($image_name, $image_path, $width, $height,$orginal="") 
{ 

    $source_path = $image_path; 
	if($orginal=="")
    	$destination_path = $image_path."thumbnail/thumb_";
	else 
    	$destination_path = $image_path.$orginal;

    $new_width=$width; 
    $new_height=$height; 

    $destimg=imagecreatetruecolor($new_width,$new_height) or die("Problem In Creating image"); 
    $srcimg=ImageCreateFromPNG($source_path.$image_name) or die("Problem In opening Source Image"); 

    ImageCopyResized($destimg,$srcimg,0,0,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg)) or die("Problem In resizing"); 
    ImagePNG($destimg,$destination_path.$image_name) or die("Problem In saving"); 
	//added by dhiman
	chmod($destination_path.$image_name,0777);
} 

//GIF function 
// Some addition has been done by dhiman

function thumb_gif($image_name, $image_path, $width, $height,$orginal="") 
{ 
    $source_path = $image_path; 
	if($orginal=="")
    	$destination_path = $image_path."thumbnail/thumb_";
	else 
    	$destination_path = $image_path.$orginal;

    $new_width=$width; 
    $new_height=$height; 

    $destimg=imagecreatetruecolor($new_width,$new_height) or die("Problem In Creating image"); 
    $srcimg=ImageCreateFromGIF($source_path.$image_name) or die("Problem In opening Source Image"); 

    ImageCopyResized($destimg,$srcimg,0,0,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg)) or die("Problem In resizing"); 
    ImageGIF($destimg,$destination_path.$image_name) or die("Problem In saving");

	//added by dhiman
	chmod($destination_path.$image_name,0777);
} 

/*****************************Function used for making thumbnail*********************************/



//Function used for uploading a file
function fileUpload($upload_dir,$file_name,$tmp_name,$file_size,$file_type,$sql="")
{
	$flag=0;
	if($file_name!="" && $file_size<31457280)
	{
		$upload_file=$upload_dir.$file_name;			
		if($sql!="")//for update image
		{
			$sql_rs=mysql_query($sql) or die(mysql_error());
			$sql_data=mysql_fetch_row($sql_rs);

			$image_to_unlink=$sql_data[0];
			//echo($image_to_unlink);
			
											

			if(file_exists($upload_dir.$image_to_unlink) && $upload_dir.$image_to_unlink!=$upload_dir)
			{		
				copy($upload_dir.$image_to_unlink, $upload_dir.$image_to_unlink.".bak"); //create the backup file
				unlink($upload_dir.$image_to_unlink); //delete the specified file
				
				switch($file_type)
				{
					case "image":
						$extn=strstr($file_name,".");
						//echo($extn);
						$new_extn = strtoupper($extn);
						if($new_extn==".JPG" || $new_extn==".GIF" ||  $new_extn==".JPEG" ||  $new_extn==".PNG" || $new_extn==".BMP")
						{			
							if(move_uploaded_file($tmp_name,$upload_file))
							{										
								unlink($upload_dir.$image_to_unlink.".bak"); //delete the backup file
								chmod($upload_file, 0644); //change file to read mode
								$GLOBALS['err'] = "Your file have uploaded successfully!!!";
							}
							else
							{
								copy($upload_dir.$image_to_unlink.".bak",$upload_dir.$image_to_unlink);
								unlink($upload_dir.$image_to_unlink.".bak");
								$GLOBALS['err'] = "A error occoured during uploading your file!!!";
								$flag=1;
								return $flag;
							}
						}
						else
						{
							copy($upload_dir.$image_to_unlink.".bak",$upload_dir.$image_to_unlink);
							unlink($upload_dir.$image_to_unlink.".bak");
							$GLOBALS['err'] = "File should be an Image!!!";
							$flag=1;
							return $flag;
						}
					break;
					case "general":
						if(move_uploaded_file($tmp_name,$upload_file))
						{
							unlink($upload_dir.$image_to_unlink.".bak"); //delete the backup file
							chmod($upload_file, 0644); //change file to read mode								
							$GLOBALS['err'] = "Your file have uploaded successfully!!!";
						}
						else
						{
							copy($upload_dir.$image_to_unlink.".bak",$upload_dir.$image_to_unlink);
							unlink($upload_dir.$image_to_unlink.".bak");

							$GLOBALS['err'] = "A error occoured during uploading your file!!!";

							$flag=1;
							return $flag;
						}
					break;
				}																	
			}		
			else
			{
				switch($file_type)
				{
					case "image":
						$extn=strstr($file_name,".");
						$new_extn = strtoupper($extn);

						if($new_extn==".JPG" || $new_extn==".GIF" ||  $new_extn==".JPEG" ||  $new_extn==".PNG")
						{
							if(move_uploaded_file($tmp_name,$upload_file))
							{
								chmod($upload_file, 0644); //change file to read mode
								$GLOBALS['err']= "Your file have uploaded successfully!!!";
							}
							else
							{
								$GLOBALS['err']= "A error occoured during uploading your file!!!";
								$flag=1;
								return $flag;
							}
						}
						else
						{
							$GLOBALS['err']= "File should be an Image!!!";
							$flag=1;
							return $flag;
						}
					break;
					case "general":
						if(move_uploaded_file($tmp_name,$upload_file))
						{
							chmod($upload_file, 0644); //change file to read mode
							$GLOBALS['err'] = "Your file have uploaded successfully!!!";
						}
						else
						{
							$GLOBALS['err'] = "An error occoured during uploading your file!!!";
							$flag=1;
							return $flag;
						}
					break;
				}//end of switch

			}//end of unlink checking
		}//
		else//for insert image
		{
			switch($file_type)
			{
				case "image":
					$extn=strstr($file_name,".");
					$new_extn = strtoupper($extn);

					if($new_extn==".JPG" || $new_extn==".GIF" ||  $new_extn==".JPEG" ||  $new_extn==".PNG")
					{
						if(move_uploaded_file($tmp_name,$upload_file))
						{
							chmod($upload_file, 0644); //change file to read mode
						
							$GLOBALS['err'] = "Your file have uploaded successfully!!!";
						}
						else
						{
							$GLOBALS['err'] = "A error occoured during uploading your file!!!";
							$flag=1;
							return $flag;
						}
					}
					else
					{
						$GLOBALS['err'] = "File should be an Image!!!";
						$flag=1;
						return $flag;
					}
				break;
				case "general":
					if(move_uploaded_file($tmp_name,$upload_file))
					{
						chmod($upload_file, 0644); //change file to read mode
						$GLOBALS['err'] = "Your file have uploaded successfully!!!";
					}
					else
					{
						$GLOBALS['err'] = "A error occoured during uploading your file!!!";
						$flag=1;
						return $flag;
					}
				break;
			}//end of switch
		}//end of sql checking
	}//end of size and file checking
	else
	{
		$GLOBALS['err'] = "Your file is too big to upload!!!";
		$flag=1;
		return;
	}		
	return $flag;
}


//Function used for pagination
function pagination($count,$frmName)
{
	if($_REQUEST['mode']=='delete')
	{
		$count=$count-1;
		$noOfPages = ceil($count/$GLOBALS['show']);
		$_REQUEST['pageNo']=$noOfPages;
	}
	else
	{
		$noOfPages = ceil($count/$GLOBALS['show']);
	}
?>
<script language="JavaScript" type="text/javascript">
<!--
function prevPage(no)
{
	document.<?=$frmName?>.action="";
	document.<?=$frmName?>.pageNo.value = no-1;
	document.<?=$frmName?>.submit();
}

function nextPage(no)
{
	document.<?=$frmName?>.action="";
	document.<?=$frmName?>.pageNo.value = no+1;
	document.<?=$frmName?>.submit();
}

function disPage(no)
{

	document.<?=$frmName?>.action="";
	document.<?=$frmName?>.pageNo.value = no;
	document.<?=$frmName?>.submit();
}
//-->
</script>
<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
	<tr >
		<td width="25%" align="left">
			<? if($_REQUEST['pageNo']!=1){ ?>
			<a href="javascript:prevPage(<?=$_REQUEST['pageNo'] ?>);" onmouseout="javascript:window.status='Done';" onmousemove="javascript:window.status='Go to Previous Page';" class="mainlink"  style="color:#335EA8;">&#171; Prev</a>
			<? }else{ ?>
				<!--<a href="#" onmouseout="javascript:window.status='Done';" onmousemove="javascript:window.status='Go to Previous Page';"><font size="3">&#171;</font> Prev</a>-->
			<? }?>
		</td>
		<td align="center" style="text-align:center;" >
			<? 
			####### script to display no of pages #########
			//condition where no of pages is less than display limit
			$displayPageLmt = 6; #holds no of page links to display
			if($noOfPages <= $displayPageLmt)
			{
				for($pgLink = 1; $pgLink <= $noOfPages; $pgLink++)
				{
					if($pgLink==$_REQUEST['pageNo'])
					{
						echo "<a href=\"#\" style=\"text-decoration:none;font-width:bold;color:#335EA8\" onmouseout=\"javascript:window.status='Done';\" onmousemove=\"javascript:window.status='Go to this Page';\" class=\"mainactive\"  >$pgLink</a>";
					}
					else
					{
						echo "<a href=\"javascript:disPage($pgLink)\" style=\"text-decoration:none;color:#335EA8\" onmouseout=\"javascript:window.status='Done';\" onmousemove=\"javascript:window.status='Go to this Page';\" class=\"mainlink\" >$pgLink</a>";
					}	
					if($pgLink<>$noOfPages) echo "&nbsp;";
				} #end of for loop
			} #end of if

			//condition for no of pages greater than display limit
			if($noOfPages > $displayPageLmt)
			{
				if(($_REQUEST['pageNo']+($displayPageLmt-1)) <= $noOfPages)
				{
					for($pgLink = $_REQUEST['pageNo']; $pgLink <= ($_REQUEST['pageNo']+$displayPageLmt-1); $pgLink++)
					{
						if($pgLink==$_REQUEST['pageNo'])
						{
							echo "<a href=\"#\" style=\"text-decoration:none;font-width:bold;color:#335EA8\" onmouseout=\"javascript:window.status='Done';\" onmousemove=\"javascript:window.status='Go to this Page';\" class=\"mainactive\" >$pgLink</a>";
						}
						else
						{
							echo "<a href=\"javascript:disPage($pgLink)\" style=\"text-decoration:none;color:#335EA8\" onmouseout=\"javascript:window.status='Done';\" onmousemove=\"javascript:window.status='Go to this Page';\" class=\"mainlink\" >$pgLink</a>";
						}
						if($pgLink<>($_REQUEST['pageNo']+$displayPageLmt-1)) echo "&nbsp;";
					}#end of for loop						
				}#end of inner if
				else
				{
					for($pgLink = ($noOfPages - ($displayPageLmt-1)); $pgLink <= $noOfPages; $pgLink++)
					{
						if($pgLink==$_REQUEST['pageNo'])
						{
							echo "<a href=\"#\" style=\"text-decoration:none;font-width:bold;color:#C63031\" onmouseout=\"javascript:window.status='Done';\" onmousemove=\"javascript:window.status='Go to this Page';\" class=\"mainactive\" >$pgLink</a>";
						}
						else
						{
							echo "<a href=\"javascript:disPage($pgLink)\" style=\"text-decoration:none;color:#C63031\" onmouseout=\"javascript:window.status='Done';\" onmousemove=\"javascript:window.status='Go to this Page';\" class=\"mainlink\" >$pgLink</a>";
						}
						if($pgLink<>$noOfPages) echo "&nbsp;";
					}#end of for loop

				}					
			}#end of if noOfPage>displayPageLmt
			?>
		</td>
		<td width="35%" align="right">
			<? if($_REQUEST['pageNo'] != $noOfPages) { ?>
				<a href="javascript:nextPage(<?=$_REQUEST['pageNo'] ?>)" onmouseout="javascript:window.status='Done';" onmousemove="javascript:window.status='Go to Next Page';" class="mainlink" style="color:#335EA8;">Next &#187;</a>
			<? }else{ ?>
				<!--<a href="#" onmouseout="javascript:window.status='Done';" onmousemove="javascript:window.status='Go to Next Page';">Next <font size="3">&#187;</font></a>-->
			<? }?>
		</td>
	</tr>	
</table>
<?
}
?>
<?
function paginationImage($count,$frmName)
{
	if($_REQUEST['mode']=='delete')
	{
		$count=$count-1;
		$noOfPages = ceil($count/$GLOBALS['show']);
		$_REQUEST['pageNo']=$noOfPages;
	}
	else
	{
		$noOfPages = ceil($count/$GLOBALS['show']);
	}
?>
<script language="JavaScript" type="text/javascript">
<!--
function prevPage(no)
{
	document.<?=$frmName?>.action="<?=$_SERVER['PHP_SELF']?>";
	document.<?=$frmName?>.pageNo.value = no-1;
	document.<?=$frmName?>.submit();
}
function nextPage(no)
{
	document.<?=$frmName?>.action="<?=$_SERVER['PHP_SELF']?>";
	document.<?=$frmName?>.pageNo.value = no+1;
	document.<?=$frmName?>.submit();
}
//-->
</script>
<table width="100%" align="center" border="0" cellspacing="0" cellpadding="4">
	<tr>
		<td width="45%" align="right">
			<? if($_REQUEST[pageNo]!=1){ ?>
				<input type="button" onClick="javascript:prevPage(<?=$_REQUEST[pageNo] ?>);" onmouseout="javascript:window.status='Done';" onmousemove="javascript:window.status='Go to Previous Image';" class="button" value=" <- ">
			<? }else{ ?>
				<input type="button" disabled class="button" value=" <- ">
			<? }?>
		</td>
		<td align="center">&nbsp;</td>
		<td width="45%" align="left">
			<? if($_REQUEST[pageNo] != $noOfPages) { ?>
				<input type="button" onClick="javascript:nextPage(<?=$_REQUEST[pageNo] ?>);" onmouseout="javascript:window.status='Done';" onmousemove="javascript:window.status='Go to Next Image';" class="button" value=" -> ">
			<? }else{ ?>
				<input type="button" disabled class="button" value=" -> ">
			<? }?>
		</td>
	</tr>
</table>
<?
}
?>
<?
function dispDates($name,$selected)
{
	list($secName,) = explode("_",$name);
	$day=date('d',strtotime($selected));$month=date('m',strtotime($selected));$year=date('Y',strtotime($selected));
	$month_arr=array('January','February','March','April','May','June','July','August','September','October','November','December');?>
	<select name="<?=$name;?>_month" <? if($name == $secName."_start"){ echo " onChange='document.forms[1].".$secName."_end_month.selectedIndex=this.selectedIndex'";}?>>
	<? 	for($i=1;$i<13;$i++){ $i=$i<10?$i='0'.$i:$i;?>
		<option value="<?=$i;?>" <?=$i==$month?"selected":"";?>><?=$month_arr[$i-1];?></option>
	<? }?>
	</select>&nbsp;
	<select name="<?=$name;?>_day" <? if($name == $secName."_start"){ echo " onChange='document.forms[1].".$secName."_end_day.selectedIndex=this.selectedIndex'";}?>>
	<? for($i=1;$i<32;$i++){ $i=$i<10?$i='0'.$i:$i;?>
		<option value="<?=$i;?>" <?=$day==$i?"selected":"";?>><?=$i;?></option>
	<? }?>
	</select>&nbsp;

	<select name="<?=$name;?>_year" <? if($name == $secName."_start"){ echo " onChange='document.forms[1].".$secName."_end_year.selectedIndex=this.selectedIndex'";}?>>
	<? 
	for($i=0;$i<7;$i++)
	{
	?>
		<option value="<?=date('Y')+$i;?>" <?=(date('Y')+$i)==$year?"selected":"";?>><?=date('Y')+$i;?></option>
	<? 
	}
	?>
	</select>
<? 
}
?>

<?
function getchapterID($member_id)
{
	$sql_chapter_id = mysql_query("select * from member_master where member_id ='$member_id'");
	$rec_chapter_id = mysql_fetch_array($sql_chapter_id);
	$chapterID = $rec_chapter_id['chapter_id'];
	return $chapterID;
}
function getUniversityID($chapter_id)
{
	$sql_university_id = mysql_query("select * from member_master where chapter_id ='$chapter_id'");
	$rec_university_id = mysql_fetch_array($sql_university_id);
	$universityID = $rec_university_id['university_id'];
	return $universityID;
}
function  getfraternityId($member_id)
{
	$sql_fraternity_id = mysql_query("select * from member_master where member_id ='$member_id'");
	$fraternityID = mysql_fetch_array($sql_fraternity_id);
	$fraternityID = $fraternityID['fraternity_id'];
	return $fraternityID;
}
function getmember_name($member_id)
{
	$sql_member_name = mysql_query("select * from member_master where member_id ='$member_id'");
	$rec_member_name = mysql_fetch_array($sql_member_name);
	$memberName = $rec_member_name['name'];
	return $memberName;
}
function getmember_email($member_id)
{
	$sql_member_email = mysql_query("select * from member_master where member_id ='$member_id'");
	$rec_member_email = mysql_fetch_array($sql_member_email);
	$memberEmail = $rec_member_email['email'];
	return $memberEmail;
}
function MakeThumbnailNew($file_path,$file_name,$new_width, $new_height, $orginal="")
{
	$original_image_path=$file_path.$file_name; // the path with the file name where the file will be stored, upload is the directory name.
	$file_path=$file_path."thumbnail/thumb_".$file_name;
	
	$ImageArray = maintainAspectRatio($new_width, $original_image_path);
	$new_width=$ImageArray['width'];
	$new_height=$ImageArray['height'];
	
	$len = strlen($file_name); 
	$pos =strpos($file_name,"."); 
	$type = substr($file_name,$pos + 1,$len); 
	$file_type = strtolower($type);

	///////// Start the thumbnail generation//////////////
	if (!($file_type =="jpeg" OR $file_type=="jpg" OR $file_type=="gif" OR $file_type=="png"))
	{
		$GLOBALS['err'] = "Your uploaded file must be of JPG or GIF. Other file types are not allowed<BR>";
	}
	/////////////////////////////////////////////// Starting of GIF thumb nail creation///////////
	if (@$file_type=="gif")
	{
		$im=ImageCreateFromGIF($original_image_path);
		$width=ImageSx($im);              // Original picture width is stored
		$height=ImageSy($im);                  // Original picture height is stored
		$newimage=imagecreatetruecolor($new_width,$new_height);
		imageCopyResized($newimage,$im,0,0,0,0,$new_width,$new_height,$width,$height);
		if (function_exists("imagegif")) 
		{
			header("Content-type: image/gif");
			ImageGIF($newimage,$file_path);
		}
		elseif (function_exists("imagejpeg")) 
		{
			header("Content-type: image/jpeg");
			ImageJPEG($newimage,$file_path);
		}
		chmod("$file_path",0777);
	}////////// end of gif file thumb nail creation//////////
	
	////////////// starting of JPG thumb nail creation//////////
	
	/*echo $file_type."sdfjkhsdkl";
	
	die();*/
	
	if($file_type=="jpeg" || $file_type=="jpg")
	{
		$im=ImageCreateFromJPEG($original_image_path);
		$width=ImageSx($im);              // Original picture width is stored
		$height=ImageSy($im);             // Original picture height is stored
		$newimage=imagecreatetruecolor($new_width,$new_height);                 
		imageCopyResized($newimage,$im,0,0,0,0,$new_width,$new_height,$width,$height);
		ImageJpeg($newimage,$file_path);
		chmod("$file_path",0777);
		
		/*}
		else
		{
			$GLOBALS['err'] = "Your uploaded file must be of JPG or GIF. Other file types are not allowed<BR>";
		}*/
	}
	if($file_type=="png")
	{
		$im=imagecreatefrompng($original_image_path); 
		$width=ImageSx($im);              // Original picture width is stored
		$height=ImageSy($im);             // Original picture height is stored
		$newimage=imagecreatetruecolor($new_width,$new_height);                 
		imageCopyResized($newimage,$im,0,0,0,0,$new_width,$new_height,$width,$height);
		imagepng($newimage,$file_path);
		chmod("$file_path",0777);
	}
	////////////////  End of JPG thumb nail creation //////////
}
function maintainAspectRatio($FLASH_WIDTH,$image_url)
{
	$arrImageSize = @getimagesize(trim($image_url),$arrImageSize);
	$width = $arrImageSize[0];
	$height = $arrImageSize[1];
	if($width > $FLASH_WIDTH )
	{
		$target_width = $FLASH_WIDTH;
		$target_height = round($height * ($FLASH_WIDTH/$width));
		if($target_height > 150)
		{
			$target_width = round($FLASH_WIDTH * (150/$target_height));
			$target_height = 150;
		}
			
	}
	else
	{
		$target_width = $width;
		if($height > 150)
		{
			$target_height = 150;
			$target_width = round($width * (150/$height));
		}
		else
		{
			$target_height = $height;
		}
	}
	return array("width"=>$target_width,"height"=>$target_height,"image_url"=>$image_url);
}
	
	function getNewDisscussion($mode)
	{		
		if($mode == "allBoards" || $mode == "")
		{
			$sql = "SELECT count(*) FROM (
				(
					SELECT DM.db_id
					FROM db_master DM, db_invitation DINV, member_master MM
					WHERE DINV.db_id = DM.db_id
					AND MM.member_id=DM.member_id 
					AND MM.is_active!='N' 
					AND DINV.member_id = '".$_SESSION['member_id']."'
					AND (";
					
					if($_SESSION['is_pnm'] != 'Y' && $_SESSION['non_greek'] != 'Y')
						$sql .= "DINV.invitation_source = 'National' OR DINV.invitation_source = 'Chapter' OR ";
					
					$sql .= "DINV.invitation_source = 'Campus' OR DINV.invitation_source = 'ALL'
					)
					AND DINV.is_deleted <> 'Y' 
					AND DINV.is_read <> 'Y' 
				)			
				UNION
				(
					SELECT DM.db_id FROM ".DB_MASTER." DM WHERE DM.member_id = '".$_SESSION['member_id']."' AND mem_msg_read <> 'Y')
				) AS NEW_TABLE";				
		}
		if($mode == "campusBoards")
		{
			$sql = "SELECT count(*) FROM ".DB_MASTER." DM, ".DB_INVITATION." DINV, ".MEMBER_MASTER." MM WHERE DINV.db_id = DM.db_id  AND DM.member_id = MM.member_id AND MM.is_active!='N' AND DINV.member_id = '".$_SESSION['member_id']."' AND (DINV.invitation_source = 'Campus' OR DINV.invitation_source = 'Chapter') AND DINV.is_deleted<>'Y' AND DINV.is_read <> 'Y'";
		}
		if($mode == "chapterBoards")
		{
			$sql = "SELECT count(*) FROM ".DB_MASTER." DM, ".DB_INVITATION." DINV, ".MEMBER_MASTER." MM WHERE DINV.db_id = DM.db_id AND DINV.member_id = '".$_SESSION['member_id']."' AND (DINV.invitation_source = 'Campus' OR DINV.invitation_source = 'Chapter') AND DINV.is_deleted<>'Y'  
					AND DINV.is_read <> 'Y' AND MM.is_active!='N' AND DM.member_id = MM.member_id AND MM.fraternity_id = ".$_SESSION['fraternity_id'];
		}
		if($mode == "myBoards")
		{
			$sql = "SELECT count(*) FROM ".DB_MASTER." DM WHERE DM.member_id = '".$_SESSION['member_id']."' AND mem_msg_read <> 'Y'";
		}
		
		$rs = mysql_query($sql) or die(mysql_error()." Error in new discussion count.");
		$rec = mysql_fetch_array($rs);
		$newDisscussion = $rec['0'];
		
		return $newDisscussion;
	}
	
	function getNewMessages()
	{
		//.............Personal.............
		$sql_inbox= "SELECT COUNT(*) FROM  message_transaction MT,message_master MSGM,member_master MM
					WHERE MSGM.msg_id = MT.msg_id  and MM.member_id = MSGM.member_id AND MM.is_active != 'N'";
		$sql_inbox .= " AND ( r_member_id = '".$_SESSION['member_id']."' AND `r_chap_id` = '0' AND r_fra_id = '0')";	
		$sql_inbox .= " AND MT.is_read = 'N'";
		$sql_inbox .= " AND ADDDATE( cast( MSGM.post_date AS date ) , INTERVAL 28 DAY ) >= CURDATE( ) ";		
		$rs_personal_email = mysql_fetch_array(mysql_query($sql_inbox));
		$rec_personal_email = $rs_personal_email['0'];
		
		if($_SESSION['is_pnm'] != 'Y' && $_SESSION['non_greek'] != 'Y')
		{
			//.............Chapter.............
			$sql_inbox= "SELECT count(*) FROM  message_transaction MT,message_master MSGM,member_master MM
							WHERE MSGM.msg_id = MT.msg_id  AND  MM.member_id = MSGM.member_id AND MM.is_active != 'N'";
							
			$sql_inbox .= " AND MSGM.r_member_id = '0' AND (MSGM.r_chap_id = '".$_SESSION['chapter_id']."' OR MSGM.r_uni_id = '".$_SESSION['university_id']."') AND MSGM.r_fra_id = '0'";
			$sql_inbox .= " AND MT.delete_status = '0' AND MT.memberId = '".$_SESSION['member_id']."' AND MT.is_read = 'N'";
			

			$sql_inbox .= " AND ADDDATE( cast( MSGM.post_date AS date ) , INTERVAL 28 DAY ) >= CURDATE( ) ";
			
			$rs_chapter_email = mysql_fetch_array(mysql_query($sql_inbox));
			$rec_chapter_email = $rs_chapter_email['0'];
			
			//.............National.............
			$sql_inbox = "SELECT count(*) FROM  
						message_transaction MT,message_master MSGM,member_master MM WHERE MSGM.msg_id = MT.msg_id and MM.member_id = MSGM.member_id AND MM.is_active != 'N'";
					
			$sql_inbox .= " AND (r_fra_id = '".$_SESSION['fraternity_id']."' AND r_chap_id = '0' AND r_member_id = '0')";
			$sql_inbox .=	"  AND MT.is_read = 'N' AND MT.delete_status = '0' AND MT.memberId = '".$_SESSION['member_id']."'";
			
			$sql_inbox .= " AND ADDDATE( cast( MSGM.post_date AS date ) , INTERVAL 28 DAY ) >= CURDATE( ) ";
			
			$rs_national_email = mysql_fetch_array(mysql_query($sql_inbox));
			$rec_national_email = $rs_national_email['0'];
			
			$inbox_count = $rec_personal_email + $rec_chapter_email + $rec_national_email;
		}
		else
			$inbox_count = $rec_personal_email;
			
		
		
		return $inbox_count;
	}
	
	function getNewDiscussions()
	{
		$sql = "SELECT COUNT(*)
					FROM db_master DM, db_invitation DINV, member_master MM
					WHERE DINV.db_id = DM.db_id
					AND MM.member_id=DM.member_id 
					AND MM.is_active!='N'
					AND DINV.member_id = '".$_SESSION['member_id']."'
					AND (";
					
					if($_SESSION['is_pnm'] != 'Y' && $_SESSION['non_greek'] != 'Y')
						$sql .= "DINV.invitation_source = 'National' OR DINV.invitation_source = 'Chapter' OR ";
					
					$sql .= "DINV.invitation_source = 'Campus' OR DINV.invitation_source = 'ALL'
					)
					AND DINV.is_deleted <> 'Y' AND DINV.is_read <> 'Y'
				 	AND ADDDATE( cast( DM.update_date AS date ) , INTERVAL 28 DAY ) >= CURDATE( )";
			
		$rs = mysql_query($sql) or die(mysql_error()." Error in new discussion count.");
		$rec = mysql_fetch_array($rs);
		$new_dbs = $rec['0'];
		
		return $new_dbs;
	}
	
	function getNewEvents()
	{
		$sql = "SELECT * FROM ( 
					(
						SELECT MM.name, MM.composite_id,MM.fraternity_id,EM.*,EM.street eStreet,EM.city eCity, EM.image AS event_image, date_format(event_start_date,'%b,%d,%Y') as date 
						FROM ".EVENT_MASTER." EM, ".MEMBER_MASTER." MM WHERE EM.member_id = MM.member_id AND EM.member_id = '".$_SESSION['member_id']."' AND MM.is_active!='N' AND ADDDATE(event_end_date, interval 1 day) > CURDATE()
					)
					UNION
					( 
						SELECT MM.name, MM.composite_id,MM.fraternity_id,EM.*,EM.street eStreet,EM.city eCity, EM.image AS event_image, date_format(event_start_date,'%b,%d,%Y') as date 
						FROM ".EVENT_MASTER." EM, ".EVENT_TRANSACTION." ET, ".MEMBER_MASTER." MM WHERE ET.event_id = EM.event_id AND EM.member_id = MM.member_id AND MM.is_active!='N' AND ET.r_member_id = '".$_SESSION['member_id']."' AND (EM.event_section = 'G' OR EM.event_section = 'NG') AND (EM.visibility = 'P' OR EM.visibility = 'S') AND ADDDATE(event_end_date, interval 1 day) > CURDATE()
					)
				)AS EM";
				
		$events = mysql_query($sql) or die(mysql_error()." Error in new discussion count.");
		$new_events = mysql_num_rows($events);
		
		return $new_events;
	}
	
	function RelativeTime($timestamp)
	{
		$difference = time() - $timestamp;	
		
		if($difference > 0)
		{
			$arr = explode(" ",$timestamp);
			
			$getDate = $arr[0];
			$getTime = $arr[1];
			
			$dateArr = explode("-",$getDate);
			$timeArr = explode(":",$getTime);
			
			$yr = $dateArr[0];
			$month = $dateArr[1];
			$day = $dateArr[2];
			
			$hr = $timeArr[0];
			$min = $timeArr[1];
			$sec = $timeArr[2];	
			
			$d1 = mktime($hr,$min,$sec,$month,$day,$yr);
			$d2 = mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y"));
				
			$sec_diff = ($d2-$d1);	
				
			$periods = array("Second(s)", "Minute(s)", "Hour(s)", "Day(s)", "Week(s)","Month(s)", "Year(s)", "Decade(s)");
			$lengths = array("60","60","24","7","30","12","10");
			
			if ($sec_diff > 0) { 
				// this was in the past
				$ending = "ago";
			} 
			else 
			{ 
				// this was in the future
				$sec_diff = -$sec_diff;
				$ending = "to go";
			}		
			
			for($j = 0; $sec_diff >= $lengths[$j]; $j++)
				$sec_diff /= $lengths[$j];		
			$sec_diff = round($sec_diff);
			if($sec_diff != 1) $periods[$j];
			$text = "$sec_diff $periods[$j] $ending";	
		}	
		return $text;
	}

function sortmddata($array, $by, $order, $type)
{       
	$sortby = "sort$by"; //This sets up what you are sorting by
	$firstval = current($array); //Pulls over the first array
	$vals = array_keys($firstval); //Grabs the associate Arrays
	
	foreach ($vals as $init){
		$keyname = "sort$init";
		$$keyname = array();
	}
	
	foreach ($array as $key => $row) {
	   
		foreach ($vals as $names){
			$keyname = "sort$names";
			$test = array();
			$test[$key] = $row[$names];
			$$keyname = array_merge($$keyname,$test);
		   
		}
	
	}         
	
	if ($order == "DESC")
	{   
		if ($type == "num")
		{
			array_multisort($$sortby,SORT_DESC, SORT_NUMERIC,$array);
		} 
		else 
		{
			array_multisort($$sortby,SORT_DESC, SORT_STRING,$array);
		}
	} 
	else 
	{
		if ($type == "num")
		{
			array_multisort($$sortby,SORT_ASC, SORT_NUMERIC,$array);
		} 
		else 
		{
			array_multisort($$sortby,SORT_ASC, SORT_STRING,$array);
		}
	}
	return $array;
}

function generateRandom($n)
{
		$codelenght = $n;
		$newcode_length =0;
		$newcode ='';
		while($newcode_length < $codelenght) {
			$x=1;
			$y=3;
			$part = rand($x,$y);
			if($part==1){$a=48;$b=57;}  // Numbers
			if($part==2){$a=65;$b=90;}  // UpperCase
			if($part==3){$a=97;$b=122;} // LowerCase
			$code_part=chr(rand($a,$b));
			$newcode_length = $newcode_length + 1;
			$newcode = $newcode.$code_part;
		}
		return $newcode;
}


?>
