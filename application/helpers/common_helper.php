<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function show_menus($listmenus,$parent_id = 0,$stt = 0,$char = '' )
{
    $menu_sub = array();
    foreach($listmenus as $key => $item)
    {
        if($item['parent_id'] == $parent_id)
        {
            $menu_sub[] = $item;
            unset($listmenus[$key]);
        }
    }
    if(count($menu_sub))
    {   
        if($stt > 0) {
            echo '<ul class="menu-content">';
            foreach($menu_sub as $key => $item)
            {
                echo '<li><a href="#"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shop">';
                echo $item['name'];
                echo '</a></li>';
            }
            echo '</ul>';
        } else {
            echo '<ul  class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">';
            foreach($menu_sub as $key => $item)
            {
                if($item['parent_id'] == $parent_id){
                    echo '<li class=" navigation-header"><span>'.$item['name'].'</span></li>';
                    echo '<li class=" nav-item">';
                    echo '<a href="" ><i class="feather '.$item['icon'].'"></i><span class="menu-title">'.$item['name'].'</span></a>';
                        show_menus($listmenus,$item['id'],++$stt);
                    echo '</li>';
                }
            }
            echo '</ul>';
        }
    }
}
?>