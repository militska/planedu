<?php 

global  $base_url;

  $breadcrumbs[] = l('Главная', null);
  $breadcrumbs[] = l('Специальность', 'node/'.node_load($nid)->parentnid);
  $breadcrumbs[] = l('Учебные планы', 'node/'.node_load($nid)->parentnid.'/planedu');
 
 
  drupal_set_breadcrumb($breadcrumbs);

  $header = array(
    array('data' => 'Индекс'),    
    array('data' => 'Дисциплина'), 
    array('data' => 'Действие'),        
            
  );
    
 foreach (taxonomy_get_tree(variable_get('planedu_cycles')) as $recordtax) {   
    
  print "<h3><i>".taxonomy_term_load($recordtax->tid)->name."</h3></i>";
 
 
   $disc = db_select('planedu_disc', 'pd')
      ->condition('parentnid', $nid)        
      ->condition('parenttid', $recordtax->tid)
      ->orderBy('parenttid', 'DESC')     
      ->fields('pd', array('id', 'disc', 'types', 'parentnid', 'indxdisc','parenttid'))       
      ->execute();   
 
  foreach ($disc as $rec) {
      
    $rows[]= array(     
        $rec->indxdisc,
        $rec -> disc, 
        "<a href='".$base_url."/node/".$nid."/info/".$rec->id."'>
        Подробнее </a>&nbsp•&nbsp
        
        
        <br><a href='".$base_url."/node/".$nid."/info/".$rec->id."/edit'>
        Редактировать</a>
&nbsp•&nbsp
       <a href='".$base_url."/delerec/".$rec->id."/".$nid."'>
         Удалить</a> " 
    );
  }

  print theme('table', array('header' => $header, 'rows' => $rows));  
  unset($rows); 
 }
  
   print node_load($nid)->parentnid;
   print render(drupal_get_form('planedu_newdisc_form', $nid));
