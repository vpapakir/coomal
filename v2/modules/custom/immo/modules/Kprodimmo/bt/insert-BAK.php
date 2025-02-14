<?php
$prepared_query = 'INSERT INTO immo_product
                       (id_page, 
                        datecreate_product_immo, 
                        offer_product_immo, 
                        ref_product_immo, 
                        type_product_immo,
                        price_product_immo, 
                        currency_product_immo , 
                        feeamount_product_immo,
                        feetype_product_immo,
                        feeincex_product_immo,
                        surfacehab_product_immo,
                        surfaceground_product_immo,
                        surfacegroundm2_product_immo,
                        surfacegroundmeasure_product_immo,
                        cellar_product_immo,
                        loft_product_immo,
                        levelnb_product_immo,
                        piecesnb_product_immo,
                        sleepnb_product_immo,
                        bathnb_product_immo,
                        wcnb_product_immo,
                        outhousesnb_product_immo,
                        condition_product_immo,
                        dpe_product_immo,
                        ges_product_immo,
                        heating_product_immo,
                        heatingother_product_immo,
                        insulation_product_immo,
                        window_product_immo,
                        water_product_immo,
                        power_product_immo,
                        phone_product_immo,
                        tv_product_immo,
                        internet_product_immo,
                        furnished_product_immo,
                        agency_product_immo,
                        comdetails_product_immo,
                        remarks_product_immo)
                   VALUES
                        (:id_page,
                         NOW(),
                         :offer,
                         :reference_general,
                         :type_general,
                         :price_general,
                         :currency_general,
                         :feeamount_general,
                         :feetype_general,
                         :feeincex_general,
                         :surfacehab_general,
                         :surfaceground_general,
                         :surfacegroundm2_general,
                         :surfacegroundmeasure_general,
                         :cellar_general,
                         :loft_general,
                         :levelnb_general,
                         :piecesnb_general,
                         :sleepnb_general,
                         :bathnb_general,
                         :wcnb_general,
                         :outhousesnb_general,
                         :condition_general,
                         :dpe_energy,
                         :ges_energy,
                         :heating_energy,
                         :heatingother_energy,
                         :insulation_energy,
                         :window_energy,
                         :water_other,
                         :product_other,
                         :phone_other,
                         :tv_other,
                         :internet_other,
                         :furnished_other,
                         NULL,
                         :comdetails_admin,
                         :remarks_admin)';
if((checkrights($main_rights_log, '9', $redirection)) === true){ $_SESSION['prepared_query'] = $prepared_query; }
$query = $connectData->prepare($prepared_query);
$query->execute(array(
                       'id_page' => $selected_product,
                       'offer' => $kprodimmo_offer_general,
                       'reference_general' => $kprodimmo_reference_general,
                       'type_general' => $kprodimmo_type_general,
                       'price_general' => $kprodimmo_price_general,
                       'currency_general' => $kprodimmo_currency_general,
                       'feeamount_general' => $kprodimmo_fee_general,
                       'feetype_general' => $kprodimmo_feetype_general,
                       'feeincex_general' => $kprodimmo_feeincex_general,
                       'surfacehab_general' => $kprodimmo_surfacehab_general,
                       'surfaceground_general' => $kprodimmo_surfaceground_general,
                       'surfacegroundm2_general' => $kprodimmo_surfacegroundm2_general,
                       'surfacegroundmeasure_general' => $kprodimmo_surfacetype_general,
                       'cellar_general' => $kprodimmo_surfacecellar_general,
                       'loft_general' => $kprodimmo_surfaceloft_general,
                       'levelnb_general' => $kprodimmo_numfloor_general,
                       'piecesnb_general' => $kprodimmo_numrooms_general,
                       'sleepnb_general' => $kprodimmo_numsleeps_general,
                       'bathnb_general' => $kprodimmo_numbath_general,
                       'wcnb_general' => $kprodimmo_numwc_general,
                       'outhousesnb_general' => $kprodimmo_numouthouses_general,
                       'condition_general' => $kprodimmo_condition_general,
                       'dpe_energy' => $kprodimmo_dpe_energy,
                       'ges_energy' => $kprodimmo_ges_energy,
                       'heating_energy' => $kprodimmo_heating_energy,
                       'heatingother_energy' => $kprodimmo_heatingother_energy,
                       'insulation_energy' => $kprodimmo_isolation_energy,
                       'window_energy' => $kprodimmo_window_energy,
                       'water_other' => $kprodimmo_water_other,
                       'product_other' => $kprodimmo_power_other,
                       'phone_other' => $kprodimmo_phone_other,
                       'tv_other' => $kprodimmo_tv_other,
                       'internet_other' => $kprodimmo_internet_other,
                       'furnished_other' => $kprodimmo_furnished_other,
                       'comdetails_admin' => $kprodimmo_comdetails_admin,
                       'remarks_admin' => $kprodimmo_note_admin,
                      ));
$query->closeCursor();
?>
