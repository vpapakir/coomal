<?php
for($i = 0, $count = count($main_activatedidlang); $i < $count; $i++)
{       
?>
    <tr>
<td align="left"><table class="block_expandmain1" width="100%" border="0">
    <tr>
        <td align="left">
            <table id="collapsePageLang<?php echo($main_activatedidlang[$i]); ?>"
<?php
                if(empty($_SESSION['expand_page_lang'.$main_activatedidlang[$i]]) || $_SESSION['expand_page_lang'.$main_activatedidlang[$i]] == 'false')
                {
                    echo('class="block_collapsetitle1"');
                }
                else
                {
                    echo('class="block_expandtitle1"');
                }
?>
                 width="100%" cellpadding="0" cellspacing="0" onclick="expand_collapse_tab('block_expand_collapsePageLang<?php echo($main_activatedidlang[$i]); ?>', 'img_expand_collapsePageLang<?php echo($main_activatedidlang[$i]); ?>', 'expand_page_lang<?php echo($main_activatedidlang[$i]); ?>', '<?php echo($config_customheader.'graphics/icons/expand/plus16x16.gif'); ?>', '<?php echo($config_customheader.'graphics/icons/expand/minus16x16.gif'); ?>', '+', '-', 'Afficher', 'Cacher', 'block_collapsetitle1','block_expandtitle1', 'collapsePageLang<?php echo($main_activatedidlang[$i]); ?>');" style="cursor: pointer;">
                <td align="left">                    
<?php
                        if(empty($_SESSION['expand_page_lang'.$main_activatedidlang[$i]]) || $_SESSION['expand_page_lang'.$main_activatedidlang[$i]] == 'false')
                        {
?>
                            <img id="img_expand_collapsePageLang<?php echo($main_activatedidlang[$i]); ?>" src="<?php echo($config_customheader); ?>graphics/icons/expand/plus16x16.gif" alt="+" title="Afficher"/>
<?php                        
                        }
                        else
                        {
?>
                            <img id="img_expand_collapsePageLang<?php echo($main_activatedidlang[$i]); ?>" src="<?php echo($config_customheader); ?>graphics/icons/expand/minus16x16.gif" alt="-" title="Cacher"/>
<?php
                        }
?>                    
                </td>
                <td width="100%" align="center">
                    <span><?php give_translation($main_activatedcodelang[$i]); ?></span>
                </td>
                <td align="left"></td>
            </table>
            <input id="expand_page_lang<?php echo($main_activatedidlang[$i]); ?>" style="display: none;" type="hidden" name="expand_page_lang<?php echo($main_activatedidlang[$i]); ?>" value="<?php if(empty($_SESSION['expand_page_lang'.$main_activatedidlang[$i]]) || $_SESSION['expand_page_lang'.$main_activatedidlang[$i]] == 'false'){ echo('false'); }else{ echo('true'); } ?>" />
        </td>
    </tr>
    <tr id="block_expand_collapsePageLang<?php echo($main_activatedidlang[$i]); ?>"
<?php
        if(empty($_SESSION['expand_page_lang'.$main_activatedidlang[$i]]) || $_SESSION['expand_page_lang'.$main_activatedidlang[$i]] == 'false')
        {
            echo('style="display: none;"');
        }
        else
        {
            echo(null);
        }
?>
        >
                    <td><table width="100%">    
                        <tr>        
                            <td class="font_subtitle" width="100%">
                                <?php give_translation('page_edit.subtitle_title_language', '', $config_showtranslationcode); ?>
                            </td>
                            <td align="right">
                                <span class="font_main" name="titleL<?php echo($main_activatedidlang[$i]); ?>">150</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input id="txtPageTitleL<?php echo($main_activatedidlang[$i]); ?>"
                                       style="width: 100%;" 
                                       type="text" 
                                       name="txtPageTitleL<?php echo($main_activatedidlang[$i]); ?>" 
                                       onkeyup="onkeyup_setnolimit('txtPageTitleL<?php echo($main_activatedidlang[$i]); ?>', 'txtPageBrowserL<?php echo($main_activatedidlang[$i]); ?>');
                                                charcountdown('txtPageTitleL<?php echo($main_activatedidlang[$i]); ?>', 'titleL<?php echo($main_activatedidlang[$i]); ?>', '150');" 
                                       value="<?php if(!empty($_SESSION['txtPageTitleL'.$main_activatedidlang[$i]])){ echo($_SESSION['txtPageTitleL'.$main_activatedidlang[$i]]); } ?>"/>
                            </td>
                        </tr>
                        <tr>        
                            <td class="font_subtitle">
                                <?php give_translation('page_edit.subtitle_intro_language', '', $config_showtranslationcode); ?>
                            </td> 
                            <td align="right">
<?php 
                                if(empty($_SESSION['page_edit_active_ckEditor']))
                                {
?>
                                    <span class="font_main" name="introL<?php echo($main_activatedidlang[$i]); ?>">250</span>
<?php
                                }
?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea id="areaPageIntroL<?php echo($main_activatedidlang[$i]); ?>" 
                                          style="width: 100%;" rows="4"
                                          name="areaPageIntroL<?php echo($main_activatedidlang[$i]); ?>"
                                          <?php if((!empty($_SESSION['page_edit_active_ckEditor']) && $_SESSION['page_edit_active_ckEditor'] === true) || (!empty($_SESSION['page_property_radPageContent']) && $_SESSION['page_property_radPageContent'] == 'html')){ echo('class="tinyMCE_editor"'); }else{ echo(null); } ?>
                                          onkeyup="charcountdown('areaPageIntroL<?php echo($main_activatedidlang[$i]); ?>', 'introL<?php echo($main_activatedidlang[$i]); ?>', '250');" 
                                          ><?php if(!empty($_SESSION['areaPageIntroL'.$main_activatedidlang[$i]])){ echo($_SESSION['areaPageIntroL'.$main_activatedidlang[$i]]); } ?></textarea>
                            </td>
                        </tr>
                        <tr>        
                            <td class="font_subtitle">
                                <?php give_translation('page_edit.subtitle_desc_language', '', $config_showtranslationcode); ?>
                            </td> 
                            <td></td>
                        </tr> 
                        <tr>
                            <td colspan="2">
                                <textarea style="width: 100%;" rows="8" 
                                          name="areaPageDescL<?php echo($main_activatedidlang[$i]); ?>"
                                          <?php if((!empty($_SESSION['page_edit_active_ckEditor']) && $_SESSION['page_edit_active_ckEditor'] === true) || (!empty($_SESSION['page_property_radPageContent']) && $_SESSION['page_property_radPageContent'] == 'html')){ echo('class="tinyMCE_editor"'); }else{ echo(null); } ?>
                                          ><?php if(!empty($_SESSION['areaPageDescL'.$main_activatedidlang[$i]])){ echo($_SESSION['areaPageDescL'.$main_activatedidlang[$i]]); } ?></textarea>
                            </td>
                            <td></td>
                        </tr>
                        <tr>        
                            <td class="font_subtitle">
                                <?php give_translation('page_edit.subtitle_titlebrowser_language', '', $config_showtranslationcode); ?>
                            </td> 
                            <td align="right">
                                <span class="font_main" name="browserL<?php echo($main_activatedidlang[$i]); ?>">150</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input id="txtPageBrowserL<?php echo($main_activatedidlang[$i]); ?>"
                                       style="width: 100%;"
                                       type="text" 
                                       name="txtPageBrowserL<?php echo($main_activatedidlang[$i]); ?>" 
                                       onkeyup="charcountdown('txtPageBrowserL<?php echo($main_activatedidlang[$i]); ?>', 'browserL<?php echo($main_activatedidlang[$i]); ?>', '150');"
                                       value="<?php if(!empty($_SESSION['txtPageBrowserL'.$main_activatedidlang[$i]])){ echo($_SESSION['txtPageBrowserL'.$main_activatedidlang[$i]]); } ?>"/>
                            </td>
                        </tr>
                        <tr>        
                            <td class="font_subtitle">
                                <?php give_translation('page_edit.subtitle_keywords_language', '', $config_showtranslationcode); ?> <span class="font_main" style="margin-left: 10px;">
                                            [
                                             <span class="link_main" style="cursor: pointer;" onclick="include_generated_text('txtPageTitleL<?php echo($main_activatedidlang[$i]); ?>', 'areaPageTagsL<?php echo($main_activatedidlang[$i]); ?>');"><?php give_translation('page_edit.keywords_addtitle_language', '', $config_showtranslationcode); ?></span>
                                            ]
                                             &nbsp;
                                            [
                                             <span class="link_main" style="cursor: pointer;" onclick="include_generated_text('areaPageIntroL<?php echo($main_activatedidlang[$i]); ?>', 'areaPageTagsL<?php echo($main_activatedidlang[$i]); ?>');"><?php give_translation('page_edit.keywords_addintro_language', '', $config_showtranslationcode); ?></span>
                                            ]
                                          </span>
                            </td> 
                            <td align="right">
                                <span class="font_main" name="tagsL<?php echo($main_activatedidlang[$i]); ?>">250</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea id="areaPageTagsL<?php echo($main_activatedidlang[$i]); ?>"
                                          style="width: 100%;"
                                          name="areaPageTagsL<?php echo($main_activatedidlang[$i]); ?>"
                                          onkeyup="charcountdown('areaPageTagsL<?php echo($main_activatedidlang[$i]); ?>', 'tagsL<?php echo($main_activatedidlang[$i]); ?>', '250');"
                                          ><?php if(!empty($_SESSION['areaPageTagsL'.$main_activatedidlang[$i]])){ echo($_SESSION['areaPageTagsL'.$main_activatedidlang[$i]]); } ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><table width="100%" cellpadding="0" cellspacing="0" border="0">
<?php
                        try
                        {
                            $prepared_query = 'SELECT *
                                               FROM page_image
                                               WHERE id_page = :id
                                               ORDER BY position_image';
                            if((checkrights($main_rights_log, '9', $redirection)) === true){ $_SESSION['prepared_query'] = $prepared_query; }
                            $query = $connectData->prepare($prepared_query);
                            $query->bindParam('id', $_SESSION['page_select_cboPageSelect']);
                            $query->execute();
                            
                            while($data = $query->fetch())
                            {
?>
                                <tr>
                                    <td>
                                        <a class="highslide" href="<?php echo($config_customheader.$data['path_image']); ?>" onclick="return hs.expand(this);"><img src="<?php echo($config_customheader.$data['pathsearch_image']); ?>" style="margin-bottom: 3px; border: 1px solid lightgray;"></img></a>
                                    </td>
                                    <td width="2%"></td>
                                    <td width="100%" style="vertical-align: top;">
                                        <span class="font_main">Légende (Pos: <?php echo($data['position_image']); ?> - Nom: <?php echo($data['name_image']); ?>)</span>
                                        <br clear="left"/>
                                        <textarea style="width: 100%" name="areaListTitleImage<?php echo($data[0]); ?>L<?php echo($main_activatedidlang[$i]); ?>"
                                                  ><?php if(!empty($_SESSION['areaListTitleImage'.$data[0].'L'.$main_activatedidlang[$i]])){ echo($_SESSION['areaListTitleImage'.$data[0].'L'.$main_activatedidlang[$i]]); }; ?></textarea>
                                    </td>
                                </tr>
<?php                        
                            }
                            $query->closeCursor();
                        }
                        catch(Exception $e)
                        {
                            $_SESSION['error400_message'] = $e->getMessage();
                            if($_SESSION['index'] == 'index.php')
                            {
                                die(header('Location: '.$config_customheader.'Error/400'));
                            }
                            else
                            {
                                die(header('Location: '.$config_customheader.'Backoffice/Error/400'));
                            }
                        }
?>
                            </table></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border-top: 1px solid lightgrey;"><table width="100%" style="margin-top: 4px;">
                                <tr>        
                                    <td></td> 
                                    <td></td>
                                    <td width="<?php echo($right_column_width); ?>">
                                        <input type="submit" name="bt_save_page" value="<?php give_translation('page_edit.main_bt_save', '', $config_showtranslationcode); ?>"/>
                                    </td>
                                </tr> 
                            </table></td>
                        </tr>
                    </table></td>
                </tr>              
            </table>
        </td>
    </tr>   
<?php
}
?>
