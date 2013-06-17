/**
 * Created with JetBrains PhpStorm.
 * User: andrey
 * Date: 6/16/13
 * Time: 5:02 PM
 * To change this template use File | Settings | File Templates.
 */

$(function(){
    $('.cat_switcher').change(function(){
        if($(this).val() == 'by_cat'){
            location.href = "/news/index/viewmode/by_cat";
        }else if($(this).val() == 'as_list'){
            location.href = "/news/index/viewmode/as_list";
        }
    });
});