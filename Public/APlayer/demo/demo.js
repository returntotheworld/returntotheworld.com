var ap1 = new APlayer({
    element: document.getElementById('player1'),
    narrow: false,
    autoplay: false,
    showlrc: false,
    mutex: true,
    theme: '#e6d0b2',
    preload: 'metadata',
    music: {
        title: 'Preparation',
        author: 'Hans Zimmer/Richard Harvey',
        url: 'http://devtest.qiniudn.com/Preparation.mp3',
        pic: 'http://devtest.qiniudn.com/Preparation.jpg'
    }
});

ap1.on('play', function () {
    console.log('play');
});
ap1.on('play', function () {
    console.log('play play');
});
ap1.on('pause', function () {
    console.log('pause');
});
ap1.on('canplay', function () {
    console.log('canplay');
});
ap1.on('playing', function () {
    console.log('playing');
});
ap1.on('ended', function () {
    console.log('ended');
});
ap1.on('error', function () {
    console.log('error');
});

var ap2 = new APlayer({
    element: document.getElementById('player2'),
    narrow: true,
    autoplay: false,
    showlrc: false,
    mutex: true,
    theme: '#e6d0b2',
    music: {
        title: 'Preparation',
        author: 'Hans Zimmer/Richard Harvey',
        url: 'http://devtest.qiniudn.com/Preparation.mp3',
        pic: 'http://devtest.qiniudn.com/Preparation.jpg'
    }
});

var ap3 = new APlayer({
    element: document.getElementById('player3'),
    narrow: false,
    autoplay: false,
    showlrc: 3,
    mutex: true,
    theme: '#615754',
    music: {
        title: '回レ！雪月花',
        author: '小倉唯',
        url: 'http://devtest.qiniudn.com/回レ！雪月花.mp3',
        pic: 'http://devtest.qiniudn.com/回レ！雪月花.jpg',
        lrc: "/Public/APlayer/demo/あっちゅ～ま青春!.lrc"
    }
});

var ap4 = new APlayer({
    element: document.getElementById('player4'),
    narrow: false,
    autoplay: false,
    showlrc: false,
    mutex: true,
    theme: '#ad7a86',
    music: [
        {
            title: 'あっちゅ～ま青春!',
            author: '七森中☆ごらく部',
            url: 'http://devtest.qiniudn.com/あっちゅ～ま青春!.mp3',
            pic: 'http://devtest.qiniudn.com/あっちゅ～ま青春!.jpg'
        },
        {
            title: 'secret base~君がくれたもの~',
            author: '茅野愛衣',
            url: 'http://devtest.qiniudn.com/secret base~.mp3',
            pic: 'http://devtest.qiniudn.com/secret base~.jpg'
        },
        {
            title: '回レ！雪月花',
            author: '小倉唯',
            url: 'http://devtest.qiniudn.com/回レ！雪月花.mp3',
            pic: 'http://devtest.qiniudn.com/回レ！雪月花.jpg'
        }
    ]
});
var aarr = ["http://7xli4a.com1.z0.glb.clouddn.com/qzone/audio/%E6%8A%98%E5%AD%90%E6%88%8F.mp3","http://7xli4a.com1.z0.glb.clouddn.com/qzone/audio/%E7%BA%A2%E8%89%B2%E9%AB%98%E8%B7%9F%E9%9E%8B.mp3","http://7xli4a.com1.z0.glb.clouddn.com/qzone/audio/%E8%8A%B1%E9%A6%99.mp3"];
var aindex = ~~(Math.random()*aarr.length);
var ap5 = new APlayer({
    element: document.getElementById('player5'),
    narrow: false,
    autoplay: true,
    showlrc: 3,
    mutex: true,
    theme: '#ad7a86',
    music: [
        // {
        //     title:"随机播放曲目",
        //     author: '未知',
        //     url:""+aarr[aindex]+"",
        //     pic: 'http://devtest.qiniudn.com/あっちゅ～ま青春!.jpg',
        //     lrc: '/Public/APlayer/demo/あっちゅ～ま青春!.lrc'
        // },
        {
            title:"リフレクティア",
            author: 'eufonius',
            url:"http://sellmoe.qiniudn.com/リフレクティア.mp3",
            pic: 'http://devtest.qiniudn.com/あっちゅ～ま青春!.jpg',
            lrc: '/Public/APlayer/demo/リフレクティア.lrc'
        },
        // {
        //     title:"歌曲02",
        //     author: '七森中☆ごらく部',
        //     url:"http://www.haook.cn/mp3test/2.mp3",
        //     pic: 'http://devtest.qiniudn.com/あっちゅ～ま青春!.jpg',
        //     lrc: '/Public/APlayer/demo/あっちゅ～ま青春!.lrc'
        // },

        // {
        //     title:"歌曲03",
        //     author: '七森中☆ごらく部',
        //     url:"http://www.haook.cn/mp3test/3.mp3",
        //     pic: 'http://devtest.qiniudn.com/あっちゅ～ま青春!.jpg',
        //     lrc: '/Public/APlayer/demo/あっちゅ～ま青春!.lrc'
        // },
        // {
        //     title:"歌曲05",
        //     author: '七森中☆ごらく部',
        //     url:"http://www.haook.cn/mp3test/5.mp3",
        //     pic: 'http://devtest.qiniudn.com/あっちゅ～ま青春!.jpg',
        //     lrc: '/Public/APlayer/demo/あっちゅ～ま青春!.lrc'
        // },
        // {
        //     title: '折子戏',
        //     author: '张国荣',
        //     url: 'http://7xli4a.com1.z0.glb.clouddn.com/qzone/audio/%E6%8A%98%E5%AD%90%E6%88%8F.mp3',
        //     pic: 'http://devtest.qiniudn.com/あっちゅ～ま青春!.jpg',
        //     lrc: '/Public/APlayer/demo/あっちゅ～ま青春!.lrc'
        // },
        // {
        //     title: '红色高跟鞋',
        //     author: '蔡健雅',
        //     url: 'http://7xli4a.com1.z0.glb.clouddn.com/qzone/audio/%E7%BA%A2%E8%89%B2%E9%AB%98%E8%B7%9F%E9%9E%8B.mp3',
        //     pic: 'http://devtest.qiniudn.com/あっちゅ～ま青春!.jpg',
        //     lrc: '/Public/APlayer/demo/あっちゅ～ま青春!.lrc'
        // },
        // {
        //     title: '花香',
        //     author: '周传雄',
        //     url: 'http://7xli4a.com1.z0.glb.clouddn.com/qzone/audio/%E8%8A%B1%E9%A6%99.mp3',
        //     pic: 'http://devtest.qiniudn.com/あっちゅ～ま青春!.jpg',
        //     lrc: '/Public/APlayer/demo/あっちゅ～ま青春!.lrc'
        // },
        // {
        //     title: 'あっちゅ～ま青春!',
        //     author: '七森中☆ごらく部',
        //     url: 'http://devtest.qiniudn.com/あっちゅ～ま青春!.mp3',
        //     pic: 'http://devtest.qiniudn.com/あっちゅ～ま青春!.jpg',
        //     lrc: '/Public/APlayer/demo/あっちゅ～ま青春!.lrc'
        // },
        // {
        //     title: 'secret base~君がくれたもの~',
        //     author: '茅野愛衣',
        //     url: 'http://devtest.qiniudn.com/secret base~.mp3',
        //     pic: 'http://devtest.qiniudn.com/secret base~.jpg',
        //     lrc: 'http://65.com/Public/APlayer/demo/secret base~君がくれたもの~.lrc'
        // },
        // {
        //     title: '回レ！雪月花',
        //     author: '小倉唯',
        //     url: 'http://devtest.qiniudn.com/回レ！雪月花.mp3',
        //     pic: 'http://devtest.qiniudn.com/回レ！雪月花.jpg',
        //     lrc: '/Public/APlayer/demo/回レ！雪月花.lrc'
        // }
    ]
});

window.onblur = function () { 
    // ap5.volume(0.3)
    // setTimeout(function(){ap5.pause()},5000);
    ap5.pause();
}; 
window.onfocus = function () { 
    // ap5.volume(0.5);
    // ap5.play();
    // setTimeout(function(){ap5.volume(1)},3000);
    ap5.play();
};