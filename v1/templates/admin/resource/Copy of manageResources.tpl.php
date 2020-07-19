<?=boxHeader(array('title'=>'ManageResources.resource.title'))?>
<? $categoryID = input('CategoryID'); ?>
	<tr> 
	<form name="getResources" method="post">
	<input type="hidden" name="SID" value="manageResources" />
	<input type="hidden" name="ResourceType" value="<?=input('ResourceType')?>" />
	<td valign=top bgcolor="#ffffff">
	<?
		echo getLists($out['DB']['ResourceCategories'],$categoryID,array('name'=>'CategoryID','action'=>'submit();'));	
	?>	
		&nbsp;&nbsp;<a href="<?=setting('url')?>manageCategories">[<?=lang('EditResourceCategories.resource.link')?>]</a>
		&nbsp;&nbsp;<a href="<?=setting('url')?>manageResourceTypes">[<?=lang('EditResourceTypes.resource.link')?>]</a>
	</td> 
	</form>
	</tr> 
	<? if(!empty($out['DB']['Resources'][0]['ResourceID'])) {?>
	<form name="manageResources" method="post" onSubmit="submitonce(this)">
		<input type="hidden" name="SID" value="manageResources" />
		<input type="hidden" name="actionMode" value="save" />
		<input type="hidden" name="CategoryID" value="<?=input('CategoryID')?>" />
		<input type="hidden" name="ResourceType" value="<?=input('ResourceType')?>" />
		
		<tr> 
			<td valign="top" bgcolor="#ffffff" class="fieldNames">
					<br/>
					<div align="center">
					<a href="<?=setting('url')?>manageResource/CategoryID/<?=input('CategoryID')?>/ResourceType/<?=input('ResourceType')?>" class="boldLink">[<?=lang('AddResource.resource.link')?>]</a>
					</div>		
					<br/>				
				<table border="0" cellspacing="1" cellpadding="5" width="100%">
					<? foreach($out['DB']['Resources'] as $id=>$row) {?>
					<input type="hidden" name="Resource<?=DTR?>ResourceID[<?=$id?>]" value="<?=$row['ResourceID']?>"/>
					<tr>
						<td valign="top" class="row1" width="1%">
							<img src="<?=setting('layout')?>images/icons/status-<?=$row['PermAll']?>.gif" width="15" height="13"/>
						</td>	
						<td valign="top" class="row1" width="1%">
							<? if($row['PermAll']==1) { ?>
								<input type="checkbox" name="Resource<?=DTR?>PermAll[<?=$id?>]" value="1" checked="checked"/>
							<? } else {?>
								<input type="checkbox" name="Resource<?=DTR?>PermAll[<?=$id?>]" value="1" />							
							<? } ?>
						</td>	
						<td valign="top" align="center" class="row1" width="1%">
							<? if(!empty($row['ResourceIcon'])) { ?>
								<img src="<?=setting('urlfiles').$row['ResourceIcon']?>" border="0"/>
							<? } else {?>
							<img src="<?=setting('layout')?>images/icons/nopicture.gif" width="15" height="13"/>
							<? }?>
						</td>																
						<td valign="top" class="row1" width="70%">
							<?=getValue($row['ResourceTitle'])?>
						</td>
						<!--td valign="top" class="row1">
							<?
							$ResourcePositionUp = $row['ResourcePosition'] - 3;
							$ResourcePositionDown = $row['ResourcePosition'] + 3;
							?>
							<a href="<?=setting('url')?><?=input('SID')?>/Resource<?=DTR?>ResourcePosition/<?=$ResourcePositionUp?>/Resource<?=DTR?>ResourceID/<?=$row['ResourceID']?>/ResourceGroup/<?=$row['ResourceGroupID']?>/actionMode/save1"><img src="<?=setting('layout')?>images/icons/up.gif" border="0" alt="<?=lang('MoveUpResource.resource.tip')?>" hspace="3"  /></a>
							<a href="<?=setting('url')?><?=input('SID')?>/Resource<?=DTR?>ResourcePosition/<?=$ResourcePositionDown?>/Resource<?=DTR?>ResourceID/<?=$row['ResourceID']?>/GroupID/<?=$row['ResourceGroupID']?>/actionMode/save1"><img src="<?=setting('layout')?>images/icons/down.gif" border="0" alt="<?=lang('MoveDownResource.resource.tip')?>" hspace="3"  /></a>
						</td-->						
						<td valign="top" class="row1" width="10%" align="right">
							<!--a href="<?=setting('url')?>manageResource/ResourceID/<?=$row['ResourceID']?>/GroupID/<?=input('GroupID')?>">[<?=lang('-edit')?>]</a>&nbsp;&nbsp;<a href="<?=setting('url')?>manageResources/Resource<?=DTR?>ResourceID/<?=$row['ResourceID']?>/actionMode/delete/GroupID/<?=input('GroupID')?>" onClick="return confirm('<?=lang('AreYouSureToDeleteResource.resource.tip')?>')">[<?=lang('-delete')?>]</a-->
							<select name="manageR<?=$row['ResourceID']?>" onChange="selectLink('manageResources', 'manageR<?=$row['ResourceID']?>', '<?=lang('AreYouSureToDeleteSection.core.tip')?>', '2')">
								<option value="0" selected><?=lang('SelectAction.core.tip')?></option>
								<option value="<?=setting('url')?>manageResource/ResourceID/<?=$row['ResourceID']?>/CategoryID/<?=input('CategoryID')?>/ResourceType/<?=input('ResourceType')?>"><?=lang('-edit')?></option>
								<option value="<?=setting('url')?>manageResources/Resource<?=DTR?>ResourceID/<?=$row['ResourceID']?>/actionMode/delete/CategoryID/<?=input('CategoryID')?>/ResourceType/<?=input('ResourceType')?>"><?=lang('-delete')?></option>
							</select>
							
							<!--br/>
							<a href="<?=setting('url')?>manageResource/ResourceParentID/<?=$row['ResourceParentID']?>/GroupID/<?=input('GroupID')?>/ResourcePosition/<? $newResourcePosition=$row['ResourcePosition'] + 1; echo $newResourcePosition; ?>">[<?=lang('AddResourceAfter.resource.link','nospace')?>]</a>&nbsp;&nbsp;<a href="<?=setting('url')?>manageResource/ResourceParentID/<?=$row['ResourceID']?>/GroupID/<?=input('GroupID')?>/ResourcePosition/1">[<?=lang('AddResourceUnder.resource.link','nospace')?>]</a-->
						</td>										
					</tr>	
				<? } ?>					
				</table>		
			</td> 
		</tr> 
		<tr> 
			<td valign=top bgcolor="#ffffff">
				<input type="submit" value="<?=lang("-save")?>">
			</td> 
		</tr>		
	</form>	
	<?  }// end of  if(!empty($out['DB']['Resources'][0]['ResourceID']))
		else{
	?>
		<tr> 
			<td valign="top" bgcolor="#ffffff" align="center">
					<br/>
					<div align="center">
					<a href="<?=setting('url')?>manageResource/CategoryID/<?=input('CategoryID')?>/ResourceType/<?=input('ResourceType')?>" class="boldLink">[<?=lang('AddResource.resource.link')?>]</a>
					</div>		
					<br/>
				<?=lang('NoResourceFound.resource.tip')?>
				<br><br>
			</td> 
		</tr>
	<? } ?>		
<?=boxFooter()?>