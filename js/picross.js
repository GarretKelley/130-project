var stopwatch = (function() {
    var _this = this;
    var intervalID;
    var $clock;
    _this.timeElapsed = 0;
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
        _this.timeElapsed += 1000;
        return new Date(_this.timeElapsed).toISOString().slice(11, -5);
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
    var $wrong = $('span.wrong');
    if ($wrong.length) {
        return false;
    }
    var $elementCells = $('#cells div span[data-val="1"]');
    for (var i = 0; i < $elementCells.length; i++) {
        if (!gameBoard[$elementCells[i].id]) {
            return false;
        }
    }
    return true;
}
    
function showWinModal(mistakes) {
    var numNonSpaceCells = $('#cells div span[data-val="1"]').length;
    var score = Math.max((numNonSpaceCells - mistakes), 0) / numNonSpaceCells;
    var total = score;
    $('#final-score').val(score);
    $('#final-time').val(stopwatch.timeElapsed);
    $('#final-score-text').text(score);
    $('#win-message').css('display', 'flex');
    $('.level-score').each(function() {
        total += Number($(this).text());
    })
    $('#total-score-text').text(total);
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

    function handleClick($clickedCell, cellValue) {
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
                showWinModal(mistakes);
            }
        }
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