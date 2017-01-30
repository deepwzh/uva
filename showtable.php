<?php
    require_once("./include/db_info.inc.php");
  //  print($sql);
    $arr=array(12,8,6,3);
    print("<table class=\"table\">\n");
    print("<thead>\n<tr>\n<th>班级</th>\n<th>AK率</th>\n<th>优秀率</th>\n<th>良好率</th>\n<th>及格率</th>\n<th>不及格率</th>\n</tr>\n</thead>\n");
    print("<tbody>\n");
    for($k=1;$k<=14;$k++){
        $c=sprintf("%02d",$k);
        $sql ="select * from crank  where user like '20160106$c%' ";
        $result = mysqli_query($mysqli,$sql);
        $sum = mysqli_num_rows($result);//计算查询结果有多少行的
        $i=0;
        foreach ($arr as $t){
            $sql ="select * from crank  where user like '20160106$c%' and solved >=$t ";
          //  print($sql);
            $result = mysqli_query($mysqli,$sql);
            $cnt[$i] = mysqli_num_rows($result);//计算查询结果有多少行的
            $i++;
        }
        $sql ="select * from utc  where user = '20160106$c'  ";
        $result = mysqli_query($mysqli,$sql);
        $row = mysqli_fetch_array($result);
        printf("<tr>\n<th>%s</th>\n<th>%%%.2f</th><th>%%%.2f</th>\n<th>%%%.2f</th>\n<th>%%%.2f</th>\n<th>%%%.2f</th>\n</tr>\n",$row['class'],$cnt[0]*100.0/$sum,$cnt[1]*100.0/$sum,$cnt[2]*100.0/$sum,$cnt[3]*100.0/$sum,100-$cnt[3]*100.0/$sum);
    }
    /*
    while(($row = mysqli_fetch_array($result))!=NULL){

    }
    */
    print("</tbody>\n");
    print("</table>\n");

?>