<?php
if(isset($_POST['bt_add_country_geo']))
{
    unset($_SESSION['msg_cdrgeo_done']);
    
    unset($_SESSION['msg_cdrgeo_txtNameCDRgeoCountry'],
            $_SESSION['msg_cdrgeo_upload_country']);
    
    unset($_SESSION['cdrgeo_hiddenidCDRgeoCountry']);

    for($i = 0, $count = count($main_activatedidlang); $i < $count; $i++)
    {
       unset($_SESSION['cdrgeo_txtNameCDRgeoCountry'.$main_activatedidlang[$i]]); 
    }

    unset($_SESSION['cdrgeo_cboStatusCDRgeoCountry']);
    
    
    $Bok_cdrgeo_insert = true;
    
    for($i = 0, $count = count($main_activatedidlang); $i < $count; $i++)
    {
        $cdrgeo_name_country[$i] = trim(htmlspecialchars(addslashes($_POST['txtNameCDRgeoCountry'.$main_activatedidlang[$i]]), ENT_QUOTES));
    }
    
    $cdrgeo_status_country = htmlspecialchars($_POST['cboStatusCDRgeoCountry'], ENT_QUOTES);
    $cdrgeo_id_country = htmlspecialchars($_POST['hiddenidCDRgeoCountry'], ENT_QUOTES);
    
    $upload_country = $_FILES['upload_cdrgeo_country']['name'];
    
    for($i = 0, $count = count($cdrgeo_name_country); $i < $count; $i++)
    {
        if(empty($cdrgeo_name_country[0]))
        {
            $Bok_cdrgeo_insert = false;
            $_SESSION['msg_cdrgeo_txtNameCDRgeoCountry'] = 'veuillez indiquer un nom pour cette langue';
            $i = $count;
        }
        
        if($i > 0)
        {
            if(empty($cdrgeo_name_country[$i]))
            {
                $cdrgeo_name_country[$i] = $cdrgeo_name_country[0];
            }
        }
    }
    
    if($Bok_cdrgeo_insert === true)
    {
        try
        {
            $prepared_query = 'SELECT MAX(id_cdrgeo) FROM cdrgeo';
            if((checkrights($main_rights_log, '9', $redirection)) === true){ $_SESSION['prepared_query'] = $prepared_query; }
            $query = $connectData->prepare($prepared_query);
            $query->execute();

            if(($data = $query->fetch()) != false)
            {
                $cdrgeo_id_country = $data[0];
            }

            $cdrgeo_id_country++;
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
        
        if(!empty($upload_country))
        {   
            $_SESSION['msg_cdrgeo_upload_country'] = 
            upload_file('upload_cdrgeo_country',
                        $cdrgeo_id_country.'country', 
                        5242880, 
                        1400, 
                        800, 
                        180, 
                        360,
                        100,
                        200,
                        'images/cdrgeo/original/', 
                        'images/cdrgeo/thumb/',
                        'images/cdrgeo/search/',
                        'id_cdrgeo', 
                        $cdrgeo_id_country,
                        'cdrgeo_image',
                        null,
                        'false');
        }
        
        try
        {
            if(!empty($upload_country))
            {
                $prepared_query = 'SELECT id_image FROM cdrgeo_image
                                   WHERE id_cdrgeo = :id';
                if((checkrights($main_rights_log, '9', $redirection)) === true){ $_SESSION['prepared_query'] = $prepared_query; }
                $query = $connectData->prepare($prepared_query);
                $query->bindParam('id', $cdrgeo_id_country);
                $query->execute();
                
                if(($data = $query->fetch()) != false)
                {
                    $id_image_country = $data[0];
                }
                else
                {
                    $id_image_country = 0;
                }
            }
            
            $prepared_query = 'INSERT INTO cdrgeo
                               (type_cdrgeo, code_cdrgeo, position_cdrgeo, status_cdrgeo,
                                statusobject_cdrgeo, id_image, ';
            
            for($i = 0, $count = count($main_activatedidlang); $i < $count; $i++)
            {
                if($i == ($count - 1))
                {
                    $prepared_query .= 'L'.$main_activatedidlang[$i].')';
                }
                else
                {
                    $prepared_query .= 'L'.$main_activatedidlang[$i].', ';
                }
            }
            
            $prepared_query .= 'VALUES
                                (:type, :code, :position, :status, :statusobject,
                                 :image, ';
            
            for($i = 0, $count = count($main_activatedidlang); $i < $count; $i++)
            {
                if($i == ($count - 1))
                {
                    $prepared_query .= '"'.$cdrgeo_name_country[$i].'")';
                }
                else
                {
                    $prepared_query .= '"'.$cdrgeo_name_country[$i].'", ';
                }
                
                if($main_activatedidlang[$i] == $main_id_language)
                {
                    $cdrgeo_selected_lang = $i;
                }
            }
                                
                               
            if((checkrights($main_rights_log, '9', $redirection)) === true){ $_SESSION['prepared_query'] = $prepared_query; }
            $query = $connectData->prepare($prepared_query);
            $query->execute(array(
                                  'type' => 'dropdown',
                                  'code' => 'cdrgeo_country_situation',
                                  'position' => '1010',
                                  'status' => 1,
                                  'statusobject' => $cdrgeo_status_country,
                                  'image' => $id_image_country
                                  )); 
            $query->closeCursor();
            
            $_SESSION['msg_cdrgeo_done'] = 'Le pays "'.$cdrgeo_name_country[$cdrgeo_selected_lang].'" a été ajouté';
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
    }
    else
    {
        $_SESSION['cdrgeo_hiddenidCDRgeoCountry'] = $cdrgeo_id_country;
        
        for($i = 0, $count = count($main_activatedidlang); $i < $count; $i++)
        {
           $_SESSION['cdrgeo_txtNameCDRgeoCountry'.$main_activatedidlang[$i]] = $cdrgeo_name_country[$i]; 
        }

        $_SESSION['cdrgeo_cboStatusCDRgeoCountry'] = $cdrgeo_status_country;
    }
    
    if($_SESSION['index'] == 'index.php')
    {
        header('Location: '.$config_customheader.$rewritingF_page);
    }
    else
    {
        header('Location: '.$config_customheader.$rewritingB_page);
    }
}
?>
