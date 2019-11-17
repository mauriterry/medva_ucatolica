var videos = [];
$(document).ready(function(){
    $('.dropdown-toggle').dropdown();
    $(".carouselsection").carousel({
        quantity : 4,
        sizes : {
          '900' : 3,
          '500' : 1
        }
    });
    $(".banner-video-youtube").each(function(){
        console.log($(this).attr("data-video"));
        var datavideo = $(this).attr("data-video");
        var idvideo = $(this).attr("id");
        var playerDefaults = {autoplay: 0, autohide: 1, modestbranding: 0, rel: 0, showinfo: 0, controls: 0, disablekb: 1, enablejsapi: 0, iv_load_policy: 3};
        var video = {'videoId':datavideo, 'suggestedQuality': 'hd720'};
        videos[videos.length] = new YT.Player(idvideo,{ 'videoId':datavideo, playerVars: playerDefaults,events: {
          'onReady': onAutoPlay,
          'onStateChange': onFinish
        }});
    });
    function onAutoPlay(event){
        event.target.playVideo();
        event.target.mute();
    }
    function onFinish(event) {
        if(event.data === 0) {
            event.target.playVideo();
        }
    }
});