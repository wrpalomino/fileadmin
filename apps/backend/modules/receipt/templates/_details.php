<ul style="white-space: nowrap">
  <li>Date: <?php echo $receipt->getDate()?></li>
  <li>For Date: <?php echo $receipt->getForWhatDate()?></li>
  <li>Court Date: <?php echo $receipt->getCourtDate()->getDate()?></li>
  <li>Received by: <?php echo $receipt->getReceivedBy()->obtainFullName()?></li>
</ul>