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

var isCheating = false;
    
function showWinModal(mistakes) {
    if (isCheating) {
        return;
    }
    var numNonSpaceCells = $('#cells div span[data-val="1"]').length;
    var score = Math.max((numNonSpaceCells - mistakes), 0) / numNonSpaceCells;
    var total = score;
    stopwatch.stop();
    $('#final-score').val(score);
    $('#final-time').val(stopwatch.timeElapsed);
    $('#final-score-text').text(score);
    $('#final-time-text').text(new Date(stopwatch.timeElapsed).toISOString().slice(14, -5));
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
        $('#cells').removeClass().addClass(val);
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
    var className;
    $('#suggest-best').on('click', function() {
        if (!$randomGood || !$randomGood.is('#cells span:not(.no,.yes)[data-val="1"], #cells span.wrong')) {
            $randomGood = $(getRandom($gameCells.filter('#cells span:not(.no,.yes)[data-val="1"]')));
            className = 'suggest-yes';
        }
        if ($randomGood.length === 0) {
            $randomGood = $(getRandom($gameCells.filter('#cells span.wrong')));
            className = ($randomGood.is('[data-val="0"]')) ? 'suggest-no' : 'suggest-yes';
        }
        $randomGood.addClass(className);
        setTimeout(function() {
            $randomGood.removeClass(className);
        }, 500);
    });

    // suggest worst
    var $randomWorst;
    $('#suggest-worst').on('click', function() {
        if (!$randomWorst || !$randomWorst.is('#cells span:not(.no,.yes), #cells span:not(.wrong)')) {
            $randomWorst = $(getRandom($gameCells.filter('#cells span:not(.no,.yes), #cells span:not(.wrong)')));
        }
        if ($randomWorst.attr('data-val') === '0') {
            $randomWorst.addClass('suggest-yes');
        } else {
            $randomWorst.addClass('suggest-no');
        }
        setTimeout(function() {
            $randomWorst.removeClass('suggest-no').removeClass('suggest-yes');
        }, 500);
    });

    // level upload
    $('#level-upload').on('change', function(event) {
        var file = event.target.files[0];
        var canvas = document.createElement('canvas');
        var img = new Image;

        canvas.width = ($('#gSize').val() == '0') ? 7 : 13;
        canvas.height = ($('#gSize').val() == '0') ? 7 : 13;

        img.onload = function() {
            canvas.getContext('2d').drawImage(img, 0, 0, canvas.width, canvas.height);
            canvas.toBlob(function(newFile) {
                var form_data = new FormData();                  
                form_data.set('file', newFile, 'level.jpg');

                var ajaxRequest = new XMLHttpRequest();
                ajaxRequest.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        location.href = this.response;
                    }
                };
                ajaxRequest.open("POST", "ajax/level-upload.php");
                ajaxRequest.send(form_data);
            });
        }
        img.src = URL.createObjectURL(file);
    });
});

function winGame() {
    isCheating = true;
    $('#cells span[data-val="1"]').click();
}