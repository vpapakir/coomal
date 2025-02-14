<tr>
    <td align="left">
        <table width="100%" cellpadding="0" cellspacing="1" border="0">
            <tr>  
                <td align="center" class="block_main2" style="width: 19%;">
                    <div class="font_subtitle" style="text-align: center;"><?php give_translation('message_edit.listing_title_type', '', $config_showtranslationcode); ?></div>
                </td>
                <td align="center" class="block_main2" style="width: 20%;">
                    <div class="font_subtitle" style="text-align: center;"><?php give_translation('message_edit.listing_title_sender', '', $config_showtranslationcode); ?></div>
                </td>
                <td align="center" class="block_main2" style="width: 40%;">
                    <div class="font_subtitle" style="text-align: center;"><?php give_translation('message_edit.listing_title_subject', '', $config_showtranslationcode); ?></div>
                </td>
                <td align="center" class="block_main2" style="width: 15%;">
                    <div class="font_subtitle" style="text-align: center;"><?php give_translation('message_edit.listing_title_date', '', $config_showtranslationcode); ?></div>
                </td>
                <td align="center" class="block_main2" style="width: 6%;">
                    <input id="chk_msgedit_deleted_listingall" type="checkbox" name="chk_msgedit_deleted_all" value="1" <?php if(!empty($_SESSION['msgedit_deleted_chkall']) && $_SESSION['msgedit_deleted_chkall'] == 1){ echo('checked="checked"'); } ?> onclick="check_all('chk_msgedit_deleted_listingall', 'input', 'chk_msgedit_deleted_listing');"/>
                </td>
            </tr>
        </table>
    </td>
</tr>
<?php
try
{
    $msgedit_deleted_bok_listingstyle = false;
    if(empty($_SESSION['msgedit_cboSelectuserMsgEdit']))
    {
        $prepared_query = 'SELECT * FROM email_messages
                           WHERE target_messages = "admin"
                           AND status_messages = 9
                           ORDER BY lastdate_messages DESC';
        if((checkrights($main_rights_log, '9', $redirection)) === true){ $_SESSION['prepared_query'] = $prepared_query; }
        $query = $connectData->prepare($prepared_query);
        $query->execute();
    }
    else
    {
        $prepared_query = 'SELECT * FROM email_messages
                           WHERE target_messages = "admin"
                           AND status_messages = 9
                           AND id_user = :iduser
                           ORDER BY lastdate_messages DESC';
        if((checkrights($main_rights_log, '9', $redirection)) === true){ $_SESSION['prepared_query'] = $prepared_query; }
        $query = $connectData->prepare($prepared_query);
        $query->bindParam('iduser', $_SESSION['msgedit_cboSelectuserMsgEdit']);
        $query->execute();
    }   

    while($data = $query->fetch())
    {
        if($msgedit_deleted_bok_listingstyle === true)
        {
            $msgedit_deleted_listingbgcolor = 'lightgrey'; 
            $msgedit_deleted_bok_listingstyle = false;
        }
        else
        {
            $msgedit_deleted_listingbgcolor = 'white'; 
            $msgedit_deleted_bok_listingstyle = true;
        } 
        $msgedit_remainingtime = converto_timestamp($data['lastdate_messages']);
        $msgedit_remainingtime = $msgedit_remainingtime - $msgedit_elapsedtime;
        $msgedit_remainingtime = number_format(($msgedit_remainingtime / 86400), 0, ',', '.');
        $msgedit_deleted_shortdate = converto_timestamp($data['firstdate_messages']);
        $msgedit_remainingtime_sentence = str_replace('[#remainingtime_msgedit]', $msgedit_remainingtime, give_translation('message_edit.legend_remainingtime', 'false', $config_showtranslationcode));
        $msgedit_deleted_longdate = date('d-m-Y, H:i', $msgedit_deleted_shortdate)."\r\n".$msgedit_remainingtime_sentence;
        $msgedit_deleted_longdate = nl2br($msgedit_deleted_longdate);
        $msgedit_deleted_shortdate = date('d-m-Y', $msgedit_deleted_shortdate);
        
        $msgedit_prepared_query = 'SELECT * FROM user
                                   WHERE id_user = :iduser';
        if((checkrights($main_rights_log, '9', $redirection)) === true){ $_SESSION['prepared_query'] = $msgedit_prepared_query; }
        $msgedit_query = $connectData->prepare($msgedit_prepared_query);
        $msgedit_query->bindParam('iduser', $data['id_user']);
        $msgedit_query->execute();
        if(($msgedit_data = $msgedit_query->fetch()) != false)
        {
            if(!empty($msgedit_data['namecompany_user']))
            {
                $msgedit_deleted_sender = $msgedit_data['namecompany_user'];
                $msgedit_deleted_sender_title = $msgedit_data['namecompany_user']."\r\n".$msgedit_data['firstname_user'].' '.$msgedit_data['name_user']."\r\n".$data['senderemail_messages'];
            }
            else
            {
                $msgedit_deleted_sender = substr($msgedit_data['firstname_user'], 0, 1).'. '.$msgedit_data['name_user'];
                $msgedit_deleted_sender_title = $msgedit_data['firstname_user'].' '.$msgedit_data['name_user']."\r\n".$data['senderemail_messages'];   
            }
        }
        else
        {
            $msgedit_deleted_sender = $data['senderemail_messages'];
            $msgedit_deleted_sender_title = $data['senderemail_messages'];
        }
        $msgedit_query->closeCursor();
        
        $msgedit_deleted_subject = $data['subject_messages'];
        $msgedit_deleted_subject_toreplace = strstr($msgedit_deleted_subject, ']', true);
        $msgedit_deleted_subject = trim(str_replace($msgedit_deleted_subject_toreplace.']', '', $msgedit_deleted_subject));
        $msgedit_deleted_type = give_translation('mail_edit.dd_family_'.$data['type_messages'], 'false', $config_showtranslationcode);
        if((strstr($msgedit_deleted_type, '(', true)) == true)
        {
            $msgedit_deleted_type = strstr($msgedit_deleted_type, '(', true);
        }
        $msgedit_deleted_sender_title = nl2br($msgedit_deleted_sender_title);
?>
        <tr>
            <td align="left" style="background-color: <?php echo($msgedit_deleted_listingbgcolor); ?>;" onmouseover="this.style.backgroundColor = 'lightblue';" onmouseout="this.style.backgroundColor = '<?php echo($msgedit_deleted_listingbgcolor); ?>';">
                <table width="100%" cellpadding="0" cellspacing="1" border="0">
                    <tr>
                        <td class="tooltip" align="left" width="19%" title="<?php echo($msgedit_deleted_type); ?>">                 
                            <a class="link_main" href="<?php echo($config_customheader); ?>index.php?page=<?php echo($_SESSION['current_page']); ?>&amp;idmsg=<?php echo($data[0]); ?>">
                                <span class="font_main" style="margin-left: 4px;">
                                    <?php echo(cut_string($msgedit_deleted_type, 0, 10, '...', true)); ?>
                                </span>
                            </a>
                        </td>
                        <td class="tooltip" align="left" width="20%" title="<?php echo($msgedit_deleted_sender_title); ?>">
                            <span class="font_main" style="margin-left: 4px;">
                                <?php echo(cut_string($msgedit_deleted_sender, 0, 10, '...', true)); ?>
                            </span>
                        </td>
                        <td class="tooltip" align="left" width="40%" title="<?php echo($msgedit_deleted_subject); ?>">
                            <span class="font_main" style="margin-left: 4px;">
                                <?php echo(cut_string($msgedit_deleted_subject, 0, 25, '...', true)); ?>
                            </span> 
                        </td>
                        <td class="tooltip" align="center" width="15%" title="<?php echo($msgedit_deleted_longdate); ?>">
                            <span class="font_main">
                                <?php echo($msgedit_deleted_shortdate); ?>
                            </span> 
                        </td>
                        <td align="center" width="6%">
                            <input class="chk_msgedit_deleted_listing" type="checkbox" name="chk_msgedit_deleted<?php echo($data[0]); ?>" <?php if(!empty($_SESSION['msgedit_deleted_chk'.$data[0]]) && $_SESSION['msgedit_deleted_chk'.$data[0]] == 1){ echo('checked="checked"'); } ?> value="1"/>                                                 
                        </td>
                    </tr>
                </table>
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
<tr>
    <td colspan="2"><div style="height: 4px;"></div></td>
</tr>    
<tr>
    <td colspan="2" style="border-top: 1px solid lightgrey;"><div style="height: 4px;"></div></td>
</tr>
<tr>
    <td colspan="2"><table width="100%">
        <tr>        
            <td align="center">
                <input type="submit" name="bt_settoread_msgedit" value="<?php give_translation('message_edit.bt_settoread', '', $config_showtranslationcode); ?>"/>
                <input type="submit" name="bt_deleted_msgedit" value="<?php give_translation('main.bt_delete', '', $config_showtranslationcode); ?>"/>
            </td>
        </tr> 
    </table></td>
</tr>