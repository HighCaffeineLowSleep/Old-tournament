<?php

// TODO: Internal leaderboard created, Need to make format for FFA.

header('Content-type: text/javascript');

require_once "Config/DatabaseManager.php";
require_once "Api/Objects/Participant.php";
require_once "Api/Objects/Tournament.php";
require_once "Api/Objects/Stage.php";
require_once "Api/Objects/Matchup.php";
require_once "Api/Objects/Format.php";
require_once "Api/Objects/Leaderboard.php";
require_once "Api/Objects/Team.php";
require_once "Builder/GenerateTeams.php";
require_once "Builder/StageBuilder.php";
require_once "Builder/TournamentBuilder.php";
require_once "Api/Objects/Format.php";
require_once "Api/Objects/MatchStatus.php";

$id = 1;
$database = new DatabaseManager();
$tournamentFromDB = $database->getTournamentById($id);
$stagesFromDB = $database->getStageByTournamentId($database->getTournamentById($id)->getId())
                ?? array(new Stage(-1, "Add Stage", -1, -1, -1));


$tournamentBuilder = new TournamentBuilder($tournamentFromDB, $stagesFromDB);

for($index = 0; $index < sizeof($tournamentBuilder->getStages()); $index++){
    if($index < sizeof($tournamentBuilder->getStages())) {
        //echo "Within Range" . PHP_EOL;
        $tournamentBuilder->getTournament()
            ->getStageByIndex($index)
            ->populateStage($tournamentBuilder->getTournament()->getStageByIndex($index-1) ?? null,
                $tournamentBuilder->getTournament()->getRegisteredParticipants());

//        print_r($tournamentBuilder->getTournament()->getStageByIndex($index));
    } else {
        //echo "Outside of Range" . PHP_EOL;
    }
}

print_r($tournamentBuilder->getTournament()->getStages());


//foreach ($s->getStage()->getMatches() as $match){
//    $matches[] = $match->getMatchData();
//}
//echo (json_encode($matches, JSON_PRETTY_PRINT));

//$stages[0] -> setMatchResult(0, array(1,2), 0);
//$stages[0] -> setMatchResult(0, array(1,2), 1);
//$stages[0] -> setMatchResult(1, array(4,2), 0);
//$stages[0] -> setMatchResult(1, array(4,2), 1);
//$stages[0] -> setMatchResult(2, array(1,2), 0);
//$stages[0] -> setMatchResult(2, array(1,2), 1);
//$stages[0] -> setMatchResult(3, array(1,2), 0);
//$stages[0] -> setMatchResult(3, array(1,2), 1);
//$stages[0] -> setMatchResult(4, array(1,2), 0);
//$stages[0] -> setMatchResult(4, array(1,2), 1);
//$stages[0] -> setMatchResult(5, array(1,2), 1);
//$stages[0] -> setMatchResult(5, array(1,2), 0);
//$stages[0] -> setMatchResult(6, array(1,2), 1);
//$stages[0] -> setMatchResult(6, array(1,2), 0);
//$stages[0] -> setMatchResult(7, array(1,2), 1);
//$stages[0] -> setMatchResult(7, array(1,2), 0);
//$stages[0] -> setMatchResult(8, array(1,2), 1);
//$stages[0] -> setMatchResult(8, array(1,2), 0);
//$stages[0] -> setMatchResult(9, array(1,2), 1);
//$stages[0] -> setMatchResult(9, array(1,2), 0);
//$stages[0] -> setMatchResult(10, array(1,2), 1);
//$stages[0] -> setMatchResult(10, array(1,2), 0);
//$stages[0] -> setMatchResult(11, array(1,2), 1);
//$stages[0] -> setMatchResult(11, array(1,2), 0);
//$stages[0] -> setMatchResult(12, array(1,2), 1);
//$stages[0] -> setMatchResult(12, array(1,2), 0);
//$stages[0] -> isComplete();
//$stages[0]->setInternalPoints();

//$s = array();
//$i=0;
//foreach($stages as $stage){
//    if($i == 0){
//        $participants = $tournament->getRegisteredParticipants();
//    }
//    else{
//        $previousStage = $s[$i-1]->getStage();
//        $previousStage->updateIsComplete();
//        if($previousStage->isComplete()){
//            $participants = $s[$i-1]->getStage()->getSeededParticipants();
//        }
//        else {
//            $participants = array(new Participant(-1));
//        }
//    }
//    $s[] = new StageBuilder($stage, $participants);
//    $i++;
//}
//print_r($s[1]);