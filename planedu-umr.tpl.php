<?php 
  /*
  while($tmp->parentnid){
    $tmp = node_load($tmp->parentnid);
    $breadcrumb[] = l($tmp->sname, 'node/'.$tmp->nid);
  } 

*/
  $breadcrumbs[] = l('Главная', null);
  $breadcrumbs[] = l('Специальность', 'node/'.node_load($nid)->parentnid);
  $breadcrumbs[] = l('Учебные планы', 'node/'.node_load($nid)->parentnid);
  $breadcrumbs[] = l('Дисциплина', 'node/'.node_load($nid)->parentnid.'/info/'.node_load($nid)->disc);
 
  drupal_set_breadcrumb($breadcrumbs);
   
  print "Разработчик: ".node_load(node_load($nid)->dev)->title."<br>";
  print "Дисциплина: <br>"; 
  print "Учебный план".node_load(node_load($nid)->parentnid)->title."<br>";

  $term = new stdClass();
  $term->name = 'Лолололоша';
  $term->vid = 5;
  taxonomy_term_save($term);
  
drupal_set_message(print_r($term,TRUE));


?>
