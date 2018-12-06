var stopwatch = (function() {
    var _this = this;
    var intervalID;
    var $clock;
    var timeElapsed = 0;
    _this.started = false;

    /**
     * Starts timer, prints to 
     */
    this.start = function(printSelector) {
        var text;
        $clock = $(printSelector);
        $clock.text('00:00:00');

        intervalID = setInterval(function() {
            text = _this.incrementTime();
            $clock.text(text);
        }, 1000);
        _this.started = true;
    };

    /**
     * Increments time by 10 ms.
     * @returns {String} Formatted time.
     */
    this.incrementTime = function() {
        timeElapsed += 1000;
        return new Date(timeElapsed).toISOString().slice(11, -5);
    };

    /**
     * Stops the counting interval.
     */
    this.stop = function() {
        clearInterval(intervalID);
        _this.started = false;
    };

    return this;
})();

var gameBoard = {};
    
// turns any cell clicked on blue, and right-clicked to grey. 
//also starts the timer and increments turns
// starting point for determining correct / incorrect moves, etc.
$(function() {
    var $counter = $('#turnsCounter');
    var counter = 0;

    function handleClick($clickedCell, cellValue, backgroundColor) {
        var id = $clickedCell.attr('id');
        if (gameBoard[id] !== cellValue) {
            counter += 1;
            $counter.text(counter);
        }
        gameBoard[id] = cellValue;
        $clickedCell.css('background-color', backgroundColor);
        if (!stopwatch.started) {
            stopwatch.start('.stopwatch');
        }
    }

    $('.gameTable td.cell').on('click', function() {
        handleClick($(this), true, '#0000FF');
    });

    $('.gameTable td.cell').on('contextmenu', function(event) {
        handleClick($(this), false, '#A9A9A9');
        event.preventDefault();
    });
});

/* potential start point to generate grid using js
$(function(){
    var sizes = [{
        display: "7x7",
        value: "7"
    }, {
        display: "13x13",
        value: "13"
    }];
    var options = ['<option value="">Select size</option>'];
    
    for(var i = 0; i < colors.length; i++){
       options.push('<option value="');
       options.push(colors[i].value);
       options.push('">');
       options.push(colors[i].display);
       options.push('</option>');       
    }
    $('#gSize').html(options.join('')).change(function(){
        var val = $(this).val();
        // do something
    });
});
*/

// change cell colors
$(function() {
    var colors = [{
        display: "Black",
        value: "000000"
    }, {
        display: "Red",
        value: "B22222"
    }, {
        display: "Green",
        value: "228b22"
    }, {
        display: "Blue",
        value: "1E90FF"
    }, {
        display: "Yellow",
        value: "FFD700"
    }];
    var options = ['<option selected value="fff">Default</option>'];
    
    for(var i = 0; i < colors.length; i++){
       options.push('<option value="' + colors[i].value + '">' + colors[i].display + '</option>');    
    }
    $('#bColorOptions').html(options.join('')).change(function() {
        var val = $(this).val();
        if (val) {
            $(".cell").each(function() {
                var $cell = $(this);
                if (!gameBoard.hasOwnProperty($cell.attr('id'))) {
                    $cell.css('backgroundColor', '#' + val);
                }
            });
        }
    });
});

// change grid colors
$(function(){
    var colors = [{
        display: "default",
        value: "ccc"
    }, {
        display: "black",
        value: "000000"
    }, {
        display: "red",
        value: "B22222"
    }, {
        display: "green",
        value: "228b22"
    }, {
        display: "blue",
        value: "1E90FF"
    }, {
        display: "yellow",
        value: "FFD700"
    }];
    var options = ['<option value="">Select color</option>'];
    
    for(var i = 0; i < colors.length; i++){
       options.push('<option value="');
       options.push(colors[i].value);
       options.push('">');
       options.push(colors[i].display);
       options.push('</option>');       
    }
    $('#gColorOptions').html(options.join('')).change(function(){
        var val = $(this).val();
        if(val){
            $(".cell").css('borderColor', '#' + val);
        }
    });
});