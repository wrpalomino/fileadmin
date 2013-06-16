<div id="menu8">
  <ul>
    [?php foreach ($links as $lk): ?]
    
      [?php $selected = $sf_user->setSelectedSubMenuTab($lk) ?]
    
      [?php if (strpos($lk['href'], 'javascript:') === false): ?]
        <li>[?php echo link_to($lk['text'], sfOutputEscaper::unescape($lk['href']), $selected ? array("class" => "selected") : array() ) ?]</li>
      [?php else: ?]
        <li><a href="[?php echo $lk['href']?]">[?php echo $lk['text']?]</a></li>
      [?php endif; ?]
      
    [?php endforeach; ?]
  </ul>
</div>