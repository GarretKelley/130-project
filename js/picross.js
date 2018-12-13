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
        return new Date(_this.timeElapsed).toISOString().slice(14, -5);
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

function getRandom(array) {
    return array[Math.floor(Math.random() * array.length)];
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
            $gameCells.each(function() {
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
            $('#puzzle .top div, #puzzle .left div, #puzzle #cells span').css('borderColor', '#' + val);
        }
    });

    // suggest best
    var $randomGood;
    $('#suggest-best').on('click', function() {
        if (!$randomGood || !$randomGood.is(':not(.yes)[data-val="1"]')) {
            $randomGood = $(getRandom($gameCells.filter(':not(.yes)[data-val="1"]')));
        }
        $randomGood.addClass('suggest-yes');
        setTimeout(function() {
            $randomGood.removeClass('suggest-yes');
        }, 500);
    });

    var $randomWorst;
    $('#suggest-worst').on('click', function() {
        if (!$randomWorst || !$randomWorst.is(':not(.no)[data-val="0"]')) {
            $randomWorst = $(getRandom($gameCells.filter(':not(.no)[data-val="0"]')));
        }
        $randomWorst.addClass('suggest-no');
        setTimeout(function() {
            $randomWorst.removeClass('suggest-no');
        }, 500);
    });
});