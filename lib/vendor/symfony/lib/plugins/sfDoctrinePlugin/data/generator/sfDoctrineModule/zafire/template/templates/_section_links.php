<div id="sf_admin_content">
  <ul id="[?php echo $helper->section_links_id?]">
    [?php foreach ($section_links as $lk): ?]
    
      [?php if (isset($lk['target'])): ?]
        <li><a href="[?php echo urldecode($lk['href'])?]" target="[?php echo $lk['target']?]" class="external_lnk">[?php echo $lk['text']?]</a></li>
      [?php elseif ($lk['href'] == '#'): ?]
        <li><a href="[?php echo urldecode($lk['href'])?]" [?php if (isset($lk['js'])) echo htmlspecialchars_decode($lk['js'])?]>[?php echo $lk['text']?]</a></li>      
      [?php else: ?]
        <li>[?php echo link_to($lk['text'], sfOutputEscaper::unescape($lk['href']), $sf_context->getModuleName().'/'.$sf_context->getActionName()==$lk['href'] ? array("class" => "selected") : array() ) ?]</li>
      [?php endif; ?]
      
    [?php endforeach; ?]
  </ul>
</div>