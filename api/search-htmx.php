<?php
if (!isset($_GET["translation"]) || empty($_GET["translation"])) {
    die("Nothing to do");
}

define('STARTED', true);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: text/html; charset=utf-8");

require_once "get-bible.php";

isset($_GET["search"]) ? $query = trim(htmlspecialchars($_GET["search"])) : $query = null;

// Start Errors

if ($query === null || mb_strlen($query) < 3) {
    if ($trans === "nasb") {
        echo "<div class='result-error'><p>Request is to short</p></div>";
    } else {
        echo "<div class='result-error'><p>Слишком короткий запрос</p></div>";
    }
    exit;
}

// End Errors

$results = "";
$count = 0;

foreach ($bible as $book_name => $book) {
    foreach ($book as $chap_num => $chapter) {
        foreach ($chapter as $verse_num => $text) {
            if (str_contains(strtolower($text), strtolower($query))) {
                $book_index = array_search($book_name, $books_arr) + 1;
                $results .= "
                <div class='jbs-result-item'>
                    <p>" . str_replace($query, "<b>$query</b>", $text) . "</p>
                    <div class='jbs-result-description'>
                        <cite>$book_name $chap_num:$verse_num</cite>
                        <button class='jbs-chapter-button'
                            hx-get='/wp-content/plugins/justbible-search/api/text-htmx.php?translation=$trans&book=$book_index&chapter=$chap_num&marked=$verse_num'
                            hx-target='next .jbs-result-item__chapter' hx-swap='innerHTML' hx-trigger='click[isPossible(this)]'
                            data-possible='true'><span></span></button>
                    </div>
                    <div class='jbs-result-item__chapter'></div>
                </div>";
                $count++;
            }
        }
    }
}



if ($count > 0) {
    if ($trans === "nasb") {
        $info = "
        <div class='result-info'>
            <p>The request is <b><i>$query</i></b>, the number founding results is $count</p>
        </div>";
    } else {
        $info = "
        <div class='result-info'>
            <p>На запрос: <b><i>$query</i></b>, найдено результатов:  $count</p>
        </div>";
    }

    echo $info . $results;
    exit;
} else {
    if ($trans === "nasb") {
        echo "<p>Nothing found on your request: <b><i>$query</i></b></p>";
    } else {
        echo "<p>Ничего не найдено по вашему запросу: <b><i>$query</i></b></p>";
    }
    exit;
}
