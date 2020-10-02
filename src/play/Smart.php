<?php

require_once "Strategy.php";

class Smart extends Strategy
{
    function GetComputedCoordinates($board)
    {
        for ($i = 0; $i < 6; $i++) {     // Checks Attacking Horizontal groups
            for ($j = 0; $j < 4; $j++) {
                if ($board->board[$i][$j    ] == 0 &&
                    $board->board[$i][$j + 1] == 2 &&
                    $board->board[$i][$j + 2] == 2 &&
                    $board->board[$i][$j + 3] == 2) return $j;

                elseif ($board->board[$i][$j    ] == 2 &&
                        $board->board[$i][$j + 1] == 0 &&
                        $board->board[$i][$j + 2] == 2 &&
                        $board->board[$i][$j + 3] == 2) return ($j + 1);

                elseif ($board->board[$i][$j    ] == 2 &&
                        $board->board[$i][$j + 1] == 2 &&
                        $board->board[$i][$j + 2] == 0 &&
                        $board->board[$i][$j + 3] == 2) return ($j + 2);

                elseif ($board->board[$i][$j    ] == 2 &&
                        $board->board[$i][$j + 1] == 2 &&
                        $board->board[$i][$j + 2] == 2 &&
                        $board->board[$i][$j + 3] == 0) return ($j + 3);
            }
        }

        for ($i = 0; $i < 3; $i++) {     // Checks Attacking vertical groups
            for ($j = 0; $j < 7; $j++) {
                if ($board->board[$i    ][$j] == 0 &&
                    $board->board[$i + 1][$j] == 2 &&
                    $board->board[$i + 2][$j] == 2 &&
                    $board->board[$i + 3][$j] == 2) return $j;
            }
        }

        for ($i = 3; $i < 6; $i++) {     // Checks Attacking Ascending diagonal groups
            for ($j = 0; $j < 4; $j++) {
                if ($board->board[$i    ][$j    ] == 0 &&
                    $board->board[$i - 1][$j + 1] == 2 &&
                    $board->board[$i - 2][$j + 2] == 2 &&
                    $board->board[$i - 3][$j + 3] == 2) return $j;

                elseif ($board->board[$i    ][$j    ] == 2 &&
                        $board->board[$i - 1][$j + 1] == 0 &&
                        $board->board[$i - 2][$j + 2] == 2 &&
                        $board->board[$i - 3][$j + 3] == 2) return ($j + 1);

                elseif ($board->board[$i    ][$j    ] == 2 &&
                        $board->board[$i - 1][$j + 1] == 2 &&
                        $board->board[$i - 2][$j + 2] == 0 &&
                        $board->board[$i - 3][$j + 3] == 2) return ($j + 2);

                elseif ($board->board[$i    ][$j    ] == 2 &&
                        $board->board[$i - 1][$j + 1] == 2 &&
                        $board->board[$i - 2][$j + 2] == 2 &&
                        $board->board[$i - 3][$j + 3] == 0) return ($j + 3);
            }
        }

        for ($i = 3; $i < 6; $i++) {     // Checks Attacking Descending Diagonal groups
            for ($j = 3; $j < 7; $j++) {
                if ($board->board[$i    ][$j    ] == 0 &&
                    $board->board[$i - 1][$j - 1] == 2 &&
                    $board->board[$i - 2][$j - 2] == 2 &&
                    $board->board[$i - 3][$j - 3] == 2) return $j;

                elseif ($board->board[$i    ][$j    ] == 2 &&
                        $board->board[$i - 1][$j - 1] == 0 &&
                        $board->board[$i - 2][$j - 2] == 2 &&
                        $board->board[$i - 3][$j - 3] == 2) return ($j - 1);

                elseif ($board->board[$i    ][$j    ] == 2 &&
                        $board->board[$i - 1][$j - 1] == 2 &&
                        $board->board[$i - 2][$j - 2] == 0 &&
                        $board->board[$i - 3][$j - 3] == 2) return ($j - 2);

                elseif ($board->board[$i    ][$j    ] == 2 &&
                        $board->board[$i - 1][$j - 1] == 2 &&
                        $board->board[$i - 2][$j - 2] == 2 &&
                        $board->board[$i - 3][$j - 3] == 0) return ($j - 3);
            }
        }

        for ($i = 0; $i < 6; $i++) {     // Checks Defending Horizontal groups
            for ($j = 0; $j < 4; $j++) {
                if ($board->board[$i][$j    ] == 0 &&
                    $board->board[$i][$j + 1] == 1 &&
                    $board->board[$i][$j + 2] == 1 &&
                    $board->board[$i][$j + 3] == 1) return $j;

                elseif ($board->board[$i][$j    ] == 1 &&
                        $board->board[$i][$j + 1] == 0 &&
                        $board->board[$i][$j + 2] == 1 &&
                        $board->board[$i][$j + 3] == 1) return ($j + 1);

                elseif ($board->board[$i][$j    ] == 1 &&
                        $board->board[$i][$j + 1] == 1 &&
                        $board->board[$i][$j + 2] == 0 &&
                        $board->board[$i][$j + 3] == 1) return ($j + 2);

                elseif ($board->board[$i][$j    ] == 1 &&
                        $board->board[$i][$j + 1] == 1 &&
                        $board->board[$i][$j + 2] == 1 &&
                        $board->board[$i][$j + 3] == 0) return ($j + 3);
            }
        }

        for ($i = 0; $i < 3; $i++) {     // Checks Defending vertical groups
            for ($j = 0; $j < 7; $j++) {
                if ($board->board[$i    ][$j] == 0 &&
                    $board->board[$i + 1][$j] == 1 &&
                    $board->board[$i + 2][$j] == 1 &&
                    $board->board[$i + 3][$j] == 1) return $j;
            }
        }

        for ($i = 3; $i < 6; $i++) {     // Checks Defending Ascending diagonal groups
            for ($j = 0; $j < 4; $j++) {
                if ($board->board[$i    ][$j    ] == 0 &&
                    $board->board[$i - 1][$j + 1] == 1 &&
                    $board->board[$i - 2][$j + 2] == 1 &&
                    $board->board[$i - 3][$j + 3] == 1) return $j;

                elseif ($board->board[$i    ][$j    ] == 1 &&
                        $board->board[$i - 1][$j + 1] == 0 &&
                        $board->board[$i - 2][$j + 2] == 1 &&
                        $board->board[$i - 3][$j + 3] == 1) return ($j + 1);

                elseif ($board->board[$i    ][$j    ] == 1 &&
                        $board->board[$i - 1][$j + 1] == 1 &&
                        $board->board[$i - 2][$j + 2] == 0 &&
                        $board->board[$i - 3][$j + 3] == 1) return ($j + 2);

                elseif ($board->board[$i    ][$j    ] == 1 &&
                        $board->board[$i - 1][$j + 1] == 1 &&
                        $board->board[$i - 2][$j + 2] == 1 &&
                        $board->board[$i - 3][$j + 3] == 0) return ($j + 3);
            }
        }

        for ($i = 3; $i < 6; $i++) {     // Checks Defending Descending Diagonal groups
            for ($j = 3; $j < 7; $j++) {
                if ($board->board[$i    ][$j    ] == 0 &&
                    $board->board[$i - 1][$j - 1] == 1 &&
                    $board->board[$i - 2][$j - 2] == 1 &&
                    $board->board[$i - 3][$j - 3] == 1) return $j;

                elseif ($board->board[$i    ][$j    ] == 1 &&
                        $board->board[$i - 1][$j - 1] == 0 &&
                        $board->board[$i - 2][$j - 2] == 1 &&
                        $board->board[$i - 3][$j - 3] == 1) return ($j - 1);

                elseif ($board->board[$i    ][$j    ] == 1 &&
                        $board->board[$i - 1][$j - 1] == 1 &&
                        $board->board[$i - 2][$j - 2] == 0 &&
                        $board->board[$i - 3][$j - 3] == 1) return ($j - 2);

                elseif ($board->board[$i    ][$j    ] == 1 &&
                        $board->board[$i - 1][$j - 1] == 1 &&
                        $board->board[$i - 2][$j - 2] == 1 &&
                        $board->board[$i - 3][$j - 3] == 0) return ($j - 3);
            }
        }

        do {
            $xCoordinate = rand(0, 6);
        } while ($board->board[0][$xCoordinate] != 0);

        return $xCoordinate;
    }
}
