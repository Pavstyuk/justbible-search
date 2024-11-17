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

$verses = array();
$verses_span = array();

isset($_GET["translation"]) ? $translation = $_GET["translation"] : $translation = "rbo";
isset($_GET["book"]) ? $book_num = ((int) htmlspecialchars($_GET["book"]) - 1) : $book_num = 0;
isset($_GET["chapter"]) ? $chapter = (int) htmlspecialchars($_GET["chapter"]) : $chapter = 0;
isset($_GET["verse"]) ? $verse =  htmlspecialchars($_GET["verse"]) : $verse = 0;
isset($_GET["marked"]) ? $marked =  htmlspecialchars($_GET["marked"]) : $marked = 0;
if (str_contains($verse, ",")) $verses = explode(",", $verse);
if (str_contains($verse, "-")) $verse_span = explode("-", $verse);
if (isset($verse_span) && count($verse_span) > 0) {
    for ($i = $verse_span[0]; $i <= $verse_span[1]; $i++) {
        array_push($verses, $i);
    }
}

// Start Errors ...

if (isset($books_arr[$book_num])) {
    $book = $books_arr[$book_num];
} else {
    echo "<div class='result-error'>Error! Unknown book</div>";
    exit;
}

if (!isset($bible[$book][$chapter]) && $chapter !== 0) {
    echo "<div class='result-error'>Error! Unknown chapter.</div>";
    exit;
}
// End Errors ...

if (count($verses) == 0) array_push($verses, $verse);

if ($chapter == 0) {
    $array = $bible[$book];
    foreach ($array as $num => $chapter) {
        $info = array(
            "translation" => $trans,
            "book" => $book,
            "chapter" => $num,
        );
        $html = buildChapterText($chapter, $info);
        echo $html;
    }
    exit;
}

if ($chapter != 0 && $verses[0] == 0) {
    $array = $bible[$book][$chapter];
    $info = array(
        "translation" => $trans,
        "book" => $book,
        "chapter" => $chapter,
    );
    $html = buildChapterText($array, $info);
    echo $html;
    exit;
}

if (isset($verses) && count($verses) > 0) {
    $array = array();
    foreach ($verses as $ver) {
        if (isset($bible[$book][$chapter][$ver])) {
            $array[$ver] = $bible[$book][$chapter][$ver];
        } else {
            $array[$ver] = null;
        }
    }
    $info = array(
        "translation" => $trans,
        "book" => $book,
        "chapter" => $chapter,
        "verse" => $verses
    );

    $html = buildChapterText($array, $info);
    echo $html;
    exit;
} else {
    echo "<div class='result-error'>Error! Unknown parameters.</div>";
    exit;
}


function buildChapterText(array $text_arr, array $info_arr)
{
    global $marked;

    if (!isset($info_arr["verse"])) {
        $html = "
        <h3>{$info_arr['book']} {$info_arr['chapter']}</h3>
    ";

        foreach ($text_arr as $key => $text) {
            if ((int)$key !== (int)$marked) {
                $html .= "<p><sup>$key</sup>$text</p>";
            } else {
                $html .= "<p class='jbs-marked'><sup>$key</sup>$text</p>";
            }
        }
    } else {
        $html = "<p>";
        foreach ($text_arr as $key => $text) {
            $html .= "<sup>$key</sup>$text ";
        }
        $verse_start = $info_arr['verse'][0];
        $verse_end = $info_arr['verse'][count($info_arr['verse']) - 1];
        $verse_start != $verse_end ? $verses = "$verse_start-$verse_end" : $verses = $verse_start;
        $html .= "<p> <cite>{$info_arr['book']} {$info_arr['chapter']}:$verses</cite>";
    }
    return $html;
}
