<?php

@$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (mysqli_connect_errno() === 1049) {
    die('Ийм нэртэй баз байхгүй.');
} elseif (mysqli_connect_errno() === 1049) {
    die('Хэрэглэгчийн мэдээлэл буруу байна.');
} elseif (mysqli_connect_errno()) {
    die('Алдаа гарлаа : ' . mysqli_connect_errno());
} else {
    echo 'success';
}

function _select(&$stmt, &$count, $sql, $types, $sqlParams,  &  ...$bindParams)
{
    global $con;
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, $types, ...$sqlParams);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $count = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_bind_result($stmt, ...$bindParams);
}

function _exec($sql, $types, $sqlParams, &$count)
{
    global $con;
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, $types, ...$sqlParams);
    $success = mysqli_stmt_execute($stmt);
    $count = mysqli_stmt_affected_rows($stmt);
    _close_stmt($stmt);
    return $success;
}

function _close_stmt($stmt)
{
    mysqli_stmt_close($stmt);
}

function _close($stmt = null)
{
    global $con;
    if (!is_null($stmt)) {
        _close_stmt($stmt);
    }
    mysqli_close($con);
}

function _fetch($stmt)
{
    mysqli_stmt_fetch($stmt);
}
