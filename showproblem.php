<?php     
    require_once("./include/db_info.inc.php");
    $sql ="select * from problem_list ";
    $result = mysqli_query($mysqli,$sql);
    $sum= mysqli_num_rows($result);//计算查询结果有多少行的
?>
<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA_Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>UVA水题系统</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/uva.css" rel="stylesheet">
        <script src="js/uva.js"></script>
    </head>
    <body  onload="onload()">
    <div id="content">
        <a href="intro.txt" target="_blank">系统说明</a>
        <form class="form-inline" action="showtable1.php" style="text-align: center;margin:15px;" onsubmit="return mysubmit();">
            <div class="form-group">
                <label for="exampleInputName2">章节</label>
                <select  class="form-control" name="chap">
                    <option>All</option>
                    <option>-</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                    <option>11</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail2"  >类型</label>
                <select  class="form-control" name="type">
                    <option>All</option>
                    <option>Example</option>
                    <option>Exercise</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail2">UVA题号</label>
                <input type="text" class="form-control" id="exampleInputEmail2" name="fuva_id" >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail2">难度</label>
            </div>
            <button type="submit" class="btn btn-default">查询</button>
        </form>
        <div id='tablecontent'>
        </div>
        <nav aria-label="Page navigation" style="text-align:center;">
            <ul class="pagination" id ="page">
                <li>
                <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
                </li>
                <?php 
                    global $sum;
                    $n=$sum / 10;
                    if($sum%10)$n++;
                    for($i=1;$i<=$n;$i++){
                        print("<li ><a  href='#'>$i</a></li>\n");
                    }
                ?>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
                </li>
            </ul>
        </nav>
    </div>

        <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>