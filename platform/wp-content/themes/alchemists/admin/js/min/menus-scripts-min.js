!function($){"use strict";$(document).ready(function(){e.menu_item_mouseup(),e.megamenu_status_update(),e.update_megamenu_fields()});var e={menu_item_mouseup:function(){$(document).on("mouseup",".menu-item-bar",function(m,t){$(m.target).is("a")||setTimeout(e.update_megamenu_fields,300)})},megamenu_status_update:function(){$(document).on("click",".edit-menu-item-alchemists-megamenu-check",function(){var m=$(this).parents(".menu-item:eq( 0 )");$(this).is(":checked")?m.addClass("alchemists-megamenu"):m.removeClass("alchemists-megamenu"),e.update_megamenu_fields()})},update_megamenu_fields:function(){var e=$(".menu-item");e.each(function(m){var t=$(".edit-menu-item-alchemists-megamenu-check",this);if($(this).is(".menu-item-depth-0"))t.attr("checked")&&$(this).addClass("alchemists-megamenu");else{var s=e.filter(":eq("+(m-1)+")");s.is(".alchemists-megamenu")?(t.attr("checked","checked"),$(this).addClass("alchemists-megamenu")):(t.attr("checked",""),$(this).removeClass("alchemists-megamenu"))}})}}}(jQuery);