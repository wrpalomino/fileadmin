<?php
  $paragrah_container = "<div style='line-height:300%; margin-top:-15px;margin-bottom:15px'>";
  $subtitle_container = "<p style='margin-bottom:-20px; font-weight:bold'>";
  $helper->dob_detail = "";
  $helper->content_text = ""; /*"<ol>
    <li class='important'>FAMILY</li>
    ".$paragrah_container."
    Where BORN?<br/>
    Parents names & occupations<br/>
    Who lived with after born?<br/>
    Where grew up?<br/>
    Brothers and sisters?<br/>
    1st name, age and occupation<br/>
    Have siblings been in trouble?<br/>
    Are parents still alive?<br/>
    Any contact with them?<br/>
    Good relationship with Parents?<br/>
    How would you describe childhood?<br/>
    Describe any significant events in your childhood?<br/>
    Describe any significant events in family history<br/>
    Any important extended family members grandparents aunts etc<br/>
    If ward of state - for how long<br/>
    Where lived as ward<br/>
    Contact with family during wardship
    </div>
    
    <li class='important'>EDUCATION</li>
    ".$paragrah_container."
    Where go to primary school?<br/>
    Where go to High School?<br/>
    If more than one school set out schools and years of attendance<br/>
    What was last year at school?<br/>
    Why leave school -ie to go to job<br/>
    Did you enjoy school?<br/>
    Did you have a good social experience at school?<br/>
    How was your academic performance?<br/>
    Any educational problems?<br/>
    Have you completed any other courses?<br/>
    If yes include details and years of attendance<br/>
    University?<br/>
    Tafe?<br/>
    Other?
    </div>
    
    <li class='important'>RELATIONSHIP & CHILDREN</li>
    ".$paragrah_container."
    In relationship?<br/>
    Partner’s name<br/>
    How long for<br/>
    Where do they work?<br/>
    Do you have Children?<br/>
    names<br/>
    ages<br/>
    what is other parent’s name<br/>
    Who live with?<br/>
    How is relationship going?<br/>
    Contact?<br/>
    Kids health problems<br/>
    Other issues with kids<br/>
    Set out details of any significant past relationships
    </div>
          
    <li class='important'>EMPLOYMENT AND FINANCES</li>
    ".$paragrah_container."
    ".$subtitle_container."A. Current job</p>
    Employer<br/>
    Hours of work<br/>
    Can we get reference?<br/>
    How long worked there?<br/>
    Complete work history/chronology (attach CV if one available. Set out previous employers and the years 
    that you worked for them, positions held and respobsibilities etc<br/>
    include reasons for leaving jobs<br/>
    How long out of work before getting next job?<br/>
    How do you feel about your job?<br/>
    What are your future work plans?<br/>
   
    ".$subtitle_container."B. Earnings</p>
    Net wage per week<br/>
    Outgoings<br/>
    Renting or Own house<br/>
    How much pay to fine per week? (if appropriate)<br/>
    Assets<br/>
    Debts<br/>
          
    ".$subtitle_container."C. Benefit</p>
    Type of benefit<br/>
    Amount per week<br/>
    When commenced<br/>
    Family Benefits?
    </div>

    <li class='important'>HEALTH AND SUBSTANCE ABUSE</li>
    ".$paragrah_container."
    ".$subtitle_container."A. Health</p>
    Any health problems as kid?<br/>
    Health problems now?<br/>
    And/or family member<br/>
    Report from Doctor<br/>
    
    ".$subtitle_container."Psychiatric problems</p>
    Diagnosis/diagnoses<br/>
    When first arose<br/>
    Impact on life<br/>
    Reports from GP and Psychiatrist?<br/>
    
    ".$subtitle_container."Substance abuse</p>
    What substances abused<br/>
    Cost per day (eg 1 gram of amphetamine costing $ x)<br/>
    How old when started?<br/>
    What on/who with<br/>
    How much using?<br/>
    Attempts to get off<br/>
    Rehab placements<br/>
    How make them feel /why using?
    </div>
    
    <li class='important'>PRIOR CRIMINAL HISTORY</li>
    ".$paragrah_container."
    Have you been to Court before?<br/>
    When and what for?<br/>
    Include details of each time been to Court<br/>
    What happened and why ?<br/>
    Date or approx date of offending<br/>
    Age when it occurred<br/>
    Sentence received?<br/>
    Impact of the sentence on your life?
    </div>
    
    <li class='important'>OFFENCES BEFORE THE COURT</li>
    ".$paragrah_container."
    Give your version of what happened<br/>
    What was going on in your life that contributed to what happened?<br/>
    How do you feel now about what happened<br/>
    
    ".$subtitle_container."Mitigatory factors</p>
    Have you made any apology?<br/>
    Have you paid compensation or returned goods/money?<br/>
    Has a compensation order been sought against you?<br/>
    Early plea indicated<br/>
    Date?<br/>
    History of plea when plea entered<br/>
    Admissions? (eg in interview)<br/>
    Has there been much delay since the offence?
    </div>
    
    <li class='important'>POST OFFENCE CONDUCT</li>
    ".$paragrah_container."
    What has changed in your life since the offences?<br/>
    Subsequent rehabilitation<br/>
    How have you shown remorse
    </div>
    
    <li class='important'>REPORTS AND WRITTENCHARACTER REFERENCES</li>
    ".$paragrah_container."
    Who do you think could give you a strong written character reference?<br/>
    Have they been prepared?<br/>
    Do you want us to forward an outline of what they should contain?<br/>
    Can anyone else provide a report that would be useful?
    </div>
    
    <li class='important'>CHARACTER EVIDENCE IN COURT</li>
    ".$paragrah_container."
    Who would you suggest we call as a witness in Court to give evidence about you?
    </div>
    
    <li class='important'>MISCELLANEOUS</li>
    ".$paragrah_container."
    Anything else you want to say about the circumstances of the offending?<br/>
    Summarize in a paragraph everything that has happened in your life since the offences and how you now 
    feel about what happened<br/>
    What are your plans for the future?
    </div>
    
    <li class='important'>SENTENCING SUBMISSIONS</li>
    ".$paragrah_container."
    Appropriate disposition and why<br/>
    List supporting propositions briefly eg early plea, rehabilitation<br/>
    Was client on bail for other offences at this time<br/>
    Were they breaching CBO or suspended sentence<br/>
    ".$subtitle_container."IF GAOL</p>
    Totality<br/>
    Concurrency and cumulation<br/>
    Length between minimum and head sentence.<br/>
    What is time served already in custody.<br/>
    Sentencing Act considerations; serious offender, continual offender, confiscation issues.<br/>
    Instructions on forensic samples, sex offenders registry issues
    </div>
    </ol>";*/
?>
<?php echo $helper->get_partial_subfolder('genins', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>