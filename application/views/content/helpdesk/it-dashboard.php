<div class="container p-4">    
     <main class="container-fluid">
  <h5>IT Helpdesk</h5>
  <br>
  <div class="container p-4">   
 <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper ">
                                        <div class="widget-content-left">
                                          
                                          <span class="bi bi-box h5"></span>
                                                <h5 class="ml-2">Open </h5>
                                                <h5>&nbsp; (<?php echo $Open; ?>  Open Tickets)</h5>
                                            </a>
                                         
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                           <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                          
                                            <span class="bi bi-person h5"></span>
                                         <h5 class="ml-2">Replied</h5>
                                           <h5>&nbsp; (<?php echo $replied; ?> Replied Tickets)</h5>
               
            
                                            </a>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

  </div>
 </div>
<div class="container p-4">   
                      <div class="row">
                         <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                           
                                            <span class="bi bi-person h5"></span>
                                         <h5 class="ml-2">Onhold </h5>
                                         <h5>&nbsp; (<?php echo $onhold; ?> Onhold Tickets)</h5>
                                            </a>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                          
                                            <span class="bi bi-person h5"></span>
                                         <h5 class="ml-2"> Closed </h5>
                                          <h5>&nbsp; (<?php echo $closed; ?> Closed Tickets)</h5>
                                            </a>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                      </div>
                     </div>   
                     <div class="container">
      <h2>Line Chart</h2>
      <div>
        <canvas id="myChart"></canvas>
      </div>
    </div>        

  </div>




</main>


