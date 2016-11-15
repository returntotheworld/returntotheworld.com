<?php
require_once("../funs.php");
$vid = @$_GET['id'];
if (isID($vid))
    {
        $_SESSION['access'.$vid]=md5(uniqid());
        function pauseicon(){
            echo('<img id="zhuochong" src="http://www.saber.xn--6qq986b3xl/wp-content/uploads/2014/07/1_b.gif" alt="">');
        }
        function danmubutton(){
            echo('<svg height="25" version="1.1" width="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"><desc>Created with Snap</desc><defs></defs><g>
        <path fill="none" stroke="#fd4c5d" stroke-width="5" stroke-linejoin="bevel" d="M5.0916789,20.818994C5.0916789,20.818994,58.908321,20.818994,58.908321,20.818994"></path>
        <path fill="none" stroke="#fd4c5d" stroke-width="5" stroke-linejoin="bevel" d="m 5.1969746,31.909063 53.8166424,0"></path>
        <path fill="none" stroke="#fd4c5d" stroke-width="5" stroke-linejoin="bevel" d="M5.0916788,42.95698C5.0916788,42.95698,58.908321,42.95698,58.908321,42.95698"></path>
    </g></svg>');
        }
        function fullscreenbut(){
            echo('<svg height="25" version="1.1" width="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"><desc>Created with Snap</desc><defs></defs><g>
        <path fill="#fd4c5d" d="m 11.524596,14.485173 15.198613,15.198613 2.92281,-2.92281 -15.198612,-15.198614 z m -4.363231,-7.286041 2.901826,9.91657 7.014745,-7.014745 z" transform="matrix(1,0,0,1,0,0)"></path>
        <path fill="#fd4c5d" d="M 52.475404,14.485173 37.27679,29.683786 34.35398,26.760976 49.552593,11.562362 z m 4.363231,-7.286041 -2.901826,9.91657 -7.014744,-7.014745 z" transform="matrix(1,0,0,1,0,0)"></path>
        <path fill="#fd4c5d" d="m 11.524596,49.514827 15.198613,-15.198614 2.92281,2.92281 -15.198612,15.198614 z m -4.363231,7.286041 2.901826,-9.916571 7.014745,7.014745 z" transform="matrix(1,0,0,1,0,0)"></path>
        <path fill="#fd4c5d" d="M 52.475404,49.514827 37.27679,34.316213 l -2.92281,2.92281 15.198613,15.198614 z m 4.363231,7.286041 -2.901826,-9.916571 -7.014744,7.014745 z" transform="matrix(1,0,0,1,0,0)"></path>
    </g></svg>');
        }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="danmu.css?<?php echo @filemtime('danmu.css');?>">
</head>
<body>
<div  class="playermainbody" allowfullscreen="true" type="danmuplayer" playersse="<?php echo $_SESSION['access'.$vid];?>">
            <div id="videoframe">
                    <iframe id="videoiframe" border=0></iframe>
                    <div id="ctrlcovre">
                        <div id="pauseicon"><?php pauseicon();?></div>
                    </div>
      <div id="tipbox"></div>
                <div class="videopreload" id="videopreload">
      <div class="videopreloadanimationframe">
        <div class="videopreloadanimation shakeanimation"><img id="zhuochong" src="http://saber.xn--6qq986b3xl/wp-content/uploads/2014/07/2.gif" alt=""></div>
      </div>
      <div id="stat"></div>
</div>
            </div>
            <div id="sendbox">
                <input id="danmuinput" name="danmuinput" />
                <div id="fontstylebutton">A<div id="fontpannel">
                    <div id="danmuType">
                        <span>奇行</span>
                        <div id="fromtop" title="顶部">⿵</div>
                        <div id="frombottom" title="底部">⿶</div>
                        <div id="fromright" title="向左" class="selected">←</div>
                        <div id="fromleft" title="向右">→</div>
                    </div>
                    <div id="fontSize">
                        <span>大小</span>
                        <div id="Sizesmall" title="小">C</div>
                        <div id="Sizemiddle" title="中" class="selected">D</div>
                        <div id="Sizebig" title="大">E</div>
                    </div>
                    <div id="fontColor">
                        <span>颜色</span>
                        <input id="colorinput" placeholder="FFFFFF" name="colorInput" />
                        <div id="colorview"></div>
                    </div>
                </div>
                </div>
                <div id="sendbutton">发射</div>
                <div id="sendboxcover"></div>
            </div>
            <div id="controler" onselectstart="return false" >
                <div id="play_pause">
                    <div id="pause" title="暂停">
                        <span type="1"></span>
                        <span type="2"></span>
                    </div>
                    <div id="play" title="播放">
                        <div></div>
                    </div>
                </div>
                <div id="progress">
                    <div id="videocached"></div>
                    <div id="progerssdisplay"></div>
                    <canvas id="danmumark"></canvas>
                    <div id="progersscover"></div>
                </div>
                <div id="time">载入中</div>
                <div id="danmuctrl" title="显示/隐藏弹幕"><?php danmubutton();?></div>
                <div id="volume" title="音量">
                    <div id="voluemstat"><img src="jj.svg" alt=""></div>
                    <div id="range">
                        <div></div>
                    </div>
                    <span>100</span>
                </div>
                <div id="loop" title="循环"><img src="xh.svg" alt=""></div>
                <div id="fullscreen" title="全屏"><?php fullscreenbut();?></div>
            </div>
        </div>
        <script>
        console.log("视频id:<?php echo $vid;?>");
        cmd_url="../command.php"; 
        </script>

    <script src="../command.js?<?php echo @filemtime('../command.js');?>"></script>
        <script src="danmu.js?<?php echo @filemtime('danmu.js');?>"></script>
    <script>
    initPlayer(<?php echo $vid;?>);
    </script>
</body>
</html>
<?php
    }
else
    {
        echo "Error";
    }
?>