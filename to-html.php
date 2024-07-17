<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
<style>
@media print {

  .card {
    page-break-before: always;
    page-break-after: always;
    page-break-inside: avoid;
    break-inside: avoid;

    /* 上下留 5% padding */
    padding: 5%;
    /* 一個 card 不會超過一頁的高度，如果超過就截斷不顯示 */
    height: 100vh;
    overflow: hidden;
  }
  /* h1 的字體變大一點，希望至少高度佔 5% */
  h5.h5-10 {
    font-size: 100px;
  }
  h5.h5-20 {
    font-size: 70px;
  }
  h5.h5-30 {
    font-size: 50px;
  }
  .etitle.h5-10 {
    font-size: 70px;
  }
  .etitle.h5-20 {
    font-size: 50px;
  }
  .etitle.h5-30 {
    font-size: 35px;
  }
  .card-header {
    font-size: 50px;
  }
  /* 顯示在頁面右下角絕對位置 */
  .float-end {
      float: right;
      position: absolute;
      right: 5%;
      bottom: 5%;
  }

  p.body {
    font-size: 30px;
  }
}
</style>
<?php

$fp = fopen(__DIR__ . '/open_parliament_0703翻譯.csv', 'r');
$cols = fgetcsv($fp);
$c = 0;
while ($rows = fgetcsv($fp)) {
    /*     [Commitment Unique Identifier] => AL0002
    [Country/Locality] => Albania
    [Action Plan Number] => 1
    [Commitment Number] => 2
    [Code] => ALB
    [Region] => Europe
    [National Or Local] => National
    [Commitment Dummy] => 1
    [Year Of Submission] => 2012
    [Action Plan End Year] => 2014
    [Action Plan Duration (Years)] => 2
    [Theme] => e-Governance: 2012 and Onward
    [Commitment Title] => e-Acts
    [Short Title] => e-Acts
    [Short Title 中文] => 電子法案
    [Full Text] => e-Acts project aims to support the process of preparation, approval and submitting of legal acts (laws, decisions of the Council of Ministers, etc). It offers an extended collaboration process between ministries, working on joint acts and requesting opinions or suggestions within the system. Also, through this system are administered the sessions of the Council of Ministers of the Republic of Albania and are also published all the decisions of these sessions.
    [] => AL0002 電子法案 e-Acts
    [Full Text 中文] => e-Acts 計畫旨在支持法律行為（法律、部長會議的決定等）的準備、批准和提交過程。它提供了各部會之間的擴展協作流程，致力於聯合行動並在系統內徵求意見或建議。此外，透過該系統管理阿爾巴尼亞共和國部長會議的會議，並公佈這些會議的所有決定。
    [Start Date] => NA
    [End Date] => NA
    [Lead Institution] => Council of Ministers
    [Supporting Institution(s)] => National Agency for Information Society
    [Anti-Corruption and Integrity] => 0 */
    $data = array_combine($cols, $rows);
    $id = $data['Commitment Unique Identifier'];
    $country = $data['Country/Locality'];
    $etitle = $data['Short Title'];
    $ctitle = $data['Short Title 中文'];
    $ctext = $data['Full Text 中文'];
    if (mb_strlen($ctitle) < 10) {
        $class = 'h5-10';
    } elseif (mb_strlen($ctitle) < 20) {
        $class = 'h5-20';
    } else {
        $class = 'h5-30';
    } 
    $url = "https://www.opengovpartnership.org/members/" . urlencode(strtolower($country)) . "/commitments/" . urlencode(strtolower($id));
?>
<div class="card">
    <div class="card-header">[<?= $id ?>] <?= $country ?></div>
    <div class="card-body <?= $class ?>">
        <h5 class="card-title <?= $class ?>"><?= htmlspecialchars($ctitle) ?></h5>
        <p class="etitle <?= $class ?>"><?= htmlspecialchars($etitle) ?></p>
        <p class="body"><?= htmlspecialchars(mb_strimwidth($ctext, 0, 300, '...')) ?></p>
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= urlencode($url) ?>" class="float-end">
    </div>
</div>
<?php
    $c ++;
}
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
