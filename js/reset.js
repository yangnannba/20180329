(function () {
    var maxWidth = 750;
    document.addEventListener('DOMContentLoaded', function () {
        var deviceWidth = document.documentElement.clientWidth;
        document.documentElement.style.fontSize = deviceWidth / 20 + 'px';
        if(deviceWidth>maxWidth){
            document.documentElement.style.fontSize = maxWidth/20 + 'px';
        }
    }, false);
    window.onresize = function(){
        var deviceWidth = document.documentElement.clientWidth;
        document.documentElement.style.fontSize = deviceWidth / 20 + 'px';
//            alert('You have changed the size of the window')
        if(deviceWidth>maxWidth){
            document.documentElement.style.fontSize = maxWidth/20 + 'px';
        }
    };
})();

