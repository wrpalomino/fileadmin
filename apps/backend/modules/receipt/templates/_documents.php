<?php $receipt_id = $receipt->getId() ?>
<ul>
  <li><a href="#" onclick="openBox('document/new?doc=paircp&receipt_id=<?php echo $receipt_id?>')">Paid&nbsp;Receipt</a></li>
  <li><a href="#" onclick="openBox('document/new?doc=intrcp&receipt_id=<?php echo $receipt_id?>')">Interim&nbsp;Receipt</a></li>
</ul>