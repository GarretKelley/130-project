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

function didWin() {
    var $cells = $('.cell');
    var IDs = Object.keys(gameBoard);
    if (IDs.length !== $cells.length) {
        return false;  // can't win if all cells aren't selected
    }
    for (var i = 0; i < IDs.length; i++) {
        if ($('#' + IDs[i]).attr('data-val') != gameBoard[IDs[i]]) {
            return false;
        }
    }
    return true;
}
    
// turns any cell clicked on blue, and right-clicked to grey. 
// starts the timer and increments turns
// determines correct / incorrect moves, score
$(function() {
    var $turnCounter = $('#turnsCounter');
    var turnCounter = 0;
    var $mistakes = $('#mistakesCounter');
    var mistakes = 0;
    var $gameCells = $('#cells span');

    function handleClick($clickedCell, cellValue, backgroundColor) {
        var id = $clickedCell.attr('id');
        var correctValue = $clickedCell.attr('data-val');

        if (!stopwatch.started) {
            stopwatch.start('.stopwatch');
        }

        if (gameBoard[id] !== cellValue) {
            turnCounter += 1;
            $turnCounter.text(turnCounter);

            if (cellValue) {  // left click
                $clickedCell.removeClass('no').addClass('yes');
            } else {
                $clickedCell.removeClass('yes').addClass('no');
            }

            if (cellValue != correctValue) {
                mistakes += 1;
                $mistakes.text(mistakes);
                $clickedCell.addClass('wrong');
            } else {
                $clickedCell.removeClass('wrong');
            }

            gameBoard[id] = cellValue;
            // win condition
            if (didWin()) {
                alert('you win!');
            }
        }

        // add turn
        // if left click, put yes class
        // if right click, put no class
        // if wrong, add mistake put wrong class

        // left click + correct = add turn, put yes class on
        // left click + incorrect = add turn, add mistake, put yes and wrong class on
        // right click + correct = add turn, put no class on
        // right click + incorrect = add turn, add mistake, put no and wrong class on
        // win condition = length yes classes === length elements, and no wrong class on

    }

    $gameCells.on('click', function() {
        handleClick($(this), true);
    });

    $gameCells.on('contextmenu', function(event) {
        handleClick($(this), false);
        event.preventDefault();
    });

    // change cell colors
    $('#bColorOptions').change(function() {
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

    // change grid color
    $('#gColorOptions').change(function(){
        var val = $(this).val();
        if(val) {
            $(".cell").css('borderColor', '#' + val);
        }
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