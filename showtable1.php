<?php 
require_once("./include/db_info.inc.php");
function get_chap($mysqli,$uva_id){
    $sql ="select * from `problem_list` where `uva_id` =  " . $uva_id;
    $result = mysqli_query($mysqli,$sql);
    $row = mysqli_fetch_array($result);
    return $row;
}
function getDirector(){
    $str = substr($_GET['field'],0,1);
    if($str == "1")echo "↑";
    else if($str == "2") echo "↓";
    else echo "-";
}
function print_row($id,$r,$class=" class='active'"){
    $type =( $r['type']==0 )? "例题":"练习";
    $uva_id= $r['uva_id']; 
    $chap =$r['chap'];
    $cid = $r['cid'];
    $title = $r['title'];
    $uts=$r['uts'];
    $usr=$r['usr'];
    print("<tr>\n<td $class>$id</td>\n<td $class>$type</td>\n<td $class>$uva_id</td>\n<td $class>Chap.$chap</td>\n<td $class>$cid</td><td $class><a target='_blank' href='https://vjudge.net/problem#OJId=UVA&probNum=$uva_id&title=&source=&category=all'>$title</a></td><td $class>$uts</td><td $class>$usr%</td></tr>");
}
?>
<table class="table table-hover" tag="">
    <tr id="ths">
        <th class="active">序号</th>
        <th class="active">类型</th>
        <th class="active" id='uva_id' onclick="sort_table(this)">UVA题号<span><?php if(substr($_GET['field'],1)=="uva_id"||substr($_GET['field'],1)=="" )getDirector();else echo "-"; ?></span></th>
        <th class="active" id='chap' onclick="sort_table(this)">章节<span><?php if(substr($_GET['field'],1)=="chap")getDirector(); else  echo "-";?></span></th>
        <th class="active" id='cid' onclick="sort_table(this)">章节题号<span><?php if(substr($_GET['field'],1)=="cid")getDirector(); else echo "-";?></span></th>
        <th class="active" id='title' onclick="sort_table(this)">标题<span><?php if(substr($_GET['field'],1)=="title")getDirector();else echo "-"; ?></span></th>
        <th class="active" id='uts' onclick="sort_table(this)">AC人数<span><?php if(substr($_GET['field'],1)=="uts")getDirector(); else echo "-";?></span></th>
        <th class="active" id='usr' onclick="sort_table(this)">AC率<span><?php if(substr($_GET['field'],1)=="usr")getDirector();else echo "-"; ?></span></th>
    </tr>
    <?php

        $field_value =substr($_GET['field'],0,1);
        $field=" order by " . substr($_GET['field'],1);
        echo $field_value;
        if($field_value == "1")$rule = " ASC";
        else if ($field_value == "2") $rule = " DESC";
        else{
            $rule = " ";
            $field = " ";
        }
        $factor = " where ";
        $is_first = false;

        $row = "";
        if(!empty($_GET['fuva_id'])){
            global $row;
            if($is_first) $factor.= " and ";
            $row = get_chap($mysqli,$_GET['fuva_id']);
            print_row(0,$row,"style='background-color:yellow'");
            $factor .=" `chap` = ". $row['chap'];
            $is_first = true;
        }
        else if(!empty($_GET['chap'])&&$_GET['chap']!='All'){
            if($is_first) $factor.= " and ";
            $factor .=" `chap` = ".$_GET['chap'];
            $is_first = true;
        }
        if(!empty($_GET['type'])&&$_GET['type']!="All"){
            if($is_first) $factor.= " and ";
            $factor .=" `type` = ".($_GET['type']=="Example"?0:1);
            $is_first = true;
        }
        if(!$is_first)$factor = "";
        $pos = (0+($_GET['page']-1)*10);
        $sql ="select * from problem_list ". $factor . $field . $rule . " limit ". ($pos + "") ." ,10";
        print $sql;
        $result = mysqli_query($mysqli,$sql);
        $id = $pos;
        while(($r = mysqli_fetch_array($result))!=NULL){
            $id++;
            if($r['uva_id']==$_GET['fuva_id'])continue;
            print_row($id,$r);
            
        }
    ?>
</table>